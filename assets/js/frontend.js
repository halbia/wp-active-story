(function($) {
    'use strict';

    var WPAS = {
        init: function() {
            this.currentStory = null;
            this.currentIndex = 0;
            this.progressInterval = null;
            this.bindEvents();
        },

        bindEvents: function() {
            // Open story when circle is clicked
            $(document).on('click', '.wpas-story-circle', function() {
                var $this = $(this);
                WPAS.openStory($this);
            });

            // Close popup
            $(document).on('click', '.wpas-popup-close, .wpas-popup-overlay', function() {
                WPAS.closePopup();
            });

            // Navigation
            $(document).on('click', '.wpas-popup-prev', function() {
                WPAS.prevItem();
            });

            $(document).on('click', '.wpas-popup-next', function() {
                WPAS.nextItem();
            });

            // Keyboard navigation
            $(document).on('keydown', function(e) {
                if ($('#wpas-story-popup').is(':visible')) {
                    if (e.key === 'Escape') {
                        WPAS.closePopup();
                    } else if (e.key === 'ArrowLeft') {
                        WPAS.prevItem();
                    } else if (e.key === 'ArrowRight') {
                        WPAS.nextItem();
                    }
                }
            });
        },

        openStory: function($circle) {
            var items = $circle.data('items');
            var author = $circle.data('author');
            var avatar = $circle.data('avatar');

            if (!items || items.length === 0) return;

            this.currentStory = items;
            this.currentIndex = 0;

            // Set user info
            $('.wpas-popup-username').text(author);
            $('.wpas-popup-avatar').attr('src', avatar);

            // Setup progress bars
            this.setupProgressBars(items.length);

            // Load first item
            this.loadItem(this.currentIndex);

            // Show popup
            $('#wpas-story-popup').fadeIn();
            $('body').css('overflow', 'hidden');

            // Start progress
            this.startProgress();
        },

        setupProgressBars: function(count) {
            var $container = $('.wpas-popup-progress');
            $container.empty();

            for (var i = 0; i < count; i++) {
                $container.append(
                    '<div class="wpas-popup-progress-bar">' +
                    '<div class="wpas-progress-fill"></div>' +
                    '</div>'
                );
            }
        },

        loadItem: function(index) {
            if (!this.currentStory || index < 0 || index >= this.currentStory.length) {
                return;
            }

            this.currentIndex = index;
            var item = this.currentStory[index];
            var $mediaContainer = $('.wpas-popup-media');

            // Clear previous media
            $mediaContainer.empty();

            // Load new media
            if (item.type === 'image') {
                $mediaContainer.html('<img src="' + item.media_url + '" alt="' + item.title + '">');
            } else if (item.type === 'video') {
                $mediaContainer.html(
                    '<video autoplay controls>' +
                    '<source src="' + item.media_url + '" type="video/mp4">' +
                    '</video>'
                );
            }

            // Update progress bars
            this.updateProgressBars(index);
        },

        startProgress: function() {
            this.stopProgress();

            if (!this.currentStory || this.currentIndex >= this.currentStory.length) return;

            var item = this.currentStory[this.currentIndex];
            var duration = (item.duration || 5) * 1000;
            var $progressBar = $('.wpas-progress-fill').eq(this.currentIndex);
            var startTime = Date.now();

            this.progressInterval = setInterval(function() {
                var elapsed = Date.now() - startTime;
                var progress = (elapsed / duration) * 100;

                if (progress <= 100) {
                    $progressBar.css('width', progress + '%');
                } else {
                    WPAS.nextItem();
                }
            }, 50);
        },

        stopProgress: function() {
            if (this.progressInterval) {
                clearInterval(this.progressInterval);
                this.progressInterval = null;
            }
        },

        updateProgressBars: function(index) {
            $('.wpas-progress-fill').each(function(i) {
                $(this).css('width', i < index ? '100%' : i === index ? '0%' : '0%');
            });
        },

        nextItem: function() {
            if (this.currentIndex < this.currentStory.length - 1) {
                this.currentIndex++;
                this.loadItem(this.currentIndex);
                this.startProgress();
            } else {
                this.closePopup();
            }
        },

        prevItem: function() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
                this.loadItem(this.currentIndex);
                this.startProgress();
            }
        },

        closePopup: function() {
            this.stopProgress();
            $('#wpas-story-popup').fadeOut();
            $('body').css('overflow', '');
            this.currentStory = null;
            this.currentIndex = 0;
        }
    };

    $(document).ready(function() {
        WPAS.init();
    });

})(jQuery);