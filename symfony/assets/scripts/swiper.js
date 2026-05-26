import Swiper from 'swiper';
import 'swiper/swiper-bundle.min.css';
import { Navigation, Autoplay } from 'swiper/modules';

const swiper = new Swiper('.swiper', {
    modules: [Navigation, Autoplay],
    autoplay: 2000,
    loop: true,
    spaceBetween: 30,
    slidesPerView: 4,
    breakpoints: {
        1400: {
            slidesPerView: 3.5,
        },
        1200: {
            slidesPerView: 3,
        },

        992: {
            slidesPerView: 2.5,
        },

        768: {
            slidesPerView: 1.5,
        },
        576: {
            slidesPerView: 1,
        },
    }
});

