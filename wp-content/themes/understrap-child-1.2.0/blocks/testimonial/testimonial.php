<?php
$bg_image = get_field('background_image');
$counters = get_field('counters');
$testimonial = get_field('testimonial');
// echo "<pre>", var_dump($counters), "</pre>";
?>
<div class="testimonial-wrapper">
    
    <img src="<?php echo $bg_image['url'] ?>" class="background-image" alt="" srcset="">
    <div class="content">
    <h3 class="heading-testimonial">Testimonial</h3>
    <p class="sub-heading-testimonial">What Our Customer Saying?</p>
        <div class="testimonial">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($testimonial as $key => $item) {
                        if ($key == 0) :
                    ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key ?>" class="active" aria-current="true" aria-label="Slide <?php echo $key + 1; ?>"></button>
                        <?php else : ?>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $key ?>" aria-label="Slide <?php echo $key + 1; ?>"></button>
                    <?php endif;
                    } ?>

                </div>
                <div class="carousel-inner testimonial-carousel">
                    <?php foreach ($testimonial as $key => $item) {
                        if ($key == 0) :
                    ?>
                            <div class="carousel-item active">
                                <img class="customer-image" src="<?php echo $item['customer_image']['url'] ?>" alt="">
                                <p class="testimonial-text"><?php echo $item['text'] ?></p>
                                <p class="customer-name"><?php echo $item['customer_name'] ?></p>
                                <div class="customer-position"><?php echo $item['position'] ?></div>
                            </div>
                        <?php else : ?>
                            <div class="carousel-item">
                                <img class="customer-image" src="<?php echo $item['customer_image']['url'] ?>" alt="">
                                <p class="testimonial-text"><?php echo $item['text'] ?></p>
                                <p class="customer-name"><?php echo $item['customer_name'] ?></p>
                                <div class="customer-position"><?php echo $item['position'] ?></div>
                            </div>
                    <?php endif;
                    } ?>
                </div>
            </div>
        </div>
        <div class="counters">
            <?php foreach($counters as $item){ ?>
            <div class="counter">
                <h4 class="counter-index"><?php echo $item['index'] ?></h4>
                <p class="counter-text"><?php echo $item['text'] ?></p>
            </div>
            <?php } ?>
        </div>
    </div>

</div>