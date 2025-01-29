const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');
const typography = require('@tailwindcss/typography');
const forms = require('@tailwindcss/forms');

const config = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    fontFamily: {
      body: ['Body', ...defaultTheme.fontFamily.sans],
      heading: ['Heading', ...defaultTheme.fontFamily.serif],
    },
    screens: {
      xxxs: "340px",
      xxs: "360px",
      xs: "480px",
      sm: "640px",
      md: "769px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1600px",
      "3xl": "1920px",
    },
    extend: {
      colors: { // Add desired theme colors here
        gray: colors.neutral,
      },
      typography: {
        DEFAULT: {
          css: {},
        },
      },
    },
  },
  plugins: [
    typography,
    forms,
  ],
};

module.exports = config;
