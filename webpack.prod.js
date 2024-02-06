const devConfigs = require("./webpack.dev");

module.exports = {
  ...devConfigs,
  mode: "production",
  devtool: undefined,
};
