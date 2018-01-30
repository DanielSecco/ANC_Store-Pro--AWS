<div class="mkd-testimonial-content" id="mkd-testimonials-<?php echo esc_attr($current_id) ?>" <?php depot_mikado_inline_style($box_styles); ?>>
    <div class="mkd-testimonial-text-holder">
        <?php if(!empty($title)) { ?>
            <h3 itemprop="name" class="mkd-testimonial-title entry-title"><?php echo esc_html($title); ?></h3>
        <?php } ?>
        <?php if(!empty($text)) { ?>
            <p class="mkd-testimonial-text"><?php echo esc_html($text); ?></p>
        <?php } ?>
        <?php if(has_post_thumbnail() || !empty($author)) { ?>
            <div class="mkd-testimonials-author-holder clearfix">
                <?php if(!empty($author)) { ?>
                    <h5 class="mkd-testimonial-author"><span class="mkd-testimonial-author-inner"><?php echo esc_html($author); ?></span></h5>
                <?php } ?>
                <?php if(!empty($position)) { ?>
                    <h6 class="mkd-testimonial-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>