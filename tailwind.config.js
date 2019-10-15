const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {

    theme: {

        maxHeight: theme => theme('maxWidth'),

        extend: {

            colors: {
                grey: defaultTheme.colors.gray,
                cream: 'rgb(255, 250, 245)',
                'cream-dark': 'rgb(245, 240, 235)',
                'cream-darker': 'rgb(235, 230, 225)',
            },

            fill: {
                cream: 'rgb(255, 250, 245)',
                'cream-dark': 'rgb(245, 240, 235)',
                'cream-darker': 'rgb(235, 230, 225)',
                grey: defaultTheme.colors.gray,
                ...defaultTheme.colors,
            },

            stroke: {
                cream: 'rgb(255, 250, 245)',
                'cream-dark': 'rgb(245, 240, 235)',
                'cream-darker': 'rgb(235, 230, 225)',
                grey: defaultTheme.colors.gray,
                ...defaultTheme.colors,
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
        fill: ['responsive', 'group-hover'],
        stroke: ['responsive', 'group-hover'],
    },

    plugins: [

        require('@tailwindcss/custom-forms'),

    ],

}
