import { rules } from './Rules.js';

export class Validator {
    constructor(formElement) {
        this.form = formElement;
        this.fields = [...this.form.querySelectorAll('[name]')];
        this.rules = rules;
    }

    validate() {
        let isValid = true;

        this.fields.forEach(field => {
            const name = field.name;
            const value = field.value.trim();
            const rule = this.rules[name];

            // On va chercher le span.response dans le même .form-control
            const span = field.nextElementSibling;

            if (!rule || !span) return;

            const result = rule.test(value);

            // On affiche le message de validation
            span.textContent = result ? rule.success : rule.error;
            span.className = "response " + (result ? "valid-feedback" : "invalid-feedback");

            // 🔧 Ajoute les classes Bootstrap visibles
            if (result) {
                field.classList.add("is-valid");
                field.classList.remove("is-invalid");
            } else {
                field.classList.add("is-invalid");
                field.classList.remove("is-valid");
                isValid = false;
            }

        });

        return isValid;
    }
}
