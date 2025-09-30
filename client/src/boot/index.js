import Swiper, {Autoplay, EffectCoverflow, EffectFade, Navigation, Pagination} from 'swiper';
import GLightbox from "glightbox";

/* global window */

window.document.addEventListener('DOMContentLoaded', () => {
    // INIT NAVIGATION DROPDOWN
    const navMenuButton = document.querySelector('[data-behaviour="toggle-navigation"]');
    const navMenu = document.querySelector('.nav_menu');

    if (navMenuButton && navMenu) {
        navMenuButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            navMenu.classList.toggle('show');
            navMenuButton.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!navMenuButton.contains(e.target) && !navMenu.contains(e.target)) {
                navMenu.classList.remove('show');
                navMenuButton.classList.remove('active');
            }
        });
    }

    // INIT LANGUAGE DROPDOWN
    const langButton = document.querySelector('[data-behaviour="toggle-language"]');
    const langMenu = document.querySelector('.nav_language_menu');

    if (langButton && langMenu) {
        langButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            langMenu.classList.toggle('show');
            langButton.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!langButton.contains(e.target) && !langMenu.contains(e.target)) {
                langMenu.classList.remove('show');
                langButton.classList.remove('active');
            }
        });
    }

    // INIT MENUBUTTON (old functionality - keeping for compatibility)
    const menu_button = document.querySelector('[data-behaviour="toggle-menu"]');
    if (menu_button) {
        menu_button.addEventListener('click', () => {
            document.body.classList.toggle('body--show');
        });
    }

    // INIT LIGHTBOX
    const lightbox = GLightbox({
        selector: '[data-gallery="gallery"]',
        touchNavigation: true,
        loop: true,
    });

    // INIT SWIPER
    const sliders = document.querySelectorAll('.swiper');
    sliders.forEach(function (slider) {
        const autoSwiper = slider.classList.contains('swiper--auto');
        const swiper = new Swiper(slider, {
            // configure Swiper to use modules
            modules: [Pagination, Navigation, Autoplay, EffectFade],
            effect: 'slide',
            fadeEffect: {
                crossFade: true
            },
            direction: 'vertical',
            loop: true,

            autoplay: autoSwiper ? {
                delay: 5000,
            } : false,

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: true,
            },
        });
    });

    // INIT SERVICES SLIDER
    document.querySelectorAll('.services-slider').forEach(slider => {
        const slides = slider.querySelectorAll('.service-slide');
        const dots = slider.parentElement.querySelectorAll('.slider-dot');
        const prevBtn = slider.parentElement.querySelector('.slider-arrow-prev');
        const nextBtn = slider.parentElement.querySelector('.slider-arrow-next');

        let currentSlide = 0;
        const totalSlides = slides.length;
        const slidesToShow = window.innerWidth <= 768 ? 1 : (window.innerWidth <= 1200 ? 2 : 3);
        const maxSlide = Math.max(0, totalSlides - slidesToShow);

        // Autoplay settings
        const autoplay = slider.dataset.autoplay === 'true';
        const autoplaySpeed = parseInt(slider.dataset.autoplaySpeed) || 5000;
        let autoplayInterval;

        function updateSlider() {
            const translateX = -(currentSlide * (100 / slidesToShow));
            slider.style.transform = `translateX(${translateX}%)`;

            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            currentSlide = currentSlide >= maxSlide ? 0 : currentSlide + 1;
            updateSlider();
        }

        function prevSlide() {
            currentSlide = currentSlide <= 0 ? maxSlide : currentSlide - 1;
            updateSlider();
        }

        function goToSlide(index) {
            currentSlide = Math.min(index, maxSlide);
            updateSlider();
        }

        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => goToSlide(index));
        });

        // Autoplay
        if (autoplay && totalSlides > slidesToShow) {
            autoplayInterval = setInterval(nextSlide, autoplaySpeed);

            slider.parentElement.addEventListener('mouseenter', () => {
                clearInterval(autoplayInterval);
            });

            slider.parentElement.addEventListener('mouseleave', () => {
                autoplayInterval = setInterval(nextSlide, autoplaySpeed);
            });
        }

        // Responsive update
        window.addEventListener('resize', () => {
            const newSlidesToShow = window.innerWidth <= 768 ? 1 : (window.innerWidth <= 1200 ? 2 : 3);
            const newMaxSlide = Math.max(0, totalSlides - newSlidesToShow);
            if (currentSlide > newMaxSlide) {
                currentSlide = newMaxSlide;
            }
            updateSlider();
        });

        // Initialize
        updateSlider();
    });

    // FIXED HEADER
    window.addEventListener('scroll', () => {
        if (document.documentElement.scrollTop > 30 || document.body.scrollTop > 30){
            document.body.classList.add('menu--fixed');
        } else {
            document.body.classList.remove('menu--fixed');
        }
    });
});
