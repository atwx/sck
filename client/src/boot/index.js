import Swiper, {Autoplay, EffectCoverflow, EffectFade, Navigation, Pagination} from 'swiper';
import GLightbox from "glightbox";

/* global window */

window.document.addEventListener('DOMContentLoaded', () => {
    //INIT Sticky Navbar
    //Set class on body when .header_nav_strip sticky position is at top
    if (document.querySelector('.header_nav_strip')) {
        const navStrip = document.querySelector('.header_nav_strip');
        const navStripOffset = navStrip.offsetTop;

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > navStripOffset) {
                document.body.classList.add('nav-strip--sticky');
            } else {
                document.body.classList.remove('nav-strip--sticky');
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
    const menu_button = document.querySelector('[data-behaviour="toggle-navigation"]');
    if (menu_button) {
        menu_button.addEventListener('click', () => {
            document.body.classList.toggle('nav--show');
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
        const swiper = new Swiper(slider, {
            // configure Swiper to use modules
            modules: [Pagination, Navigation, Autoplay, EffectFade],
            effect: 'slide',
            fadeEffect: {
                crossFade: true
            },
            direction: 'horizontal',
            loop: slider.dataset.loop === 'true',

            autoplay: slider.dataset.autoplay === 'true' ? {
                delay: slider.dataset.autoplaydelay || 10000,
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

        //Add pause functionality for autoplay sliders
        if (slider.dataset.autoplay === 'true') {
            const pauseButton = slider.querySelector('.swiper-button-pause');
            if (pauseButton) {
                pauseButton.addEventListener('click', () => {
                    if (swiper.autoplay.running) {
                        swiper.autoplay.stop();
                        pauseButton.classList.add('paused');
                    } else {
                        swiper.autoplay.start();
                        pauseButton.classList.remove('paused');
                    }
                });
            }
        }
    });

    // INIT CARDS SLIDER
    document.querySelectorAll('.cards-slider').forEach(slider => {
        const slides = slider.querySelectorAll('.card-slide');
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
