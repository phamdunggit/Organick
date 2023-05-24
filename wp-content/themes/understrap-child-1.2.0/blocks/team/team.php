<?php
$show_all = get_field('show_all');
$team;
// $temp=get_field('image','498');
$args = array(
    'post_type' => 'team',
    'posts_per_page' => -1, // Set to -1 to get all posts
    'fields' => 'ids',
);

if ($show_all == 2) :
    $team = get_field('team');
else :
    $get_all_team = new WP_Query($args);
    $team = $get_all_team->posts;
endif;

// echo "<pre>";
// // var_dump($custom_query->posts);
// var_dump($team);
// // var_dump( get_field('social_network_address', $team['0'])); 
// echo "</pre>";
?>
<?php if (!$team) : else : ?>

    <div class="team-container">
        <div class="team-heading-container">
            <h2 class="team-heading"><?php echo get_field('heading') ?></h2>
            <p class="team-sub-heading"><?php echo get_field('sub-heading') ?></p>
            <div class="team-text"><?php echo get_field('text') ?></div>
        </div>
        <div class="team-wrapper">
            <?php foreach ($team as $member) { ?>
                <div class="member" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $member ?>">
                    <div class="member-image">
                        <img src="<?php echo get_field('image', $member)['url'] ?>" alt="">
                    </div>
                    <div class="member-info">
                        <h5 class="member-name"><?php echo get_the_title($member) ?></h5>
                        <div class="member-detail">
                            <p class="member-position"><?php echo get_field('position', $member) ?></p>
                            <div class="member-social-list">
                                <?php foreach (get_field('social_network_address', $member) as $item) { ?>
                                    <a href="<?php echo $item['link'] ?>" target="_blank"><i class="<?php echo $item['icon'] ?>" aria-hidden="true"></i></a>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="list-modal">
            <?php foreach ($team as $member) { ?>
                <div class="modal modal-xl fade" id="exampleModal<?php echo $member ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col-12"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                                <div class="col-md-12 col-lg-5 modal-member-image">
                                    <img src="<?php echo get_field('image', $member)['url'] ?>" alt="">
                                </div>
                                <div class="col-md-12 col-lg-7 modal-member-info-container">
                                    <div class="modal-member-info">
                                        <h5 class="member-name"><?php echo get_the_title($member) ?></h5>
                                        <p class="member-position"><?php echo get_field('position', $member) ?></p>
                                        <p class="experience">Year of experience: <span><?php echo get_field('experience', $member) ?></span></p>
                                        <div class="quote"><p> "<?php echo get_field('quote', $member) ?>"</p></div>
                                        <div class="member-social-list">
                                            <?php foreach (get_field('social_network_address', $member) as $item) { ?>
                                                <a href="<?php echo $item['link'] ?>" target="_bl"><i class="<?php echo $item['icon'] ?>" aria-hidden="true"></i></a>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<?php endif; ?>