/*
the projects require.js config,
used in build process also
see: http://requirejs.org/docs/api.html#config
*/

/*global requirejs*/
requirejs.config({
  baseUrl: '/js/app',
  waitSeconds: 15,
  shim: {
    'underscore': {
      exports: '_'
    },
    'backbone': {
      deps: ['underscore', 'jquery'],
      exports: 'Backbone'
    },
    'marionette': {
      deps: ['backbone'],
      exports: 'Marionette'
    },
    'modernizr': {
      exports: 'Modernizr'
    }
  },
  paths: {
    backbone: '../libs/backbone',
    jquery: '../libs/jquery',
    marionette: '../libs/backbone.marionette',
    modernizr: '../libs/modernizr',
    underscore: '../libs/lodash'
  }
});
