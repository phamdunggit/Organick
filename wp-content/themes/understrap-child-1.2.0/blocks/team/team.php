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

echo "<pre>";
// var_dump($custom_query->posts);
var_dump($team);
// var_dump( get_field('social_network_address', $team['0'])); 
echo "</pre>";
?>
<?php if (!$team) : else : ?>
    <div class="team-wrapper">
        <div class="team-heading">
            <h2 class="team-heading"></h2>
            <p class="team-sub-heading"></p>
            <div class="team-text"></div>
        </div>
        <?php foreach ($team as $member) { ?>
            <div class="member" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $member ?>">
                <div class="member-image">
                    <img src="<?php echo get_field('image', $member)['url'] ?>" alt="">
                </div>
                <div class="member-info">
                    <h5 class="member-name"><?php echo get_the_title($member) ?></h5>
                    <p class="member-position"><?php echo get_field('position', $member) ?></p>
                    <div class="member-social-list">
                        <?php foreach (get_field('social_network_address', $member) as $item) { ?>
                            <a href="<?php echo $item['link'] ?>"><i class="<?php echo $item['icon'] ?>" aria-hidden="true"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="list-modal">
            <?php foreach ($team as $member) { ?>
                <div class="modal fade" id="exampleModal<?php echo $member ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <h1>hello</h1>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>