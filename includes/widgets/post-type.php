<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_DLK_Post_Type extends Widget_Base {

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
                'default'       =>  esc_html__( 'Post', 'dlk-addons-elementor' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'select_cat',
            [
                'label'         =>  esc_html__( 'Select Category Post', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::SELECT2,
                'options'       =>  dlk_check_get_cat( 'category' ),
                'multiple'      =>  true,
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'limit',
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
            'order_by',
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
                'default'   =>  3,
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

        $this->add_control(
            'show_excerpt',
            [
                'label'     =>  esc_html__( 'Show excerpt', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    '1' => [
                        'title' =>  esc_html__( 'Yes', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-check',
                    ],
                    '0' => [
                        'title' =>  esc_html__( 'No', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-ban',
                    ]
                ],
                'default' => '1'
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'     =>  esc_html__( 'Excerpt Words', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  '10',
                'condition' =>  [
                    'show_excerpt' => '1',
                ],
            ]
        );

        $this->end_controls_section();

        /* Section style title */
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__( 'Title', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-type .item-post .item-post__title a'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     =>  esc_html__( 'Color Hover', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-type .item-post .item-post__title a:hover'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .element-post-type .item-post .item-post__title',
            ]
        );

        $this->add_control(
            'title_alignment',
            [
                'label'     =>  esc_html__( 'Title Alignment', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>  esc_html__( 'Center', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-right',
                    ],
                    'justify'=> [
                        'title' =>  esc_html__( 'Justified', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-justify',
                    ],
                ],
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-type .item-post .item-post__title'   =>  'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        /* Section style excerpt  */
        $this->start_controls_section(
            'section_style_excerpt',
            [
                'label' => esc_html__( 'Excerpt', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-type .item-post .item-post__content p'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .element-post-type .item-post .item-post__content p',
            ]
        );

        $this->add_control(
            'excerpt_alignment',
            [
                'label'     =>  esc_html__( 'Excerpt Alignment', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-left',
                    ],
                    'center' => [
                        'title' =>  esc_html__( 'Center', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-right',
                    ],
                    'justify'=> [
                        'title' =>  esc_html__( 'Justified', 'dlk-addons-elementor' ),
                        'icon'  =>  'fa fa-align-justify',
                    ],
                ],
                'toggle'    =>  true,
                'selectors' =>  [
                    '{{WRAPPER}} .element-post-type .item-post .item-post__content p'   =>  'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings       =   $this->get_settings_for_display();
        $cat_post       =   $settings['select_cat'];
        $limit_post     =   $settings['limit'];
        $order_by_post  =   $settings['order_by'];
        $order_post     =   $settings['order'];

        if ( !empty( $cat_post ) ) :

            $post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post,
                'cat'               =>  $cat_post
            );

        else:

            $post_type_arg = array(
                'post_type'         =>  'post',
                'posts_per_page'    =>  $limit_post,
                'orderby'           =>  $order_by_post,
                'order'             =>  $order_post
            );

        endif;

        $post_type_query = new \ WP_Query( $post_type_arg );

        if ( $post_type_query->have_posts() ) :

    ?>

        <div class="element-post-type">
            <div class="row">
                <?php while ( $post_type_query->have_posts() ): $post_type_query->the_post(); ?>

                <div class="col-12 col-sm-6 col-md-4 col-lg-<?php echo esc_attr( 12 / $settings['column_number'] ); ?>">
                    <div class="item-post">
                        <div class="item-post__thumbnail">
                            <img src="<?php echo esc_url( Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail', $settings ) ); ?>" alt="<?php the_title(); ?>">
                        </div>

                        <h2 class="item-post__title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php if ( $settings['show_excerpt'] == 1 ) : ?>

                            <div class="item-post__content">
                                <p>
                                    <?php
                                    if ( has_excerpt() ) :
                                        echo esc_html( wp_trim_words( get_the_excerpt(), $settings['excerpt_length'], '...' ) );
                                    else:
                                        echo esc_html( wp_trim_words( get_the_content(), $settings['excerpt_length'], '...' ) );
                                    endif;
                                    ?>
                                </p>
                            </div>

                        <?php endif; ?>
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

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Post_Type );