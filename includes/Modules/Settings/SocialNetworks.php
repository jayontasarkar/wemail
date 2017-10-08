<?php

namespace WeDevs\WeMail\Modules\Settings;

use WeDevs\WeMail\Modules\Settings\AbstractSettings;

class SocialNetworks extends AbstractSettings {

    /**
     * Menu priority
     *
     * @since 1.0.0
     *
     * @var integer
     */
    public $priority = 20;

    /**
     * Settings menu name
     *
     * @since 1.0.0
     *
     * @return string
     */
    public function get_menu_name() {
        return __( 'Social Networks', 'wemail' );
    }

    /**
     * Settings data
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function get_settings() {
        $settings = wemail()->api->settings()->social_networks()->get();

        return wp_parse_args( $settings, $this->default_links() );
    }

    /**
     * Social network names
     *
     * This method can be used when network order is needed
     *
     * @since 1.0.0
     *
     * @return array
     */
    public function networks() {
        $networks = [
            'facebook',
            'twitter',
            'google-plus',
            'linkedin',
            'youtube',
            'instagram',
            'pinterest',
            'snapchat',
            'whatsapp',
            'tumblr',
            'flickr',
            'reddit',
            'viber'
        ];

        /**
         * Social network names
         *
         * @since 1.0.0
         *
         * @param array $networks
         */
        return apply_filters( 'wemail_social_networks', $networks );
    }

    /**
     * Route data
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function get_route_data() {
        return [
            'i18n'      => $this->i18n(),
            'settings'  => $this->get_settings(),
            'networks'  => $this->networks()
        ];
    }

    public function i18n() {
        $i18n = [
            'facebook'     => __( 'Facebook', 'wemail' ),
            'twitter'      => __( 'Twitter', 'wemail' ),
            'linkedin'     => __( 'LinkedIn', 'wemail' ),
            'google-plus'  => __( 'Google+', 'wemail' ),
            'youtube'      => __( 'YouTube', 'wemail' ),
            'pinterest'    => __( 'Pinterest', 'wemail' ),
            'instagram'    => __( 'Instagram', 'wemail' ),
            'tumblr'       => __( 'Tumblr', 'wemail' ),
            'flickr'       => __( 'Flickr', 'wemail' ),
            'reddit'       => __( 'Reddit', 'wemail' ),
            'snapchat'     => __( 'Snapchat', 'wemail' ),
            'whatsapp'     => __( 'WhatsApp', 'wemail' ),
            'viber'        => __( 'Viber', 'wemail' ),
        ];

        /**
         * Social network i18n strings
         *
         * @since 1.0.0
         *
         * @param array $default_links
         */
        return apply_filters( 'wemail_social_network_i18n', $i18n );
    }

    public function default_links() {
        $default_links = [
            'facebook'      => 'https://facebook.com',
            'twitter'       => 'https://twitter.com',
            'google-plus'   => 'https://plus.google.com/',
            'linkedin'      => 'https://linkedin.com',
            'youtube'       => 'https://youtube.com',
            'instagram'     => 'https://instagram.com',
            'pinterest'     => 'https://pinterest.com',
            'tumblr'        => 'https://tumblr.com',
            'flickr'        => 'https://flickr.com',
            'reddit'        => 'https://reddit.com',
            'snapchat'      => 'https://snapchat.com',
            'whatsapp'      => 'https://whatsapp.com',
            'viber'         => 'https://viber.com',
        ];

        /**
         * Social network default links
         *
         * @since 1.0.0
         *
         * @param array $default_links
         */
        return apply_filters( 'wemail_social_network_default_links', $default_links );
    }

}
