import Parallax from 'parallax-js';

export default class {
  constructor() {
    this.scenes = new Map();
    this.sceneClass = 'scene';

    document.addEventListener('DOMContentLoaded', () => {
      const $scenes = document.querySelectorAll(`.${this.sceneClass}`);

      if (!$scenes) return;
      $scenes.forEach((el) => {
        this.scenes.set(el, new Parallax(el, {
          selector: '.scene__layer',
          relativeInput: true,
          hoverOnly: true,
        }));
      });
    });

    if (!PROD) console.log('Parallax module loaded.');
  }

  get(el) {
    this.scenes.get(el);
  }
}
