/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            colors: {
                'morado-oscuro': '#805395',
                'morado-claro': '#A881B7',
                'rosa': "#E94282",
            },
        },
    },
    plugins: [
        require("daisyui"),
        require('flowbite/plugin'),
    ],
    daisyui: {
        themes: ["light", "dark", "cupcake"],
    },
};
