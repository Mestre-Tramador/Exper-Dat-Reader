/************************************\
 * Tailwind CSS configuration file. *
\************************************/

/** @type {import("tailwindcss").Config} */
module.exports = {
  content: [
    "./resources/views/*.blade.php",
    "./resources/ts/Pages/**/*.vue",
  ],
  plugins: [],
  theme: {
    extend: {},
  }
};
