/**
 * Alcatraz Front End Styles & JS.
 */

// Import front end scripts.
import './scripts/skip-link-focus-fix';
import './scripts/init';
import { linkColor, positionNavigation } from './scripts/link-color';

window.addEventListener('scroll', linkColor);
document.addEventListener('DOMContentLoaded', linkColor);
document.addEventListener('DOMContentLoaded', positionNavigation);
window.addEventListener('resize', positionNavigation);
