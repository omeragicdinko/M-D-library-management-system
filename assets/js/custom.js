$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  app.route({
    view: 'customers',
    load: 'customers.html'
  });

  app.route({
    view: 'borrows',
    load: 'borrows.html'
  });

  app.route({
    view: 'employees',
    load: 'employees.html'
  });
  app.route({
    view: 'libraries',
    load: 'libraries.html'
  });
  app.route({
    view: 'books',
    load: 'books.html'
  });

  // run app
  app.run();

});
