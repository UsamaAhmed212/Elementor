<?php 

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Define Concatenate Project Name constants
 */
$CONCAT_PROJECT_NAME = PROJECT_NAME . '-';
define( 'CONCAT_PROJECT_NAME', $CONCAT_PROJECT_NAME );

// Elementor Initialize Class
class elementor_templates_library {

	private static $instance = null;
    static $plugin_data = null;

	public static function init() {
        if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
    
	public function __construct() {
        
        self::$plugin_data = array(
            'root_file' =>  __FILE__,
            'pro-link' => 'https://magic.wpcolors.net/pricing-plan/#mgpricing',
            'remote_site' => 'https://magic.wpcolors.net/',
            'remote_page_site' => 'https://magic.wpcolors.net/',
            'widget' => 'mg-items',
            'mgaddon_import_data' => 'mg-widget'
        );
        
		add_action( 'elementor/editor/before_enqueue_styles', array( $this, 'elementor_editor_styles' )  );

		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'elementor_editor_scripts' ) );

		$this->elementor_Import_templates_library();

        add_action('wp_ajax_process_ajax', array($this, 'ajax_data'));
        
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_widget_styles' ) );
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'editor_preview_widget_styles' ) );

    }
    
	function editor_widget_styles() {

        wp_register_style( CONCAT_PROJECT_NAME . 'templates-library-editor',  ELEMENTOR_TEMPLATES_LIBRARY_DIR_URI . '/templates-library/assets/css/templates-library-editor.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( CONCAT_PROJECT_NAME . 'templates-library-editor' );

	}
	
	function editor_preview_widget_styles() {

		wp_register_style( CONCAT_PROJECT_NAME . 'templates-library-editor-preview',  ELEMENTOR_TEMPLATES_LIBRARY_DIR_URI . '/templates-library/assets/css/templates-library-editor-preview.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( CONCAT_PROJECT_NAME . 'templates-library-editor-preview' );
    
	}
    
	// Elementor Editor Styles Enqueue
	public function elementor_editor_styles() {

		// Templates Library Css Enqueue
        wp_register_style( CONCAT_PROJECT_NAME . 'templates-library', ELEMENTOR_TEMPLATES_LIBRARY_DIR_URI . '/templates-library/assets/css/templates-library.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( CONCAT_PROJECT_NAME . 'templates-library' );
        
    }

	// Elementor Editor Scripts Enqueue
    public function elementor_editor_scripts() {

        // Masonry Enqueue
        wp_enqueue_script('masonry');

		// Templates Library Js Enqueue
        wp_register_script( 'boxshadow-templates-library', ELEMENTOR_TEMPLATES_LIBRARY_DIR_URI . '/templates-library/assets/js/templates-library.js', array(), '1.0.0', true );
        wp_enqueue_script( 'boxshadow-templates-library' );

    }
    
    public function elementor_Import_templates_library() {

		// Elementor Import Templates Library Class
	    require __DIR__ . '/inc/import.php';

	}
    
	function choose_option_table($table_name) {

        if ($table_name == 'element') {
            $out = 'widget';
        } elseif ($table_name == 'section') {
            $out = 'section';
        } elseif ($table_name == 'header-footer') {
            $out = 'header_footer';
        } elseif ($table_name == 'theme-builder') {
            $out = 'themebuilder';
        } else {
            $out = 'pages';
        }
        return $out;
	}
    
    function ajax_data() {
        $direct_data = json_decode(wp_remote_retrieve_body(wp_remote_get(self::$plugin_data['remote_site'] . '/wp-json/mg/v1/' . self::$plugin_data['widget'] . '/')), true);

        $option_type = $this->choose_option_table($_POST['data']['type']);
        $nav = '';
        $data = get_option('mgaddon_ready_items');

        if ($data) {
            $products = $data[$option_type];
        } else {
            $products = $direct_data[$option_type];
        }


        if (is_array($products)) {

            $category = isset($_POST['data']['category']) ? $_POST['data']['category'] : '';
            $page_number = esc_attr($_POST['data']['page']);
            $search = isset($_POST['data']['search']) ? $_POST['data']['search'] : '';
            $limit = 30;
            $offset = 0;

            $current_page = 1;
            if (isset($page_number)) {
                $current_page = (int)$page_number;
                $offset = ($current_page * $limit) - $limit;
            }
            $search_filter = strtolower($search);
            //$paged = $total_products > count($paged_products) ? true : false;

            if (!empty($search_filter)) {
                $filtered_products = array();
                foreach ($products as $product) {
                    if (!empty($search_filter)) {
                        if (preg_match("/{$search_filter}/", strtolower($product['name']))) {
                            $filtered_products[] = $product;
                        }
                    }
                }

                $products = $filtered_products;
            }

            $paged_products = array_slice($products, $offset, $limit);
            $total_products = count($products);
            $total_pages = is_float($total_products / $limit) ? intval($total_products / $limit) + 1 : $total_products / $limit;

            //echo '<div class="filter-wrap"><a data-cat="" href="#">All</a>'.$nav.'</div>';
            echo '<div class="item-inner">';
            echo '<div class="item-wrap">';
            if (count($paged_products)) {
                foreach ($paged_products as $product) {
                    $pro = $product['pro'] ? '<span class="pro">pro</span>' : '';
                    $parent_site = substr($product['thumb'], 0, strpos($product['thumb'], 'wp-content'));
                    if ($product['pro'] && !class_exists('magicalAddonsProMain')) {

                        $btn = '<a target="_blank" href="' . self::$plugin_data['pro-link'] . '" class="buy-tmpl"><i class="eicon-external-link-square"></i> Buy pro</a>';
                    } else {
                        $btn = '<a href="#" data-parentsite="' . $parent_site . '" data-id="' . $product['id'] . '" class="insert-tmpl"><i class="eicon-file-download"></i> Insert</a>';
                    }
        ?>
                    <div class="item">
                        <div class="product">
                            <div data-preview='<?php echo esc_attr($product['preview']); ?>' class='lib-img-wrap'>
                                <?php echo $pro; ?>
                                <img src="<?php echo esc_url($product['thumb']); ?>">
                                <i class="eicon-zoom-in-bold"></i>
                            </div>
                            <div class='lib-footer'>
                                <p class="lib-name"><?php echo esc_html($product['name']); ?></p>
                                <?php echo wp_kses_post($btn); ?>
                            </div>

                        </div>
                    </div>

                    <?php }
                if ($total_pages > 1) {
                    echo '</div><div class="pagination-wrap"><ul>';
                    for ($page_number = 1; $page_number <= $total_pages; $page_number++) { ?>
                        <li class="page-item <?php echo $_POST['data']['page'] == $page_number ? 'active' : ''; ?>"><a class="page-link" href="#" data-page-number="<?php echo esc_attr($page_number); ?>"><?php echo esc_html($page_number); ?></a></li>

        <?php }
                    echo '</ul></div></div>';
                }
            } else {
                $mgnot_template_found = esc_html__('No template found', 'magical-addons-for-elementor');
                echo '<h3 class="no-found">' . $mgnot_template_found . '</h3>';
            }
            die();
        }
    }
    
}

elementor_templates_library::init();