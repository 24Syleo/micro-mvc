import { dataForm } from "./dataForm.js";
import { Validator } from "./Validator.js";
import { FetchService } from "./FetchService.js";

export function form(idForm, submit, endpoint, redirect) {
    const form = document.getElementById(idForm);
    const btn = document.getElementById(submit);

    const valid = new Validator(form);

    async function sendData(evt) {
        evt.preventDefault();
        const isValid = valid.validate();
        if (isValid) {
            const data = dataForm(form)
            try {
                const res = await FetchService.post(endpoint, data);
                if (res.success) {
                    if (redirect) {
                        location.href = redirect;
                    } else {
                        location.reload();
                    }
                } else {
                    location.href = '/error';
                }
            } catch (err) {
                console.log(err);
            }
        }
    }

    btn.addEventListener('click', sendData);
}