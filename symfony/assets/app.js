import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

/* PAGE CSS */
import './styles/home.css';
import './styles/register.css';
import './styles/login.css'
import './styles/profile.css'
import './styles/spot.css'
import './styles/flan.css'
import './styles/aboutUs.css'
import './styles/detailFlan.css'
import './styles/detailSpot.css'

/* COMPONENTS CSS */
import './styles/_header.css';
import './styles/_footer.css';
import './styles/_cardSpot.css';
import './styles/_cardFlan.css';
import './styles/_cardCity.css';

/* SCRIPT JS */
import starRating from './scripts/starRating.js';
document.addEventListener('DOMContentLoaded', () => {
    starRating();
});

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
