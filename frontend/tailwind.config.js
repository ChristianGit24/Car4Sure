/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './index.html',
    './src/**/*.{vue,js,ts,jsx,tsx}',
  ],
  theme: {
    extend: {
      colors: {
        orange: {
          500: '#F97316',
        }
      }
    },
  },
  // Disable dark mode entirely or set it to 'class' for manual toggling
  media: false, // Set to 'false' to disable dark mode completely, or 'class' for manual control
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    themes: [
      {
        light: {
          primary: "#646cff",
          secondary: "#535bf2",
          accent: "#747bff",
          neutral: "#213547",
          "base-100": "#ffffff",
          info: "#3abff8",
          success: "#36d399",
          warning: "#fbbd23",
          error: "#f87272",
        },
      },
    ],
    darkTheme: false, // Explicitly disable dark theme
  },
}

