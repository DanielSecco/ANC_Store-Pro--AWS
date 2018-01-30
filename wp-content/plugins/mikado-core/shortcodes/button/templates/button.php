<button type="submit" <?php depot_mikado_inline_style($button_styles); ?> <?php depot_mikado_class_attribute($button_classes); ?> <?php echo depot_mikado_get_inline_attrs($button_data); ?> <?php echo depot_mikado_get_inline_attrs($button_custom_attrs); ?>>
    <span class="mkd-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo depot_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>