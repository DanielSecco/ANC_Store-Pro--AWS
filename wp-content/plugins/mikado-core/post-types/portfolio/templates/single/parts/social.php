<div class="mkd-portfolio-single-likes">
    <?php echo depot_mikado_like_portfolio_single(); ?>
</div>
<?php if(depot_mikado_options()->getOptionValue('enable_social_share') == 'yes' && depot_mikado_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="mkd-ps-info-item mkd-ps-social-share">
        <?php echo depot_mikado_get_social_share_html() ?>
    </div>
<?php endif; ?>