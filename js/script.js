// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('body').on('click', '.page-scroll a', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href').replace("/", "")).offset().top -100
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

	// destroy the modal object to load the modal with different content
    $('body').on('hidden.bs.modal', '.modal', function () {
	  $(this).removeData('bs.modal');
	});

    // init datepicker plugin
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'de-DE'
    })

    // init textarea autosize plugin
    autosize($('textarea'));

    // init fancybox plugin 
    $(".fancybox").fancybox({
        'minHeight': 400
    });

    // hide admin status message after a while and remove status parameter from URL
    if($('.statusMessage').length != 0) {
        setTimeout(function(){
            $('.statusMessage').fadeOut();
            window.history.pushState("object or string", "Title", "/" + refineUrl() );
        }, 3000);        
    }

    // write removed images ids to a hidden input to delele them later on submit
    $('.remove-image').click(function() {
        var image_id = $(this).attr('id').split("-")[1];
        var image_url = $('#image-'+image_id+' img').attr('src').split("/");
        var image_name = image_url[image_url.length-1];

        var deleted_images_ids = JSON.parse( $('[name="deleted_images_ids"]').val() );
        var deleted_images_urls = JSON.parse( $('[name="deleted_images_urls"]').val() );

        if(jQuery.inArray(image_id, deleted_images_ids) == -1) {
            deleted_images_ids.push(image_id);
            deleted_images_urls.push(image_name);
        }

        $('[name="deleted_images_ids"]').val(JSON.stringify(deleted_images_ids));
        $('[name="deleted_images_urls"]').val(JSON.stringify(deleted_images_urls));

        $('#image-' + image_id).fadeOut();

        return false;
    });
});

// Highlight the top nav as scrolling occurs
$('body').scrollspy({
    target: '.navbar-fixed-top'
})

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
    $('.navbar-toggle:visible').click();
});


// Clear URL from parameters
function refineUrl() {
    //get full url
    var url = window.location.href;
    //get url after /  
    var value = url.substring(url.lastIndexOf('/') + 1);
    //get the part after before ?
    value  = value.split("?")[0];   

    return value;     
}

// Images preview before upload
function readURL(input) {
    $('#image-peview').empty();
    var files = input.files;

    for (var i = 0, f; f = files[i]; i++) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image-peview').append( '<img class="img-thumbnail img-bordered" src='+e.target.result+' width="200" />' );
        };
        reader.readAsDataURL(f);
    }
}
