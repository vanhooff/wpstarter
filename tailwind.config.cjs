const typography = require('@tailwindcss/typography');
const forms = require('@tailwindcss/forms');

const config = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    extend: {
      colors: {}, // Extend Tailwind's default colors
    },
  },
  plugins: [
    typography,
    forms,
  ],
};

module.exports = config;
