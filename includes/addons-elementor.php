<?php

namespace Elementor;

class dlk_addons_elementor_widgets {

    /**
     * Plugin constructor.
     */
    public function __construct() {
        $this->dlk_addons_elementor_add_actions();
    }

    private function dlk_addons_elementor_add_actions() {

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'dlk_addons_elementor_widgets_registered' ] );
        add_action( 'elementor/init', [ $this, 'dlk_addons_elementor_widgets_int' ] );

    }

    public function dlk_addons_elementor_widgets_registered() {
        $this->dlk_addons_elementor_includes();
    }

    public function dlk_addons_elementor_widgets_int() {
        $this->dlk_addons_elementor_register_widget();
    }

    private function dlk_addons_elementor_includes() {

        require_once ( dlk_addons_elementor_server_path . '/includes/widgets/post-type.php' );
        require_once ( dlk_addons_elementor_server_path . '/includes/widgets/team-members.php' );
        require_once ( dlk_addons_elementor_server_path . '/includes/widgets/price-table.php' );

        if ( class_exists('Woocommerce') ) :
            require_once ( dlk_addons_elementor_server_path . '/includes/widgets/products-filter.php' );
        endif;

    }

    private function dlk_addons_elementor_register_widget() {

        Plugin::instance()->elements_manager->add_category(
            'dlk-addons-elementor',
            [
                'title' => esc_html__( 'DLK Addons Elementor', 'dlk-addons-elementor' ),
                'icon'  => 'icon-goes-here'
            ]
        );

    }

}

new dlk_addons_elementor_widgets();

/* Start get Category check box */
function dlk_check_get_cat( $type_taxonomy ) {

    $cat_check    =   array();
    $category     =   get_terms(
        array(
            'taxonomy'      =>  $type_taxonomy,
            'hide_empty'    =>  false
        )
    );

    if ( isset( $category ) && !empty( $category ) ):

        foreach( $category as $item ) {

            $cat_check[$item->term_id]  =   $item->name.'('. $item->count .')';

        }

    endif;

    return $cat_check;

}
/* End get Category check box */