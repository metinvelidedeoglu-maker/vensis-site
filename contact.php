<?php
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location:/iletisim');exit;}
function c($v){return trim(strip_tags($v??''));}
if(c($_POST['website']??'')!=='')exit('OK');
$name=c($_POST['name']);$email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL);$message=c($_POST['message']);
$company=c($_POST['company']);$phone=c($_POST['phone']);$subject=c($_POST['subject'])?:'Web Talebi';
$ok=false;if($name&&$email&&$message){$body="Ad: $name\nFirma: $company\nE-posta: $email\nTelefon: $phone\nKonu: $subject\n\n$message";$headers="From: Vensis Web <vensis@vensis.com.tr>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";$ok=mail('vensis@vensis.com.tr','Vensis Web Talebi: '.$subject,$body,$headers);}
?><!doctype html><html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="/assets/style.css"><title>Form Sonucu</title></head><body><section><div class="wrap card"><h1><?=$ok?'Talebiniz alındı.':'Mesaj gönderilemedi.'?></h1><p><?=$ok?'En kısa sürede dönüş yapılacaktır.':'Lütfen tekrar deneyin veya e-posta gönderin.'?></p><a class="btn" href="/">Ana Sayfa</a></div></section></body></html>