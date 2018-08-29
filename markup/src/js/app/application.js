import './polyfills';
import Main from './Main';
import Sliders from './Sliders';
import Parallax from './Parallax';
import FormControls from './FormControls';
import CopyCode from './CopyCode';

new Main();
new FormControls();
new CopyCode();
export const sliders = new Sliders();
export const parallax = new Parallax();
