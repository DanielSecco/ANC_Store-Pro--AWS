<?php if($icon_animation_holder) : ?>
    <span class="mkd-icon-animation-holder" <?php depot_mikado_inline_style($icon_animation_holder_styles); ?>>
<?php endif; ?>
    <span <?php depot_mikado_class_attribute($icon_holder_classes); ?> <?php depot_mikado_inline_style($icon_holder_styles); ?> <?php echo depot_mikado_get_inline_attrs($icon_holder_data); ?>>
        <?php if(!empty($link)) : ?>
            <a itemprop="url" class="<?php echo esc_attr($link_class) ?>" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
        <?php endif; ?>
            <?php echo depot_mikado_icon_collections()->renderIcon($icon, $icon_pack, $icon_params); ?>
        <?php if(!empty($link)) : ?>
            </a>
        <?php endif; ?>
    </span>
<?php if($icon_animation_holder) : ?>
    </span>
<?php endif; ?>
