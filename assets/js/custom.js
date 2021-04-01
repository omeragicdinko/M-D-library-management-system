$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  //TODO dodaj rute sve
  // define routes
  app.route({
    view: 'books',
    load: 'books.html'
  });

  // run app
  app.run();

});
