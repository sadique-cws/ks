document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {
        draggable:true,
    });
  });

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, {});
  });

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.carousel');
    var instances = M.Carousel.init(elems, {
		fullWidth: true,
		indicators: true,
    });
  });



document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.Bulk');
    var instances = M.Modal.init(elems, { });
  });


document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems, {});
  });

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, {
        'hover':true,
        'coverTrigger':false,
        'constrainWidth':false,
    });
  });

