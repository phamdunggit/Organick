<?php
$points=get_field('points');
?>
<div class="point-container">
    <div class="points">
        <?php if(!$points): else :
        foreach($points as $item){
        ?>
        <div class="point">
            <span class="index"><?php echo $item['index'] ?></span>
            <span class="value"><?php echo $item['value'] ?></span>
        </div>
        <?php } endif; ?>
    </div>
</div>