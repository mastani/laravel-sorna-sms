<?php

class TestCase extends \PHPUnit\Framework\TestCase {

    public function testExample() {
        $sms = new \mastani\SornaSMS\SornaSMS();

        echo "\n";
        echo json_encode($sms->sendSMS('09000000000', 'تست ارسال'));

        $this->assertTrue(true);
    }
}