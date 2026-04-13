/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        'kopi': {
          50:  '#faf6f1',
          100: '#f2e8d9',
          200: '#e5d0b3',
          300: '#d4b08a',
          400: '#c49060',
          500: '#b67a40',
          600: '#8B5E1A',
          700: '#7a4f14',
          800: '#5c3a0e',
          900: '#3d2609',
        },
        'cream': {
          50:  '#fefdfb',
          100: '#faf6ef',
          200: '#f5edde',
          300: '#ede0c8',
          400: '#e0ceaf',
        },
        'brown': {
          primary: '#8B5E1A',
          dark:    '#5c3a0e',
          light:   '#C49060',
          muted:   '#D4B08A',
        },
        'sidebar': '#FAFAF8',
        'card-bg': '#FFFFFF',
        'page-bg': '#F5F2ED',
      },
      fontFamily: {
        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui'],
        display: ['"Fraunces"', 'serif'],
      },
      fontSize: {
        'xxs': ['0.65rem', { lineHeight: '1rem' }],
      },
      boxShadow: {
        'card': '0 1px 3px 0 rgba(139,94,26,0.08), 0 1px 2px -1px rgba(139,94,26,0.06)',
        'card-hover': '0 4px 12px 0 rgba(139,94,26,0.12)',
        'sidebar': '1px 0 0 0 #ede0c8',
        'modal': '0 20px 60px rgba(0,0,0,0.15)',
        'tooltip': '0 4px 16px rgba(0,0,0,0.18)',
      },
      borderRadius: {
        'xl2': '1rem',
        'xl3': '1.25rem',
      },
      backgroundImage: {
        'gradient-kopi': 'linear-gradient(135deg, #8B5E1A 0%, #C49060 100%)',
      },
    },
  },
  plugins: [],
}
