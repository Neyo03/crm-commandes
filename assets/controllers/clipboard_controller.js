import { Controller } from '@hotwired/stimulus';


export default class extends Controller {

    static targets = ['source'];

    copy(event) {
        event.preventDefault();

        const textToCopy = this.sourceTarget.value || this.sourceTarget.textContent;

        navigator.clipboard.writeText(textToCopy).then(() => {
            console.log('Text copied to clipboard:', textToCopy);
            this.dispatchEvent('copy:success', { detail: { text: textToCopy } });
        }).catch((err) => {
            console.error('Failed to copy text:', err);
            this.dispatchEvent('copy:error', { detail: { error: err } });
        });
    }

    dispatchEvent(name, payload) {
        const event = new CustomEvent(name, payload);
        this.element.dispatchEvent(event);
    }
}
