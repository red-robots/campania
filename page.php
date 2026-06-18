<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
get_header();
$repeatable_blocks = get_field('flexible_content');
$flexible_content_internal = get_field('subpage_flexible_content');
?>
<?php if($flexible_content_internal) { ?>

  <div id="primary" class="content-area flexible-content-internal">
    <?php include( locate_template('repeatable-blocks-internal.php') ); ?>
  </div>

<?php } else { ?>
<div id="primary" class="content-area-full generic-layout">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <?php if ($repeatable_blocks) { ?>
        <?php include( locate_template('repeatable-blocks.php') ); ?>
      <?php } else { ?>
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php } ?>

<script>
jQuery(document).ready(function($){
  if( $(".mySwiperCarousel").length ) {
    let swiper;

    // 1. Core initialization function
    function initSwiper() {
      swiper = new Swiper(".mySwiperCarousel", {
          slidesPerView: 3, 
          spaceBetween: 30,
          // Loop is set to true, but we'll dynamically manage it based on filtered content length
          loop: document.querySelectorAll('.swiper-slide:not(.hidden-slide)').length >= 3,
          autoplay: {
              delay: 3000,
              disableOnInteraction: false,
              pauseOnMouseEnter: true,
          },
          navigation: {
              nextEl: ".btn-next",
              prevEl: ".btn-prev",
          },
          breakpoints: {
              0: { slidesPerView: 1, spaceBetween: 10 },
              640: { slidesPerView: 2, spaceBetween: 20 },
              1024: { slidesPerView: 3, spaceBetween: 30 },
          },
      });
    }

    // Run Swiper initial load
    initSwiper();

    // 2. Filter Button Logic
    const filterButtons = document.querySelectorAll('.filter-btn');
    const allSlides = document.querySelectorAll('.mySwiperCarousel .swiper-slide');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
          // Change Active Styling of Nav Items
          filterButtons.forEach(btn => btn.classList.remove('active'));
          button.classList.add('active');

          const targetFilter = button.getAttribute('data-filter');
          console.log(targetFilter);
          // Destroy existing Swiper parameters completely before filtering elements
          swiper.destroy(true, true);

          // Show/Hide slides depending on data-category properties
          allSlides.forEach(slide => {
              const slideCategory = slide.getAttribute('data-category');
             
              if (targetFilter === 'all' || slideCategory === targetFilter) {
                  slide.classList.remove('hidden-slide');
              } else {
                  slide.classList.add('hidden-slide');
              }
          });

          // Update Fancybox grouping to only open slides visible on screen
          Fancybox.unbind("[data-fancybox='gallery']");
          Fancybox.bind(".swiper-slide:not(.hidden-slide) [data-fancybox='gallery']", {
              loop: true,
              on: {
                  done: () => { swiper.autoplay.stop(); },
                  close: () => { swiper.autoplay.start(); }
              }
          });

          // Re-build Swiper with the remaining slides
          initSwiper();
      });
    });

    // Initial Fancybox bind for all visible slides
    Fancybox.bind(".swiper-slide:not(.hidden-slide) [data-fancybox='gallery']", {
      loop: true,
      on: {
          done: () => { swiper.autoplay.stop(); },
          close: () => { swiper.autoplay.start(); }
      }
    });
  }
});
</script>
<?php
get_footer();
