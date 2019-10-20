const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {

    theme: {

        maxHeight: theme => theme('maxWidth'),

        extend: {

            colors: {
                grey: defaultTheme.colors.gray,
                cream: 'rgb(255, 252, 247)',
                'cream-dark': 'rgb(245, 242, 237)',
                'cream-darker': 'rgb(235, 232, 227)',
            },

            fontFamily: {
                sans: ['"FreightSans Pro"', ...defaultTheme.fontFamily.sans],
            },

        },

        customForms: theme => ({
            default: {
                input: {
                    borderColor: defaultTheme.colors.gray[400],
                    borderWidth: defaultTheme.borderWidth['2'],
                    // '&:focus': {
                    //     borderColor: defaultTheme.colors.gray[400],
                    // },
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
        textColor: ['responsive', 'hover', 'group-hover', 'focus'],
    },

    plugins: [

        require('@tailwindcss/custom-forms'),

    ],

}
