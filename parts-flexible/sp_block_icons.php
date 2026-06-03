<?php if( get_row_layout() == 'block_icons' ) {  
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $top_text = get_sub_field('top_text');
  $icons = get_sub_field('icons_with_info');
  if($top_text || $icons) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
    <div class="wrapper">
      <div class="inside">
        <div class="wrap">
          <?php if ($top_text) { ?>
            <div class="top-text"><?php echo anti_email_spam($top_text) ?></div>
          <?php } ?>
          <?php if ($icons) { ?>
            <div class="iconsList">
              <?php foreach($icons as $c) { 
                $icon = $c['icon'];
                $text = $c['text'];
                ?>
                <div class="info">
                  <div class="inner">
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
                </div>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>