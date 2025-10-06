export function dataForm(form) {
    const formData = new FormData(form);
    const data = {};

    formData.forEach((value, key) => {
        if (data[key]) {
            // Si déjà une valeur pour cette clé
            if (Array.isArray(data[key])) {
                data[key].push(value);
            } else {
                data[key] = [data[key], value];
            }
        } else {
            data[key] = value;
        }
    });

    return data;
}
