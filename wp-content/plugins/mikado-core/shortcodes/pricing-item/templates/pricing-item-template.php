<div class="mkd-price-item">
        <div class="mkd-pi-inner">
            <div class="mkd-pi-prices">
                <span class="mkd-pi-currency" <?php echo depot_mikado_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
                <p class="mkd-pi-price" <?php echo depot_mikado_get_inline_style($price_styles); ?>><?php echo esc_html($price_value); ?></p>
            </div>

            <div class="mkd-pi-content-holder">
                <h4 class="mkd-pi-title"><?php echo esc_html($title); ?></h4>
                <p class="mkd-pi-subtitle"><?php echo esc_html($subtitle); ?></p>
                <div class="mkd-pi-content">
                    <?php echo do_shortcode($content); ?>
                </div>
            </div>
        </div>
</div>