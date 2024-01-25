import './bootstrap.js';
// assets/app.js
import 'bootstrap/dist/css/bootstrap.min.css';
import { Dropdown } from 'bootstrap';

import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

//Ajout d'un écouteur d'événement sur le document
//Au moment ou le document est complément charger, les fonction à l'intérieur vont être charger
document.addEventListener('DOMContentLoaded', () => {
    enableDropdowns();
});

// Fonction js pour faire fonctionner les menus dropdown. 
// Js provenant de la doc bootstrap 
// @see:https://getbootstrap.com/docs/5.3/components/dropdowns/#overview
const enableDropdowns = () =>
{
    const dropdownElementList = document.querySelectorAll('.dropdown-toggle')
    const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl))
}

