<?php if( get_row_layout() == 'features_block_icons' ) {  
  $featured_image = get_sub_field('featured_image');
  $title = get_sub_field('title');
  $buttons = get_sub_field('buttons');
  $icons = get_sub_field('icons');
  if($featured_image || $title || $icons) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php if($featured_image) { ?>
        <figure class="imageBlock">
          <img src="<?php echo $featured_image['url']?>" alt="" role="presentation">
        </figure>
        <?php } ?>

        <?php if($title || $icons) { ?>
        <div class="textBlock">
          <div class="wrap">
            <?php if($title) { ?>
            <div class="titleBlock">
              <div class="h2">
                <?php echo anti_email_spam($title) ?>
              </div>
              <?php if ($buttons) { ?>
              <div class="buttons">
                <?php foreach($buttons as $b) {
                  $btn = $b['button'];
                  $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                  $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                  $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                  if( $btnTitle && $btnLink ) { ?>
                    <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                  <?php } ?>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
            <?php } ?>

            <?php if($icons) { ?>
            <div class="iconsBlock">
              <?php foreach($icons as $c) { 
                $icon = $c['icon'];
                $text = $c['text'];
                ?>
                <div class="info">
                  <?php if($icon) { ?>
                  <div class="icon">
                    <img src="<?php echo $icon['url']?>" alt="" role="presentation">
                  </div>
                  <?php } ?>

                  <?php if($text) { ?>
                  <div class="text">
                    <?php echo anti_email_spam($text) ?>
                  </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>