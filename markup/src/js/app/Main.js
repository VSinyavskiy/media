import { on } from 'delegated-events';

export default class {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => {
      on('click', '.header__button', this.menuToggle);
      on('click', '.square__btn', this.squareToggle);
      on('click', '[data-dialog]', this.openDialog);
      on('click', '[data-dialog-dismiss]', this.closeDialog);
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

  openDialog(event) {
    const $dialog = document.querySelector(event.target.getAttribute('data-dialog'));

    if (!$dialog) return;
    document.querySelectorAll('.dialog').forEach(el => el.classList.remove('dialog_isOpen'));
    $dialog.classList.add('dialog_isOpen');
  }

  closeDialog(event) {
    let $dialog = event.target;

    while (!$dialog.matches('.dialog')) {
      $dialog = $dialog.parentElement;
    }

    $dialog.classList.remove('dialog_isOpen');
  }
}
