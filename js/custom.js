// $(window).scroll(function() {
//     if($(this).scrollTop() > 50)
//     {
//         $('.navbar-trans').addClass('afterscroll');
//     } else
//     {
//         $('.navbar-trans').removeClass('afterscroll');
//     }

// });

// Navbar fade in on scroll using css class
$(window).scroll(function() {
    if($(this).scrollTop() > 100) {
      $('.navbar').addClass('opaque');
    } else {
      $('.navbar').removeClass('opaque');
      }
});

//Upload images with preview
// wait for the DOM to be loaded
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback function
    $('#newListingForm').ajaxForm(function() {
      //alert("Uploaded Knob-ed");
    document.getElementById("db-success").innerHTML = "<div class='db-success'>New listing successfully added</div>";
    });
});

function preview_image() {
 var total_file=document.getElementById("upload_file").files.length;
 for(var i=0;i<total_file;i++) {
  $('#image_preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
 }
}
