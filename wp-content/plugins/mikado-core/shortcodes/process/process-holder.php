<?php
namespace MikadoCore\CPT\Shortcodes\ProcessHolder;

use MikadoCore\Lib;

class ProcessHolder implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_process_holder';

        add_action('vc_before_init', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
            'name'                    => esc_html__('Process Holder', 'mkd-core'),
            'base'                    => $this->base,
            'as_parent'               => array('only' => 'mkd_process_item'),
            'category'                => esc_html__('by MIKADO', 'mkd-core'),
            'icon'                    => 'icon-wpb-process extended-custom-icon',
            'js_view'                 => 'VcColumnView',
            'params'                  => array(
                array(
                    'type'        => 'dropdown',
                    'param_name'  => 'number_of_items',
                    'heading'     => esc_html__('Number of Process Items', 'mkd-core'),
                    'value'       => array(
                        esc_html__('Three', 'mkd-core') => 'three',
                        esc_html__('Four', 'mkd-core')  => 'four'
                    ),
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => ''
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = array(
            'number_of_items' => ''
        );

        $params = shortcode_atts($default_atts, $atts);
        $params['content'] = $content;

        $params['holder_classes'] = array(
            'mkd-process-holder',
            'mkd-process-holder-items-'.$params['number_of_items']
        );

        return mkd_core_get_shortcode_module_template_part('templates/process-holder-template', 'process', '', $params);
    }
}