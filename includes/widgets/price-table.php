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
                'label_block'   =>  false
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
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );

        $this->end_controls_section();

        /* Section Footer */
        $this->start_controls_section(
            'section_footer',
            [
                'label' =>  esc_html__( 'Footer', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'button_icon', [
                'label'     =>  esc_html__( 'Button Icon', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::ICON,
                'default'   => '',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label'         =>  esc_html__( 'Button Text', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Choose Plan', 'dlk-addons-elementor' ),
                'label_block'   =>  true
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label'         =>  esc_html__( 'Button Link', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::URL,
                'placeholder'   =>  esc_html__( 'https://your-link.com', 'dlk-addons-elementor' ),
                'show_external' =>  true,
                'default'       =>  [
                    'url'   => '#',
                ],
            ]
        );

        $this->end_controls_section();

        /* Section Ribbon */
        $this->start_controls_section(
            'section_ribbon',
            [
                'label' =>  esc_html__( 'Ribbon', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'ribbon_featured',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Featured ?', 'dlk-addons-elementor'),
                'label_on'      =>  esc_html__('Yes', 'dlk-addons-elementor'),
                'label_off'     =>  esc_html__('No', 'dlk-addons-elementor'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'ribbon_style',
            [
                'label'     =>  esc_html__( 'Ribbon Style', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ribbon-1',
                'options'   =>  [
                    'ribbon-1'  =>  esc_html__( 'Style 1', 'dlk-addons-elementor' ),
                    'ribbon-2'  =>  esc_html__( 'Style 2', 'dlk-addons-elementor' ),
                    'ribbon-3'  =>  esc_html__( 'Style 3', 'dlk-addons-elementor' ),
                ],
                'conditions'    =>  [
                    'terms' =>  [
                        [
                            'name'  =>  'ribbon_featured',
                            'value' =>  'yes',
                        ],
                    ]
                ]
            ]
        );

        $this->add_control(
            'featured_tag_text',
            [
                'label'         =>  esc_html__( 'Featured Tag Text', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Featured', 'dlk-addons-elementor' ),
                'label_block'   =>  false,
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item.ribbon-2:before, {{WRAPPER}} .element-price-table .element-price-table__item.ribbon-3:before'   =>  'content: "{{VALUE}}";',
                ],
                'condition'    =>  [
                    'ribbon_style!'     =>  'ribbon-1',
                    'ribbon_featured'   =>  'yes'
                ]
            ]
        );

        $this->end_controls_section();

        /* Section style */
        $this->start_controls_section(
            'section_style_price_table',
            [
                'label' => esc_html__( 'Pricing Table Style', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'pricing_table_background_color',
            [
                'label'     =>  esc_html__( 'Background Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table.style-2 .element-price-table__item'   =>  'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_padding',
            [
                'label'         =>  esc_html__( 'Padding', 'plugin-domain' ),
                'type'          =>  Controls_Manager::DIMENSIONS,
                'size_units'    =>  [ 'px', '%', 'em' ],
                'selectors'     =>  [
                    '{{WRAPPER}} .element-price-table.style-2 .element-price-table__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_margin',
            [
                'label'         =>  esc_html__( 'Margin', 'plugin-domain' ),
                'type'          =>  Controls_Manager::DIMENSIONS,
                'size_units'    =>  [ 'px', '%', 'em' ],
                'selectors'     =>  [
                    '{{WRAPPER}} .element-price-table.style-2 .element-price-table__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_margin_border_radius',
            [
                'label'         => esc_html__( 'Border Radius', 'plugin-domain' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => [ 'px', '%' ],
                'range'         => [
                    'px' => [
                        'min'   =>  0,
                        'max'   =>  1000,
                        'step'  =>  1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-price-table.style-2 .element-price-table__item' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pricing_table_alignment',
            [
                'label'     =>  esc_html__( 'Content Alignment', 'dlk-addons-elementor' ),
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
                    '{{WRAPPER}} .element-price-table'   =>  'text-align: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_section();

        /* Style Header */
        $this->start_controls_section(
            'section_style_header',
            [
                'label' => esc_html__( 'Header', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'price_table_title',
            [
                'label'     =>  esc_html__( 'Title Style', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'background_color_header',
            [
                'label'     =>  esc_html__( 'Background Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table.style-2 .element-price-table__item .item-header'   =>  'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .title'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'title_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .title',
            ]
        );

        $this->add_control(
            'price_table_sub_title',
            [
                'label'     =>  esc_html__( 'Sub Title Style', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .sub-title'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'sub_title_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .sub-title',
            ]
        );

        $this->end_controls_section();

        /* Style Price */
        $this->start_controls_section(
            'section_style_price',
            [
                'label' => esc_html__( 'Price', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'original_price_title',
            [
                'label'     =>  esc_html__( 'Original Price', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'original_price_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '#999999',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .muted-price'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'original_price_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .muted-price',
            ]
        );

        $this->add_control(
            'sale_price_title',
            [
                'label'     =>  esc_html__( 'Sale Price', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'sale_price_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .price-tag'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'sale_price_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .price-tag',
            ]
        );

        $this->add_control(
            'currency_title',
            [
                'label'     =>  esc_html__( 'Currency', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'currency_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .price-tag .price-currency'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'currency_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .price-tag .price-currency',
            ]
        );

        $this->add_control(
            'pricing_period_title',
            [
                'label'     =>  esc_html__( 'Pricing Period', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::HEADING,
                'separator' =>  'before',
            ]
        );

        $this->add_control(
            'pricing_period_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .price-period'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'pricing_period_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .price-period',
            ]
        );

        $this->end_controls_section();

        /* Style Feature List */
        $this->start_controls_section(
            'section_style_feature_list',
            [
                'label' => esc_html__( 'Feature List', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'feature_list_color',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .element-price-table__feature .item-list-feature'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_disable_list_color',
            [
                'label'     =>  esc_html__( 'Disable item color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .element-price-table__feature .item-list-feature.disable-item'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'feature_list_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .element-price-table__feature .item-list-feature',
            ]
        );

        $this->end_controls_section();

        /* Style Button */
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__( 'Button', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'padding_button',
            [
                'label'         =>  esc_html__( 'Padding', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::DIMENSIONS,
                'size_units'    =>  [ 'px', '%', 'em' ],
                'selectors'     =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'margin_button',
            [
                'label'         =>  esc_html__( 'Margin', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::DIMENSIONS,
                'size_units'    =>  [ 'px', '%', 'em' ],
                'selectors'     =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'button_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a',
            ]
        );

        $this->start_controls_tabs(
            'style_tabs'
        );

        // Start Normal Tabs
        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'dlk-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     =>  esc_html__( 'Text Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bk_color',
            [
                'label'     =>  esc_html__( 'Background Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a'   =>  'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      =>  'border',
                'label'     =>  esc_html__( 'Border', 'dlk-addons-elementor' ),
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'         =>  esc_html__( 'Border Radius', 'dlk-addons-elementor' ),
                'type'          =>  Controls_Manager::SLIDER,
                'size_units'    =>  [ 'px' ],
                'range'         =>  [
                    'px'    => [
                        'min'   =>  0,
                        'max'   =>  50,
                        'step'  =>  1,
                    ],
                ],
                'default'   => [
                    'unit'  =>  'px',
                    'size'  =>  '',
                ],
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // End Normal Tabs

        // Start Hover Tabs
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'dlk-addons-elementor' ),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     =>  esc_html__( 'Text Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a:hover'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bk_color_hover',
            [
                'label'     =>  esc_html__( 'Background Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a:hover'   =>  'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'     =>  esc_html__( 'Border Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item .item_button a:hover'   =>  'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        // End Hover Tabs

        $this->end_controls_tabs();

        $this->end_controls_section();

        /* Start Style Ribbon */
        $this->start_controls_section(
            'section_style_ribbon',
            [
                'label'     =>  esc_html__( 'Ribbon', 'dlk-addons-elementor' ),
                'tab'       =>  Controls_Manager::TAB_STYLE,
                'condition' =>  [
                    'ribbon_featured'   =>  'yes'
                ]
            ]
        );

        $this->add_control(
            'ribbon_line_color',
            [
                'label'     =>  esc_html__( 'Line Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item.ribbon-1:before'   =>  'background-color: {{VALUE}};',
                ],
                'condition'    =>  [
                    'ribbon_style'      =>  'ribbon-1',
                    'ribbon_featured'   =>  'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      =>  'ribbon_text_typography',
                'selector'  =>  '{{WRAPPER}} .element-price-table .element-price-table__item.ribbon-2:before, {{WRAPPER}} .element-price-table .element-price-table__item.ribbon-3:before',
                'condition' =>  [
                    'ribbon_style'      =>  [ 'ribbon-2', 'ribbon-3' ],
                    'ribbon_featured'   =>  'yes'
                ]
            ]
        );

        $this->add_control(
            'ribbon_color_text',
            [
                'label'     =>  esc_html__( 'Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item.ribbon-2:before, {{WRAPPER}} .element-price-table .element-price-table__item.ribbon-3:before'   =>  'color: {{VALUE}};',
                ],
                'condition'    =>  [
                    'ribbon_style'      =>  [ 'ribbon-2', 'ribbon-3' ],
                    'ribbon_featured'   =>  'yes'
                ]
            ]
        );

        $this->add_control(
            'ribbon_background_color',
            [
                'label'     =>  esc_html__( 'Background Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .element-price-table .element-price-table__item.ribbon-2:before, {{WRAPPER}} .element-price-table .element-price-table__item.ribbon-3:before'   =>  'background-color: {{VALUE}};',
                    '{{WRAPPER}} .element-price-table .element-price-table__item.ribbon-2:after'   =>  'border-bottom-color: {{VALUE}};'
                ],
                'condition'    =>  [
                    'ribbon_style'      =>  [ 'ribbon-2', 'ribbon-3' ],
                    'ribbon_featured'   =>  'yes'
                ]
            ]
        );

        $this->end_controls_section();
        /* End Style Ribbon */

    }

    protected function render() {

        $settings   =   $this->get_settings_for_display();
        $target     =   $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow   =   $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';

        $class_ribbon_featured  =   '';

        if ( $settings['ribbon_featured'] == 'yes' ) :
            $class_ribbon_featured = ' ribbon-featured '. $settings['ribbon_style'];
        endif;

    ?>

        <div class="element-price-table <?php echo esc_attr( $settings['pricing_style'] ); ?>">
            <div class="element-price-table__item<?php echo esc_attr( $class_ribbon_featured ); ?>">

                <?php if ( $settings['pricing_style'] != 'style-1' && !empty( $settings['icon'] ) ) : ?>

                    <div class="item-pricing-icon">
                        <span class="icon-pricing">
                            <i class="<?php echo esc_attr( $settings['icon'] )?>" aria-hidden="true"></i>
                        </span>
                    </div>

                <?php endif; ?>

                <div class="item-header">
                    <h2 class="title">
                        <?php echo esc_html( $settings['title'] ); ?>
                    </h2>

                    <?php if ( !empty( $settings['sub_title'] ) ) : ?>

                        <span class="sub-title">
                            <?php echo esc_html( $settings['sub_title'] ); ?>
                        </span>

                    <?php endif; ?>
                </div>

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

                        <?php foreach ( $settings['list'] as $item ) : ?>

                            <div class="item-list-feature<?php echo esc_attr( $item['item_active'] != 'yes' ? ' disable-item' : '' ); ?>">
                                <i class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> <?php echo esc_attr( $item['list_icon'] ); ?>"></i>
                                <?php echo esc_html( $item['list_title'] ); ?>
                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php
                endif;

                if ( $settings['button_text'] ) :
                ?>

                    <div class="item_button">
                        <a href="<?php echo esc_url( $settings['button_link']['url'] ); ?>" <?php echo esc_attr( $target . $nofollow ); ?>>
                            <?php if ( $settings['button_icon'] ) : ?>
                                <i class="<?php echo esc_attr( $settings['button_icon'] ); ?>"></i>
                            <?php
                            endif;

                            echo esc_html( $settings['button_text'] );
                            ?>
                        </a>
                    </div>

                <?php endif; ?>
            </div>
        </div>

    <?php

    }

    protected function content_template() {

    ?>

        <#
        var target = settings.website_link.is_external ? ' target="_blank"' : '';
        var nofollow = settings.website_link.nofollow ? ' rel="nofollow"' : '';

        var class_ribbon_featured  =   '';

        if ( settings.ribbon_featured === 'yes' ) {
            class_ribbon_featured = ' ribbon-featured-'settings.ribbon_style;
        }
        #>

        <div class="element-price-table {{ settings.pricing_style }}">
            <div class="element-price-table__item{{ class_ribbon_featured }}">

                <# if ( settings.pricing_style !== 'style-1' && settings.icon ) { #>

                    <div class="item-pricing-icon">
                        <span class="icon-pricing">
                            <i class="{{ settings.icon }}" aria-hidden="true"></i>
                        </span>
                    </div>

                <# } #>

                <div class="item-header">
                    <h2 class="title">
                        {{{ settings.title }}}
                    </h2>

                    <# if ( settings.sub_title ) { #>

                        <span class="sub-title">
                            {{{ settings.sub_title }}}
                        </span>

                    <# } #>
                </div>

            </div>
        </div>

    <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Price_Table );