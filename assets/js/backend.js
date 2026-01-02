jQuery(document).ready(function($) {
    'use strict';

    // Initialize variables
    var mediaFrame;
    var currentMediaButton;
    var currentItemIndex;
    var searchTimeout;

    // Add new story item
    $('.wpas-add-item').on('click', function(e) {
        e.preventDefault();

        var container = $('#wpas-story-items-container');
        var template = $('#wpas-story-item-template').html();
        var newIndex = container.find('.wpas-story-item').length;

        // Replace placeholder with actual index
        var newItem = template.replace(/__INDEX__/g, newIndex);

        // Append to container
        container.append(newItem);

        // Initialize the new item
        initItem($(container.find('.wpas-story-item').last()));

        // Update sortable
        initSortable();
    });

    // Initialize sortable items
    function initSortable() {
        $('#wpas-story-items-container').sortable({
            handle: '.wpas-drag-handle',
            placeholder: 'ui-sortable-placeholder',
            update: function() {
                updateItemIndices();
            }
        });
    }

    // Update indices after sorting
    function updateItemIndices() {
        $('#wpas-story-items-container .wpas-story-item').each(function(index) {
            var $item = $(this);
            var oldIndex = $item.data('index');
            $item.data('index', index);

            // Update all inputs with new index
            $item.find('[name]').each(function() {
                var name = $(this).attr('name');
                if (name && name.includes('[' + oldIndex + ']')) {
                    var newName = name.replace('[' + oldIndex + ']', '[' + index + ']');
                    $(this).attr('name', newName);
                }
            });
        });
    }

    // Initialize a story item
    function initItem($item) {
        var index = $item.data('index');

        // Toggle collapse
        $item.find('.wpas-toggle-collapse').on('click', function(e) {
            e.preventDefault();
            $item.toggleClass('collapsed');
        });

        // Media selection via button click
        $item.find('.wpas-select-media').on('click', function(e) {
            e.preventDefault();
            currentMediaButton = $(this);
            currentItemIndex = index;
            openMediaFrame();
        });

        // Media selection via preview click
        $item.find('.wpas-media-preview').on('click', function(e) {
            e.preventDefault();
            currentMediaButton = $(this).siblings('.wpas-select-media');
            currentItemIndex = index;
            openMediaFrame();
        });

        // Remove media
        $item.find('.wpas-remove-media').on('click', function(e) {
            e.preventDefault();
            var $preview = $(this).closest('.wpas-media-preview');
            $preview.removeClass('has-media').find('img, video').remove();
            $preview.siblings('.wpas-media-id, .wpas-media-url').val('');
            $(this).hide();
            // تغییر متن دکمه انتخاب رسانه
            $preview.siblings('.wpas-select-media').text(wpas_metabox.i18n.select_media);
        });

        // Duplicate item
        $item.find('.wpas-duplicate-item').on('click', function(e) {
            e.preventDefault();
            duplicateItem($item);
        });

        // Delete item
        $item.find('.wpas-delete-item').on('click', function(e) {
            e.preventDefault();
            if (confirm(wpas_metabox.i18n.delete_confirm || 'Are you sure you want to delete this item?')) {
                $item.remove();
                updateItemIndices();
            }
        });

        // Type change
        $item.find('.wpas-item-type').on('change', function() {
            var type = $(this).val();
            var $mediaText = $item.find('.wpas-media-text');
            var $preview = $item.find('.wpas-media-preview');
            var $selectButton = $item.find('.wpas-select-media');

            if (type === 'image') {
                $mediaText.text(wpas_metabox.i18n.select_image);
                $selectButton.text($selectButton.text().replace('Video', 'Image'));
            } else {
                $mediaText.text(wpas_metabox.i18n.select_video);
                $selectButton.text($selectButton.text().replace('Image', 'Video'));
            }

            // Clear current media if type doesn't match
            var currentUrl = $item.find('.wpas-media-url').val();
            if (currentUrl) {
                var currentType = currentUrl.match(/\.(jpg|jpeg|png|gif|webp|avif|svg)$/i) ? 'image' : 'video';
                if (currentType !== type) {
                    $item.find('.wpas-remove-media').click();
                }
            }
        });
    }


    // Duplicate item
    function duplicateItem($originalItem) {
        var container = $('#wpas-story-items-container');
        var newIndex = container.find('.wpas-story-item').length;
        var clone = $originalItem.clone();

        // Update index
        clone.data('index', newIndex);

        // Update all inputs with new index
        clone.find('[name]').each(function() {
            var name = $(this).attr('name');
            var matches = name.match(/\[(\d+)\]/);
            if (matches) {
                var newName = name.replace('[' + matches[1] + ']', '[' + newIndex + ']');
                $(this).attr('name', newName);
                $(this).val($originalItem.find('[name="' + name + '"]').val());
            }
        });

        // Clear title
        clone.find('.wpas-item-title-input').val('');

        // Append after original
        $originalItem.after(clone);

        // Initialize new item
        initItem(clone);

        // Update sortable
        updateItemIndices();
        initSortable();
    }

    // Media uploader - با ساختار جدید
    function openMediaFrame() {
        // بستن frame قبلی اگر وجود دارد
        if (mediaFrame) {
            mediaFrame.detach();
            mediaFrame = null;
        }

        var $item = $('.wpas-story-item[data-index="' + currentItemIndex + '"]');
        var itemType = $item.find('.wpas-item-type').val();

        // تنظیم نوع رسانه بر اساس انتخاب کاربر
        var mediaType = itemType === 'image' ? 'image' : 'video';

        mediaFrame = wp.media({
            title: wpas_metabox.i18n.select_media,
            button: {
                text: wpas_metabox.i18n.use_this_media
            },
            multiple: false,
            library: {
                type: mediaType // فقط نوع انتخاب شده را نمایش بده
            }
        });

        mediaFrame.on('select', function() {
            var attachment = mediaFrame.state().get('selection').first().toJSON();
            var $item = $('.wpas-story-item[data-index="' + currentItemIndex + '"]');

            // بررسی مطابقت نوع رسانه با نوع آیتم (اکنون غیرضروری است چون فیلتر شده)
            var itemType = $item.find('.wpas-item-type').val();
            var mediaType = attachment.type;

            if ((itemType === 'image' && mediaType !== 'image') ||
                (itemType === 'video' && mediaType !== 'video')) {
                alert(wpas_metabox.i18n.media_type_mismatch || 'Please select ' + itemType + ' media');
                return;
            }

            // Update fields
            $item.find('.wpas-media-id').val(attachment.id);
            $item.find('.wpas-media-url').val(attachment.url);

            // Update preview
            var $preview = $item.find('.wpas-media-preview');
            $preview.addClass('has-media');

            if (itemType === 'image') {
                $preview.find('img').remove();
                $preview.append('<img src="' + attachment.url + '" alt="' + (attachment.alt || '') + '">');
            } else {
                $preview.find('video').remove();
                $preview.append('<video controls><source src="' + attachment.url + '" type="' + attachment.mime + '"></video>');
            }

            // Show remove button
            $item.find('.wpas-remove-media').show();

            // Update button text if exists
            if (currentMediaButton && currentMediaButton.length) {
                currentMediaButton.text(wpas_metabox.i18n.change_media);
            }
        });

        mediaFrame.on('close', function() {
            // وقتی مدیا فریم بسته می‌شود، آن را تخریب می‌کنیم
            setTimeout(function() {
                if (mediaFrame) {
                    mediaFrame.detach();
                    mediaFrame = null;
                }
            }, 100);
        });

        mediaFrame.open();

        // فورس کردن رفرش لیست رسانه‌ها
        setTimeout(function() {
            if (mediaFrame && mediaFrame.content && mediaFrame.content.get()) {
                mediaFrame.content.get().collection.props.set({
                    type: mediaType
                });
                mediaFrame.content.get().collection.props.changed = {};
                mediaFrame.content.get().collection.mirroring._hasMore = true;
                mediaFrame.content.get().collection.more();
            }
        }, 300);
    }

    // Related Posts Ajax Search
    $('.wpas-search-input').on('input', function() {
        var $input = $(this);
        var searchTerm = $input.val().trim();
        var $resultsContainer = $('.wpas-search-results');
        var $list = $resultsContainer.find('.wpas-search-results-inner');

        clearTimeout(searchTimeout);

        if (searchTerm.length < 2) {
            $resultsContainer.removeClass('has-results');
            return;
        }

        searchTimeout = setTimeout(function() {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'wpas_search_related_posts',
                    search: searchTerm,
                    nonce: wpas_metabox.nonce
                },
                beforeSend: function() {
                    $resultsContainer.addClass('has-results');
                    $list.html('<div class="wpas-loading-item">Searching...</div>');
                },
                success: function(response) {
                    if (response.success && response.data.length > 0) {
                        var html = '';
                        response.data.forEach(function(post) {
                            html += '<div class="wpas-search-result-item" data-post-id="' + post.id + '" data-post-type="' + post.type + '">' +
                                '<strong>' + post.title + '</strong>' +
                                '<span class="wpas-post-type">(' + post.type_label + ')</span>' +
                                '</div>';
                        });
                        $list.html(html);

                        // Initialize click handlers
                        $('.wpas-search-result-item').on('click', addRelatedPostFromSearch);
                    } else {
                        $list.html('<div class="wpas-no-results">No posts found</div>');
                    }
                },
                error: function() {
                    $list.html('<div class="wpas-error">Error searching posts</div>');
                }
            });
        }, 500);
    });

    function addRelatedPostFromSearch() {
        var $item = $(this);
        var postId = $item.data('post-id');
        var postTitle = $item.find('strong').text();
        var postType = $item.data('post-type');
        var postTypeLabel = $item.find('.wpas-post-type').text().replace(/[()]/g, '');

        // Check if already added
        if ($('#wpas-related-posts-list').find('[value="' + postId + '"]').length > 0) {
            alert(wpas_metabox.i18n.already_added || 'This post is already added');
            return;
        }

        // Add to list
        var html = '<div class="wpas-related-post-item" data-post-id="' + postId + '">' +
            '<input type="hidden" name="wpas_related_posts[]" value="' + postId + '">' +
            '<div class="wpas-related-post-content">' +
            '<strong>' + postTitle + '</strong>' +
            '<span class="wpas-post-type">(' + postTypeLabel + ')</span>' +
            '</div>' +
            '<button type="button" class="button-link wpas-remove-related-post">' +
            '<span class="dashicons dashicons-no-alt"></span>' +
            '</button>' +
            '</div>';

        $('#wpas-related-posts-list').append(html);

        // Remove from search results
        $item.remove();

        // Clear search if no results left
        if ($('.wpas-search-result-item').length === 0) {
            $('.wpas-search-results').removeClass('has-results');
            $('.wpas-search-input').val('');
        }

        // Initialize remove button
        $('#wpas-related-posts-list .wpas-related-post-item:last-child .wpas-remove-related-post').on('click', removeRelatedPost);
    }

    // Original add related post (برای backward compatibility)
    $('.wpas-add-related-post-btn').on('click', function(e) {
        e.preventDefault();

        var $select = $('#wpas-related-post-select');
        var postId = $select.val();
        var postTitle = $select.find('option:selected').text();
        var postType = $select.find('option:selected').data('type');

        if (!postId) {
            alert(wpas_metabox.i18n.select_post || 'Please select a post');
            return;
        }

        // Check if already added
        if ($('#wpas-related-posts-list').find('[value="' + postId + '"]').length > 0) {
            alert(wpas_metabox.i18n.already_added || 'This post is already added');
            return;
        }

        // Add to list
        var html = '<div class="wpas-related-post-item" data-post-id="' + postId + '">' +
            '<input type="hidden" name="wpas_related_posts[]" value="' + postId + '">' +
            '<div class="wpas-related-post-content">' +
            '<strong>' + postTitle + '</strong>' +
            '<span class="wpas-post-type">(' + postType + ')</span>' +
            '</div>' +
            '<button type="button" class="button-link wpas-remove-related-post">' +
            '<span class="dashicons dashicons-no-alt"></span>' +
            '</button>' +
            '</div>';

        $('#wpas-related-posts-list').append(html);

        // Remove from select
        $select.find('option:selected').remove();
        $select.val('');

        // Initialize remove button
        $('#wpas-related-posts-list .wpas-related-post-item:last-child .wpas-remove-related-post').on('click', removeRelatedPost);
    });

    function removeRelatedPost() {
        var $item = $(this).closest('.wpas-related-post-item');

        // Remove from list
        $item.remove();
    }

    // Initialize all existing items
    $('.wpas-story-item').each(function() {
        initItem($(this));
    });

    // Initialize sortable
    initSortable();

    // Initialize remove buttons for existing related posts
    $('.wpas-remove-related-post').on('click', removeRelatedPost);
});