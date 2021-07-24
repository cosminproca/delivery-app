module.exports = {
  root: true,
  env: {
    node: true,
    browser: true
  },
  parser: 'vue-eslint-parser',
  extends: [
    'plugin:vue/vue3-recommended',
    'standard',
    'prettier',
    'plugin:prettier/recommended'
  ],
  rules: {
    'vue/max-attributes-per-line': 'off',
    'prettier/prettier': 'error',
    'vue/component-name-in-template-casing': ['error', 'PascalCase']
  }
};
