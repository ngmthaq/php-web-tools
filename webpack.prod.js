const devConfigs = require("./webpack.dev.js");

const rules = require("./webpack.rules.js");

module.exports = {
  ...devConfigs,
  mode: "production",
  devtool: undefined,
  module: {
    ...devConfigs.module,
    rules: rules("production"),
  },
};
