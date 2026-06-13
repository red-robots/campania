jQuery(document).ready(function($) {
	var $container = $('.gallery-container');
  var $grid = $('.masonry-grid');

	$grid.on('layoutComplete', function() {
		$container.addClass('masonry-active');
	});

	$grid.masonry({
		itemSelector: '.grid-item',
		columnWidth: '.grid-sizer',
		percentPosition: true,
		gutter: 0
	});

	// var grid = document.querySelector('.masonry-grid');
	// // Initialize Masonry ONLY after images have loaded
	// imagesLoaded(grid, function() {
	// 	var msnry = new Masonry(grid, {
	// 		itemSelector: '.grid-item',
	// 		columnWidth: '.grid-sizer',
	// 		percentPosition: true,
	// 		gutter: 0 // Space between items
	// 	});
	// });


	$('#load-more-btn').click(function(e) {
		e.preventDefault();
		var button = $(this);
		var buttonDefaultLabel = button.attr('data-default-label');
		var data = {
				'action': 'load_more_featured_posts',
				'page': parseInt(gallery_params.current_page) + 1
		};

		$.ajax({
			url: gallery_params.ajaxurl,
			data: data,
			type: 'POST',
			beforeSend: function(xhr) {
					button.text('Loading...');
			},
			success: function(response) {
				if (response) {
					var $items = $(response);
					
					$grid.append($items);
					$grid.masonry('appended', $items);
					$grid.masonry('layout');

					gallery_params.current_page++;
					button.text(buttonDefaultLabel);

					if (gallery_params.current_page == gallery_params.max_page) {
							button.remove();
					}
				} else {
					button.remove();
				}
			},
			error: function(xhr, status, error) {
				console.error("AJAX Error (Status):", status);
				console.error("AJAX Error (Details):", error);
				console.dir(xhr); // Logs the full server response object
				//button.text('Error Loading. Try Again.');
			}
		});
	});


	// 1. Initialize Fancybox
	$('[data-fancybox="gallery"]').fancybox({
		clickContent: false, 
		buttons: [],         
		smallBtn: true,      
		toolbar: false,
		animationEffect: "fade",
		transitionEffect: "fade",
		loop: false, // Ensure it stops at boundaries instead of looping
		
		// This runs every time a popup item transitions and loads
		afterShow: function(instance, current) {
			var currentIndex = current.index;            // Current item number (starts at 0)
			var totalItems = instance.group.length;       // Total number of items in gallery
			
			// Look for the navigation buttons inside the currently active popup
			var $currentPopup = current.$content;
			var $prevBtn = $currentPopup.find('.prev-btn');
			var $nextBtn = $currentPopup.find('.next-btn');

			// Reset states first
			$prevBtn.prop('disabled', false).css('opacity', '1');
			$nextBtn.prop('disabled', false).css('opacity', '1');

			// If it's the very first item, disable the previous button
			if (currentIndex === 0) {
					$prevBtn.prop('disabled', true).css('opacity', '0.3');
			}

			// If it's the very last item, disable the next button
			if (currentIndex === totalItems - 1) {
					$nextBtn.prop('disabled', true).css('opacity', '0.3');
			}
		}
	});

	// 2. Safe Previous Button Handler
	$(document).on('click', '.prev-btn', function(e) {
		e.preventDefault();
		var instance = $.fancybox.getInstance();
		if (instance) {
			instance.previous();
		}
	});

	// 3. Safe Next Button Handler
	$(document).on('click', '.next-btn', function(e) {
		e.preventDefault();
		var instance = $.fancybox.getInstance();
		if (instance) {
			instance.next();
		}
	});
	
});
