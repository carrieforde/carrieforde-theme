/**
 * Alcatraz Front End Styles & JS.
 */

// Import styles for compilation.
import './sass/main';

// Import front end scripts.
import './scripts/skip-link-focus-fix';
import './scripts/init';
import { linkColor } from './scripts/link-color';

window.addEventListener('scroll', linkColor);
document.addEventListener('DOMContentLoaded', linkColor);
