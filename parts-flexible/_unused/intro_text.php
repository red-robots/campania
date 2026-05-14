<?php if( get_row_layout() == 'intro_text' ) {  
  $title = get_sub_field('title');
  $text = get_sub_field('text');
  $buttons = get_sub_field('buttons');
  if($title || $text || $buttons) { ?>
  <div data-group="<?php echo get_row_layout() ?>" id="repeatable-<?php echo get_row_layout() ?>--<?php echo $i ?>" class="repeatable repeatable-<?php echo get_row_layout() ?>">
    <div class="intro-wrapper">
      <?php if ($title) { ?>
        <h2 class="stitle"><?php echo $title ?></h2>
      <?php } ?>
      <?php if ($text) { ?>
        <div class="text"><?php echo anti_email_spam($text) ?></div>
      <?php } ?>
      <?php if ($buttons) { ?>
      <div class="buttons">
        <?php foreach($buttons as $b) { 
          $btn = $b['button'];
          $btnStyle = ($b['button_style']) ? $b['button_style'] : 'normal';
          $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
          $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
          $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
          if( $btnTitle && $btnLink ) { ?>
            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button btn-<?php echo $btnStyle ?>"><?php echo $btnTitle ?></a>
          <?php } ?>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } ?>