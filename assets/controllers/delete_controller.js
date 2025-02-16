import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static values = { url: String, csrf: String };

    confirm(event) {
        event.preventDefault();

        if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
            this.sendDeleteRequest();
        }
    }

    sendDeleteRequest() {
        fetch(this.urlValue, {
            method: "DELETE",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": this.csrfValue
            }
        })
        .then(response => {
            if (response.ok) {
                alert("Utilisateur supprimé !");
                location.reload();
            } else {
                alert("Erreur lors de la suppression !");
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
}
