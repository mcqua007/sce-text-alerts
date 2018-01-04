define(function(require) {
  "use strict";

  var Backbone = require('backbone');

  var Router = Backbone.Router.extend({

    el: 'body',

    initialize: function() {
      console.log('Router Init');
    },

    routes: {
      '*actions': 'baseView'
    },

    defaultRoute: function() {
      console.log('Default Route');
    },

    baseView: function() {
      console.log('Base View');
      require(['views/BaseView'], function(BaseView) {
        return new BaseView();
      });
    }

  });

  return Router;

});
