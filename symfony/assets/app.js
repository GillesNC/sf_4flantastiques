import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

/* PAGE CSS */
import './styles/pages/home.css';
import './styles/pages/register.css';
import './styles/pages/login.css'
import './styles/pages/profile.css'
import './styles/pages/spot.css'
import './styles/pages/flan.css'
import './styles/pages/aboutUs.css'
import './styles/pages/detailFlan.css'
import './styles/pages/detailSpot.css'

/* COMPONENTS CSS */
import './styles/components/_header.css';
import './styles/components/_footer.css';
import './styles/components/_cardSpot.css';
import './styles/components/_cardFlan.css';
import './styles/components/_cardCity.css';

/* SCRIPT JS */
import starRating from './scripts/starRating.js';
import './scripts/swiper.js';

document.addEventListener('DOMContentLoaded', () => {
    starRating();
});

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
