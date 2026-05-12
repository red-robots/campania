<?php
$partsFiles = get_flexible_parts();
if( have_rows('flexible_content_internal') ) {
$i=1; while( have_rows('flexible_content_internal') ): the_row();
  if($partsFiles) {
    foreach($partsFiles as $file) {
      include( locate_template('parts-flexible/'.$file) );
    }
  }
$i++; endwhile;
} ?>
<script>
jQuery(document).ready(function($){
  const testimonialSwipers = document.querySelectorAll('.testimonial-swiper');
  if(testimonialSwipers.length) {
    // Loop through each element found
    testimonialSwipers.forEach((el) => {
      new Swiper(el, {
        // Essential for centering the main card
        centeredSlides: true,
        slidesPerView: 1.1,
        spaceBetween: 0,
        loop: true,
        speed: 400,
        effect: 'slide',
				grabCursor: true,
				allowTouchMove: true,
        autoplay: {
          delay: 8000, // Time in ms between slides (3 seconds)
          disableOnInteraction: false, // Keeps sliding after user interacts
        },
        navigation: {
          nextEl: el.querySelector('.testimonial-button-next'),
          prevEl: el.querySelector('.testimonial-button-prev'),
        },
        // Listen for events here
        on: {
          // slideChange: function () {
          //   this.el.classList.add('is-changing');
          // },
          // // When the animation starts
          slideChangeTransitionStart: function () {
            this.el.classList.add('is-changing');
          },
          // // When the animation finishes
          slideChangeTransitionEnd: function () {
            this.el.classList.remove('is-changing');
          },
        },
        // Responsive breakpoints
        breakpoints: {
          640: {
            slidesPerView: 1.5,
          },
          1024: {
            slidesPerView: 2.2, // Shows more cards on larger screens
          },
        },
      });
    });
  }
});


function handleResponsiveInfoBlock() {
  const container = document.querySelector('.container'); // Replace with your actual parent class
  const blocks = document.querySelectorAll('.infoBlock');
  const groups = document.querySelectorAll('.infoGroup');
  const isMobile = window.innerWidth <= 960;

  if (isMobile && groups.length === 0) {
    // --- WRAP LOGIC ---
    for (let i = 0; i < blocks.length; i += 2) {
      const wrapper = document.createElement('div');
      wrapper.className = 'infoGroup';

      // Insert wrapper before the first block of the pair
      blocks[i].parentNode.insertBefore(wrapper, blocks[i]);

      // Move the pair into the wrapper
      wrapper.appendChild(blocks[i]);
      if (blocks[i + 1]) {
        wrapper.appendChild(blocks[i + 1]);
      }
    }
  }
  else if (!isMobile && groups.length > 0) {
    // --- UNWRAP LOGIC ---
    groups.forEach(group => {
      // Move all children back to the main container before the group
      while (group.firstChild) {
        group.parentNode.insertBefore(group.firstChild, group);
      }
      // Remove the now-empty wrapper
      group.remove();
    });
  }
}

// Run on load and on every resize
window.addEventListener('resize', handleResponsiveInfoBlock);
window.addEventListener('DOMContentLoaded', handleResponsiveInfoBlock);

</script>
