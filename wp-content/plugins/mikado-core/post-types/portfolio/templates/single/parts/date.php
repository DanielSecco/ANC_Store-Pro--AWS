<?php if(depot_mikado_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="mkd-ps-info-item mkd-ps-date">
        <h5 class="mkd-ps-info-title"><?php esc_html_e('Date:', 'mkd-core'); ?></h5>
        <p itemprop="dateCreated" class="mkd-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(depot_mikado_get_page_id()); ?>"/>
    </div>
<?php endif; ?>