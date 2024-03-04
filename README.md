# Nac-Telekom-SMS-Rest-API

NacSms, PHP programlama dili için NacSMS API'sini kullanarak SMS gönderme, gönderici başlıklarını listeleme, SMS iptal etme, gönderilen SMS'leri listeleme ve kredi sorgulama gibi işlevler sağlar.

## Kurulum

1. Composer kullanarak:

```bash
composer require metinyildirimnet/Nac-Telekom-SMS-Rest-API
````

veya composer.json dosyanıza doğrudan ekleyin:

```bash
"require": {
    "metinyildirimnet/Nac-Telekom-SMS-Rest-API": "^1.0"
}
```

2. Manuel olarak:
Bu rapoyu indirin veya kopyalayın ve projenize dahil edin.

```bash
<?php

require 'vendor/autoload.php'; // Composer kullanıyorsanız bu satırı değiştirin

use NacSms;

$sms = new NacSms("create");

// Gönderilecek JSON verisi
$jsonData = array(
    "type" => 1,
    "sendingType" => 0,
    "title" => "Siparişiniz için teşekkür ederiz.",
    "content" => "Test amaçlı tekil mesaj örneğidir, dikkate almayınız.",
    "number" => 905340129823,
    "encoding" => 0,
    "sender" => "GULTEKKIMYA",
    "validity" => 60
);

$response = $sms->sendSms($jsonData);
echo $response;

// Gönderici başlıklarını listeleme örneği
$listResponse = $sms->listSenders();
echo $listResponse;

// SMS iptal örneği
$cancelResponse = $sms->cancelSms(123); // Burada 123, iptal etmek istediğiniz SMS\'in ID'si olarak kabul edilmiştir.
echo $cancelResponse;

// Gönderilen SMS\'leri listeleme örneği
$listSmsResponse = $sms->listSms();
echo $listSmsResponse;

// Kredi sorgulama örneği
$creditResponse = $sms->checkCredit();
echo $creditResponse;

```

2. Manuel olarak:
Bu repoyu projelerinizde kullanmak isterseniz info{at]metinyildirim.net adresinden bana ulaşabilirsiniz.
