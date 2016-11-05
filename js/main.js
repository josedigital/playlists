$(function() {

  
  // Cache DOM elements. Define vars.
  // ------------------------------ /
  var trigger = $('.nav-trigger'),
  body = $('body'),
  scroll = $('.scrolly'),
  open,
  close;


  // Functions
  // ------------------------------ /
  open = function() {
    body.addClass('nav-active');
  };

  close = function() {
    body.removeClass('nav-active');
  };


  // Mobile Nav
  // ------------------------------ /
  trigger.on('click', function() {
    if(body.hasClass('nav-active')) {
      close();
    } else {
      open();
    }
    return false;
  });




  // Scrolly
  // ------------------------------ /
  scroll.scrolly();



});