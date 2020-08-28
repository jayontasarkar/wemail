<?php

namespace WeDevs\WeMail\Core\Mail;

trait MailerHelper
{
    /**
     * @var $phpmailer \PHPMailer|PHPMailer\PHPMailer\PHPMailer
     */
    protected $phpmailer;

    /**
     *  Format Email Addresses
     *
     * @param $address
     * @return array
     */
    protected function formatEmailAddress( $address ) {
        return array_map( function ( $address ) {
            return $address[0];
        }, $address );
    }

    /**
     * Set Mailer
     *
     * @param $mailer
     */
    public function setPHPMailer( $mailer ) {
        $this->phpmailer = $mailer;
    }

    /**
     * Format phpmailer attachments into plain array of file urls
     *
     * @param $attachments
     *
     * @return array
     */
    public function formatAttachments( $attachments ) {
        global $wpdb;

        $attachments = array_map( function ( $attachment ) {
            if ( is_array( $attachment ) ) {
                $split = explode('/uploads/', $attachment[0]);

                return esc_sql( end( $split ) );
            }

            return null;
        }, $attachments );

        $attachments = array_filter( $attachments );

        $files = $wpdb->get_results("SELECT * FROM {$wpdb->postmeta} WHERE `meta_key` = '_wp_attached_file' AND `meta_value` IN('".implode("', '", $attachments)."')");

        return array_map( function ( $file ) {
            return wp_get_attachment_url( $file->post_id );
        }, $files );
    }
}
