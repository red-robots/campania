<?php if( get_row_layout() == 'category_section' ) {  
  $section_title = get_sub_field('section_title');
  $categories = get_sub_field('categories');
  if($section_title || $categories) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <div class="wrapper">
      <?php if($section_title) { ?>
      <div class="titleDiv">
        <h2 class="sectionTitle"><?php echo anti_email_spam($section_title) ?></h2>
      </div>
      <?php } ?>

      <?php if($categories) { ?>
      <div class="categories">
        <div class="flexwrap">
        <?php foreach($categories as $cat) { 
          $image = $cat['image'];
          $title = $cat['title'];
          $link = $cat['link'];
          //$aTitle = (isset($link['title']) && $link['title']) ? $link['title'] : '';
          $aLink = (isset($link['url']) && $link['url']) ? $link['url'] : '';
          $aTarget = (isset($link['target']) && $link['target']) ? $link['target'] : '_self';
          $openLink = '<div class="inner">';
          $closeLink = '</div>';
          if($aLink) {
            $openLink = '<a href="'.$aLink.'" target="'.$aTarget.'" class="inner link">';
            $closeLink = '</a>';
          }
          if($image) { ?>
          <div class="imageBlock">
            <?php echo  $openLink; ?>
            <figure>
              <img src="<?php echo $image['url']?>" alt="<?php echo $image['title']?>">
            </figure>
            <?php if($title) { ?>
            <figcaption>
              <span><?php echo anti_email_spam($title) ?></span>
            </figcaption>
            <?php } ?>
            <?php echo  $closeLink; ?>
          </div>
          <?php } ?>
        <?php } ?>
        </div>
      </div>
      <?php } ?>

      <?php
      $cta = get_sub_field('cta_button');
      $ctaTitle = (isset($cta['title']) && $cta['title']) ? $cta['title'] : '';
      $ctaLink = (isset($cta['url']) && $cta['url']) ? $cta['url'] : '';
      $ctaTarget = (isset($cta['target']) && $cta['target']) ? $cta['target'] : '_self';
      if($ctaTitle && $ctaLink) { ?>
      <div class="buttons">
        <a href="<?php echo  $ctaLink ?>" target="<?php echo  $ctaTarget ?>" class="button"><?php echo  $ctaTitle ?></a>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>