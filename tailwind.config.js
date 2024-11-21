import defaultTheme from 'tailwindcss/defaultTheme'

module.exports = {
    presets: [
        require('./vendor/tallstackui/tallstackui/tailwind.config.js') 
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
        }
    },
    content: [
        './app/**/*.php',
        './resources/**/*.html',
        './resources/**/*.js',
        './resources/**/*.jsx',
        './resources/**/*.ts',
        './resources/**/*.tsx',
        './resources/**/*.php',
        './resources/**/*.vue',
        './resources/**/*.twig',
        './vendor/tallstackui/tallstackui/src/**/*.php', 
    ],
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui')
    ],
    daisyui: {
        themes: ["light", "dark", "pastel"],
    },
}
