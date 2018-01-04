define(function(require) {
  "use strict";

  var Backbone = require('backbone');

  //Base View Class, Extend This
  var BaseView = Backbone.Marionette.ItemView.extend({

    el: 'body',

    initialize: function() {

    }

  });

  return BaseView;

});
