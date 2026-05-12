"use strict";

(function () {
  tinymce.PluginManager.add('checklistbutton', function (editor, url) {
    //console.log(url);
    var parts = url.split('assets');
    var themeURL = parts[0]; // Add Button to Visual Editor Toolbar

    editor.addButton('custom_class', {
      title: 'Checklist',
      cmd: 'custom_class',
      image: themeURL + 'assets/img/checklist.png'
    }); // Add Command when Button Clicked

    editor.addCommand('custom_class', function () {
      //alert('Button clicked!');
      // var selected_text = editor.selection.getContent({
      //   'format': 'html'
      // });
      var selected_text = editor.selection.getContent();

      if (selected_text.length === 0) {
        alert('Please select some text.');
        return;
      }

      var open_column = '<div class="ChecklistWrap">';
      var close_column = '</div>';
      var return_text = '';
      return_text = open_column + selected_text + close_column;
      editor.execCommand('mceReplaceContent', false, return_text);
      return; //var selected_text = editor.selection.getContent();
      // var selected_text = editor.selection.getContent({
      //   'format': 'html'
      // });
      // var return_text = '';
      // return_text = '<span class="dropcap">' + selected_text + '</span>';
      // editor.execCommand('mceInsertContent', 0, return_text);
    });
  });
  tinymce.PluginManager.add('ctabutton', function (editor, url) {
    //console.log(url);
    var parts = url.split('assets');
    var themeURL = parts[0]; // Add Button to Visual Editor Toolbar

    editor.addButton('edbutton1', {
      title: 'Button Dark Orange',
      cmd: 'edbutton1',
      image: themeURL + 'assets/img/button-orange.png'
    }); // Add Command when Button Clicked

    editor.addCommand('edbutton1', function () {
      var selected_text = editor.selection.getContent();

      if (selected_text.length === 0) {
        alert('Please select some text.');
        return;
      }

      var open_column = '<span class="custom-button-element white"><a data-mce-href="#" href="#"  data-mce-selected="inline-boundary" class="button-element button">';
      var close_column = '</a></span>';
      var return_text = '';
      return_text = open_column + selected_text + close_column;
      editor.execCommand('mceReplaceContent', false, return_text);
      return;
    });
  });
})();
"use strict";

/**
 *  Custom jQuery Scripts
 *  Developed by: Lisa DeBona
 *  Date Modified: 03.31.2026
 */
jQuery(document).ready(function ($) {
  if ($('.popup-image').length) {
    $('.popup-image').fancybox({
      //buttons : ['close','thumbs','fullScreen'],
      buttons: ['fullScreen', 'close'],
      protect: true,
      loop: false,
      hash: false,
      animationEffect: 'fade'
    });
  } // $('.grid').masonry({
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


  var grid = document.querySelector('.masonry-images'); // Initialize Masonry ONLY after images have loaded

  imagesLoaded(grid, function () {
    var msnry = new Masonry(grid, {
      itemSelector: '.masonry-item',
      columnWidth: '.masonry-item',
      percentPosition: true,
      gutter: 0 // Space between items

    });
  });
  var swiperElements = document.querySelectorAll('.swiper');

  if (swiperElements.length) {
    // Loop through each element found
    swiperElements.forEach(function (el) {
      new Swiper(el, {
        speed: 400,
        slidesPerView: 1,
        effect: 'fade',
        loop: true,
        grabCursor: true,
        allowTouchMove: true,
        autoplay: {
          delay: 5000,
          // Time in ms between slides (3 seconds)
          disableOnInteraction: false // Keeps sliding after user interacts

        },
        navigation: false,
        // navigation: {
        //   nextEl: el.querySelector('.swiper-button-next'),
        //   prevEl: el.querySelector('.swiper-button-prev'),
        // },
        pagination: {
          el: el.querySelector('.swiper-pagination'),
          clickable: true
        }
      });
    });
  } //OPEN menu toggle


  $(document).on('click', '.menu-toggle', function (e) {
    e.preventDefault();
    var isExpanded = $(this).attr('aria-expanded') === 'true';
    $(this).attr('aria-expanded', !isExpanded);
    var ariaControls = $(this).attr('aria-controls');

    if ($(ariaControls).length) {
      $(ariaControls).addClass('open');
    }
  }); //CLOSE menu toggle

  $(document).on('click', '.closeMenuToggle', function (e) {
    e.preventDefault();
    $('#primary-navigation').addClass('closed');
    $('.menu-toggle').attr('aria-expanded', 'false');
    setTimeout(function () {
      $('#primary-navigation').removeClass('open closed');
    }, 800);
  });
});