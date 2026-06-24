<?php if( get_row_layout() == 'callout' ) {  
  $no_margin_top = get_sub_field('no_margin_top');
  $no_margin_bottom = get_sub_field('no_margin_bottom');
  $marginTop = ($no_margin_top) ? ' noMarginTop' : '';
  $marginBottom = ($no_margin_bottom) ? ' noMarginBottom' : '';
  $text = get_sub_field('text');
  $btn = get_sub_field('button');
  $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
  $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
  $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
  if($text || $buttons) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?><?php echo $marginTop.$marginBottom ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php if ($text) { ?>
          <h2 class="calloutTitle"><?php echo anti_email_spam($text) ?></h2>
        <?php } ?>
        <?php if ($btnTitle && $btnLink) { ?>
          <div class="buttons">
            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>