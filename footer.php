	</div><!-- #content -->
	
  <?php  
  // $company_group_logo = get_field('company_group_logo', 'option');
  // $company_website = get_field('company_website', 'option');
  // $office_address = get_field('office_address', 'option');
  // $office_phone = get_field('office_phone', 'option');
  // $footer_message = get_field('footer_message', 'option');
  // $restaurant_logos = get_field('restaurant_logos', 'option');
  ?>
  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="wrapper">
      <div class="footer-content">
        <?php if( has_nav_menu('footer') ) { 
          wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu','link_before'=>'<span>','link_after'=>'</span>','items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>') ); ?>
        <?php } ?>  
        <div class="site-icon"></div>
      </div>
      <div class="copyright">
        <span>&copy; <?php echo get_bloginfo('name') ?> <?php echo date('Y') ?></span>
      </div>
    </div>
  </footer>

</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>
