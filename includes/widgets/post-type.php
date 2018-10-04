<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_DLK_Post_type extends Widget_Base {

    public function get_categories() {
        return array( 'dlk-addons-elementor' );
    }

    public function get_name() {
        return 'dlk-post-type';
    }

    public function get_title() {
        return esc_html__( 'DLK Post Type', 'dlk-addons-elementor' );
    }

    public function get_icon() {
        return 'eicon-post';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'dlk_section_post_type',
            [
                'label' =>  esc_html__( 'Post Type', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'dlk_post_type_title',
            [
                'label'         =>  esc_html__( 'Title', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Post', 'dlk-addons-elementor' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'dlk_post_type__column_number',
            [
                'label'     =>  esc_html__( 'Column', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  3,
                'options'   =>  [
                    4   =>  esc_html__( '4 Column', 'dlk-addons-elementor' ),
                    3   =>  esc_html__( '3 Column', 'dlk-addons-elementor' ),
                    2   =>  esc_html__( '2 Column', 'dlk-addons-elementor' ),
                    1   =>  esc_html__( '1 Column', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'dlk_post_type_select_cat',
            [
                'label'         =>  esc_html__( 'Select Category Post', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  dlk_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'dlk_post_type_limit',
            [
                'label'     =>  esc_html__( 'Number of Posts', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  6,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'dlk_post_type_order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'            =>  esc_html__( 'Post ID', 'dlk-addons-elementor' ),
                    'author'        =>  esc_html__( 'Post Author', 'dlk-addons-elementor' ),
                    'title'         =>  esc_html__( 'Title', 'dlk-addons-elementor' ),
                    'date'          =>  esc_html__( 'Date', 'dlk-addons-elementor' ),
                    'rand'          =>  esc_html__( 'Random', 'dlk-addons-elementor' ),
                    'comment_count' =>  esc_html__( 'Comment count', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'dlk_post_type_order',
            [
                'label'     =>  esc_html__( 'Order', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'Ascending', 'dlk-addons-elementor' ),
                    'DESC'  =>  esc_html__( 'Descending', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $cat_post       =   $settings['dlk_post_type_select_cat'];
        $limit_post     =   $settings['dlk_post_type_limit'];
        $order_by_post  =   $settings['dlk_post_type_order_by'];
        $order_post     =   $settings['dlk_post_type_order'];

        if ( !empty( $cat_post ) ) :

            $dlk_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'cat'               =>  $cat_post
            );

        else:

            $dlk_post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post
            );

        endif;

        $dlk_post_type_query = new \ WP_Query( $dlk_post_type_arg );

        if ( $dlk_post_type_query->have_posts() ) :

    ?>

        <div class="dlk-post-type">

            <?php while ( $dlk_post_type_query->have_posts() ): $dlk_post_type_query->the_post(); ?>

                <h3>
                    <?php the_title(); ?>
                </h3>

            <?php endwhile; wp_reset_postdata(); ?>

        </div>

    <?php

        endif;
    }

    protected function content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Post_type );