/*
  eslint-disable
  dot-notation
*/
import './polyfills';
import Main from './Main';
import Sliders from './Sliders';
import Parallax from './Parallax';
import FormControls from './FormControls';
import CopyCode from './CopyCode';
import Game from './Game';

new Main();
new FormControls();
new CopyCode();
export const sliders = new Sliders();
export const parallax = new Parallax();
export const game = new Game();

window['namespaces'] = window['namespaces'] || {};
window['namespaces']['app.markup'] = {
  sliders,
  parallax,
  game,
};
