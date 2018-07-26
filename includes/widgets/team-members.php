<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Widget_DLK_Team_Member extends Widget_Base {

    public function get_categories() {
        return array( 'dlk-addons-elementor' );
    }

    public function get_name() {
        return 'dlk-team-member';
    }

    public function get_title() {
        return esc_html__( 'DLK Team Member', 'dlk-addons-elementor' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'dlk_section_team_member_image',
            [
                'label' =>  esc_html__( 'Team Member Image', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'dlk_team_member_image',
            [
                'label'     =>  esc_html__( 'Team Member Avatar', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::MEDIA,
                'default'   =>  [
                    'url'   =>  Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      =>  'thumbnail',
                'default'   =>  'full',
                'separator' =>  'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dlk_section_team_member_content',
            [
                'label' =>  esc_html__( 'Team Member Content', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'dlk_team_member_name',
            [
                'label'     =>  esc_html__( 'Name', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::TEXT,
                'default'   =>  esc_html__( 'John Doe', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'dlk_team_member_job_title',
            [
                'label'     =>  esc_html__( 'Job Position', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::TEXT,
                'default'   =>  esc_html__( 'Software Engineer', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'dlk_team_member_description',
            [
                'label'     =>  esc_html__( 'Description', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::TEXTAREA,
                'default'   =>  esc_html__( 'Add team member description here. Remove the text if not necessary.', 'dlk-addons-elementor' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dlk_section_team_member_social_profiles',
            [
                'label' =>  esc_html__( 'Social Profiles', 'dlk-addons-elementor' )
            ]
        );

        $this->add_control(
            'dlk_team_member_enable_social_profiles',
            [
                'label'     =>  esc_html__( 'Display Social Profiles?', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SWITCHER,
                'default'   =>  'yes',
            ]
        );

        $this->add_control(
            'dlk_team_member_social_profile_links',
            [
                'type'      =>  Controls_Manager::REPEATER,
                'condition' =>  [
                    'dlk_team_member_enable_social_profiles!'   =>  '',
                ],
                'default'   =>  [
                    [
                        'social' => 'fa fa-facebook',
                    ],
                    [
                        'social' => 'fa fa-twitter',
                    ],
                    [
                        'social' => 'fa fa-google-plus',
                    ],
                    [
                        'social' => 'fa fa-linkedin',
                    ],
                ],
                'fields'    =>  [
                    [
                        'name'          =>  'social',
                        'label'         =>  esc_html__( 'Icon', 'dlk-addons-elementor' ),
                        'type'          =>  Controls_Manager::ICON,
                        'label_block'   =>  true,
                        'default'       =>  'fa fa-wordpress',
                        'include'       =>  [
                            'fa fa-apple',
                            'fa fa-behance',
                            'fa fa-bitbucket',
                            'fa fa-codepen',
                            'fa fa-delicious',
                            'fa fa-digg',
                            'fa fa-dribbble',
                            'fa fa-envelope',
                            'fa fa-facebook',
                            'fa fa-flickr',
                            'fa fa-foursquare',
                            'fa fa-github',
                            'fa fa-google-plus',
                            'fa fa-houzz',
                            'fa fa-instagram',
                            'fa fa-jsfiddle',
                            'fa fa-linkedin',
                            'fa fa-medium',
                            'fa fa-pinterest',
                            'fa fa-product-hunt',
                            'fa fa-reddit',
                            'fa fa-shopping-cart',
                            'fa fa-slideshare',
                            'fa fa-snapchat',
                            'fa fa-soundcloud',
                            'fa fa-spotify',
                            'fa fa-stack-overflow',
                            'fa fa-tripadvisor',
                            'fa fa-tumblr',
                            'fa fa-twitch',
                            'fa fa-twitter',
                            'fa fa-vimeo',
                            'fa fa-vk',
                            'fa fa-whatsapp',
                            'fa fa-wordpress',
                            'fa fa-xing',
                            'fa fa-yelp',
                            'fa fa-youtube',
                        ],
                    ],
                    [
                        'name'          =>  'link',
                        'label'         =>  esc_html__( 'Link', 'dlk-addons-elementor' ),
                        'type'          =>  Controls_Manager::URL,
                        'label_block'   =>  true,
                        'default'       =>  [
                            'url'           =>  '#',
                            'is_external'   =>  true,
                            'nofollow'      =>  false,
                        ],
                        'placeholder'       =>  esc_html__( 'Place URL here', 'dlk-addons-elementor' ),
                    ],
                ],
                'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dlk_section_team_members_styles_general',
            [
                'label' =>  esc_html__( 'Team Member Styles', 'dlk-addons-elementor' ),
                'tab'   =>  Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'dlk_team_members_preset',
            [
                'label'     =>  esc_html__( 'Style Preset', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'dlk-team-members-simple',
                'options'   =>  [
                    'dlk-team-members-simple'   =>  esc_html__( 'Simple Style', 'dlk-addons-elementor' ),
                    'dlk-team-members-overlay'  =>  esc_html__( 'Overlay Style', 'dlk-addons-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'dlk_team_members_background',
            [
                'label'     =>  esc_html__( 'Content Background Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .dlk-team-members-overlay .dlk-team-member__content'   =>  'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dlk_team_members_alignment',
            [
                'label'     =>  esc_html__( 'Set Alignment', 'dlk-addons-elementor' ),
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
                'default'   =>  '',
            ]
        );

        $this->add_responsive_control(
            'dlk_team_members_content_padding',
            [
                'label'     =>  esc_html__( 'Content Padding', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'dlk_team_members_border',
                'label' => esc_html__( 'Border', 'dlk-addons-elementor' ),
                'selector' => '{{WRAPPER}} .dlk-team-member',
            ]
        );

        $this->add_responsive_control(
            'dlk_team_members_border_radius',
            [
                'label'     =>  esc_html__( 'Border Radius', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .dlk-team-member' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dlk_section_team_members_typography',
            [
                'label' => esc_html__( 'Color &amp; Typography', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'dlk_team_members_name_heading',
            [
                'label' => __( 'Member Name', 'dlk-addons-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dlk_team_members_name_color',
            [
                'label'     =>  esc_html__( 'Member Name Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__name'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dlk_team_members_name_typography',
                'selector' => '{{WRAPPER}} .dlk-team-member__name',
            ]
        );

        $this->add_control(
            'dlk_team_members_position_heading',
            [
                'label' => __( 'Member Job Position', 'dlk-addons-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dlk_team_members_position_color',
            [
                'label'     =>  esc_html__( 'Member Position Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__position'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dlk_team_members_position_typography',
                'selector' => '{{WRAPPER}} .dlk-team-member .dlk-team-member__position',
            ]
        );

        $this->add_control(
            'dlk_team_members_description_heading',
            [
                'label' => __( 'Member Description', 'dlk-addons-elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dlk_team_members_description_color',
            [
                'label'     =>  esc_html__( 'Member Description Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__description'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dlk_team_members_description_typography',
                'selector' => '{{WRAPPER}} .dlk-team-member .dlk-team-member__description',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dlk_section_team_members_social_profiles_styles',
            [
                'label' => esc_html__( 'Social Profiles Style', 'dlk-addons-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'dlk_team_members_social_icon_color',
            [
                'label'     =>  esc_html__( 'Icon Color', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__social-link a'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dlk_team_members_social_icon_color_hover',
            [
                'label'     =>  esc_html__( 'Icon Color Hover', 'dlk-addons-elementor' ),
                'type'      =>  Controls_Manager::COLOR,
                'default'   =>  '',
                'selectors' =>  [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__social-link a:hover'   =>  'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dlk_team_members_social_icon_size',
            [
                'label' => esc_html__( 'Size', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .dlk-team-member .dlk-team-member__social-link a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $team_member_classes    =   $settings['dlk_team_members_preset'];
        $has_team_member_image  =   $settings['dlk_team_member_image']['url'];
        $alignment_content      =   $settings['dlk_team_members_alignment'];

        if ( !empty( $alignment_content ) ) :
            $class_alignment_content = 'alignment-content-'.$alignment_content;
        else:
            $class_alignment_content = 'alignment-content-center';
        endif;

    ?>

        <div class="dlk-team-member <?php echo esc_attr( $team_member_classes ); ?>">
            <div class="dlk-team-member__inner">
                <div class="dlk-team-member__image">
                    <figure>
                        <?php
                         if ( $has_team_member_image ) :
                             echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'dlk_team_member_image' ) );
                         else:
                             $no_team_member_image  =   dlk_addons_elementor_path . 'assets/images/no-images.png';
                         ?>

                            <img src="<?php echo esc_url( $no_team_member_image ) ?>" alt="<?php echo esc_attr( $settings['dlk_team_member_name'] ); ?>" />

                         <?php endif; ?>
                    </figure>
                </div>

                <div class="dlk-team-member__content <?php echo esc_attr( $class_alignment_content ); ?>">
                    <h3 class="dlk-team-member__name">
                        <?php echo esc_html( $settings['dlk_team_member_name'] ); ?>
                    </h3>

                    <h4 class="dlk-team-member__position">
                        <?php echo esc_html( $settings['dlk_team_member_job_title'] ); ?>
                    </h4>

                    <?php if ( !empty( $settings['dlk_team_member_social_profile_links'] ) ) : ?>

                        <ul class="dlk-team-member__social-profiles">
                            <?php
                            foreach ( $settings['dlk_team_member_social_profile_links'] as $item ) :
                                $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                                $nofollow = $item['link']['nofollow'] ? ' rel="nofollow"' : '';
                            ?>

                            <li class="dlk-team-member__social-link">
                                <a href="<?php echo esc_url( $item['link']['url'] ); ?>"<?php echo $target . $nofollow; ?>>
                                    <i class="<?php echo esc_attr( $item['social'] ) ?>" aria-hidden="true"></i>
                                </a>
                            </li>

                            <?php endforeach; ?>
                        </ul>

                    <?php endif; ?>

                    <p class="dlk-team-member__description">
                        <?php echo esc_html( $settings['dlk_team_member_description'] ); ?>
                    </p>
                </div>
            </div>
        </div>

    <?php

    }

    protected function _content_template() {

    ?>

        <#
        var dlk_team_member_image = {
                id: settings.dlk_team_member_image.id,
                url: settings.dlk_team_member_image.url,
                size: settings.thumbnail_size,
                dimension: settings.thumbnail_custom_dimension,
                model: view.getEditModel()
        };

        var image_url = elementor.imagesManager.getImageUrl( dlk_team_member_image );

        if ( ! image_url ) {
            return;
        }

        team_member_classes = settings.dlk_team_members_preset;

        if ( '' !== settings.dlk_team_members_alignment ) {
            class_alignment_content = 'alignment-content-' + settings.dlk_team_members_alignment;
        }else{
            class_alignment_content = 'alignment-content-center';
        }

        #>

        <div class="dlk-team-member {{ team_member_classes }}">
            <div class="dlk-team-member__inner">
                <div class="dlk-team-member__image">
                    <figure>
                        <img src="{{{ image_url }}}">
                    </figure>
                </div>

                <div class="dlk-team-member__content {{ class_alignment_content }}">
                    <h3 class="dlk-team-member__name">
                        {{{ settings.dlk_team_member_name }}}
                    </h3>

                    <h4 class="dlk-team-member__position">
                        {{{ settings.dlk_team_member_job_title }}}
                    </h4>

                    <# if ( settings.dlk_team_member_social_profile_links.length ) { #>

                        <ul class="dlk-team-member__social-profiles">

                            <#
                            _.each( settings.dlk_team_member_social_profile_links, function( item ) {

                            var target = item.link.is_external ? ' target="_blank"' : '';
                            var nofollow = item.link.nofollow ? ' rel="nofollow"' : '';
                            #>

                                <li class="dlk-team-member__social-link">
                                    <a href="{{ item.link.url }}"{{ target }}{{ nofollow }}>
                                        <i class="{{ item.social }}" aria-hidden="true"></i>
                                    </a>
                                </li>

                            <# }); #>

                        </ul>

                    <# } #>

                    <p class="dlk-team-member__description">
                        {{{ settings.dlk_team_member_description }}}
                    </p>
                </div>
            </div>
        </div>

    <?php

    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Team_Member );