import { on } from 'delegated-events';
import ClipboardJS from 'clipboard';

export default class {
  constructor() {
    document.addEventListener('DOMContentLoaded', () => {
      const clipboard = new ClipboardJS('[data-copy-to-clipboard]', {
        text(trigger) {
          return trigger.getAttribute('data-copy-to-clipboard');
        },
      });

      clipboard.on('success', function(e) {
        const $this = e.trigger;
        e.clearSelection();

        if ($this.matches('.copy-icon')) {
          $this.classList.add('copy-icon_success');
        }

        if ($this.hasAttribute('data-copy-to-clipboard-success')) {
          let message = $this.getAttribute('data-copy-to-clipboard-success');
          let $formItem = $this;

          while (!$formItem.matches('.form__item')) {
            $formItem = $formItem.parentElement;
          }
          $formItem.querySelector('.form__control').value = message;
        }
      });

      clipboard.on('error', function(e) {
        console.error('Action:', e.action);
        console.error('Trigger:', e.trigger);
      });

      on('click', '[data-copy-to-clipboard]', (event) => {
        event.preventDefault();
      });
    });

    if (!PROD) console.log('CopyCode module loaded.');
  }
}
