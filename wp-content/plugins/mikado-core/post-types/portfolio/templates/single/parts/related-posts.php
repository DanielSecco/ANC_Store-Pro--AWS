<?php
// ova opcija trenutno ne postoji pa ako vam treba samo je napravite
$show_related_posts = depot_mikado_options()->getOptionValue('portfolio_single_related_posts') == 'yes' ? true : false;

$post_id = get_the_ID();
$related_posts = mkd_core_get_portfolio_single_related_posts($post_id);
?>
<?php if($show_related_posts) { ?>
    <div class="mkd-ps-related-posts-holder">
        <div class="mkd-ps-related-posts">
            <?php
	            if ( $related_posts && $related_posts->have_posts() ) :
	                while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <div class="mkd-ps-related-post">
			                <?php if(has_post_thumbnail()) { ?>
		                        <div class="mkd-ps-related-image">
			                        <a itemprop="url" href="<?php the_permalink(); ?>" target="_self">
				                        <?php the_post_thumbnail('full'); ?>
			                        </a>
	                            </div>
			                <?php } ?>
	                        <div class="mkd-ps-related-text">
		                        <h4 itemprop="name" class="mkd-ps-related-title entry-title">
			                        <a itemprop="url" href="<?php the_permalink(); ?>" target="_self"><?php the_title(); ?></a>
		                        </h4>
		                        <?php $categories = wp_get_post_terms($post_id, 'portfolio-category'); ?>
		                        <?php if(!empty($categories)) { ?>
			                        <div class="mkd-ps-related-categories">
				                        <?php foreach ($categories as $cat) { ?>
					                        <a itemprop="url" class="mkd-ps-related-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
				                        <?php } ?>
			                        </div>
		                        <?php } ?>
	                        </div>
                        </div>
	                <?php
	                endwhile;
	            endif;
            
                wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>
