import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['button', 'menu'];

    connect() {
        this.element.addEventListener('click', (event) => {
            if (!this.menuTarget.contains(event.target) && !this.buttonTarget.contains(event.target)) {
                this.close();
            }
        });
    }

    toggle() {
        this.menuTarget.classList.toggle('hidden');
    }

    close() {
        this.menuTarget.classList.add('hidden');
    }
}