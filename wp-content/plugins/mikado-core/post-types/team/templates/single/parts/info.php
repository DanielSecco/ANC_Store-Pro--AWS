<div class="mkd-team-single-info-holder">
    <div class="mkd-grid-row">
        <div class="mkd-ts-image-holder mkd-grid-col-4">
            <?php the_post_thumbnail(); ?>
        </div>
        <div class="mkd-ts-details-holder mkd-grid-col-8">
            <h2 class="mkd-name"><?php the_title(); ?></h2>
            <p class="mkd-position"><?php echo esc_html($position); ?>
                <?php foreach ($social_icons as $social_icon) {
                    print $social_icon;
                } ?>
            </p>
            <div class="mkd-ts-bio-holder">
                <?php if(!empty($birth_date)) { ?>
                    <div class="mkd-grid-col-6">
                        <div class="mkd-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_calendar icon"></span>
                            <span class="info"><?php echo esc_html('born on: ', 'mkd-core').esc_html($birth_date); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($address)) { ?>
                    <div class="mkd-grid-col-6">
                        <div class="mkd-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_building icon"></span>
                            <span class="info"><?php echo esc_html('lives in: ', 'mkd-core').esc_html($address); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($email)) { ?>
                    <div class="mkd-grid-col-6">
                        <div class="mkd-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_mail_alt icon"></span>
                            <span class="info"><?php echo esc_html('email: ', 'mkd-core').esc_html($email); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($education)) { ?>
                    <div class="mkd-grid-col-6">
                        <div class="mkd-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_ribbon icon"></span>
                            <span class="info"><?php echo esc_html('education: ', 'mkd-core').esc_html($education); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($phone)) { ?>
                    <div class="mkd-grid-col-6">
                        <div class="mkd-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_phone icon"></span>
                            <span class="info"><?php echo esc_html('phone: ', 'mkd-core').esc_html($phone); ?></span>
                        </div>
                    </div>
                <?php } ?>
                <?php if(!empty($resume)) { ?>
                    <div class="mkd-grid-col-6">
                        <div class="mkd-grid-col-6-inner">
                            <span aria-hidden="true" class="icon_document_alt icon"></span>
                            <a href="<?php echo esc_url($resume); ?>" download target="_blank"><span class="info"><?php echo esc_html('download Resume', 'mkd-core'); ?></span></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
	</div>
</div>