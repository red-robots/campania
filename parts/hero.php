<?php  
$slideshow = get_field('slideshow_images');
if($slideshow) { 
$hero_type = ( count($slideshow) > 1 ) ? 'slideshow swiper':'static'; ?>
<div class="hero <?php echo $hero_type ?>">
  <div class="swiper-wrapper">
  <?php foreach ($slideshow as $slide) { 
    $img = $slide['image'];
    $info = $slide['slide_caption'];
    $slideTitle = (isset($info['title']) && $info['title']) ? $info['title'] : '';
    $slideText = (isset($info['description']) && $info['description']) ? $info['description'] : '';
    $slideButtons = (isset($info['buttons']) && $info['buttons']) ? $info['buttons'] : '';
    if($img) { ?>
    <div class="swiper-slide slide">
      <div class="slideImage" style="background-image:url('<?php echo $img['url'] ?>')"></div>
      <?php if ($slideTitle || $slideText || $slideButtons) { ?>
      <div class="slideText">
        <div class="textWrap">
          <div class="inner">
            <?php if ($slideTitle) { ?>
            <div class="title"><?php echo $slideTitle ?></div> 
            <?php } ?>
            <?php if ($slideText) { ?>
            <div class="text"><?php echo $slideText ?></div> 
            <?php } ?>
            <?php if ($slideButtons) { ?>
            <div class="buttons">
              <?php foreach ($slideButtons as $b) { 
                $btn = $b['button'];
                $btn_url = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                $btn_text = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                $btn_target = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                if($btn_url && $btn_text ) { ?>
                <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_text ?></a>
                <?php } ?>
              <?php } ?>
            </div> 
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  <?php } ?>
  </div>

  <?php if ( count($slideshow) > 1 ) { ?>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>

  <!-- If we need navigation buttons -->
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
  <?php } ?>
</div>
<?php } ?>