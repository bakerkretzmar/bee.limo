const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {

    theme: {

        maxHeight: theme => theme('maxWidth'),

        extend: {

            colors: {
                grey: defaultTheme.colors.gray,
                cream: 'rgb(255, 250, 245)',
            },

            fontFamily: {
                sans: ['"National 2"', ...defaultTheme.fontFamily.sans],
            },

        },

    },

    variants: {
        //
    },

    plugins: [
        //
    ],

}
