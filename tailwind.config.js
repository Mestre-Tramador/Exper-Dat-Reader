/************************************\
 * Tailwind CSS configuration file. *
\************************************/

/** @type {import("tailwindcss").Config} */
module.exports = {
    content: [
        "./resources/views/*.blade.php",
        "./resources/vue/Pages/**/*.vue",
        "./resources/vue/Components/**/*.vue",
    ],
    theme: {
        extend: {
            transformOrigin: {
                "top-center": "top center"
            },
            animation: { dropdown: "dropdown 300ms ease-in-out forwards" },
            keyframes: {
                dropdown: {
                    "0%": {
                        transform: "scaleY(0)"
                    },
                    "80%": {
                        transform: "scaleY(1.1)"
                    },
                    "100%": {
                        transform: "scaleY(1)"
                    }
                }
            }
        }
    },
    plugins: []
};
