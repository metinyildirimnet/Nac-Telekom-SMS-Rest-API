<?php
class NacSms {
    private $baseUrl;
    private $endpoint;

    public function __construct($endpoint) {
        $this->baseUrl = "http://smslogin.nac.com.tr:9587/sms/";
        $this->endpoint = $endpoint;
    }

    public function sendSms($data) {
        $url = $this->baseUrl . $this->endpoint;

        $jsonData = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function listSenders() {
        $url = $this->baseUrl . "list-sender";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function cancelSms($id) {
        $url = $this->baseUrl . "cancel?id=" . $id;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function listSms() {
        $url = $this->baseUrl . "list";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function checkCredit() {
        $url = $this->baseUrl . "credit";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

?>
