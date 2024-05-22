/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        "black": "#060606"
      },
      fontFamily: {
        "hanken-grotesk": ["Hanken Grotesk", "sans-serif"]
      },
      fontSize: {
        '2xs': ".625rem" //10px
      },
      maxHeight: {
        '12.4': "3.1rem"
      },
      height: {
        '12.4': "3.1rem"
      }
    },
  },
  plugins: [],
}

