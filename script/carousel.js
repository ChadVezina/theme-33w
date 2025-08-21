/**
 * Hero Carousel Functionality
 * Manages the hero section background image carousel with navigation arrows and dots
 */

// Global carousel configuration will be set from PHP
window.HeroCarousel = {
    images: [],
    currentSlide: 0,
    heroSection: null,
    autoplayInterval: null,

    /**
     * Initialize the carousel
     * @param {Array} images - Array of image URLs
     */
    init: function (images) {
        if (!images || images.length === 0) {
            console.warn("Hero Carousel: No images provided");
            return;
        }

        this.images = images;
        this.heroSection = document.querySelector(".hero");

        if (!this.heroSection) {
            console.warn("Hero Carousel: .hero section not found");
            return;
        }

        if (this.images.length > 1) {
            this.setupCarousel();
        } else {
            // If only one image, just set it as background
            this.setBackground(this.images[0]);
        }
    },

    /**
     * Setup the complete carousel functionality
     */
    setupCarousel: function () {
        // Add smooth transition to hero section
        this.heroSection.style.transition = "opacity 0.6s ease-in-out";

        // Create and setup navigation elements
        this.createNavigationArrows();
        this.createDotsNavigation();

        // Setup event listeners
        this.setupEventListeners();

        // Start autoplay
        this.startAutoplay();

        // Set initial background
        this.setBackground(this.images[0]);
    },

    /**
     * Create navigation arrows
     */
    createNavigationArrows: function () {
        // Previous arrow
        const prevArrow = document.createElement("button");
        prevArrow.className = "hero-carousel__arrow hero-carousel__arrow--prev";
        prevArrow.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6v12z" fill="currentColor"/></svg>';
        prevArrow.setAttribute("aria-label", "Image précédente");
        prevArrow.addEventListener("click", () => this.prevSlide());

        // Next arrow
        const nextArrow = document.createElement("button");
        nextArrow.className = "hero-carousel__arrow hero-carousel__arrow--next";
        nextArrow.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6v12z" fill="currentColor"/></svg>';
        nextArrow.setAttribute("aria-label", "Image suivante");
        nextArrow.addEventListener("click", () => this.nextSlide());

        // Insert into hero section
        this.heroSection.appendChild(prevArrow);
        this.heroSection.appendChild(nextArrow);
    },

    /**
     * Create dots navigation
     */
    createDotsNavigation: function () {
        const dotsContainer = document.createElement("div");
        dotsContainer.className = "hero-carousel__dots";

        this.images.forEach((_, index) => {
            const dot = document.createElement("button");
            dot.className = "hero-carousel__dot";
            if (index === 0) dot.classList.add("hero-carousel__dot--active");
            dot.setAttribute("aria-label", `Aller à l'image ${index + 1}`);
            dot.addEventListener("click", () => this.goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        this.heroSection.appendChild(dotsContainer);
    },

    /**
     * Setup keyboard and other event listeners
     */
    setupEventListeners: function () {
        // Keyboard navigation
        document.addEventListener("keydown", (e) => {
            if (e.key === "ArrowLeft") {
                this.prevSlide();
                this.resetAutoplay(); // Reset autoplay on manual interaction
            }
            if (e.key === "ArrowRight") {
                this.nextSlide();
                this.resetAutoplay(); // Reset autoplay on manual interaction
            }
        });

        // Pause autoplay on hover
        this.heroSection.addEventListener("mouseenter", () => this.pauseAutoplay());
        this.heroSection.addEventListener("mouseleave", () => this.startAutoplay());
    },

    /**
     * Change background image with fade animation
     * @param {string} imageUrl - URL of the image to set as background
     */
    setBackground: function (imageUrl) {
        if (!this.heroSection) return;

        this.heroSection.style.opacity = "0.7";

        setTimeout(() => {
            this.heroSection.style.backgroundImage = `url("${imageUrl}")`;
            this.heroSection.style.opacity = "1";
        }, 300);
    },

    /**
     * Go to a specific slide
     * @param {number} index - Index of the slide to go to
     */
    goToSlide: function (index) {
        if (index < 0 || index >= this.images.length) return;

        this.currentSlide = index;
        this.setBackground(this.images[this.currentSlide]);
        this.updateDots();
    },

    /**
     * Go to previous slide
     */
    prevSlide: function () {
        const newIndex = this.currentSlide === 0 ? this.images.length - 1 : this.currentSlide - 1;
        this.goToSlide(newIndex);
    },

    /**
     * Go to next slide
     */
    nextSlide: function () {
        const newIndex = this.currentSlide === this.images.length - 1 ? 0 : this.currentSlide + 1;
        this.goToSlide(newIndex);
    },

    /**
     * Update dots active state
     */
    updateDots: function () {
        const dots = document.querySelectorAll(".hero-carousel__dot");
        dots.forEach((dot, index) => {
            dot.classList.toggle("hero-carousel__dot--active", index === this.currentSlide);
        });
    },

    /**
     * Start autoplay
     */
    startAutoplay: function () {
        this.pauseAutoplay(); // Clear any existing interval
        this.autoplayInterval = setInterval(() => {
            this.nextSlide();
        }, 8000); // 8 seconds interval
    },

    /**
     * Pause autoplay
     */
    pauseAutoplay: function () {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    },

    /**
     * Reset autoplay (pause and restart)
     */
    resetAutoplay: function () {
        this.startAutoplay();
    },
};

// Initialize when DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    // The images array will be set from PHP via window.heroCarouselImages
    if (window.heroCarouselImages && window.heroCarouselImages.length > 0) {
        window.HeroCarousel.init(window.heroCarouselImages);
    }
});
