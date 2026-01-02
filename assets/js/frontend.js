/**
 * Frontend JavaScript for WP Active Story
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize stories
    const storyContainers = document.querySelectorAll('.wpas-story-container');
    
    storyContainers.forEach(container => {
        initStory(container);
    });
});

function initStory(container) {
    const items = container.querySelectorAll('.wpas-story-item');
    const progressBars = container.querySelectorAll('.wpas-progress-fill');
    const prevBtn = container.querySelector('.wpas-control-btn.prev');
    const nextBtn = container.querySelector('.wpas-control-btn.next');
    const pauseBtn = container.querySelector('.wpas-control-btn.pause');
    const closeBtn = container.querySelector('.wpas-story-close');
    const likeBtn = container.querySelector('.wpas-like-btn');
    const prevArea = container.querySelector('.wpas-prev-area');
    const nextArea = container.querySelector('.wpas-next-area');
    
    let currentIndex = 0;
    let isPaused = false;
    let progressInterval;
    let touchStartX = 0;
    let touchEndX = 0;
    
    // Show first item
    showItem(currentIndex);
    
    // Start progress
    startProgress();
    
    // Event Listeners
    if (prevBtn) prevBtn.addEventListener('click', prevStory);
    if (nextBtn) nextBtn.addEventListener('click', nextStory);
    if (pauseBtn) pauseBtn.addEventListener('click', togglePause);
    if (closeBtn) closeBtn.addEventListener('click', closeStory);
    if (likeBtn) likeBtn.addEventListener('click', toggleLike);
    
    // Touch events
    if (prevArea) {
        prevArea.addEventListener('touchstart', handleTouchStart);
        prevArea.addEventListener('touchend', handleTouchEnd);
        prevArea.addEventListener('click', prevStory);
    }
    
    if (nextArea) {
        nextArea.addEventListener('touchstart', handleTouchStart);
        nextArea.addEventListener('touchend', handleTouchEnd);
        nextArea.addEventListener('click', nextStory);
    }
    
    // Keyboard events
    document.addEventListener('keydown', handleKeydown);
    
    // Functions
    function showItem(index) {
        // Hide all items
        items.forEach(item => {
            item.classList.remove('active');
        });
        
        // Show current item
        if (items[index]) {
            items[index].classList.add('active');
        }
        
        // Reset progress bars
        progressBars.forEach((bar, i) => {
            bar.style.width = i < index ? '100%' : '0%';
        });
        
        currentIndex = index;
    }
    
    function startProgress() {
        if (isPaused) return;
        
        const currentProgressBar = progressBars[currentIndex];
        if (!currentProgressBar) return;
        
        let width = 0;
        const duration = parseInt(currentProgressBar.dataset.duration) || 5000; // 5 seconds default
        const interval = 50; // Update every 50ms
        const increment = (100 / (duration / interval));
        
        clearInterval(progressInterval);
        
        progressInterval = setInterval(() => {
            if (width >= 100) {
                clearInterval(progressInterval);
                nextStory();
                return;
            }
            
            if (!isPaused) {
                width += increment;
                currentProgressBar.style.width = width + '%';
            }
        }, interval);
    }
    
    function nextStory() {
        if (currentIndex < items.length - 1) {
            showItem(currentIndex + 1);
            startProgress();
        } else {
            // Last story - close or loop
            closeStory();
        }
    }
    
    function prevStory() {
        if (currentIndex > 0) {
            showItem(currentIndex - 1);
            startProgress();
        }
    }
    
    function togglePause() {
        isPaused = !isPaused;
        const pauseIcon = pauseBtn.querySelector('i');
        
        if (pauseIcon) {
            pauseIcon.className = isPaused ? 'fas fa-play' : 'fas fa-pause';
        }
        
        if (!isPaused) {
            startProgress();
        }
    }
    
    function closeStory() {
        container.style.display = 'none';
        document.removeEventListener('keydown', handleKeydown);
    }
    
    function toggleLike() {
        const storyId = likeBtn.dataset.storyId;
        likeBtn.classList.toggle('liked');
        
        // AJAX call to save like
        fetch(wpas_ajax.ajax_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                action: 'wpas_like_story',
                story_id: storyId,
                nonce: wpas_ajax.nonce
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likeCount = likeBtn.querySelector('.like-count');
                if (likeCount) {
                    likeCount.textContent = data.likes_count;
                }
            }
        });
    }
    
    function handleTouchStart(e) {
        touchStartX = e.changedTouches[0].screenX;
        isPaused = true;
    }
    
    function handleTouchEnd(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        isPaused = false;
        startProgress();
    }
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next
                nextStory();
            } else {
                // Swipe right - previous
                prevStory();
            }
        }
    }
    
    function handleKeydown(e) {
        switch(e.key) {
            case 'ArrowLeft':
                prevStory();
                break;
            case 'ArrowRight':
                nextStory();
                break;
            case ' ':
                e.preventDefault();
                togglePause();
                break;
            case 'Escape':
                closeStory();
                break;
            case 'l':
            case 'L':
                toggleLike();
                break;
        }
    }
}
