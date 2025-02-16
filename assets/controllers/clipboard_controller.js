import { Controller } from '@hotwired/stimulus';


export default class extends Controller {

    static targets = ['source'];

    copy(event) {
        event.preventDefault();

        const textToCopy = this.sourceTarget.value || this.sourceTarget.textContent;

        navigator.clipboard.writeText(textToCopy).then(() => {
            this.dispatchEvent('copy:success', { detail: { text: textToCopy } });
            alert("Lien copiée !");
        }).catch((err) => {
            this.dispatchEvent('copy:error', { detail: { error: err } });
        });
    }

    dispatchEvent(name, payload) {
        const event = new CustomEvent(name, payload);
        this.element.dispatchEvent(event);
    }
}
