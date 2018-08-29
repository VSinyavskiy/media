import Inputmask from 'inputmask';

export default class {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => {
      const $masks = document.querySelectorAll('.mask');

      $masks.forEach((el) => {
        switch (true) {
          case el.matches('.mask_tel'): {
            Inputmask({
              mask: '+7 999999 999 999',
              placeholder: '_',
              showMaskOnHover: false,
              showMaskOnFocus: true,
            }).mask(el);
            break;
          }
          default: break;
        }
      });
    });

    if (!PROD) console.log('FormControls module loaded.');
  }
}
