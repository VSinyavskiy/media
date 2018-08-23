import Glide from '@glidejs/glide';
// SCSS theme -> src/styles/_glide-theme.scss

export default class {
  constructor() {
    this.sliders = new Map();
    this.gC = 'slider'; // $glide-class from SCSS theme
    this.gES = '__'; // $glide-element-separator from SCSS theme
    this.gMS = '_'; // $glide-modifier-separator from SCSS theme
    this.classes = {
      direction: {
        ltr: `${this.gC}${this.gMS}ltr`,
        rtl: `${this.gC}${this.gMS}rtl`,
      },
      slider: `${this.gC}${this.gMS}slider`,
      slide: `${this.gC}${this.gMS}slide`,
      carousel: `${this.gC}${this.gMS}carousel`,
      swipeable: `${this.gC}${this.gMS}swipeable`,
      dragging: `${this.gC}${this.gMS}dragging`,
      cloneSlide: `${this.gC}${this.gES}slide${this.gMS}clone`,
      activeNav: `${this.gC}${this.gES}bullet${this.gMS}active`,
      activeSlide: `${this.gC}${this.gES}slide${this.gMS}active`,
      disabledArrow: `${this.gC}${this.gES}arrow${this.gMS}disabled`,
    };

    document.addEventListener('DOMContentLoaded', () => {
      document.querySelectorAll(`.${this.gC}`).forEach((el) => {
        const $slides = el.querySelectorAll(`.${this.classes.slide}`);

        if (!$slides) return;

        const slider = new Glide(el, {
          type: 'carousel',
          gap: 160,
          startAt: 0,
          perView: 1,
          keyboard: false,
          classes: this.classes,
        });

        // if (el.matches(`.${this.gC}_prizes`)) {
        //   slider.update({
        //     autoplay: 5000,
        //   });
        // }

        slider.mount();
        this.sliders.set(el, slider);
      });
    });

    if (!PROD) console.log('Sliders module loaded.');
  }

  get(el) {
    return this.sliders.get(el);
  }
}
