/******************************\
 * ESLint configuration file. *
\******************************/

/** @type {import("@types/eslint").ESLint.ConfigData} */
module.exports = {
    env: {
        browser: true,
        es2021: true
    },
    extends: [
        "eslint:recommended",
        "plugin:vue/vue3-recommended",
        "plugin:@typescript-eslint/recommended",
        "prettier"
    ],
    parser: "vue-eslint-parser",
    parserOptions: {
        ecmaVersion: "latest",
        parser: "@typescript-eslint/parser",
        sourceType: "module"
    },
    plugins: ["vue", "@typescript-eslint", "prettier"],
    rules: {
        indent: ["error", 4, { SwitchCase: 1 }],
        "linebreak-style": ["error", "unix"],
        quotes: ["error", "double"],
        semi: ["error", "always"],
        "prettier/prettier": ["error"]
    }
};
