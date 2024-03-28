import defaults from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: ['./resources/**/*.{html,svelte,js,blade.php}'],
    theme: {
        extend: {
            colors: {
                cream: 'rgb(255, 252, 247)',
                'cream-dark': 'rgb(245, 242, 237)',
                'cream-darker': 'rgb(235, 232, 227)',
            },
            fontFamily: {
                sans: ['freight-sans-pro', ...defaults.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};
