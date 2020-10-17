const defaults = require('tailwindcss/defaultTheme');

module.exports = {
    experimental: {
        extendedSpacingScale: true,
        applyComplexClasses: true,
        // defaultLineHeights: true,
        extendedFontSizeScale: true,
    },
    future: {
        purgeLayersByDefault: true,
        removeDeprecatedGapUtilities: true,
    },
    purge: [
        'resources/**/*.html',
        'resources/**/*.svelte',
        'resources/**/*.js',
        'resources/**/*.blade.php',
    ],
    theme: {
        minWidth: theme => theme('maxWidth'),
        extend: {
            colors: {
                grey: defaults.colors.gray,
                cream: 'rgb(255, 252, 247)',
                'cream-dark': 'rgb(245, 242, 237)',
                'cream-darker': 'rgb(235, 232, 227)',
            },
            fontFamily: {
                sans: ['freight-sans-pro', ...defaults.fontFamily.sans],
            },
        },
        customForms: theme => ({
            default: {
                input: {
                    borderColor: defaults.colors.gray[400],
                    borderWidth: defaults.borderWidth['2'],
                },
                checkbox: {
                    color: defaults.colors.teal[500],
                    borderColor: defaults.colors.gray[400],
                    borderWidth: defaults.borderWidth['2'],
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
};
