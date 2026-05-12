/**
 *  Custom jQuery Scripts
 *  Developed by: Lisa DeBona
 *  Date Modified: 03.31.2026
 */
jQuery(document).ready(function($) {

	if( $('.popup-image').length ) {
		$('.popup-image').fancybox({
			//buttons : ['close','thumbs','fullScreen'],
			buttons : ['fullScreen','close'],
			protect: true,
			loop: false,
			hash : false,
			animationEffect: 'fade'
		});
	}

	// $('.grid').masonry({
	// 	itemSelector: '.grid-item',
	// 	columnWidth: 200
	// });

	// init Masonry
	// var $grid = $('.grid').masonry({
	// 	itemSelector: '.grid-item',
	// 	percentPosition: true,
	// 	columnWidth: '.grid-sizer'
	// });
	// // layout Masonry after each image loads
	// $grid.imagesLoaded().progress( function() {
	// 	$grid.masonry();
	// });

	// Select the grid element
	var grid = document.querySelector('.masonry-images');
	// Initialize Masonry ONLY after images have loaded
	imagesLoaded(grid, function() {
		var msnry = new Masonry(grid, {
			itemSelector: '.masonry-item',
			columnWidth: '.masonry-item',
			percentPosition: true,
			gutter: 0 // Space between items
		});
	});

  const swiperElements = document.querySelectorAll('.swiper');
  if(swiperElements.length) {
    // Loop through each element found
    swiperElements.forEach((el) => {
      new Swiper(el, {
        speed: 400,
        slidesPerView: 1,
        effect: 'fade',
        loop: true,
				grabCursor: true,
				allowTouchMove: true,
        autoplay: {
          delay: 5000, // Time in ms between slides (3 seconds)
          disableOnInteraction: false, // Keeps sliding after user interacts
        },
        navigation:false,
        // navigation: {
        //   nextEl: el.querySelector('.swiper-button-next'),
        //   prevEl: el.querySelector('.swiper-button-prev'),
        // },
        pagination: {
          el: el.querySelector('.swiper-pagination'),
          clickable: true,
        },
      });
    });
  }

	//OPEN menu toggle
	$(document).on('click', '.menu-toggle', function(e){
		e.preventDefault();
		let isExpanded = $(this).attr('aria-expanded') === 'true';
		$(this).attr('aria-expanded', !isExpanded);
		let ariaControls = $(this).attr('aria-controls');
		if( $(ariaControls).length ) {
			$(ariaControls).addClass('open');
		}
	});

	//CLOSE menu toggle
	$(document).on('click', '.closeMenuToggle', function(e){
		e.preventDefault();
		$('#primary-navigation').addClass('closed');
		$('.menu-toggle').attr('aria-expanded','false');
		setTimeout(function(){
			$('#primary-navigation').removeClass('open closed');
		},800);
	});


});



