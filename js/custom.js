// Navbar fade in on scroll using css class
$(window).scroll(function() {
    if($(this).scrollTop() > 100) {
      $('.navbar').addClass('opaque');
    } else {
      $('.navbar').removeClass('opaque');
      }
});
