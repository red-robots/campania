<?php if( get_row_layout() == 'news_feeds' ) {
	$number_items = get_sub_field('number_items');
	$perpage = ($number_items) ? $number_items : 10;
	$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
	$args = array(
		'posts_per_page'   => $perpage,
		'orderby'          => 'date',
		'order'            => 'DESC',
		'post_type'        => 'post',
		'post_status'      => 'publish',
		'paged'			   => $paged
	);
	$news = new WP_Query($args);
  if ( $news->have_posts() ) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
		<div class="news-feeds-container">
			<div class="news-feeds">
				<?php while ( $news->have_posts() ) : $news->the_post(); ?>
					<div class="news-item">
						<a href="<?php echo get_permalink(); ?>" class="inside">
							<?php if( $postImage = get_the_post_thumbnail(get_the_ID()) ) { ?>
							<figure class="postImage">
								<?php echo $postImage ?>
							</figure>
							<?php } ?>
							<div class="post-title-wrap">
								<h3><?php the_title(); ?></h3>
								<!-- <div class="post-date">
									<?php //echo get_the_date('n/j/y'); ?>
								</div> -->
							</div>
						</a>
					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>

			<?php
			$total_pages = $news->max_num_pages;
			if ($total_pages > 1){ ?>
				<div id="pagination" class="pagination-wrapper">
					<?php
					$pagination = array(
						'base' => @add_query_arg('pg','%#%'),
						'format' => '?pg=%#%',
						'mid-size' => 1,
						'current' => $paged,
						'total' => $total_pages,
						'prev_next' => True,
						'prev_text' => __( '<span class="fa fa-arrow-left"></span>' ),
						'next_text' => __( '<span class="fa fa-arrow-right"></span>' )
					);
					echo paginate_links($pagination); ?>
				</div>
			<?php } ?>
		</div>
  </div>
  <?php } ?>
<?php } ?>
