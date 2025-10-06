// rules.js
export const rules = {
    firstname: {
        test: (val) => val.length >= 3 && val.length <= 20,
        success: "✅ Prénom valide.",
        error: "❌ Doit contenir entre 3 et 20 caractères.",
    },
    lastname: {
        test: (val) => val.length >= 3 && val.length <= 20,
        success: "✅ Nom valide.",
        error: "❌ Doit contenir entre 3 et 20 caractères.",
    },
    email: {
        test: (val) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val),
        success: "✅ Email valide.",
        error: "❌ Format d'email invalide.",
    },
    password: {
        test: (val) => val.length >= 8,
        success: "✅ Mot de passe valide.",
        error: "❌ Minimum 8 caractères.",
    },
    role: {
        test: (val) => val === "user" || val === "admin",
        success: "✅ Rôle valide.",
        error: "❌ Rôle invalide.",
    },
    title: {
        test: (val) => val.length >= 3 && val.length <= 45,
        success: "✅ Titre valide.",
        error: "❌ Doit contenir entre 3 et 45 caractères.",
    },
    description: {
        test: (val) => val.length >= 10 && val.length <= 250,
        success: "✅ Description valide.",
        error: "❌ Doit contenir entre 10 et 250 caractères.",
    },
    price: {
        test: (val) => {
            const num = parseFloat(val);
            return !isNaN(num) && num > 0;
        },
        success: "✅ Prix valide.",
        error: "❌ Le prix doit être un nombre positif.",
    },
    idCategory: {
        test: (val) => !!val, // doit être sélectionné
        success: "✅ Catégorie valide.",
        error: "❌ Veuillez sélectionner une catégorie.",
    },
};
