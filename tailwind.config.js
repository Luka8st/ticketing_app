/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        "black": "#060606",
        "lime": "#65a30d",
        "teal": "#115e59",
        "teal-light": "#5eead4",
        "cyan": "#06b6d4"
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

