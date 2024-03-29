<?php
/**
 * Created by PhpStorm.
 * User: Dungdt
 * Date: 12/15/2015
 * Time: 3:19 PM
 */

use Omnipay\Omnipay;
use Omnipay\Common\CreditCard;

if (!class_exists('ST_Authorize_Payment_Gateway')) {
    class ST_Authorize_Payment_Gateway extends STAbstactPaymentGateway
    {
        static private $_ints;
        private $default_status = true;
        private $_gatewayObject = null;
        private $_gateway_id = 'st_authorize';

        function __construct()
        {
            add_filter('st_payment_gateway_st_authorize_name', array($this, 'get_name'));
            try {
                $this->_gatewayObject = Omnipay::create('AuthorizeNet_AIM');

            } catch (Exception $e) {
                $this->default_status = false;
            }
            add_action('admin_notices', array($this, '_add_notices'));
            add_action('admin_init', array($this, '_dismis_notice'));
        }

        function _dismis_notice()
        {
            if (STInput::get('st_dismiss_authorize_notice')) {
                update_option('st_dismiss_authorize_notice', 1);
            }

        }

        function _add_notices()
        {
            if (get_option('st_dismiss_authorize_notice')) {
                return;
            }

            if (class_exists('STTravelCode')) {
                if (isset(STTravelCode::$plugins_data['Version'])) {
                    $version = STTravelCode::$plugins_data['Version'];
                    if (version_compare('1.3.2', $version, '>')) {
                        $url = admin_url('plugin-install.php?tab=plugin-information&plugin=traveler-code&TB_iframe=true&width=753&height=350');
                        ?>
                        <div class="error settings-error notice is-dismissible">
                            <p class=""><strong><?php _e('Traveler Notice:', 'traveler-authorize') ?></strong></p>
                            <p>
                                <?php printf(__('<strong>Authorize.net</strong> require %s version %s or above. Your current is %s', 'traveler-authorize'), '<strong><em>' . __('Traveler Code', 'traveler-authorize') . '</em></strong>', '<strong>1.3.2</strong>', '<strong>' . $version . '</strong>'); ?>
                            </p>
                            <p>
                                <a href="http://shinetheme.com/demosd/documentation/how-to-update-the-theme-2/"
                                   target="_blank"><?php _e('Learn how to update it', 'traveler-authorize') ?></a>
                                |
                                <a href="<?php echo admin_url('index.php?st_dismiss_payfast_notice=1') ?>"
                                   class="dismiss-notice"
                                   target="_parent"><?php _e('Dismiss this notice', 'traveler-authorize') ?></a>
                            </p>
                            <button type="button" class="notice-dismiss"><span
                                        class="screen-reader-text"><?php _e('Dismiss this notice', 'traveler-authorize') ?>
									.</span></button>
                        </div>
                        <?php
                    }
                }
            }
        }


        function get_option_fields()
        {
            return array(
                array(
                    'id' => 'authorize_login_id',
                    'label' => __('Login ID', 'traveler-authorize'),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Login ID', 'traveler-authorize'),
                    'condition' => 'pm_gway_st_authorize_enable:is(on)'
                ),
                array(
                    'id' => 'authorize_transaction_key',
                    'label' => __('Transaction Key', 'traveler-authorize'),
                    'type' => 'text',
                    'section' => 'option_pmgateway',
                    'desc' => __('Transaction Key', 'traveler-authorize'),
                    'condition' => 'pm_gway_st_authorize_enable:is(on)'
                ),
                array(
                    'id' => 'authorize_enable_sandbox',
                    'label' => __('Enable Test Mode', 'traveler-authorize'),
                    'type' => 'on-off',
                    'section' => 'option_pmgateway',
                    'std' => 'on',
                    'desc' => __('Allow you to enable test mode', 'traveler-authorize'),
                    'condition' => 'pm_gway_st_authorize_enable:is(on)'
                ),
            );
        }

        function _pre_checkout_validate()
        {
            $validate = new STValidate();
            $validate->set_rules('st_authorize_card_name', __("Card Name", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_number', __("Card Number", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_expiry_month', __("Expiry Month", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_expiry_year', __("Expiry Year", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_code', __("Card Code", 'traveler-authorize'), 'required');

            if (!$validate->run()) {
                STTemplate::set_message($validate->error_string());
                return FALSE;
            }
            return true;
        }

        function do_checkout($order_id)
        {
            if (!$this->is_available()) {
                return
                    [
                        'status' => 0,
                        'complete_purchase' => 0,
                        'error_type' => 'card_validate',
                        'error_fields' => '',
                    ];
            }
            $gateway = $this->_gatewayObject;
            $gateway->setApiLoginId(st()->get_option('authorize_login_id', ''));
            $gateway->setTransactionKey(st()->get_option('authorize_transaction_key', ''));

            if (st()->get_option('authorize_enable_sandbox', 'on') == 'on') {
                $gateway->setTestMode(true);
                $gateway->setDeveloperMode(true);
            }

            $total = get_post_meta($order_id, 'total_price', true);
            $total = round((float)$total, 2);
            $order_token_code = get_post_meta($order_id, 'order_token_code', true);

            $purchase = [
                'card' => new CreditCard([
                    'firstName' => STInput::request('st_authorize_card_name'),
                    'number' => STInput::request('st_authorize_card_number'),
                    'expiryMonth' => STInput::request('st_authorize_card_expiry_month'),
                    'expiryYear' => STInput::request('st_authorize_card_expiry_year'),
                    'cvv' => STInput::request('st_authorize_card_code'),
                ]),
                'amount' => number_format((float)$total, 2, '.', ''),
                'currency' => TravelHelper::get_current_currency('name'),
                'description' => 'Order',
                'transactionId' => uniqid() . $order_id,
                'failureUrl' => $this->get_cancel_url($order_id),
                'returnUrl' => $this->get_return_url($order_id),
                'cancelUrl' => $this->get_cancel_url($order_id)
            ];

            $response = $gateway->purchase($purchase)->send();
            try {
                if ($response->isSuccessful()) {
                    return array('status' => true, 'complete_purchase' => 1);
                } elseif ($response->isRedirect()) {
                    return array(
                        'status' => true,
                        'redirect' => $response->getRedirectUrl()
                    );
                } else {
                    return array('status' => false, 'message' => $response->getMessage(), 'data' => $purchase);
                }
            } catch (\Exception $e) {
                return array('status' => false, 'message' => $response->getMessage(), 'data' => $purchase, 'complete_purchase' => 0);
            }
        }

        function package_do_checkout($order_id)
        {
            if (!class_exists('STAdminPackages')) {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st0'), 'message' => __('This function is off', 'traveler-authorize')];
            }

            $validate = new STValidate();
            $validate->set_rules('st_authorize_card_name', __("Card Name", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_number', __("Card Number", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_expiry_month', __("Expiry Month", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_expiry_year', __("Expiry Year", 'traveler-authorize'), 'required');
            $validate->set_rules('st_authorize_card_code', __("Card Code", 'traveler-authorize'), 'required');

            if (!$validate->run()) {
                return [
                    'status' => TravelHelper::st_encrypt($order_id . 'st10'),
                    'message' => $validate->error_string()
                ];
            }

            $order = STAdminPackages::get_inst()->get('*', $order_id);
            $gateway = $this->_gatewayObject;

            $gateway->setApiLoginId(st()->get_option('authorize_login_id', ''));
            $gateway->setTransactionKey(st()->get_option('authorize_transaction_key', ''));

            if (st()->get_option('authorize_enable_sandbox', 'on') == 'on') {
                $gateway->setTestMode(true);
                $gateway->setDeveloperMode(true);
            }

            $purchase = [
                'card' => new CreditCard([
                    'firstName' => STInput::request('st_authorize_card_name'),
                    'number' => STInput::request('st_authorize_card_number'),
                    'expiryMonth' => STInput::request('st_authorize_card_expiry_month'),
                    'expiryYear' => STInput::request('st_authorize_card_expiry_year'),
                    'cvv' => STInput::request('st_authorize_card_code'),
                ]),
                'amount' => (float)round((float)$order->package_price, 2),
                'currency' => TravelHelper::get_current_currency('name'),
                'description' => __('Member Package', 'traveler-authorize'),
                'transactionId' => uniqid() . $order_id,
                'failureUrl' => STAdminPackages::get_inst()->get_cancel_url($order_id),
                'returnUrl' => STAdminPackages::get_inst()->get_return_url($order_id),
                'cancelUrl' => STAdminPackages::get_inst()->get_cancel_url($order_id)
            ];

            try {
                $response = $gateway->purchase(
                    $purchase
                )->send();
            } catch (Exception $e) {
                return [
                    'status' => TravelHelper::st_encrypt($order_id . 'st10'),
                    'message' => $e->getMessage()
                ];
            }
            if ($response->isSuccessful()) {
                return [
                    'status' => TravelHelper::st_encrypt($order_id . 'st1'),
                    'redirect_url' => STAdminPackages::get_inst()->get_return_url($order_id),
                ];
            } elseif ($response->isRedirect()) {
                return [
                    'status' => TravelHelper::st_encrypt($order_id . 'st1'),
                    'redirect_url' => STAdminPackages::get_inst()->get_return_url($order_id),
                ];
            } else {
                STTemplate::set_message($response->getMessage(), 'danger');
                return false;
            }
        }

        function complete_purchase($order_id)
        {
        }

        function package_completed_checkout($order_id)
        {
            if (!class_exists('STAdminPackages')) {
                return ['status' => TravelHelper::st_encrypt($order_id . 'st0'), 'message' => __('This function is off', 'traveler-authorize')];
            }
            $status = STInput::get('status');
            if ( TravelHelper::st_compare_encrypt( (int) $order_id . 'st1', $status ) ) {
                return true;
            }
        }

        function check_complete_purchase($order_id)
        {

        }

        function html()
        {
            echo Traveler_Authorize_Payment::get_inst()->loadTemplate('authorize');
        }

        function get_name()
        {
            return __('Authorize.net', 'traveler-authorize');
        }

        function get_default_status()
        {
            return $this->default_status;
        }

        function is_available($item_id = false)
        {
            if (st()->get_option('pm_gway_st_authorize_enable') == 'off') {
                return false;
            } else {
                if (!st()->get_option('authorize_login_id')) {
                    return false;
                }
                if (!st()->get_option('authorize_transaction_key')) {
                    return false;
                }
            }

            if ($item_id) {
                $meta = get_post_meta($item_id, 'is_meta_payment_gateway_st_authorize', true);
                if ($meta == 'off') {
                    return false;
                }
            }

            return true;
        }

        function getGatewayId()
        {
            return $this->_gateway_id;
        }

        function is_check_complete_required()
        {
            return FALSE;
        }

        function get_logo()
        {
            return Traveler_Authorize_Payment::get_inst()->pluginUrl . 'assets/img/an-logo.png';
        }

        static function instance()
        {
            if (!self::$_ints) {
                self::$_ints = new self();
            }

            return self::$_ints;
        }

        static function add_payment($payment)
        {
            $payment['st_authorize'] = self::instance();

            return $payment;
        }
    }

    add_filter('st_payment_gateways', array('ST_Authorize_Payment_Gateway', 'add_payment'));
}