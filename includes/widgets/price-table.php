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

        $settings       =   $this->get_settings_for_display();

    }

    protected function content_template() {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Price_Table );