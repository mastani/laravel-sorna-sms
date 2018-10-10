<?php

namespace mastani\SornaSMS;

use nusoap_client;
use Illuminate\Support\Facades\Config;

class SornaSMS {

    private $wsdl;
    private $code;
    private $username;
    private $password;
    private $client;

    /**
     * Construct class.
     *
     * @return $this
     */
    public function __construct() {
        $this->wsdl = config::get('sornasms.wsdl');
        $this->code = config::get('sornasms.portal_code');
        $this->username = config::get('sornasms.username');
        $this->password = config::get('sornasms.password');

        $this->client = new nusoap_client($this->wsdl, 'wsdl');
        $this->client->soap_defencoding = 'UTF-8';
        $this->client->decode_utf8 = false;

        return $this;
    }

    public function getAuthData() {
        return ['PortalCode' => $this->code, 'UserName' => $this->username, 'PassWord' => $this->password];
    }

    /**
     * Get system credit
     *
     * @return array
     */
    public function getSystemCredit() {
        $data = $this->getAuthData();
        $operation = 'getsystemcredit';
        $return = 'getsystemcreditResult';

        $result = $this->client->call($operation, $data);

        if (isset($result[$return]) && $result[$return] > 0)
            return [
                'success' => true,
                'result' => $result[$return]
            ];
        else
            return [
                'success' => false,
                'error' => $result[$return],
                'error_description' => $this->getErrorDescription($result[$return])
            ];
    }

    /**
     * Send single or multi sms
     *
     * @param mixed $mobile
     * @param mixed $message
     * @return array
     */
    public function sendSMS($mobile, $message) {
        $data = $this->getAuthData();
        $data['Mobile'] = $mobile;
        $data['Message'] = $message;
        $operation = (!is_array($mobile)) ? 'SingleSMSEngine' : 'MultiSMSEngine';
        $return = (!is_array($mobile)) ? 'SingleSMSEngineResult' : 'MultiSMSEngineResult';

        $result = $this->client->call($operation, $data);

        if (isset($result[$return]) && $result[$return] > 0)
            return [
                'success' => true,
                'result' => $result[$return]
            ];
        else
            return [
                'success' => false,
                'error' => $result[$return],
                'error_description' => $this->getErrorDescription($result[$return])
            ];
    }

    /**
     * Send single or multi sms with 021 line
     *
     * @param mixed $mobile
     * @param mixed $message
     * @return array
     */
    public function sendSMS021($mobile, $message) {
        $data = $this->getAuthData();
        $data['Mobile'] = $mobile;
        $data['Message'] = $message;
        $operation = (!is_array($mobile)) ? 'SingleSMSEngine021' : 'MultiSMSEngine021';
        $return = (!is_array($mobile)) ? 'SingleSMSEngine021Result' : 'MultiSMSEngine021Result';

        $result = $this->client->call($operation, $data);

        if (isset($result[$return]) && $result[$return] > 0)
            return [
                'success' => true,
                'result' => $result[$return]
            ];
        else
            return [
                'success' => false,
                'error' => $result[$return],
                'error_description' => $this->getErrorDescription($result[$return])
            ];
    }

    /**
     * Send single or multi sms with blacklist module
     *
     * @param mixed $mobile
     * @param mixed $message
     * @return array
     */
    public function sendSMSBlacklist($mobile, $message) {
        $data = $this->getAuthData();
        $data['Mobile'] = $mobile;
        $data['Message'] = $message;
        $operation = (!is_array($mobile)) ? 'SingleSMSEngineBlacklist' : 'MultiSMSEngineBlackList';
        $return = (!is_array($mobile)) ? 'SingleSMSEngineBlacklistResult' : 'MultiSMSEngineBlackListResult';

        $result = $this->client->call($operation, $data);

        if (isset($result[$return]) && $result[$return] > 0)
            return [
                'success' => true,
                'result' => $result[$return]
            ];
        else
            return [
                'success' => false,
                'error' => $result[$return],
                'error_description' => $this->getErrorDescription($result[$return])
            ];
    }

    private function getErrorDescription($error) {
        switch ($error) {
            case null:
                return 'خطا در اتصال به سرور';
                break;

            case '-99':
                return 'اتمام زمان مجاز جهت ارسال پیامک';
                break;

            case '-100':
                return 'Reference id مورد نظر یافت نشد.';
                break;

            case '-101':
                return 'احراز کاربر موفقیت آمیز نبود.';
                break;

            case '-102':
                return 'نام کاربری یافت نشد.';
                break;

            case '-103':
                return 'شماره کاربری اشتباه یا در بین بازه شماره های کاربر نیست.';
                break;

            case '-104':
                return 'اعتبار کاربر کم است.';
                break;

            case '-105':
                return 'فرمت درخواست اشتباه است.';
                break;

            case '-106':
                return 'تعداد Reference id ها بیش از 1000 عدد است.';
                break;

            case '-107':
            case '-108':
                return 'شماره گیرنده پیام اشتباه است.';
                break;

            case '-98':
            case '-111':
                return 'شماره گیرنده در لیست سیاه مخابرات قرار دارد.';
                break;

            case '-112':
                return 'شماره لیست سیاه یافت نشد.';
                break;

            case '-115':
                return 'برنامه ارسالی در حال اجرا میباشد. امکان ارسال همزمان وجود ندارد.';
                break;

            default:
                return 'خطای ناشناس رخ داده است.';
        }
    }

    function contains($needle, $haystack) {
        return strpos($haystack, $needle) !== false;
    }
}