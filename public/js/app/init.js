// This is the javascript entry point

require(['config'], function() {
  "use strict";
  var app = require(['app', 'routers/router'], function(app, Router) {
    app.router = new Router();
    app.start();
    return app;
  });
  window.app = app;
  return app;
});
