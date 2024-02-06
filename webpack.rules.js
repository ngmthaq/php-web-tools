const toml = require("toml");
const yaml = require("yamljs");
const json5 = require("json5");

function getRules(mode) {
  return [
    {
      test: /\.m?js$/,
      exclude: /(node_modules|bower_components)/,
      use: {
        loader: "babel-loader",
        options: {
          presets: ["@babel/preset-env"],
        },
      },
    },
    {
      test: /\.css$/i,
      use: [
        { loader: "style-loader" },
        {
          loader: "css-loader",
          options: {
            sourceMap: mode !== "production",
          },
        },
      ],
    },
    {
      test: /\.s[ac]ss$/i,
      use: [
        { loader: "style-loader" },
        {
          loader: "css-loader",
          options: {
            sourceMap: mode !== "production",
          },
        },
        {
          loader: "sass-loader",
          options: {
            sourceMap: mode !== "production",
          },
        },
      ],
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif)$/i,
      use: {
        loader: "file-loader",
      },
    },
    {
      test: /\.(woff|woff2|eot|ttf|otf)$/i,
      use: {
        loader: "file-loader",
      },
    },
    {
      test: /\.(csv|tsv)$/i,
      use: {
        loader: "csv-loader",
      },
    },
    {
      test: /\.xml$/i,
      use: {
        loader: "xml-loader",
      },
    },
    {
      test: /\.toml$/i,
      type: "json",
      parser: {
        parse: toml.parse,
      },
    },
    {
      test: /\.yaml$/i,
      type: "json",
      parser: {
        parse: yaml.parse,
      },
    },
    {
      test: /\.json5$/i,
      type: "json",
      parser: {
        parse: json5.parse,
      },
    },
  ];
}

module.exports = getRules;
