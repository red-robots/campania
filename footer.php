	</div><!-- #content -->
	
  <?php  
  $company_group_logo = get_field('company_group_logo', 'option');
  $company_website = get_field('company_website', 'option');
  $office_address = get_field('office_address', 'option');
  $office_phone = get_field('office_phone', 'option');
  $footer_message = get_field('footer_message', 'option');
  $restaurant_logos = get_field('restaurant_logos', 'option');
  ?>
  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="footer-content">
      <div class="top-info">
        <?php if ($company_group_logo) { ?>
        <div class="footLogo">
          <?php if ($company_website) { ?>
          <a href="<?php echo $company_website ?>" target="_blank">
            <img src="<?php echo $company_group_logo['url'] ?>" alt="<?php echo $company_group_logo['title'] ?>">
          </a>  
          <?php } else { ?>
            <img src="<?php echo $company_group_logo['url'] ?>" alt="<?php echo $company_group_logo['title'] ?>">
          <?php } ?>
        </div>
        <?php } ?>
        
        <?php if ($office_address) { ?>
        <div class="footAddress">
          <?php echo anti_email_spam($office_address) ?>
        </div>
        <?php } ?>

        <?php if ($office_phone) { ?>
        <div class="footContact">
          <?php echo anti_email_spam($office_phone) ?>
        </div>
        <?php } ?>

        <?php $social_media = get_social_media(); ?>
        <?php if($social_media) { ?>
        <div class="footSocial">
          <?php foreach ($social_media as $icon) { ?>
          <a href="<?php echo $icon['url'] ?>" target="_blank" arial-label="<?php echo ucwords($icon['type']) ?>"><i class="<?php echo $icon['icon'] ?>"></i></a> 
          <?php } ?>
        </div>
        <?php } ?>
      </div>

      <?php if ($footer_message) { ?>
      <div class="middle-info">
        <?php echo anti_email_spam($footer_message) ?>
      </div>
      <?php } ?>

      <?php if ($restaurant_logos) { ?>
      <div class="bottom-info">
        <?php get_template_part('parts/partners_footer'); ?>
      </div>
      <?php } ?>
    </div>
  </footer>

</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>
