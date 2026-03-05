import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './app/**/*.php',
        './Modules/**/*.php',
        './Modules/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    '-apple-system',
                    'BlinkMacSystemFont',
                    'SF Pro Text',
                    'SF Pro Display',
                    'Helvetica Neue',
                    'Helvetica',
                    'Arial',
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            fontSize: {
                xs: ['0.75rem', { lineHeight: '1rem' }],
                sm: ['0.875rem', { lineHeight: '1.25rem' }],
                base: ['1rem', { lineHeight: '1.55rem' }],
                lg: ['1.0625rem', { lineHeight: '1.6rem' }],
                xl: ['1.125rem', { lineHeight: '1.65rem' }],
                '2xl': ['1.35rem', { lineHeight: '1.4' }],
                '3xl': ['1.65rem', { lineHeight: '1.2' }],
                '4xl': ['1.95rem', { lineHeight: '1.1' }],
                '5xl': ['2.45rem', { lineHeight: '1.05' }],
                '6xl': ['3.1rem', { lineHeight: '1' }],
            },
        },
    },

    plugins: [forms],
};
