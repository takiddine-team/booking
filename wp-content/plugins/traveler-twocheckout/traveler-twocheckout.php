<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/25/2019
 * Time: 8:47 AM
 */

/*
Plugin Name: Traveler TwoCheckout
Description: This plugin is used for Traveler Theme
Version: 1.0
Author: ShineTheme
Author URI: https://shinetheme.com
License: GPLv2 or later
Text Domain: traveler-twocheckout
*/

class Traveler_TwoCheckout_Payment
{
    public $pluginUrl = '';
    public $pluginPath = '';
    public $customFolder = 'traveler-twocheckout';

    public function __construct()
    {
        $this->pluginPath = trailingslashit(plugin_dir_path(__FILE__));
        $this->pluginUrl = trailingslashit(plugin_dir_url(__FILE__));

        add_action('init', [$this, '_pluginSetup']);
        add_action('init', [$this, '_pluginLoader'], 20);
        add_action('wp_enqueue_scripts', [$this, '_pluginEnqueue']);
    }

    public function _pluginSetup()
    {
        load_plugin_textdomain('traveler-twocheckout', false, basename(dirname(__FILE__)) . '/languages');
    }

    public function _pluginLoader()
    {
        if (class_exists('STTravelCode') && class_exists('STAbstactPaymentGateway')) {
            require_once($this->pluginPath . 'inc/twocheckout.php');
        }
    }

    public function _pluginEnqueue()
    {
        wp_register_script( '2co-min-js', 'https://www.2checkout.com/checkout/api/2co.min.js', [ 'jquery' ], null, true );
        if (function_exists('st')) {
            $sanbox = st()->get_option( 'twocheckout_enable_sandbox', 'on');
            $twocheckout_params['twocheckout'] = [
                'accountID'  => st()->get_option( 'twocheckout_account_number', '' ),
                'publicKey'  => st()->get_option( 'twocheckout_public_key', '' ),
                'loadPubKey' => ( $sanbox == 'on' ) ? 'sandbox' : 'production',
            ];
            wp_localize_script( 'jquery', 'st_2checkout_params', $twocheckout_params );
        }
        wp_register_script( 'st-twocheckout-js', $this->pluginUrl . 'assets/js/2checkout.js', [ '2co-min-js' ], null, true );
    }

    public function loadTemplate($name, $data = null)
    {
        if (is_array($data))
            extract($data);

        $template = $this->pluginPath . 'views/' . $name . '.php';

        if (is_file($template)) {
            $templateCustom = locate_template($this->customFolder . '/views/' . $name . '.php');
            if (is_file($templateCustom)) {
                $template = $templateCustom;
            }
            ob_start();

            require($template);

            $html = @ob_get_clean();

            return $html;
        }


    }

    public static function get_inst()
    {
        static $instance;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}

Traveler_TwoCheckout_Payment::get_inst();