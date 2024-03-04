<?php

class NacSms {
    private $username;
    private $password;
    private $baseUrl;
    private $authToken;
    private $sender;

    // Kurucu metot
    public function __construct($username, $password, $sender = null) {
        $this->username = $username;
        $this->password = $password;
        $this->sender = $sender;
        // Sabit base URL
        $this->baseUrl = "http://smslogin.nac.com.tr:9587/";

        // Auth token oluşturma
        $this->authToken = $this->generateAuthToken();
    }

    // Basic authentication için auth token oluştur
    private function generateAuthToken() {
        return base64_encode($this->username . ":" . $this->password);
    }

    // Curl ile istek gönderme yardımcı fonksiyonu
    private function sendRequest($url, $headers, $data = null) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Veri gönderme
        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $response = curl_exec($ch);
        $error = curl_error($ch); // Curl hata bilgisini al
        curl_close($ch);
        
        if ($error) {
            echo "Curl error: $error\n";
        }
        
        return $response;
    }

    // Kredi sorgulama fonksiyonu
    public function credit() {
        // Kredi sorgulama endpoint'i
        $endpoint = "user/credit";
        // HTTP isteği oluşturma
        $requestUrl = $this->baseUrl . $endpoint;

        // HTTP başlıklarını ayarlayın
        $headers = array(
            "Authorization: Basic $this->authToken"
        );

        // İsteği gönderme işlemi
        $response = $this->sendRequest($requestUrl, $headers);
        return $response;
    }

    // SMS gönderimi için fonksiyon
    public function create($title, $content, $number, $sender = null) {
        // SMS gönderimi endpoint'i
        $endpoint = "sms/create";
        // HTTP isteği oluşturma
        $requestUrl = $this->baseUrl . $endpoint;

        // HTTP başlıklarını ayarlayın
        $headers = array(
            "Authorization: Basic $this->authToken",
            "Content-Type: application/json"
        );

        // İsteği gönderme işlemi için veri
        $data = array(
            "title" => $title,
            "content" => $content,
            "number" => $number,
            "type" => 1,
            "sendingType" => 0,
            "encoding" => 1,
            "validity" => 60,
            "sender" => $sender ?? $this->sender
        );

        // İsteği gönderme işlemi
        $response = $this->sendRequest($requestUrl, $headers, $data);
        return $response;
    }

    // SMS iptal fonksiyonu
    public function cancel($smsId) {
        // SMS iptal endpoint'i
        $endpoint = "sms/cancel";
        // HTTP isteği oluşturma
        $requestUrl = $this->baseUrl . $endpoint;

        // HTTP başlıklarını ayarlayın
        $headers = array(
            "Authorization: Basic $this->authToken",
            "Content-Type: application/json"
        );

        // İsteği gönderme işlemi için veri
        $data = array(
            "smsId" => $smsId
        );

        // İsteği gönderme işlemi
        $response = $this->sendRequest($requestUrl, $headers, $data);
        return $response;
    }
}
