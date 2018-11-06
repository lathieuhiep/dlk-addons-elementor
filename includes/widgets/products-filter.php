<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_DLK_Products_Filter extends Widget_Base {

    public function get_categories() {
        return array( 'dlk-addons-elementor' );
    }

    public function get_name() {
        return 'dlk-products-filter';
    }

    public function get_title() {
        return esc_html__( 'DLK Products Filter', 'dlk-addons-elementor' );
    }

    public function get_icon() {
        return 'fa fa-filter';
    }

    protected function _register_controls() {

        /* Section Query */
        $this->start_controls_section(
            'section_query',
            [
                'label' =>  esc_html__( 'Query', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Title', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'FEATURED PRODUCTS', 'dlk-addons-elementor' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Select Category Product', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  dlk_check_get_cat( 'product_cat' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'limit',
            [
                'label'     =>  esc_html__( 'Number of Posts', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  8,
                'min'       =>  1,
                'max'       =>  100,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'    =>  esc_html__( 'Product ID', 'dlk-addons-elementor' ),
                    'title' =>  esc_html__( 'Title', 'dlk-addons-elementor' ),
                    'date'  =>  esc_html__( 'Date', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'order',
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

        /* Section Layout */
        $this->start_controls_section(
            'section_layout',
            [
                'label' =>  esc_html__( 'Layout Settings', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'column_number',
            [
                'label'     =>  esc_html__( 'Column', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  4,
                'options'   =>  [
                    4   =>  esc_html__( '4 Column', 'dlk-addons-elementor' ),
                    3   =>  esc_html__( '3 Column', 'dlk-addons-elementor' ),
                    2   =>  esc_html__( '2 Column', 'dlk-addons-elementor' ),
                    1   =>  esc_html__( '1 Column', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      =>  'thumbnail',
                'exclude'   =>  [ 'custom' ],
                'default'   =>  'medium_large',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings   =   $this->get_settings_for_display();
        $select_cat =   $settings['select_cat'];
        $limit      =   $settings['limit'];
        $order_by   =   $settings['order_by'];
        $order      =   $settings['order'];

        if ( !empty( $select_cat ) ) :

            $args = array(
                'post_type'         =>  'product',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $order_by,
                'order'             =>  $order,
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  'product_cat',
                        'field'     =>  'id',
                        'terms'     =>  $select_cat,
                    ),
                ),
            );

        else:

            $args = array(
                'post_type'         =>  'product',
                'posts_per_page'    =>  $limit,
                'orderby'           =>  $order_by,
                'order'             =>  $order,
            );

        endif;

        $query = new \ WP_Query( $args );

        if ( $query->have_posts() ) :

    ?>

        <div class="element-products-filter">
            <?php if ( !empty( $settings['title'] ) ) : ?>
                <h4 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h4>
            <?php endif; ?>

            <div class="row">
                <?php while ( $query->have_posts() ): $query->the_post(); ?>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( 12 / $settings['column_number'] ); ?>">
                        <div class="item-product">
                            <div class="item-thumbnail">
                                <?php if ( has_post_thumbnail() ) : ?>

                                    <img src="<?php echo esc_url( Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail', $settings ) ); ?>" alt="<?php the_title(); ?>">

                                <?php
                                else:
                                    $no_team_member_image  =   dlk_addons_elementor_path . 'assets/images/no-images.png';
                                ?>

                                    <img src="<?php echo esc_url( $no_team_member_image ) ?>" alt="<?php the_title(); ?>" />

                                <?php endif; ?>
                            </div>

                            <h2 class="item-title">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <?php woocommerce_template_loop_price(); ?>
                        </div>
                    </div>

                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>

    <?php

        endif;
    }

    protected function _content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Products_Filter );