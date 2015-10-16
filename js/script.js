// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('body').on('click', '.page-scroll a', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top -100
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });

	// destroy the modal object to load the modal with different content
    $('body').on('hidden.bs.modal', '.modal', function () {
	  $(this).removeData('bs.modal');
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
