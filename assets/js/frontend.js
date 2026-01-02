(function($) {
    'use strict';

    var WPAS = {
        init: function() {
            // Initialize properties
            this.allStories = [];
            this.currentStory = null;
            this.currentStoryIndex = 0;
            this.currentItemIndex = 0;
            this.progressInterval = null;
            this.pauseStartTime = 0;
            this.remainingTime = 0;
            this.isPaused = false;
            this.currentProgress = 0;
            this.isRTL = $('body').hasClass('rtl') || $('html').attr('dir') === 'rtl';
            this.bindEvents();
        },

        bindEvents: function() {
            var self = this;

            // Open story when circle is clicked
            $(document).on('click', '.wpas-story-circle', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var $this = $(this);
                var index = $this.closest('.wpas-stories-slider').find('.wpas-story-circle').index($this);

                self.collectAllStories();
                self.openStory($this, index);
            });

            // Close popup
            $(document).on('click', '.wpas-popup-close, .wpas-popup-overlay', function(e) {
                e.preventDefault();
                e.stopPropagation();
                self.closePopup();
            });

            // Navigation - handle both RTL and LTR
            $(document).on('click', '.wpas-popup-prev', function(e) {
                e.preventDefault();
                e.stopPropagation();
                // In RTL, prev button should go to next item (visually right)
                if (self.isRTL) {
                    self.prevItem();
                } else {
                    self.nextItem();
                }
            });

            $(document).on('click', '.wpas-popup-next', function(e) {
                e.preventDefault();
                e.stopPropagation();
                // In RTL, next button should go to previous item (visually left)
                if (self.isRTL) {
                    self.nextItem();
                } else {
                    self.prevItem();
                }
            });

            // Keyboard navigation - always work the same regardless of RTL
            $(document).on('keydown', function(e) {
                if ($('#wpas-story-popup').is(':visible')) {
                    switch(e.key) {
                        case 'Escape':
                            self.closePopup();
                            break;
                        case 'ArrowLeft':
                            if (self.isRTL) {
                                self.nextItem();
                            } else {
                                self.prevItem();
                            }
                            break;
                        case 'ArrowRight':
                            if (self.isRTL) {
                                self.prevItem();
                            } else {
                                self.nextItem();
                            }
                            break;
                        case ' ':
                            self.togglePause();
                            e.preventDefault();
                            break;
                    }
                }
            });

            // Pause on hover
            $(document).on('mouseenter', '.wpas-popup-content', function() {
                if (!self.isPaused) {
                    self.pauseProgress();
                }
            }).on('mouseleave', '.wpas-popup-content', function() {
                if (self.isPaused) {
                    self.resumeProgress();
                }
            });

            // Handle video ended
            $(document).on('ended', '.wpas-popup-media video', function() {
                self.nextItem();
            });

            // Handle progress bar click
            $(document).on('click', '.wpas-popup-progress-bar', function(e) {
                e.stopPropagation();
                var index = $(this).index();
                if (index !== self.currentItemIndex) {
                    self.goToItem(index);
                }
            });
        },

        collectAllStories: function() {
            this.allStories = [];

            $('.wpas-story-circle').each(function(index, element) {
                var $element = $(element);
                var items = $element.data('items');
                var author = $element.data('author');
                var avatar = $element.data('avatar');

                if (items && author !== undefined) {
                    WPAS.allStories.push({
                        items: items,
                        author: author,
                        avatar: avatar
                    });
                }
            });
        },

        openStory: function($circle, storyIndex) {
            if (!this.allStories || this.allStories.length === 0) {
                console.error('No stories collected');
                return;
            }

            if (storyIndex < 0 || storyIndex >= this.allStories.length) {
                console.error('Invalid story index:', storyIndex);
                return;
            }

            var storyData = this.allStories[storyIndex];

            if (!storyData || !storyData.items || storyData.items.length === 0) {
                console.error('No story data found');
                return;
            }

            this.currentStory = storyData.items;
            this.currentStoryIndex = storyIndex;
            this.currentItemIndex = 0;
            this.isPaused = false;
            this.remainingTime = 0;
            this.currentProgress = 0;

            // Set user info
            $('.wpas-popup-username').text(storyData.author || '');
            $('.wpas-popup-avatar').attr('src', storyData.avatar || '');

            // Setup progress bars
            this.setupProgressBars(this.currentStory.length);

            // Load first item
            this.loadItem(this.currentItemIndex);

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
                    '<div class="wpas-progress-fill" style="width: 0%"></div>' +
                    '</div>'
                );
            }
        },

        loadItem: function(index) {
            if (!this.currentStory || index < 0 || index >= this.currentStory.length) {
                console.error('Invalid item index:', index);
                return;
            }

            this.currentItemIndex = index;
            var item = this.currentStory[index];
            var $mediaContainer = $('.wpas-popup-media');

            // Clear previous media
            $mediaContainer.empty();

            // Load new media
            if (item.type === 'image') {
                var img = $('<img>')
                    .attr('src', item.media_url || '')
                    .attr('alt', item.title || 'Story image');
                $mediaContainer.html(img);
            } else if (item.type === 'video') {
                var video = $('<video>')
                    .attr('autoplay', true)
                    .attr('playsinline', true);

                var source = $('<source>')
                    .attr('src', item.media_url || '')
                    .attr('type', 'video/mp4');

                video.append(source);
                $mediaContainer.html(video);

                video.on('loadedmetadata', function() {
                    console.log('Video duration:', video[0].duration, 'seconds');
                });

                video.on('ended', function() {
                    WPAS.nextItem();
                });
            } else {
                console.error('Unknown media type:', item.type);
                return;
            }

            // Update progress bars
            this.updateProgressBars(index);
        },

        startProgress: function() {
            this.stopProgress();

            if (!this.currentStory || this.currentItemIndex >= this.currentStory.length) {
                console.error('Cannot start progress - invalid state');
                return;
            }

            var item = this.currentStory[this.currentItemIndex];
            var $progressBar = $('.wpas-progress-fill').eq(this.currentItemIndex);

            // If video, wait for metadata to get actual duration
            if (item.type === 'video') {
                var video = $('.wpas-popup-media video').get(0);
                if (video) {
                    if (video.readyState >= 1) {
                        var duration = video.duration * 1000;
                        this.createProgressTimer(duration, $progressBar);
                    } else {
                        var self = this;
                        $(video).one('loadedmetadata', function() {
                            var duration = video.duration * 1000;
                            self.createProgressTimer(duration, $progressBar);
                        });
                    }
                } else {
                    var duration = 5000;
                    this.createProgressTimer(duration, $progressBar);
                }
                return;
            }

            // For images, use duration from settings
            var duration = (item.duration || 5) * 1000;
            this.createProgressTimer(duration, $progressBar);
        },

        createProgressTimer: function(duration, $progressBar) {
            var self = this;
            var startTime = Date.now() - (parseFloat($progressBar.css('width')) || 0) * duration / 100;

            this.progressInterval = setInterval(function() {
                if (self.isPaused) {
                    if (!self.pauseStartTime) {
                        self.pauseStartTime = Date.now();
                    }
                    return;
                }

                if (self.pauseStartTime) {
                    var pauseDuration = Date.now() - self.pauseStartTime;
                    startTime += pauseDuration;
                    self.pauseStartTime = 0;
                }

                var elapsed = Date.now() - startTime;
                var progress = Math.min((elapsed / duration) * 100, 100);

                self.currentProgress = progress;
                $progressBar.css('width', progress + '%');

                if (progress >= 100) {
                    self.nextItem();
                }
            }, 50);
        },

        stopProgress: function() {
            if (this.progressInterval) {
                clearInterval(this.progressInterval);
                this.progressInterval = null;
            }
            this.pauseStartTime = 0;
        },

        updateProgressBars: function(index) {
            $('.wpas-progress-fill').each(function(i) {
                $(this).css('width', i < index ? '100%' : i === index ? '0%' : '0%');
            });
        },

        nextItem: function() {
            // First try next item in current story
            if (this.currentItemIndex < this.currentStory.length - 1) {
                this.currentItemIndex++;
                this.loadItem(this.currentItemIndex);
                this.startProgress();
                return;
            }

            // If no more items in current story, go to next story
            if (this.currentStoryIndex < this.allStories.length - 1) {
                this.goToNextStory();
                return;
            }

            // If no more stories, close popup
            this.closePopup();
        },

        prevItem: function() {
            console.log('prevItem called - currentItemIndex:', this.currentItemIndex, 'story length:', this.currentStory.length);

            // First try previous item in current story
            if (this.currentItemIndex > 0) {
                console.log('Going to previous item in current story');
                this.currentItemIndex--;
                this.loadItem(this.currentItemIndex);
                this.startProgress();
                return;
            }

            // If this is first item, try previous story
            if (this.currentStoryIndex > 0) {
                console.log('Going to previous story');
                this.goToPrevStory();
                return;
            }

            console.log('Already at first item of first story');
        },

        goToNextStory: function() {
            // Move to next story
            this.currentStoryIndex++;

            if (this.currentStoryIndex >= this.allStories.length) {
                this.closePopup();
                return;
            }

            var nextStory = this.allStories[this.currentStoryIndex];

            this.currentStory = nextStory.items;
            this.currentItemIndex = 0;
            this.isPaused = false;
            this.remainingTime = 0;
            this.currentProgress = 0;

            // Update user info
            $('.wpas-popup-username').text(nextStory.author || '');
            $('.wpas-popup-avatar').attr('src', nextStory.avatar || '');

            // Setup new progress bars
            this.setupProgressBars(this.currentStory.length);

            // Load first item of new story
            this.loadItem(this.currentItemIndex);

            // Start progress
            this.startProgress();
        },

        goToPrevStory: function() {
            // Move to previous story
            this.currentStoryIndex--;

            if (this.currentStoryIndex < 0) {
                this.currentStoryIndex = 0;
                return;
            }

            var prevStory = this.allStories[this.currentStoryIndex];

            this.currentStory = prevStory.items;
            this.currentItemIndex = prevStory.items.length - 1;
            this.isPaused = false;
            this.remainingTime = 0;
            this.currentProgress = 0;

            // Update user info
            $('.wpas-popup-username').text(prevStory.author || '');
            $('.wpas-popup-avatar').attr('src', prevStory.avatar || '');

            // Setup new progress bars
            this.setupProgressBars(this.currentStory.length);

            // Load last item of previous story
            this.loadItem(this.currentItemIndex);

            // Start progress
            this.startProgress();
        },

        goToItem: function(index) {
            if (index < 0 || index >= this.currentStory.length) {
                return;
            }

            this.currentItemIndex = index;
            this.loadItem(this.currentItemIndex);
            this.startProgress();
        },

        pauseProgress: function() {
            if (!this.isPaused) {
                this.isPaused = true;

                // Pause video if exists
                var video = $('.wpas-popup-media video').get(0);
                if (video && !video.paused) {
                    video.pause();
                }

                this.pauseStartTime = Date.now();
            }
        },

        resumeProgress: function() {
            if (this.isPaused) {
                this.isPaused = false;

                // Resume video if exists
                var video = $('.wpas-popup-media video').get(0);
                if (video && video.paused) {
                    video.play().catch(function(e) {
                        console.log('Video play failed:', e);
                    });
                }
            }
        },

        togglePause: function() {
            if (this.isPaused) {
                this.resumeProgress();
            } else {
                this.pauseProgress();
            }
        },

        closePopup: function() {
            this.stopProgress();

            // Pause and reset video if exists
            var video = $('.wpas-popup-media video').get(0);
            if (video) {
                video.pause();
                video.currentTime = 0;
            }

            $('#wpas-story-popup').fadeOut();
            $('body').css('overflow', '');

            // Reset state
            this.currentStory = null;
            this.currentStoryIndex = 0;
            this.currentItemIndex = 0;
            this.isPaused = false;
            this.remainingTime = 0;
            this.currentProgress = 0;
            this.pauseStartTime = 0;
        }
    };

    $(document).ready(function() {
        WPAS.init();
    });

})(jQuery);