import Swiper from 'swiper';
import 'swiper/swiper-bundle.min.css';
import { Navigation, Autoplay } from 'swiper/modules';

const swiper = new Swiper('.swiper', {
    modules: [Navigation, Autoplay],
    autoplay: 3000,
    loop: true,
    spaceBetween: 30,
    slidesPerView: 4,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    breakpoints: {
        1400: {
            slidesPerView: 3.5,
        },
    }
});

