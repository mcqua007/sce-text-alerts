define(function(require, exports, _, Backbone, Marionette, Modernizr) {
  "use strict";

  _ = require('underscore');
  Backbone = require('backbone');
  Marionette = require('marionette');
  Modernizr = require('modernizr');

  var app = new Backbone.Marionette.Application();

  app.addInitializer(function() {

    Backbone.history.start({
      pushState: true,
      hashChange: false,
      root: '/'
    });

  });

  return app;
});
