const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {

    theme: {

        //

        extend: {

            colors: {
                grey: defaultTheme.colors.gray,
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
