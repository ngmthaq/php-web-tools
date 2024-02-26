// Languages
import en from "../langs/en.json";

// SCSS
import "../scss/main.scss";

function __(key, placeholders = {}) {
    const languages = { en };
    const lang = window.PHP.currentLanguage;
    const resource = languages[lang];
    let translation = key.split('_').reduce((t, i) => t[i] || key, resource);
    for (let placeholder in placeholders) {
        translation = translation.replace(`:${placeholder}`, placeholders[placeholder]);
    }
    return translation;
}
