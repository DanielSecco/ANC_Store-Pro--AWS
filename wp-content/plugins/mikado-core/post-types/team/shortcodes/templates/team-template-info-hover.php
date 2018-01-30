<div class="mkd-team <?php echo esc_attr($team_member_layout) ?>">
    <div class="mkd-team-inner">
        <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
            <div class="mkd-team-image">
                <?php echo get_the_post_thumbnail($member_id); ?>
                <div class="mkd-team-info-tb">
                    <div class="mkd-team-info-tc">
                        <div class="mkd-team-title-holder">
                            <h4 itemprop="name" class="mkd-team-name entry-title">
                                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                            </h4>
                            <?php if (!empty($position)) { ?>
                                <h6 class="mkd-team-position"><?php echo esc_html($position); ?></h6>
                            <?php } ?>
                        </div>
                        <div class="mkd-team-social-holder-between">
                            <div class="mkd-team-social">
                                <div class="mkd-team-social-inner">
                                    <div class="mkd-team-social-wrapp">
                                        <?php foreach($team_social_icons as $team_social_icon) {
                                            print $team_social_icon;
                                        } ?>
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