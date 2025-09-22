module.exports = {
  content: [
    './wp-content/themes/hello-wunder/**/*.php',
    './wp-content/themes/hello-wunder/**/*.js',
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/typography'),
  ],
};