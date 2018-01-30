<div class="mkd-container">
    <div class="mkd-container-inner clearfix">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="mkd-portfolio-single-holder <?php echo esc_attr($holder_classes); ?>">
                <?php if(post_password_required()) {
                    echo get_the_password_form();
                } else {
                    do_action('depot_mikado_portfolio_page_before_content');
                
                    mkd_core_get_cpt_single_module_template_part('templates/single/layout-collections/'.$item_layout, 'portfolio', '', $params);
                
                    do_action('depot_mikado_portfolio_page_after_content');
                
                    mkd_core_get_cpt_single_module_template_part('templates/single/parts/navigation', 'portfolio', $item_layout);
                
                    mkd_core_get_cpt_single_module_template_part('templates/single/parts/comments', 'portfolio');
                } ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>