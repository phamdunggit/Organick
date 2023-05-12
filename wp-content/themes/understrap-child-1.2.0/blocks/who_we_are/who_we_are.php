<?php
$bg_image=get_field('background_image');
$content =get_field('content');
// echo "<pre>";
// var_dump($content);
// echo "</pre>";
?>
<div class="wwa-wrapper">
    <img class="wwa-img-bg" src="<?php echo $bg_image['image']['url'] ?>" alt="" srcset="">
    <div class="wwa-content">
        <h2 class="wwa-heading"><?php echo $content['heading'] ?></h2>
        <p class="wwa-sub-heading"><?php echo $content['sub-heading'] ?></p>
            <ul class="wwa-list">
                <?php foreach($content['list'] as $item){ ?>
                <li>
                    <h3><?php echo $item['heading'] ?></h3>
                    <p><?php echo $item['text'] ?></p>
                </li>
                <?php } ?>
            </ul>
    </div>
</div>