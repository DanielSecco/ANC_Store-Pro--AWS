<?php
namespace MikadoCore\CPT\Shortcodes\Portfolio;

use MikadoCore\Lib;

class PortfolioList implements Lib\ShortcodeInterface {
    private $base;

    public function __construct() {
        $this->base = 'mkd_portfolio_list';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Portfolio category filter
	    add_filter( 'vc_autocomplete_mkd_portfolio_list_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio category render
	    add_filter( 'vc_autocomplete_mkd_portfolio_list_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio selected projects filter
	    add_filter( 'vc_autocomplete_mkd_portfolio_list_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio selected projects render
	    add_filter( 'vc_autocomplete_mkd_portfolio_list_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)

	    //Portfolio tag filter
	    add_filter( 'vc_autocomplete_mkd_portfolio_list_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Portfolio tag render
	    add_filter( 'vc_autocomplete_mkd_portfolio_list_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     *
     * @see vc_map
     */
    public function vcMap() {
	    if(function_exists('vc_map')) {
		    vc_map( array(
				    'name'                      => esc_html__( 'Mikado Portfolio List', 'mkd-core' ),
				    'base'                      => $this->getBase(),
				    'category'                  => esc_html__( 'by MIKADO', 'mkd-core' ),
				    'icon'                      => 'icon-wpb-portfolio extended-custom-icon',
				    'allowed_container_element' => 'vc_row',
				    'params'                    => array(
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'type',
						    'heading'     => esc_html__( 'Portfolio List Template', 'mkd-core' ),
						    'value'       => array(
							    esc_html__( 'Gallery', 'mkd-core' ) => 'gallery',
							    esc_html__( 'Masonry', 'mkd-core' ) => 'masonry'
						    ),
						    'save_always' => true,
						    'admin_label' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'number_of_columns',
						    'heading'     => esc_html__( 'Number of Columns', 'mkd-core' ),
						    'value'       => array(
							    esc_html__( 'Default', 'mkd-core' ) => '',
							    esc_html__( 'One', 'mkd-core' )     => '1',
							    esc_html__( 'Two', 'mkd-core' )     => '2',
							    esc_html__( 'Three', 'mkd-core' )   => '3',
							    esc_html__( 'Four', 'mkd-core' )    => '4',
							    esc_html__( 'Five', 'mkd-core' )    => '5'
						    ),
						    'description' => esc_html__( 'Default value is Three', 'mkd-core' ),
						    'save_always' => true,
						    'admin_label' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'space_between_items',
						    'heading'     => esc_html__( 'Space Between Portfolio Items', 'mkd-core' ),
						    'value'       => array(
                                esc_html__( 'Large', 'mkd-core' )   => 'large',
                                esc_html__( 'Medium', 'mkd-core' )   => 'medium',
							    esc_html__( 'Normal', 'mkd-core' )   => 'normal',
							    esc_html__( 'Small', 'mkd-core' )    => 'small',
							    esc_html__( 'Tiny', 'mkd-core' )     => 'tiny',
							    esc_html__( 'No Space', 'mkd-core' ) => 'no'
						    ),
				        	'save_always' => true,
						    'admin_label' => true
					    ),
					    array(
						    'type'        => 'textfield',
						    'param_name'  => 'number_of_items',
						    'heading'     => esc_html__( 'Number of Portfolios Per Page', 'mkd-core' ),
						    'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'mkd-core' ),
						    'value'       => '-1'
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'image_proportions',
						    'heading'     => esc_html__( 'Image Proportions', 'mkd-core' ),
						    'value'       => array(
							    esc_html__( 'Original', 'mkd-core' )  => 'full',
							    esc_html__( 'Square', 'mkd-core' )    => 'square',
							    esc_html__( 'Landscape', 'mkd-core' ) => 'landscape',
							    esc_html__( 'Portrait', 'mkd-core' )  => 'portrait',
							    esc_html__( 'Medium', 'mkd-core' )    => 'medium',
							    esc_html__( 'Large', 'mkd-core' )     => 'large'
						    ),
						    'description' => esc_html__( 'Set image proportions for your portfolio list.', 'mkd-core' ),
                            'dependency'  => array( 'element' => 'type', 'value' => array( 'gallery' ) )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_fixed_proportions',
						    'heading'     => esc_html__( 'Enable Fixed Image Proportions', 'mkd-core' ),
						    'value'       => array_flip(depot_mikado_get_yes_no_select_array(false)),
						    'description' => esc_html__( 'Set predefined image proportions for your masonry portfolio list. This option will apply image proportions you set in Portfolio Single page - dimensions for masonry option.', 'mkd-core' ),
						    'dependency'  => array( 'element' => 'type', 'value' => array( 'masonry' ) )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'category',
						    'heading'     => esc_html__( 'One-Category Portfolio List', 'mkd-core' ),
						    'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'selected_projects',
						    'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'mkd-core' ),
						    'settings'    => array(
							    'multiple'      => true,
							    'sortable'      => true,
							    'unique_values' => true
						    ),
						    'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'autocomplete',
						    'param_name'  => 'tag',
						    'heading'     => esc_html__( 'One-Tag Portfolio List', 'mkd-core' ),
						    'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'order_by',
						    'heading'     => esc_html__('Order By', 'mkd-core'),
						    'value'       => array_flip(depot_mikado_get_query_order_by_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'order',
						    'heading'     => esc_html__('Order', 'mkd-core'),
						    'value'       => array_flip(depot_mikado_get_query_order_array()),
						    'save_always' => true
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'item_style',
						    'heading'     => esc_html__( 'Item Style', 'mkd-core' ),
						    'value'       => array(
							    esc_html__( 'Standard - Shader', 'mkd-core' )                 => 'standard-shader',
							    esc_html__( 'Standard - Switch Featured Images', 'mkd-core' ) => 'standard-switch-images',
							    esc_html__( 'Standard - Move Up', 'mkd-core' ) => 'standard-move-up',
							    esc_html__( 'Gallery - Overlay', 'mkd-core' )                 => 'gallery-overlay',
							    esc_html__( 'Gallery - Slide From Image Bottom', 'mkd-core' ) => 'gallery-slide-from-image-bottom'
						    ),
						    'group'       => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'shadow_around_item',
                            'heading'    => esc_html__('Shadow Around Item', 'mkd-core'),
                            'value'      => array_flip(depot_mikado_get_yes_no_select_array(false, false)),
                            'group'      => esc_html__('Content Layout', 'mkd-core'),
                            'dependency' => array('element' => 'item_style', 'value' => array('standard-shader', 'standard-switch-images', 'standard-move-up')),
                        ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'enable_title',
						    'heading'    => esc_html__( 'Enable Title', 'mkd-core' ),
						    'value'      => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						    'group'      => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'title_tag',
						    'heading'     => esc_html__( 'Title Tag', 'mkd-core' ),
						    'value'       => array_flip(depot_mikado_get_title_tag(true)),
						    'dependency'  => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'title_text_transform',
						    'heading'     => esc_html__( 'Title Text Transform', 'mkd-core' ),
						    'value'       => array_flip(depot_mikado_get_text_transform_array(true)),
						    'dependency'  => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'enable_category',
						    'heading'    => esc_html__( 'Enable Category', 'mkd-core' ),
						    'value'      => array_flip(depot_mikado_get_yes_no_select_array(false, true)),
						    'group'      => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'enable_excerpt',
						    'heading'    => esc_html__( 'Enable Excerpt', 'mkd-core' ),
						    'value'      => array_flip(depot_mikado_get_yes_no_select_array(false)),
						    'group'      => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'textfield',
						    'param_name'  => 'excerpt_length',
						    'heading'     => esc_html__( 'Excerpt Length', 'mkd-core' ),
						    'description' => esc_html__( 'Number of characters', 'mkd-core' ),
						    'dependency'  => array( 'element' => 'enable_excerpt', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Content Layout', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'pagination_type',
						    'heading'     => esc_html__( 'Pagination Type', 'mkd-core' ),
						    'value'       => array(
							    esc_html__( 'None', 'mkd-core' )  => 'no-pagination',
							    esc_html__( 'Standard', 'mkd-core' ) => 'standard',
							    esc_html__( 'Load More', 'mkd-core' )    => 'load-more',
							    esc_html__( 'Infinite Scroll', 'mkd-core' )  => 'infinite-scroll'
						    ),
						    'group'       => esc_html__( 'Additional Features', 'mkd-core' )
					    ),
					    array(
						    'type'       => 'dropdown',
						    'param_name' => 'filter',
						    'heading'    => esc_html__( 'Enable Category Filter', 'mkd-core' ),
						    'value'      => array_flip(depot_mikado_get_yes_no_select_array(false)),
						    'group'      => esc_html__( 'Additional Features', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'filter_order_by',
						    'heading'     => esc_html__( 'Filter Order By', 'mkd-core' ),
						    'value'       => array(
							    esc_html__( 'Name', 'mkd-core' )  => 'name',
							    esc_html__( 'Count', 'mkd-core' ) => 'count',
							    esc_html__( 'Id', 'mkd-core' )    => 'id',
							    esc_html__( 'Slug', 'mkd-core' )  => 'slug'
						    ),
						    'dependency'  => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Additional Features', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'filter_text_transform',
						    'heading'     => esc_html__( 'Filter Text Transform', 'mkd-core' ),
						    'value'       => array_flip(depot_mikado_get_text_transform_array(true)),
						    'dependency'  => array( 'element' => 'filter', 'value' => array( 'yes' ) ),
						    'group'       => esc_html__( 'Additional Features', 'mkd-core' )
					    ),
					    array(
						    'type'        => 'dropdown',
						    'param_name'  => 'enable_article_animation',
						    'heading'     => esc_html__( 'Enable Article Animation', 'mkd-core' ),
						    'value'       => array_flip(depot_mikado_get_yes_no_select_array(false)),
						    'description' => esc_html__( 'Enabling this option you will enable appears animation for your portfolio list items', 'mkd-core' ),
						    'group'       => esc_html__( 'Additional Features', 'mkd-core' )
					    )
				    )
			    )
		    );
	    }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'type'                      => 'gallery',
	        'number_of_columns'         => '3',
            'space_between_items'       => 'normal',
	        'number_of_items'           => '-1',
            'image_proportions'         => 'full',
	        'enable_fixed_proportions'  => 'no',
            'category'                  => '',
            'selected_projects'         => '',
	        'tag'                       => '',
            'order_by'                  => 'date',
            'order'                     => 'ASC',
	        'item_style'                => 'standard-shader',
            'shadow_around_item'       => 'no',
	        'enable_title'              => 'yes',
            'title_tag'                 => 'h4',
	        'title_text_transform'      => '',
            'enable_category'           => 'yes',
            'enable_excerpt'            => 'no',
            'excerpt_length'            => '20',
            'pagination_type'           => 'no-pagination',
            'filter'                    => 'no',
            'filter_order_by'           => 'name',
	        'filter_text_transform'     => '',
            'enable_article_animation'  => 'no',
            'slider_speed'              => '5000',
            'enable_loop'               => 'yes',
            'enable_variable_width'     => 'no',
	        'enable_padding'            => 'no',
            'enable_navigation'         => 'yes',
            'navigation_skin'           => '',
            'enable_pagination'         => 'yes',
            'pagination_skin'           => '',
	        'pagination_position'       => 'on-slider'
        );
		$params = shortcode_atts($args, $atts);
	
	    /***
	     * @params query_results
	     * @params holder_data
	     * @params holder_classes
	     */
		$additional_params = array();
	    
		$query_array = $this->getQueryArray($params);
		$query_results = new \WP_Query($query_array);
	    $additional_params['query_results'] = $query_results;
	
	    $additional_params['holder_data'] = $this->getHolderData($params, $additional_params);
	    $additional_params['holder_classes'] = $this->getHolderClasses($params);
	
	    $params['this_object'] = $this;
	    
	    $html = mkd_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-holder', $params['type'], $params, $additional_params);

        return $html;
	}

	/**
    * Generates portfolio list query attribute array
    *
    * @param $params
    *
    * @return array
    */
	public function getQueryArray($params){
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['order_by'],
			'order'          => $params['order']
		);

		if(!empty($params['category'])){
			$query_array['portfolio-category'] = $params['category'];
		}

		$project_ids = null;
		if (!empty($params['selected_projects'])) {
			$project_ids = explode(',', $params['selected_projects']);
			$query_array['post__in'] = $project_ids;
		}

		if(!empty($params['tag'])){
			$query_array['portfolio-tag'] = $params['tag'];
		}

		if(!empty($params['next_page'])){
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $query_array;
	}
	
	/**
	 * Generates data attributes array
	 *
	 * @param $params
	 * @param $additional_params
	 *
	 * @return string
	 */
	public function getHolderData($params, $additional_params){
		$dataString = '';
		
		if(get_query_var('paged')) {
			$paged = get_query_var('paged');
		} elseif(get_query_var('page')) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}
		
		$query_results = $additional_params['query_results'];
		$params['max_num_pages'] = $query_results->max_num_pages;
		
		if(!empty($paged)) {
			$params['next_page'] = $paged+1;
		}
		
		foreach ($params as $key => $value) {
			if($value !== '') {
				$new_key = str_replace( '_', '-', $key );
				
				$dataString .= ' data-'.$new_key.'='.esc_attr($value);
			}
		}
		
		return $dataString;
	}

	/**
    * Generates portfolio holder classes
    *
    * @param $params
    *
    * @return string
    */
	public function getHolderClasses($params){
		$classes = array();
		
		$classes[] = !empty($params['type']) ? 'mkd-pl-'.$params['type'] : 'mkd-pl-gallery';
		$classes[] = !empty($params['space_between_items']) ? 'mkd-pl-'.$params['space_between_items'].'-space' : 'mkd-pl-normal-space';
		
		$number_of_columns   = $params['number_of_columns'];
		switch ( $number_of_columns ):
			case '1':
				$classes[] = 'mkd-pl-one-column';
				break;
			case '2':
				$classes[] = 'mkd-pl-two-columns';
				break;
			case '3':
				$classes[] = 'mkd-pl-three-columns';
				break;
			case '4':
				$classes[] = 'mkd-pl-four-columns';
				break;
			case '5':
				$classes[] = 'mkd-pl-five-columns';
				break;
			default:
				$classes[] = 'mkd-pl-three-columns';
				break;
		endswitch;

		if(!empty($params['item_style'])){
			$classes[] = 'mkd-pl-'.$params['item_style'];
		}
		
		if($params['enable_fixed_proportions'] === 'yes') {
			$classes[] = 'mkd-pl-images-fixed';
		}
		
		if($params['enable_title'] === 'no' && $params['enable_category'] === 'no' && $params['enable_excerpt'] === 'no') {
			$classes[] = 'mkd-pl-no-content';
		}
		
		if(!empty($params['pagination_type'])){
			$classes[] = 'mkd-pl-pag-'.$params['pagination_type'];
		}
		
		if($params['filter'] === 'yes'){
			$classes[] = 'mkd-pl-has-filter';
		}
		
		if($params['enable_article_animation'] === 'yes'){
			$classes[] = 'mkd-pl-has-animation';
		}
		
		if(!empty($params['enable_variable_width']) && $params['enable_variable_width'] === 'yes'){
			$classes[] = 'mkd-slider-variable-width';
		}
		
		if(!empty($params['navigation_skin'])) {
			$classes[] = 'mkd-nav-'.$params['navigation_skin'].'-skin';
		}
		
		if(!empty($params['pagination_skin'])) {
			$classes[] = 'mkd-pag-'.$params['pagination_skin'].'-skin';
		}
		
		if(!empty($params['pagination_position'])) {
			$classes[] = 'mkd-pag-'.$params['pagination_position'];
		}

        if ($params['shadow_around_item'] == 'yes') {
            $classes[] = 'mkd-pl-shadow-around-item';
        }

		return implode(' ', $classes);
	}

	/**
	 * Generates portfolio article classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	public function getArticleClasses($params){
		$classes = array();
		
		$type        = $params['type'];
		$item_style = $params['item_style'];

		if(get_post_meta(get_the_ID(), "mkd_portfolio_featured_image_meta", true) !== ""  && $item_style === 'standard-switch-images'){
			$classes[] = 'mkd-pl-has-switch-image';
		} elseif (get_post_meta(get_the_ID(), "mkd_portfolio_featured_image_meta", true) === ""  && $item_style === 'standard-switch-images') {
			$classes[] = 'mkd-pl-no-switch-image';
		}

		$image_proportion = $params['enable_fixed_proportions'] === 'yes' ? 'fixed' : 'original';
        $masonry_size = get_post_meta(get_the_ID(), 'mkd_portfolio_masonry_'.$image_proportion.'_dimensions_meta', true);

		$classes[] = !empty($masonry_size) && $type === 'masonry' ? 'mkd-pl-masonry-'.esc_attr($masonry_size) : '';
		
		$article_classes = get_post_class($classes);

		return implode(' ', $article_classes);
	}

	/**
    * Generates portfolio image size
    *
    * @param $params
    *
    * @return string
    */
	public function getImageSize($params){
		$thumb_size = 'full';

		if (!empty($params['image_proportions']) && $params['type'] == 'gallery') {
			$image_size = $params['image_proportions'];

			switch ($image_size) {
				case 'landscape':
					$thumb_size = 'depot_landscape';
					break;
				case 'portrait':
					$thumb_size = 'depot_portrait';
					break;
				case 'square':
					$thumb_size = 'depot_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		if($params['type'] == 'masonry' && $params['enable_fixed_proportions'] === 'yes') {
			$fixed_image_size = get_post_meta(get_the_ID(), 'mkd_portfolio_masonry_fixed_dimensions_meta', true);

			switch ($fixed_image_size) {
				case 'default' :
					$thumb_size = 'depot_square';
					break;
				case 'large-width':
					$thumb_size = 'depot_landscape';
					break;
				case 'large-height':
					$thumb_size = 'depot_portrait';
					break;
				case 'large-width-height':
					$thumb_size = 'depot_huge';
					break;
				default :
					$thumb_size = 'full';
					break;
			}
		}

		return $thumb_size;
	}

	/**
	 * Returns array of title element styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getTitleStyles($params) {
		$styles = array();
		
		if(!empty($params['title_text_transform'])) {
			$styles[] = 'text-transform: '.$params['title_text_transform'];
		}
		
		return implode(';', $styles);
	}

	/**
	 * Get portfolio featured image for switch featured images hover style
	 *
	 * @return string
	 */
	public function getSwitchFeaturedImage(){
		$featured_image_meta = get_post_meta(get_the_ID(), 'mkd_portfolio_featured_image_meta', true);
		
		$featured_image = !empty($featured_image_meta) ? esc_url($featured_image_meta) : '';

		return $featured_image;
	}

	/**
    * Generates filter categories array
    *
    * @param $params
    *
	* @return array
    */
	public function getFilterCategories($params){
		$cat_id = 0;

		if(!empty($params['category'])){
			$top_category = get_term_by('slug', $params['category'], 'portfolio-category');

			if(isset($top_category->term_id)){
				$cat_id = $top_category->term_id;
			}
		}

        $order = $params['filter_order_by'] === 'count' ? 'DESC' : 'ASC';

		$args = array(
			'taxonomy' => 'portfolio-category',
			'child_of' => $cat_id,
			'orderby' => $params['filter_order_by'],
			'order'  => $order
		);

		$filter_categories = get_terms($args);

		return $filter_categories;
	}
	
	/**
	 * Returns array of filter element items styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	public function getFilterStyles($params) {
		$styles = array();
		
		if(!empty($params['filter_text_transform'])) {
			$styles[] = 'text-transform: '.$params['filter_text_transform'];
		}
		
		return implode(';', $styles);
	}
	
	/**
	 * Returns link url for items
	 *
	 * @return string
	 */
    public function getItemLink(){
	    $portfolio_link_meta = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
	
	    $portfolio_link = !empty($portfolio_link_meta) ? $portfolio_link_meta : get_permalink(get_the_ID());

        return $portfolio_link;
    }
	
	/**
	 * Returns link target for items
	 *
	 * @return string
	 */
	public function getItemLinkTarget(){
		$portfolio_link_meta = get_post_meta(get_the_ID(), 'portfolio_external_link', true);
		
		$portfolio_link_target = !empty($portfolio_link_meta) ? '_blank' : '_self';
		
		return $portfolio_link_target;
	}

	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'mkd-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {

				$portfolio_category_slug = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;

				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'mkd-core' ) . ': ' . $portfolio_category_title;
				}

				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'mkd-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'mkd-core' ) . ': ' . $value['title'] : '' );
				$results[] = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {

				$portfolio_id = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;

				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'mkd-core' ) . ': ' . $portfolio_title;
				}

				$portfolio_id_display = esc_html__( 'Id', 'mkd-core' ) . ': ' . $portfolio_id;

				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}

	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'mkd-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}

		return $results;
	}

	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {

				$portfolio_tag_slug = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;

				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'mkd-core' ) . ': ' . $portfolio_tag_title;
				}

				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;

				return ! empty( $data ) ? $data : false;
			}

			return false;
		}

		return false;
	}
}