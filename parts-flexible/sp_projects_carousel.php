<?php if( get_row_layout() == 'projects_carousel' ) {
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $section_title = get_sub_field('section_title');
  $show_categories = get_sub_field('show_categories');
  $select_projects = get_sub_field('select_projects');
  if($select_projects) { ?>
    <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
      <div class="wrapper">
        <?php if ($section_title) { ?>
          <div class="titleDiv">
            <h2 class="section-title"><?php echo anti_email_spam($section_title) ?></h2>
          </div>
        <?php } ?>

        <div class="projectsCarousel">

          <?php 
          $taxonomy = 'portfolio-categories';
          $all_terms = array();
          foreach($select_projects as $proj) { 
            $post_id = $proj->ID; 
            $terms = get_the_terms( $post_id, $taxonomy );
            if($terms) {
              foreach($terms as $term) {
                $term_id = $term->term_id;
                $all_terms[$term_id] = $term->name;
              }
            }
          }
          if($all_terms) { ?>
          <ul class="projects-categories">
            <li><button class="filter-btn active" data-filter="all"><span>All</span></button></li>
            <?php foreach($all_terms as $term_id => $term_name) { ?>
            <li><button class="filter-btn" data-filter="term--<?php echo $term_id; ?>"><span><?php echo $term_name; ?></span></button></li>
            <?php } ?>
          </ul>
          <?php } ?>
          
          <div class="carousel-wrapper">
            <div class="custom-nav-btn btn-prev">
              <i class="arrow arrow-left"></i>
              <span class="sr-only">Previous</span>
            </div>
            <div class="custom-nav-btn btn-next">
              <i class="arrow arrow-right"></i>
              <span class="sr-only">Next</span>
            </div>

            <div class="swiper mySwiperCarousel">
              <div class="swiper-wrapper">
                <?php foreach($select_projects as $proj) { 
                  $post_id = $proj->ID; 
                  $post_title = $proj->post_title;
                  $post_thumbnail = get_the_post_thumbnail($post_id, 'large');
                  $post_thumbnail_url = get_the_post_thumbnail_url($post_id, 'large');
                  $terms = get_the_terms( $post_id, $taxonomy );
                  $termHash = '';
                  if($terms) {
                    foreach($terms as $term) {
                        $term_id = $term->term_id;
                        $term_name = $term->name;
                        $term_slug = $term->slug;
                        $termHash = 'term--'.$term_id;
                      }
                    }
                    ?>
                    <?php if($post_thumbnail) { ?>
                      <div class="swiper-slide" data-category="<?php echo $termHash; ?>">
                        <a href="<?php echo $post_thumbnail_url;?>" data-fancybox="gallery" data-caption="<?php echo $post_title; ?>">
                          <?php echo $post_thumbnail; ?>
                        </a>
                      </div>
                    <?php } ?>
                  <?php } ?>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      
      </div>
    </div>
  <?php } ?>
<?php } ?>
