/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      colors: {
        brand: {
          bg:             '#1C1917',
          card:           '#252220',
          border:         '#3A3733',
          accent:         '#DDB892',
          'accent-light': '#DFC4A0',
          muted:          '#7A7570',
          text:           '#F0EDE8',
        },
      },
    },
  },
  plugins: [],
}