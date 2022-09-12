const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            variants: {
                margin: ['last']
            },
            height: {
                '128' : '32rem'
            },
            maxHeight: {
                '128' : '32rem'
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
