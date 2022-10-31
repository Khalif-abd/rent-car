
const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        colors: {
            ...colors,
        },
        extend: {},
    },
    plugins: [
        require('flowbite/plugin'),
        require('@tailwindcss/forms')
    ],
}
