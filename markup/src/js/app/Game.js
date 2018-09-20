import { on } from 'delegated-events';

export default class {
  constructor() {
    this.gameClass = 'ninja-top-block__game';
    document.addEventListener('DOMContentLoaded', () => {
      on('click', `.${this.gameClass}-start`, this.openGame.bind(this));
      on('click', `.${this.gameClass}-stop`, this.closeGame.bind(this));

      this.resize();
      window.addEventListener('resize', () => {
        this.resize();
      });
    });

    if (!PROD) console.log('Main module loaded.');
  }

  resize() {
    const $game = document.querySelector(`.${this.gameClass}`);

    if (!$game) return;
    const gameAR = $game.offsetWidth / $game.offsetHeight;
    const $gameFrame = $game.querySelector('iframe');
    const gameFrameAR = $gameFrame.getAttribute('width') / $gameFrame.getAttribute('height');

    if (gameAR >= gameFrameAR) {
      $game.classList.remove(`${this.gameClass}_horizontal`);
      $game.classList.add(`${this.gameClass}_vertical`);
      $gameFrame.width = $game.offsetHeight * gameFrameAR;
      $gameFrame.height = $game.offsetHeight;
    } else {
      $game.classList.remove(`${this.gameClass}_vertical`);
      $game.classList.add(`${this.gameClass}_horizontal`);
      $gameFrame.width = $game.offsetWidth;
      $gameFrame.height = $game.offsetWidth / gameFrameAR;
    }
  }

  openGame(event) {
    event.preventDefault();
    const $game = document.querySelector(`.${this.gameClass}`);

    if (!$game) return;
    const $gameFrame = $game.querySelector('iframe');
    $game.classList.add(`${this.gameClass}_active`);
    $gameFrame.src = $gameFrame.getAttribute('data-src');
  }

  closeGame(event) {
    event.preventDefault();
    const $game = document.querySelector(`.${this.gameClass}`);

    if (!$game) return;
    const $gameFrame = $game.querySelector('iframe');
    $game.classList.remove(`${this.gameClass}_active`);
    $gameFrame.src = '';
  }
}
