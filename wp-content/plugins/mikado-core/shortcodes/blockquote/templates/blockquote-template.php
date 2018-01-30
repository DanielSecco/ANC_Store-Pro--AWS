<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="mkd-blockquote-shortcode" <?php depot_mikado_get_inline_style($blockquote_style); ?> >
	<h5 class="mkd-blockquote-text">
        <span>&#8220;</span><span><?php echo esc_attr($text); ?></span><span>&#8221;</span>
	</h5>
    <span class="mkd-blockquote-author">
        <?php echo esc_attr($author); ?>
    </span>
</blockquote>