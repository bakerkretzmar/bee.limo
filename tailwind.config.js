const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {

    theme: {

        //

        extend: {

            colors: {
                grey: defaultTheme.colors.gray,
                cream: 'rgb(255, 250, 245)',
            },

            fontFamily: {
                sans: ['"Roboto"', ...defaultTheme.fontFamily.sans],
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
