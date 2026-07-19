<?php
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$page = $path ?: 'home';
$allowed = ['home','hakkimizda','referanslar','blog','iletisim'];
if (!in_array($page, $allowed, true)) { http_response_code(404); $page = '404'; }
$meta = [
  'home' => ['Vensis | Endüstriyel Çözüm Platformu', 'Vensis; endüstriyel fan, ex-proof havalandırma ve patlamaya dayanıklı elektrik çözümlerini uzman sitelerinde bir araya getirir.'],
  'hakkimizda' => ['Bizi Tanıyın | Vensis', 'Vensis Havalandırma Ltd. Şti. kurumsal bilgiler ve uzmanlık alanları.'],
  'referanslar' => ['Referans Alanları | Vensis', 'Vensis’in savunma sanayisi ve endüstriyel projelerde hizmet verdiği sektörler.'],
  'blog' => ['Bilgi Merkezi | Vensis', 'Endüstriyel havalandırma, ex-proof fan ve ATEX hakkında teknik içerikler.'],
  'iletisim' => ['İletişim | Vensis', 'Vensis ile iletişime geçin ve projeniz için teknik destek alın.'],
  '404' => ['Sayfa Bulunamadı | Vensis', 'Aradığınız sayfa bulunamadı.']
];
[$title,$desc] = $meta[$page];
function nav($key,$text){ global $page; return '<a class="'.($page===$key?'active':'').'" href="/'.($key==='home'?'':$key).'">'.$text.'</a>'; }
$sites = [
 ['Exproof Fan','Patlayıcı ortamlara uygun ATEX fan çözümleri.','https://exprooffan.com.tr','EX','red'],
 ['Vitlo Fan','Endüstriyel ve ex-proof fan ürünleri.','https://vitlofan.com.tr','VT','green'],
 ['Vortice','Konut, ticari ve endüstriyel havalandırma.','https://vorticefan.com.tr','VO','blue'],
 ['Elicent','İtalyan menşeili kompakt fan çözümleri.','https://elicentfan.com.tr','EL','orange'],
 ['Nicotra Gebhardt','Plug fan, çift emişli ve HVAC fanları.','https://nicotra.com.tr','NG','navy'],
 ['Exproof Elektrik','ATEX aydınlatma ve elektrik ekipmanları.','https://exproofelektrik.com.tr','EE','amber'],
];
function siteCards($sites){ ob_start(); ?>
<div class="portal-grid">
<?php foreach($sites as $i=>$s): ?>
<a class="portal-card <?=htmlspecialchars($s[5])?>" href="<?=htmlspecialchars($s[2])?>" target="_blank" rel="noopener">
  <span class="card-no">0<?=$i+1?></span>
  <div class="brand-mark"><?=htmlspecialchars($s[3])?></div>
  <div class="card-copy"><h3><?=htmlspecialchars($s[0])?></h3><p><?=htmlspecialchars($s[1])?></p></div>
  <span class="arrow">↗</span>
</a>
<?php endforeach; ?>
</div>
<?php return ob_get_clean(); }
?>
<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=htmlspecialchars($title)?></title><meta name="description" content="<?=htmlspecialchars($desc)?>">
<link rel="canonical" href="https://www.vensis.com.tr/<?= $page==='home'?'':htmlspecialchars($page).'/' ?>">
<link rel="icon" href="/assets/logo.svg"><link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<div class="topline"><div class="wrap"><span>Vensis Havalandırma Ltd. Şti.</span><span><a href="tel:+903129451360">0312 945 13 60</a> · <a href="mailto:vensis@vensis.com.tr">vensis@vensis.com.tr</a></span></div></div>
<header><div class="wrap nav">
<a class="brand" href="/"><img src="/assets/logo.svg" alt="Vensis"></a>
<nav id="menu"><?=nav('home','Ana Sayfa')?> <a href="/#cozumler">Çözümler</a> <?=nav('hakkimizda','Bizi Tanıyın')?> <?=nav('referanslar','Referanslar')?> <?=nav('blog','Bilgi Merkezi')?> <?=nav('iletisim','İletişim')?></nav>
<a class="btn desktop" href="/iletisim">Projenizi Konuşalım</a><button id="toggle" aria-label="Menü">☰</button>
</div></header>
<main>
<?php if($page==='home'): ?>
<section class="hero"><div class="wrap hero-grid">
<div class="hero-copy"><span class="eyebrow">VENSİS ENDÜSTRİYEL ÇÖZÜM AĞI</span><h1>Tek merkez.<br><em>Altı uzmanlık.</em><br>Doğru çözüm.</h1><p class="lead">Fan, havalandırma ve ex-proof elektrik ihtiyaçlarınız için uzmanlaşmış markalarımızı tek çatı altında buluşturuyoruz.</p><div class="hero-actions"><a class="btn" href="#cozumler">Çözüm Sitelerini İncele</a><a class="text-link" href="https://select.vitlofan.com.tr" target="_blank" rel="noopener">Fan seçim aracını aç <span>↗</span></a></div><div class="trust-row"><span><b>2010</b>’dan beri</span><span>ATEX odaklı</span><span>Ankara merkezli</span></div></div>
<div class="network" aria-label="Vensis uzmanlık ağı"><div class="network-ring r1"></div><div class="network-ring r2"></div><div class="network-center"><img src="/assets/logo.svg" alt="Vensis"></div><span class="node n1">EX</span><span class="node n2">VT</span><span class="node n3">VO</span><span class="node n4">EL</span><span class="node n5">NG</span><span class="node n6">EE</span></div>
</div></section>
<section id="cozumler" class="solutions"><div class="wrap"><div class="section-head"><div><span class="eyebrow">UZMANLIK SİTELERİMİZ</span><h2>İhtiyacınız hangi alandaysa,<br>doğru siteye geçin.</h2></div><p>Her site belirli bir ürün grubu ve teknik ihtiyaca odaklanır. Böylece aradığınız çözüme daha hızlı ulaşırsınız.</p></div><?=siteCards($sites)?></div></section>
<section class="selector"><div class="wrap selector-box"><div class="selector-icon"><span>AI</span></div><div><span class="eyebrow light">DİJİTAL MÜHENDİSLİK ARACI</span><h2>Debi ve basıncı yazın,<br>uygun fanı saniyeler içinde bulun.</h2><p>Vensis Engineering Suite; standart ve ex-proof fan seçimlerini teknik kriterlere göre listeler.</p></div><a class="btn white-btn" href="https://select.vitlofan.com.tr" target="_blank" rel="noopener">Fan Seçim Programını Aç ↗</a></div></section>
<section class="why"><div class="wrap"><div class="section-head"><div><span class="eyebrow">NEDEN VENSİS?</span><h2>Ürün satmaktan fazlası.</h2></div></div><div class="feature-grid"><article><b>01</b><h3>Teknik ürün seçimi</h3><p>Debi, basınç, ortam ve sertifika koşullarına göre doğru ürünü belirleriz.</p></article><article><b>02</b><h3>Uzman marka ağı</h3><p>Farklı uygulamalar için uzmanlaşmış marka ve ürün portföyü sunarız.</p></article><article><b>03</b><h3>Proje odaklı tedarik</h3><p>Termin, dokümantasyon ve saha ihtiyaçlarını birlikte değerlendiririz.</p></article><article><b>04</b><h3>Satış sonrası destek</h3><p>Tekliften teslimata kadar ulaşılabilir ve hızlı iletişim sağlarız.</p></article></div></div></section>
<section class="industries"><div class="wrap industries-grid"><div><span class="eyebrow light">ÇALIŞTIĞIMIZ SEKTÖRLER</span><h2>Zorlu projelerde<br>güvenilir çözüm ortağı.</h2><p>Savunma sanayisi ve yüksek güvenlik gerektiren endüstriyel tesislerde, ürün tedarikinin yanında teknik değerlendirme desteği sunuyoruz.</p><a class="text-link light-link" href="/referanslar">Referans alanlarını incele <span>→</span></a></div><div class="sector-list"><span>Savunma Sanayisi</span><span>Enerji Tesisleri</span><span>Kimya & Petrokimya</span><span>Üretim Tesisleri</span><span>Hastaneler</span><span>Ticari Yapılar</span></div></div></section>
<section class="insights"><div class="wrap"><div class="section-head"><div><span class="eyebrow">BİLGİ MERKEZİ</span><h2>Teknik bilgiyi sadeleştiriyoruz.</h2></div><a class="text-link" href="/blog">Tüm içerikler <span>→</span></a></div><div class="article-grid"><a href="https://vensis.com.tr/exproof-fan-secim-rehberi-dogru-fani-nasil-belirleriz/" target="_blank" rel="noopener"><span>SEÇİM REHBERİ</span><h3>Exproof Fan Seçim Rehberi: Doğru Fanı Nasıl Belirleriz?</h3><b>Oku ↗</b></a><a href="https://vensis.com.tr/exproof-fanlarin-teknik-detaylari-ve-endustrideki-kritik-rolu/" target="_blank" rel="noopener"><span>TEKNİK BİLGİ</span><h3>Exproof Fanların Teknik Detayları ve Endüstrideki Kritik Rolü</h3><b>Oku ↗</b></a><a href="https://vensis.com.tr/endustriyel-guvenlikte-onemli-bir-rol-exproof-fan-nedir-ve-atex-sertifikasinin-onemi/" target="_blank" rel="noopener"><span>ATEX</span><h3>Exproof Fan Nedir ve ATEX Sertifikasının Önemi</h3><b>Oku ↗</b></a></div></div></section>
<section class="final-cta"><div class="wrap"><div><span class="eyebrow light">PROJENİZ İÇİN</span><h2>Doğru çözümü birlikte belirleyelim.</h2></div><div><p>Teknik ihtiyacınızı gönderin; uygun ürün grubu ve uzman siteye sizi yönlendirelim.</p><a class="btn white-btn" href="/iletisim">İletişime Geç</a></div></div></section>
<?php elseif($page==='hakkimizda'): ?>
<section class="pagehero"><div class="wrap"><span class="eyebrow light">KURUMSAL</span><h1>Vensis’i Tanıyın</h1><p>2010’dan beri endüstriyel havalandırma ve ex-proof sistemlerde teknik çözüm ve tedarik desteği sunuyoruz.</p></div></section><section class="content-section"><div class="wrap split"><div><h2>Teknik bilgi, doğru ürün ve güvenilir tedarik.</h2></div><div><p>Vensis Havalandırma Ltd. Şti., Ankara merkezli endüstriyel ekipman tedarikçisidir. Fan, havalandırma ve patlamaya dayanıklı elektrik ekipmanlarında farklı marka ve ürün gruplarını yönetir.</p><p>Özellikle savunma sanayisi, enerji, kimya ve üretim tesisleri gibi yüksek güvenlik gerektiren projelere odaklanır.</p></div></div><?=siteCards($sites)?></section>
<?php elseif($page==='referanslar'): ?>
<section class="pagehero"><div class="wrap"><span class="eyebrow light">DENEYİM ALANLARIMIZ</span><h1>Referans Sektörler</h1><p>Farklı teknik koşullara sahip projelerde ürün seçimi ve tedarik desteği.</p></div></section><section class="content-section"><div class="wrap sector-page"><?php foreach(['Savunma Sanayisi','Enerji Santralleri','Kimya & Petrokimya','Üretim Tesisleri','Hastaneler & Laboratuvarlar','Ticari & Endüstriyel Yapılar'] as $i=>$s): ?><article><span>0<?=$i+1?></span><h2><?=$s?></h2><p>Projeye özel fan, havalandırma ve ex-proof ekipman seçimi.</p></article><?php endforeach; ?></div></section>
<?php elseif($page==='blog'): ?>
<section class="pagehero"><div class="wrap"><span class="eyebrow light">TEKNİK İÇERİKLER</span><h1>Bilgi Merkezi</h1><p>Fan seçimi, ATEX ve endüstriyel havalandırma hakkında pratik rehberler.</p></div></section><section class="content-section"><div class="wrap article-grid large"><a href="https://vensis.com.tr/exproof-fan-secim-rehberi-dogru-fani-nasil-belirleriz/" target="_blank" rel="noopener"><span>SEÇİM REHBERİ</span><h3>Exproof Fan Seçim Rehberi: Doğru Fanı Nasıl Belirleriz?</h3><b>Oku ↗</b></a><a href="https://vensis.com.tr/exproof-fanlarin-teknik-detaylari-ve-endustrideki-kritik-rolu/" target="_blank" rel="noopener"><span>TEKNİK BİLGİ</span><h3>Exproof Fanların Teknik Detayları ve Endüstrideki Kritik Rolü</h3><b>Oku ↗</b></a><a href="https://vensis.com.tr/endustriyel-guvenlikte-onemli-bir-rol-exproof-fan-nedir-ve-atex-sertifikasinin-onemi/" target="_blank" rel="noopener"><span>ATEX</span><h3>Exproof Fan Nedir ve ATEX Sertifikasının Önemi</h3><b>Oku ↗</b></a></div></section>
<?php elseif($page==='iletisim'): ?>
<section class="pagehero"><div class="wrap"><span class="eyebrow light">İLETİŞİM</span><h1>Projenizi Konuşalım</h1><p>İhtiyacınızı iletin; doğru uzmanlık alanı ve çözüm için dönüş yapalım.</p></div></section><section class="content-section"><div class="wrap contact-grid"><div class="contact-info"><h2>Vensis Havalandırma Ltd. Şti.</h2><a href="tel:+903129451360"><small>Telefon</small>0312 945 13 60</a><a href="mailto:vensis@vensis.com.tr"><small>E-posta</small>vensis@vensis.com.tr</a><div><small>Adres</small>Aşağı Öveçler Mah. 1332. Cadde No:3 D:7<br>Çankaya / Ankara</div></div><form class="contact-form" method="post" action="/contact.php"><input class="hp" name="website"><div class="form-row"><label>Ad Soyad<input name="name" required></label><label>Firma<input name="company"></label></div><div class="form-row"><label>E-posta<input type="email" name="email" required></label><label>Telefon<input name="phone"></label></div><label>Konu<input name="subject"></label><label>Mesaj<textarea name="message" required></textarea></label><button class="btn" type="submit">Gönder</button></form></div></section>
<?php else: ?><section class="pagehero"><div class="wrap"><h1>Sayfa bulunamadı</h1><p><a href="/">Ana sayfaya dönün.</a></p></div></section><?php endif; ?>
</main>
<footer><div class="wrap footer-grid"><div class="footer-brand"><img src="/assets/logo.svg" alt="Vensis"><p>Fan, elektrik ve ex-proof çözümlerini tek merkezde buluşturan endüstriyel çözüm platformu.</p></div><div><h4>Vensis</h4><a href="/hakkimizda">Bizi Tanıyın</a><a href="/referanslar">Referanslar</a><a href="/blog">Bilgi Merkezi</a><a href="/iletisim">İletişim</a></div><div><h4>Uzmanlık Siteleri</h4><a href="https://exprooffan.com.tr" target="_blank">Exproof Fan</a><a href="https://vitlofan.com.tr" target="_blank">Vitlo Fan</a><a href="https://vorticefan.com.tr" target="_blank">Vortice</a><a href="https://exproofelektrik.com.tr" target="_blank">Exproof Elektrik</a></div><div><h4>İletişim</h4><p>0312 945 13 60<br>vensis@vensis.com.tr<br>Ankara / Türkiye</p></div></div><div class="wrap copyright"><span>© <?=date('Y')?> Vensis Havalandırma Ltd. Şti.</span><span>Fan · Elektrik · Ex-Proof</span></div></footer>
<script src="/assets/main.js"></script></body></html>
