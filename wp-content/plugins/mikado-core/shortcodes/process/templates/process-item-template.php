<div <?php depot_mikado_class_attribute($item_classes); ?>>
    <div class="mkd-pi-holder-inner">
        <div class="mkd-pi-holder-inner-wrapper">
            <?php if(!empty($process_image)) : ?>
                <div class="mkd-image-holder-inner">
                    <img src="<?php echo $image_style; ?>">
                </div>
            <?php endif; ?>
        </div>
            <div class="mkd-pi-content-holder">
                <?php if(!empty($title)) : ?>
                    <div class="mkd-pi-title-holder">
                        <h4 class="mkd-pi-title"><?php echo esc_html($title); ?></h4>
                    </div>
                <?php endif; ?>
                <?php if(!empty($text)) : ?>
                    <div class="mkd-pi-text-holder">
                        <p><?php echo esc_html($text); ?></p>
                    </div>
                <?php endif; ?>
            </div>
    </div>
</div>