import { form } from "../utils/form.js";

export function init() {
    form("formRegister", "submitRegister", "/user/create");
    form("formLogin", "submitLogin", "/auth/login", "/");
}