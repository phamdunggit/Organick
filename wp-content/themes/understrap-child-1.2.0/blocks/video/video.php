<?php
$heading = get_field('heading');
$sub_heading = get_field('sub-heading');
$text = get_field('text');
$background_image = get_field('background_image');
$link_video = get_field('link_video');
$link_video_embed = str_replace('watch?v=', 'embed/', $link_video) . '?autoplay=1';
// var_dump($link_video_embed);
?>
<div class="video-container" style="background-image: url(<?php echo $background_image['url'] ?>);">
  <div class="video-content">
    <span class="sub-heading"><?php echo $sub_heading ?></span>
    <h2 class="heading"><?php echo $heading ?></h2>
    <p class="text"><?php echo $text ?></p>
    <button type="button" class="play-btn" data-bs-toggle="modal" data-bs-target="#VideoModal">
      <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M20.5 9.90201C22.5 11.0567 22.5 13.9435 20.5 15.0982L4.75 24.1914C2.75 25.3461 0.25 23.9028 0.25 21.5934L0.250001 3.40682C0.250001 1.09741 2.75 -0.345957 4.75 0.808744L20.5 9.90201Z" fill="white" />
      </svg>
    </button>
  </div>
  <div class="modal modal-xl fade" id="VideoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="video-container">

        </div>
      </div>
    </div>
  </div>

</div>
<script>
  jQuery(document).ready(function() {
    $('#VideoModal').on('show.bs.modal', function(event) {
      $('#video-container').append('<iframe id="video" src="<?php echo $link_video_embed ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>')
    });

    // Bắt sự kiện ẩn modal
    $('#VideoModal').on('hide.bs.modal', function(event) {
      $('#video-container').empty();
    });
  });
</script>