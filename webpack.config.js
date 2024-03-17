const webpack = require('webpack');

module.exports = {
  mode: process.env.NODE_ENV === 'development' ? 'development' : 'production',
  entry: '/javascript/dashboard.js',
  output: {
    path: __dirname +"/javascript/",
    filename: 'map.js'
  },
};
