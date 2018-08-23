import { on } from 'delegated-events';

export default class {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => {
      on('click', '.header__button', this.menuToggle);
      on('click', '.square__btn', this.squareToggle);
    });

    if (!PROD) console.log('Main module loaded.');
  }

  menuToggle(event) {
    event.preventDefault();
    document.querySelector('.header').classList.toggle('header_isOpened');
  }

  squareToggle(event) {
    event.preventDefault();
    let $square = event.target;

    while (!$square.matches('.square')) {
      $square = $square.parentElement;
    }
    $square.classList.toggle('square_active');
  }
}
