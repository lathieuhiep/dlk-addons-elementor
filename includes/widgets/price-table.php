<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_DLK_Price_Table extends Widget_Base {

    public function get_categories() {
        return array( 'dlk-addons-elementor' );
    }

    public function get_name() {
        return 'dlk-price-table';
    }

    public function get_title() {
        return esc_html__( 'DLK Price Table', 'dlk-addons-elementor' );
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    protected function _register_controls() {

        /* Section Settings */
        $this->start_controls_section(
            'section_settings',
            [
                'label' =>  esc_html__( 'Settings', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'pricing_style',
            [
                'label'     =>  esc_html__( 'Pricing Style', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'style-1',
                'options'   =>  [
                    'style-1'   =>  esc_html__( 'Default', 'dlk-addons-elementor' ),
                    'style-2'   =>  esc_html__( 'Pricing Style 2', 'dlk-addons-elementor' ),
                    'style-3'   =>  esc_html__( 'Pricing Style 3', 'dlk-addons-elementor' ),
                    'style-4'   =>  esc_html__( 'Pricing Style 4', 'dlk-addons-elementor' ),
                    'style-5'   =>  esc_html__( 'Pricing Style 5', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'         =>  esc_html__( 'Title', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Startup', 'dlk-addons-elementor' ),
                'label_block'   =>  false
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'         =>  esc_html__( 'Sub Title', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'A tagline here', 'dlk-addons-elementor' ),
                'label_block'   =>  false,
                'condition'     =>  [
                    'pricing_style!' =>  'style-1',
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     =>  esc_html__( 'Icon', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::ICON,
                'default'   =>  'fa fa-home',
            ]
        );

        $this->end_controls_section();

        /* Section Price */
        $this->start_controls_section(
            'section_price',
            [
                'label' =>  esc_html__( 'Price', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'price',
            [
                'label'         =>  esc_html__( 'Price', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  99,
                'label_block'   =>  false
            ]
        );

        $this->add_control(
            'on_sale',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('On Sale ?', 'dlk-addons-elementor'),
                'label_on'      =>  esc_html__('Yes', 'dlk-addons-elementor'),
                'label_off'     =>  esc_html__('No', 'dlk-addons-elementor'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'sale_price',
            [
                'label'         =>  esc_html__( 'Sale Price', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  89,
                'label_block'   =>  false,
                'conditions'    =>  [
                    'terms' =>  [
                        [
                            'name'  =>  'on_sale',
                            'value' =>  'yes',
                        ],
                    ]
                ]
            ]
        );

        $this->add_control(
            'price_currency',
            [
                'label'         =>  esc_html__( 'Price Currency', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '$',
                'label_block'   =>  false
            ]
        );

        $this->add_control(
            'currency_placement',
            [
                'label'     =>  esc_html__( 'Currency Placement', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'left',
                'options'   =>  [
                    'left'  =>  esc_html__( 'Left', 'dlk-addons-elementor' ),
                    'right' =>  esc_html__( 'Right', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'price_period',
            [
                'label'         =>  esc_html__( 'Price Period (per)', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'month', 'dlk-addons-elementor' ),
                'label_block'   =>  false
            ]
        );

        $this->add_control(
            'period_separator',
            [
                'label'         =>  esc_html__( 'Period Separator', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  '/',
                'label_block'   =>  false
            ]
        );

        $this->end_controls_section();

        /* Section Feature */
        $this->start_controls_section(
            'section_feature',
            [
                'label' =>  esc_html__( 'Feature', 'dlk-addons-elementor' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'list_title', [
                'label'         =>  esc_html__( 'Title', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Pricing table list item' , 'dlk-addons-elementor' ),
                'label_block'   =>  true,
            ]
        );

        $repeater->add_control(
            'list_icon', [
                'label'     =>  esc_html__( 'List Icon', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::ICON,
                'default'   => 'fa fa-check',
            ]
        );

        $repeater->add_control(
            'item_active',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Item Active ?', 'dlk-addons-elementor'),
                'label_on'      =>  esc_html__('Yes', 'dlk-addons-elementor'),
                'label_off'     =>  esc_html__('No', 'dlk-addons-elementor'),
                'return_value'  =>  'yes',
                'default'       =>  'yes',
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label'     =>  esc_html__( 'Icon Color', 'dlk-addons-elementorn' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'list',
            [
                'label'     =>  '',
                'type'      =>  Controls_Manager::REPEATER,
                'fields'    =>  $repeater->get_controls(),
                'default'   =>  [
                    [
                        'list_title'    =>  esc_html__( 'Unlimited calls', 'dlk-addons-elementorn' ),
                        'list_icon'     =>  'fa fa-check',
                    ],
                    [
                        'list_title'    =>  esc_html__( 'Free hosting', 'dlk-addons-elementorn' ),
                        'list_icon'     =>  'fa fa-check',
                    ],
                    [
                        'list_title'    =>  esc_html__( '500 MB of storage space', 'dlk-addons-elementorn' ),
                        'list_icon'     =>  'fa fa-check',
                    ],
                    [
                        'list_title'    =>  esc_html__( '500 MB Bandwidth', 'dlk-addons-elementorn' ),
                        'list_icon'     =>  'fa fa-check',
                    ],
                    [
                        'list_title'    =>  esc_html__( '24/7 support', 'dlk-addons-elementorn' ),
                        'list_icon'     =>  'fa fa-check',
                    ],
                    [
                        'list_title'    =>  esc_html__( 'Pricing table list item', 'dlk-addons-elementorn' ),
                        'list_icon'     =>  'fa fa-check',
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
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

    }

    protected function render() {

        $settings           =   $this->get_settings_for_display();
        $class_item_active  =   '';

    ?>

        <div class="element-price-table <?php echo esc_attr( $settings['style-1'] ); ?>">
            <div class="element-price-table__item">
                <h2 class="title">
                    <?php echo esc_html( $settings['title'] ); ?>
                </h2>

                <div class="element-price-table__tag">
                    <span class="price-tag">

                        <?php
                        if ( $settings['on_sale'] != 'yes' ) :

                            if ( $settings['currency_placement'] == 'left' ) :
                        ?>

                            <span class="price-currency">
                                <?php echo esc_html( $settings['price_currency'] ); ?>
                            </span>

                        <?php
                            endif;

                            echo esc_html( $settings['price'] );

                            if ( $settings['currency_placement'] == 'right' ) :
                        ?>

                            <span class="price-currency">
                                <?php echo esc_html( $settings['price_currency'] ); ?>
                            </span>

                        <?php
                            endif;

                        else:

                            if ( $settings['currency_placement'] == 'left' ) :
                        ?>

                            <del class="muted-price">
                                <span class="muted-price-currency">
                                    <?php echo esc_html( $settings['price_currency'] ); ?>
                                </span>

                                <?php echo esc_html( $settings['price'] ); ?>
                            </del>

                            <span class="price-currency">
                                <?php echo esc_html( $settings['price_currency'] ); ?>
                            </span>

                        <?php
                            echo esc_html( $settings['sale_price'] );

                            else:
                        ?>

                            <del class="muted-price">
                                 <?php echo esc_html( $settings['price'] ); ?>

                                 <span class="muted-price-currency">
                                    <?php echo esc_html( $settings['price_currency'] ); ?>
                                </span>
                            </del>

                            <?php echo esc_html( $settings['sale_price'] ); ?>

                            <span class="price-currency">
                                <?php echo esc_html( $settings['price_currency'] ); ?>
                            </span>

                        <?php
                            endif;

                        endif;
                        ?>

                    </span>

                    <span class="price-period">
                        <?php echo esc_html( $settings['period_separator'] ) . '&nbsp;' . esc_html( $settings['price_period'] ); ?>
                    </span>
                </div>

                <?php if ( $settings['list'] ) : ?>

                    <div class="element-price-table__feature">

                        <?php
                        foreach ( $settings['list'] as $item ) :

                            if ( $item['item_active'] != 'yes' ) :
                                $class_item_active = ' disable-item';
                            endif;
                        ?>

                            <div class="item-list-feature<?php echo esc_attr( $class_item_active ) ?>">
                                <i class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> <?php echo esc_attr( $item['list_icon'] ); ?>"></i>
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>
            </div>
        </div>

    <?php

    }

    protected function content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Price_Table );