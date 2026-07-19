<?php
$path=trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/');
$page=$path?:'home';
$allowed=['home','urunler','hakkimizda','kataloglar','referanslar','iletisim'];
if(!in_array($page,$allowed,true)){http_response_code(404);$page='404';}
$meta=[
'home'=>['Vensis | Fan, Elektrik ve Ex-Proof','Endüstriyel fan, elektrik ve ex-proof çözümleri.'],
'urunler'=>['Ürünler | Vensis','Exproof, endüstriyel ve ticari fan ürünleri.'],
'hakkimizda'=>['Bizi Tanıyın | Vensis','Vensis kurumsal bilgiler.'],
'kataloglar'=>['Kataloglar | Vensis','Vensis marka ve ürün katalogları.'],
'referanslar'=>['Referanslar | Vensis','Vensis çözüm sunduğu sektörler.'],
'iletisim'=>['İletişim | Vensis','Vensis iletişim ve teklif formu.'],
'404'=>['Sayfa Bulunamadı | Vensis','Aradığınız sayfa bulunamadı.']];
[$title,$desc]=$meta[$page];
function nav($key,$text){global $page;return '<a class="'.($page===$key?'active':'').'" href="/'.($key==='home'?'':$key).'">'.$text.'</a>';}
function productCards(){return '<div class="cards four">'.
'<article class="card"><div class="icon">⚙</div><h3>Exproof Fanlar</h3><p>ATEX sertifikalı aksiyel, radyal ve çatı tipi çözümler.</p></article>'.
'<article class="card"><div class="icon">↻</div><h3>Endüstriyel Fanlar</h3><p>Fabrika, proses ve genel havalandırma uygulamaları.</p></article>'.
'<article class="card"><div class="icon">◉</div><h3>Ticari Fanlar</h3><p>Kanal, duvar, pencere ve sessiz fan çözümleri.</p></article>'.
'<article class="card"><div class="icon">⚡</div><h3>Exproof Elektrik</h3><p>Tehlikeli alan elektrik ekipmanları ve aksesuarları.</p></article></div>';}
?>
<!doctype html><html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?=htmlspecialchars($title)?></title><meta name="description" content="<?=htmlspecialchars($desc)?>"><link rel="icon" href="/assets/logo.svg"><link rel="stylesheet" href="/assets/style.css"></head><body>
<div class="top"><div class="wrap"><span>0312 945 13 60 · vensis@vensis.com.tr</span><span>Ankara · Türkiye</span></div></div>
<header><div class="wrap nav"><a class="brand" href="/"><img src="/assets/logo.svg" alt="Vensis"></a><nav id="menu"><?=nav('home','Ana Sayfa')?><?=nav('urunler','Ürünler')?><?=nav('hakkimizda','Bizi Tanıyın')?><?=nav('kataloglar','Kataloglar')?><?=nav('referanslar','Referanslar')?><?=nav('iletisim','İletişim')?></nav><a class="btn desktop" href="/iletisim">Teklif İste</a><button id="toggle">☰</button></div></header>
<main>
<?php if($page==='home'): ?>
<section class="hero"><div class="wrap hero-grid"><div><span class="eyebrow">Endüstriyel Havalandırma</span><h1>Fan, elektrik ve ex-proof çözümlerinde güvenilir partner.</h1><p class="lead">Sanayi projeleri için doğru ürünü seçiyor, teknik ihtiyaçlarınıza göre güvenilir tedarik sağlıyoruz.</p><div class="row"><a class="btn" href="/urunler">Ürünleri İncele</a><a class="btn ghost" href="/iletisim">Teklif Al</a></div><div class="stats"><div><strong>ATEX</strong><span>Tehlikeli alan çözümleri</span></div><div><strong>Hızlı</strong><span>Teklif ve teknik geri dönüş</span></div><div><strong>Proje</strong><span>Sanayiye özel yaklaşım</span></div></div></div><div class="hero-logo"><img src="/assets/logo.svg" alt="Vensis"></div></div></section>
<section><div class="wrap"><div class="heading"><div><span class="eyebrow">Ürün Grupları</span><h2>İhtiyacınıza uygun ürün ailesi</h2></div><p>Endüstriyel tesislerden ticari yapılara kadar farklı uygulamalar için doğru ürünleri sunuyoruz.</p></div><?=productCards()?></div></section>
<section class="soft"><div class="wrap"><div class="heading"><div><span class="eyebrow">Neden Vensis?</span><h2>Doğru ürün, doğru yaklaşım</h2></div></div><div class="cards four"><article class="card"><h3>Teknik seçim desteği</h3><p>Debi, basınç, ortam ve sertifika ihtiyaçlarına göre ürün belirleme.</p></article><article class="card"><h3>Güvenilir çözümler</h3><p>Zorlu sanayi koşulları için uygun ürünler.</p></article><article class="card"><h3>Hızlı teklif</h3><p>Projenizi bekletmeden net teklif hazırlığı.</p></article><article class="card"><h3>Uzun vadeli iş birliği</h3><p>Satış öncesi ve sonrası destek.</p></article></div></div></section>
<section class="dark"><div class="wrap"><div class="heading"><div><span class="eyebrow">Markalar</span><h2>Güçlü üreticilerle çözüm üretiyoruz</h2></div></div><div class="brands"><b>VITLO</b><b>VORTICE</b><b>ELICENT</b><b>NICOTRA</b><b>CASALS</b><b>COMEFRI</b></div></div></section>
<section><div class="wrap"><div class="cta"><div><h2>Projeniz için teklif isteyin.</h2><p>Debi, basınç ve ortam bilgilerini iletin; birlikte doğru ürünü seçelim.</p></div><a class="btn ghost white" href="/iletisim">İletişime Geç</a></div></div></section>
<?php elseif($page==='urunler'): ?>
<section class="pagehero"><div class="wrap"><h1>Ürünler</h1><p>Farklı sektör ve uygulamalar için sunduğumuz ürün grupları.</p></div></section><section><div class="wrap"><?=productCards()?></div></section>
<?php elseif($page==='hakkimizda'): ?>
<section class="pagehero"><div class="wrap"><h1>Bizi Tanıyın</h1><p>Güvenlik, verimlilik ve teknik doğruluk odaklı yaklaşımımız.</p></div></section><section><div class="wrap cards three"><article class="card"><h3>Kurumsal Yapı</h3><p>Vensis, endüstriyel fan, havalandırma ve ex-proof çözümler alanında faaliyet gösterir.</p></article><article class="card"><h3>Uzmanlık</h3><p>Patlayıcı ortam ekipmanları, fan seçimi ve sanayi projelerine uygun ürün tedariki.</p></article><article class="card"><h3>Hedefimiz</h3><p>Müşterinin ihtiyacını doğru anlayıp güvenilir ve uygulanabilir çözüm sunmak.</p></article></div></section>
<?php elseif($page==='kataloglar'): ?>
<section class="pagehero"><div class="wrap"><h1>Kataloglar</h1><p>Marka ve ürün katalogları burada yayınlanacak.</p></div></section><section><div class="wrap cards three"><?php foreach(['VITLO','VORTICE','ELICENT','NICOTRA','CASALS','COMEFRI'] as $b): ?><article class="card"><h3><?=$b?> Kataloğu</h3><p>Katalog dosyası eklendiğinde buradan indirilebilecek.</p><a class="btn ghost" href="/iletisim">Katalog İste</a></article><?php endforeach; ?></div></section>
<?php elseif($page==='referanslar'): ?>
<section class="pagehero"><div class="wrap"><h1>Referans Alanları</h1><p>Farklı sektörlerde çözüm sunduğumuz başlıca alanlar.</p></div></section><section><div class="wrap cards three"><?php foreach(['Savunma Sanayisi','Enerji Tesisleri','Kimya ve Petrokimya','Üretim Tesisleri','Hastaneler','Ticari Yapılar'] as $s): ?><article class="card"><h3><?=$s?></h3><p>Teknik ürün seçimi ve tedarik desteği.</p></article><?php endforeach; ?></div></section>
<?php elseif($page==='iletisim'): ?>
<section class="pagehero"><div class="wrap"><h1>İletişim ve Teklif</h1><p>Ürün, proje veya katalog talebinizi iletin.</p></div></section><section><div class="wrap contact"><div><div class="card"><h3>Telefon</h3><p>0312 945 13 60</p></div><div class="card"><h3>E-posta</h3><p>vensis@vensis.com.tr</p></div><div class="card"><h3>Konum</h3><p>Ankara / Türkiye</p></div></div><form class="card" method="post" action="/contact.php"><input name="website" class="hp"><input name="name" placeholder="Ad Soyad" required><input name="company" placeholder="Firma"><input type="email" name="email" placeholder="E-posta" required><input name="phone" placeholder="Telefon"><input name="subject" placeholder="Konu"><textarea name="message" placeholder="Mesajınız" required></textarea><button class="btn">Gönder</button></form></div></section>
<?php else: ?><section class="pagehero"><div class="wrap"><h1>Sayfa bulunamadı</h1><p><a href="/">Ana sayfaya dönün.</a></p></div></section><?php endif; ?>
</main>
<footer><div class="wrap footer-grid"><div><img src="/assets/logo.svg" alt="Vensis"><p>Fan, elektrik ve ex-proof çözümlerinde teknik çözüm ortağınız.</p></div><div><h4>Kurumsal</h4><a href="/hakkimizda">Bizi Tanıyın</a><a href="/referanslar">Referanslar</a><a href="/iletisim">İletişim</a></div><div><h4>Ürünler</h4><a href="/urunler">Exproof Fanlar</a><a href="/urunler">Endüstriyel Fanlar</a><a href="/urunler">Elektrik Ekipmanları</a></div><div><h4>İletişim</h4><p>0312 945 13 60<br>vensis@vensis.com.tr<br>Ankara / Türkiye</p></div></div><div class="wrap copyright">© <?=date('Y')?> Vensis. Tüm hakları saklıdır.</div></footer><script src="/assets/main.js"></script></body></html>
