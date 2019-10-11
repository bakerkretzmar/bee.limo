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

        customForms: theme => ({
            default: {
                input: {
                    borderColor: defaultTheme.colors.gray[400],
                    borderWidth: defaultTheme.borderWidth['2'],
                },
                checkbox: {
                    color: defaultTheme.colors.teal[500],
                    borderColor: defaultTheme.colors.gray[400],
                    borderWidth: defaultTheme.borderWidth['2'],
                },
            },
        }),

    },

    variants: {
        //
    },

    plugins: [

        require('@tailwindcss/custom-forms'),

    ],

}
