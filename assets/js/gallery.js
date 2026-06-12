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
	
});
