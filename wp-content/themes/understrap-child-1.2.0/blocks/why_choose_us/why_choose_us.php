<?php
$heading = get_field('heading');
$sub_heading = get_field('sub-heading');
$text = get_field('text');
$points = get_field('points');
$image = get_field('image');
$policies = get_field('policies');
// echo '<pre>';
// var_dump($points);
// echo '</pre>';
?>
<div class="why-choose-us-container">
    <div class="row">
        <div class="col-md-12 col-lg-6 wcu-content">
            <div class="wcu-heading">
                <h2><?php echo $heading ?></h2>
                <p><?php echo $sub_heading ?></p>
            </div>
            <div class="wcu-text"><?php echo $text ?></div>
            <?php if(!$points): else : ?> 
            <div class="wcu-points">
                <?php foreach($points as $item){ ?>
                <div class="point">
                    <h4>
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="9.5" cy="9.5" r="9.5" fill="#7EB693" />
                            <circle cx="9.5" cy="9.5" r="5.5" fill="#ECECEC" />
                        </svg>
                        &nbsp;
                        <?php echo $item['point'] ?>
                    </h4>
                    <p><?php echo $item['text'] ?></p>        
                </div>
                <?php } ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-md-12 col-lg-6 wcu-image">
            <img src="<?php echo $image['url'] ?>" alt="" srcset="">
        </div>
        <?php if(!$policies): else: ?>
        <div class="col-12 wcu-policies">
        <?php foreach($policies as $item){ ?>
            <div class="policy">
                <div class="policy-icon">
                    <img src="<?php echo $item['icon']['url'] ?>" alt="">
                </div>
                <h3><?php echo $item['heading'] ?></h3>
                <p><?php echo $item['text'] ?></p>
            </div>
            <?php } ?>
        </div>
        <?php endif ?>
    </div>
</div>