const { addDynamicIconSelectors } = require("@iconify/tailwind");

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./App/**/*.{html,js,php}",
    "./index.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    addDynamicIconSelectors(),
    require('@tailwindcss/typography'),
  ],
};