const path = require("path");

const rules = require("./webpack.rules.js");

const {CleanWebpackPlugin} = require("clean-webpack-plugin");

module.exports = {
    mode: "development",
    devtool: "inline-source-map",
    entry: {
        main: "./resources/js/main.js",
    },
    output: {
        filename: "[name].bundle.js",
        path: path.resolve(__dirname, "./public/bundles"),
        clean: true,
    },
    module: {
        rules: rules("development"),
    },
    plugins: [new CleanWebpackPlugin()],
    optimization: {
        splitChunks: {
            chunks: "all",
        },
    },
};
