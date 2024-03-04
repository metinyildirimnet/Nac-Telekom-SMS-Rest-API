# NacSms PHP Class

NacSms, Nac firmasının SMS gönderimi için kullanılabilecek bir PHP sınıfıdır. Bu sınıf aracılığıyla SMS gönderebilir, kredi sorgulayabilir ve gönderilen SMS'leri iptal edebilirsiniz.

## Kurulum

### Gereksinimler
- PHP 5.6 veya daha yeni bir sürüm

### Kullanım
1. `NacSms.php` dosyasını projenize dahil edin.
2. `NacSms` sınıfını kullanarak SMS gönderimi, kredi sorgulama veya SMS iptali yapabilirsiniz.

```php
<?php

// NacSms sınıfını dahil edin
require_once('NacSms.php');

// NacSms nesnesini oluşturun (Kullanıcı adı, şifre, [gönderen])
$nacSms = new NacSms("kullanici_adi", "sifre", "gonderen_isim");

// Kredi sorgulama örneği
$creditResponse = $nacSms->credit();
echo "Kredi: " . $creditResponse . "\n";

// SMS gönderimi örneği
$title = "Başlık";
$content = "İçerik";
$number = "905xxxxxxxxx"; // Örnek telefon numarası
$createResponse = $nacSms->create($title, $content, $number);
echo "SMS Gönderme Yanıtı: " . $createResponse . "\n";

// SMS iptali örneği
$smsId = "123456"; // İptal edilecek SMS ID'si
$cancelResponse = $nacSms->cancel($smsId);
echo "SMS İptal Yanıtı: " . $cancelResponse . "\n";
