import Swiper, {Autoplay, EffectCoverflow, EffectFade, Navigation, Pagination} from 'swiper';
import GLightbox from "glightbox";
import EmblaCarousel from 'embla-carousel'
import ClassNames from 'embla-carousel-class-names'
import { addPrevNextBtnsClickHandlers } from './EmblaCarouselArrowButtons'
import { addDotBtnsAndClickHandlers } from './EmblaCarouselDotButton'
import './animations';

//animate("section", { rotate: 360 }); Test if animations work

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

            if (navStripOffset <= 10) {
                document.body.classList.add('nav-strip--sticky-top');
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

    const lightboxes = document.querySelectorAll('[data-gallery="gallery"]');

    if (lightboxes.length > 0) {
        lightboxes.forEach((lightbox) => {
            const lightboxselector = lightbox.getAttribute('data-galleryid');
            if (lightbox.getAttribute('data-singleimage') === 'true') {
                lightbox = GLightbox({
                    selector: '[data-galleryid="' + lightboxselector + '"]',
                    draggable: false,
                    keyboardNavigation: false,
                    touchNavigation: false,
                });
            } else {
                lightbox = GLightbox({
                    selector: '[data-galleryid="' + lightboxselector + '"]',
                    touchNavigation: true,
                    loop: true,
                });
            }
        });
    }

    const emblaSliders = document.querySelectorAll('[data-behaviour="embla"]');
    emblaSliders.forEach((emblaSlider) => {
      const OPTIONS = { loop: true }

      const emblaNode = emblaSlider
      const viewportNode = emblaNode.querySelector('.embla__viewport')
      const prevBtnNode = emblaNode.querySelector('.embla-button__prev')
      const nextBtnNode = emblaNode.querySelector('.embla-button__next')
      const dotsNode = emblaNode.querySelector('.embla__dots')

      const emblaApi = EmblaCarousel(viewportNode, OPTIONS, [ClassNames({
        // snapped: 'embla__slide--in-view',
      })]);

      const removePrevNextBtnsClickHandlers = addPrevNextBtnsClickHandlers(
        emblaApi,
        prevBtnNode,
        nextBtnNode
      )
      const removeDotBtnsAndClickHandlers = addDotBtnsAndClickHandlers(
        emblaApi,
        dotsNode
      )
      const selectSlide = (emblaApi) => {
        const slideIndex = emblaApi.selectedScrollSnap();
        // emblaApi.slideNodes()[slideIndex+1].classList.add('embla__slide--in-view');
        const edgeSlides = emblaApi.slideNodes().filter((slideNode, index) => {
          const screenWidth = window.innerWidth;
          if (screenWidth < 768) {
          // Smartphone: no edge slides
          return false;
          } else if (screenWidth < 1024) {
          // Medium: adjacent slides are edges
          return Math.abs(index - slideIndex) === 1 || Math.abs(index - slideIndex) === emblaApi.slideNodes().length - 1;
          } else {
          // Desktop: slides at distance 2 are edges (3 slides visible, so next ones are edges)
          return Math.abs(index - slideIndex) === 2 || Math.abs(index - slideIndex) === emblaApi.slideNodes().length - 2;
          }
        });
        emblaApi.slideNodes().forEach((slideNode) => {
          slideNode.classList.remove('embla__slide--edge');
        });
        edgeSlides.forEach((edgeSlide) => {
          edgeSlide.classList.add('embla__slide--edge');
        });
      };
      emblaApi.on('init', selectSlide);
      emblaApi.on('select', selectSlide);
      emblaApi.on('resize', selectSlide);
      emblaApi.on('destroy', removePrevNextBtnsClickHandlers)
      emblaApi.on('destroy', removeDotBtnsAndClickHandlers)

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
            direction: slider.dataset.direction || 'horizontal',
            loop: slider.dataset.loop === 'true' || slider.dataset.loop === '1',
            slidesPerView: parseInt(slider.dataset.slidesperview) || 1,
            spaceBetween: parseInt(slider.dataset.spacebetween) || 10,
            centeredSlides: slider.dataset.centeredslides === 'true',
            centeredSlidesBounds: slider.dataset.centeredslides === 'true' && !(slider.dataset.loop === 'true' || slider.dataset.loop === '1'),
            loopAdditionalSlides: 3,
            slidesPerGroup: 1,
            allowTouchMove: slider.dataset.allowtouchmove || 'true',
            speed: parseInt(slider.dataset.speed) || 800,

            autoplay: slider.dataset.autoplay === 'true' || slider.dataset.autoplay === '1' ? {
                delay: parseInt(slider.dataset.autoplayDelay) || 10000,
            } : false,

            breakpoints: {
                1024: {
                    slidesPerView: Math.min(parseInt(slider.dataset.slidesperview) || 1, parseInt(slider.dataset.slidesperview))
                },
                768: {
                    slidesPerView: Math.min(parseInt(slider.dataset.slidesperview) || 1, 3)
                },
                0: {
                    slidesPerView: 1
                }
            },

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
        if (slider.dataset.autoplay === 'true' || slider.dataset.autoplay === '1') {
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


    //Select as Redirect Menu
    const selectMenus = document.querySelectorAll('[data-behaviour="select-redirect"]');
    if (selectMenus) {
        selectMenus.forEach((selectMenu) => {
            selectMenu.addEventListener('change', () => {
                window.location.href = selectMenu.value;
            });
        });
    }
});
