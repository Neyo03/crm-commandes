import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static values = { url: String, csrf: String };
    static targets = ["input", "container"];

    confirm(event) {
        event.preventDefault();

        if (confirm("Voulez-vous vraiment regénérer un lien de connexion pour cet utilisateur ?")) {
            this.sendLoginLinkRequest();
        }
    }

    sendLoginLinkRequest() {
        fetch(this.urlValue, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": this.csrfValue,
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.loginLink) {
                this.inputTarget.value = data.loginLink;
                this.containerTarget.classList.remove("d-none");
                alert("Lien de connexion regénéré !");
            } else {
                alert("Erreur lors de la génération du lien !");
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
}
