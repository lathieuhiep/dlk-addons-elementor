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
        return esc_html__( 'DLK Team Member', 'shoptheme' );
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
                'name'      =>  'dlk_team_member_image',
                'default'   =>  'full',
                'condition' =>  [
                    'dlk_team_member_image[url]!'   =>  '',
                ],
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
                            'url'           =>  '',
                            'is_external'   =>  'true',
                        ],
                        'placeholder'       =>  esc_html__( 'Place URL here', 'dlk-addons-elementor' ),
                    ],
                ],
                'title_field' => '<i class="{{ social }}"></i> {{{ social.replace( \'fa fa-\', \'\' ).replace( \'-\', \' \' ).replace( /\b\w/g, function( letter ){ return letter.toUpperCase() } ) }}}',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $has_team_member_image = $settings['dlk_team_member_image']['url'];

    ?>

        <div class="dlk-team-member">
            <div class="dlk-team-member__inner">

                <?php if ( $has_team_member_image ) : ?>

                    <div class="dlk-team-member__image">
                        <figure>
                            <?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'dlk_team_member_image' ) ); ?>
                        </figure>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    <?php

    }

    protected function _content_template() {


    }

}

Plugin::instance()->widgets_manager->register_widget_type( new Widget_DLK_Team_Member );