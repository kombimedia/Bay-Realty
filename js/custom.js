// Navbar fade in on scroll using css class
$(window).scroll(function() {
    if($(this).scrollTop() > 100) {
      $('.navbar').addClass('opaque');
    } else {
      $('.navbar').removeClass('opaque');
      }
});



// $(document).ready(function()
// {
//  $('.add-listing-form').ajaxForm(function()
//  {
//   document.getElementById("ajax-message").innerHTML = "<div class='db-success'>Your listing was successfully created</div>";
//  });
// });

// Image upload handler
// Declare global increment variable
var number = 0;

$(document).ready(function() {

// To add new input file field dynamically, on click of "Add Another Image" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'})
                ));
    });

// Executes on change event of file input to select different file
$('body').on('change', '#file', function(){
          if (this.files && this.files[0]) {
              // incrementing global variable by 1
              number += 1;

          var z = number - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
                $(this).before("<div id='preview-div"+ number +"' class='preview-div'><img id='previewimg" + number + "' src=''/></div>");

          var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);

          $(this).hide();
                $("#preview-div"+ number).append($("<img/>", {id: 'img', src: 'images/x.png', alt: 'delete'}).click(function() {
                $(this).parent().parent().remove();
                }));
            }
        });

    // To preview image
    function imageIsLoaded(e) {
        $('#previewimg' + number).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            // Throw error message if an image isn't selected
            // document.getElementById("return-messages").innerHTML = "<div class='validate-error-message'>Oops... Please upload at least one image.</div>";
            // e.preventDefault();
        }
    });
});
