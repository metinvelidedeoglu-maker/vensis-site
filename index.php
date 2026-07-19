<?php
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$page = $path ?: 'home';
$allowed = ['home','hakkimizda','referanslar','iletisim'];
if (!in_array($page, $allowed, true)) { http_response_code(404); $page = '404'; }

$meta = [
  'home' => ['Vensis | Endüstriyel Çözüm Platformu','Fan, elektrik ve ex-proof çözümleri için Vensis uzmanlık sitelerine ulaşın.'],
  'hakkimizda' => ['Bizi Tanıyın | Vensis','Vensis Havalandırma Ltd. Şti. kurumsal bilgiler.'],
  'referanslar' => ['Referans Alanları | Vensis','Vensis’in hizmet verdiği sektörler.'],
  'iletisim' => ['İletişim | Vensis','Vensis ile iletişime geçin.'],
  '404' => ['Sayfa Bulunamadı | Vensis','Aradığınız sayfa bulunamadı.']
];
[$title,$desc] = $meta[$page];

function nav($key,$label){
  global $page;
  $href = $key === 'home' ? '/' : '/'.$key;
  return '<a class="'.($page === $key ? 'active' : '').'" href="'.$href.'">'.$label.'</a>';
}

$portals = [
  ['Vitlo','https://vitlofan.com.tr','fans','p0'],
  ['Vortice','https://vorticefan.com.tr','fans','p1'],
  ['Elicent','https://elicentfan.com.tr','fans','p2'],
  ['Exproof Fan','https://exprooffan.com.tr','electric','p0'],
  ['Exproof Elektrik','https://exproofelektrik.com.tr','electric','p1'],
  ['Vensis Elektrik','https://vensiselektrik.com.tr','electric','p2'],
];

function portalCards($items){
  ob_start(); ?>
  <div class="portal-grid">
  <?php foreach($items as $p): ?>
    <a class="portal-card" href="<?=htmlspecialchars($p[1])?>" target="_blank" rel="noopener" aria-label="<?=htmlspecialchars($p[0])?> sitesine git">
      <span class="portal-image sprite-<?=htmlspecialchars($p[2])?> <?=htmlspecialchars($p[3])?>" role="img" aria-label="<?=htmlspecialchars($p[0])?>"></span>
    </a>
  <?php endforeach; ?>
  </div>
  <?php return ob_get_clean();
}
?>
<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?=htmlspecialchars($title)?></title>
<meta name="description" content="<?=htmlspecialchars($desc)?>">
<link rel="icon" href="/assets/logo.svg?v=20260719-3">
<style>
:root{--green:#008f4f;--green2:#16b36a;--ink:#102631;--navy:#061820;--muted:#647985;--soft:#f3f7f5;--line:#dbe5e0;--max:1220px}
*{box-sizing:border-box}html{scroll-behavior:smooth}body{margin:0;font-family:Arial,Helvetica,sans-serif;color:var(--ink);line-height:1.6;background:#fff}a{text-decoration:none;color:inherit}img{display:block;max-width:100%}.container{width:min(var(--max),calc(100% - 40px));margin:auto}
.topbar{background:#020b0f;color:#b9c8cf;font-size:12px}.topbar .container{height:36px;display:flex;align-items:center;justify-content:space-between;gap:20px}
header{position:sticky;top:0;z-index:50;background:#020b0f;border-bottom:1px solid rgba(255,255,255,.09)}.nav{min-height:92px;display:flex;align-items:center;justify-content:space-between;gap:28px}.brand{width:330px;flex:0 0 auto}.brand img{width:100%;height:auto;object-fit:contain}.nav nav{display:flex;align-items:center;gap:26px;color:#fff;font-size:14px;font-weight:700}.nav nav a{padding:34px 0;position:relative}.nav nav a:after{content:"";position:absolute;left:0;right:100%;bottom:23px;height:2px;background:var(--green2);transition:.25s}.nav nav a:hover:after,.nav nav a.active:after{right:0}.header-cta,.primary,.cta a,.selector-box>a,form button{display:inline-flex;min-height:48px;align-items:center;justify-content:center;padding:0 22px;border-radius:999px;background:var(--green);color:#fff;font-weight:800;border:1px solid var(--green)}#toggle{display:none;color:#fff;background:transparent;border:1px solid rgba(255,255,255,.25);border-radius:10px;padding:10px 13px;font-size:20px}
.hero{background:radial-gradient(circle at 82% 18%,rgba(22,179,106,.16),transparent 28%),linear-gradient(135deg,#061820,#0c3440);color:#fff;padding:100px 0 85px}.hero-grid{display:grid;grid-template-columns:1.05fr .95fr;gap:70px;align-items:center}.eyebrow{display:inline-block;color:var(--green2);font-size:12px;font-weight:900;letter-spacing:2.1px;margin-bottom:16px}.green{color:var(--green)}.light{color:#77e4ad}h1,h2,h3{line-height:1.08;margin:0 0 18px}h1{font-size:clamp(50px,6.4vw,82px);letter-spacing:-3px}.hero h1 em{font-style:normal;color:#73dfa9}h2{font-size:clamp(34px,4.5vw,54px);letter-spacing:-1.5px}h3{font-size:23px}.hero-copy>p{font-size:19px;color:#b8c9cf;max-width:610px;margin:0 0 30px}.hero-actions{display:flex;align-items:center;gap:25px;flex-wrap:wrap}.plain{font-weight:800;color:#fff}.proof{display:flex;gap:32px;flex-wrap:wrap;margin-top:45px;color:#94aab2;font-size:13px}.hero-logo{background:#000;border:1px solid rgba(255,255,255,.12);border-radius:26px;padding:28px;box-shadow:0 30px 80px rgba(0,0,0,.28)}.hero-logo img{width:100%;height:auto}
section{padding:90px 0}.section-head{display:flex;justify-content:space-between;gap:45px;align-items:end;margin-bottom:42px}.section-head>p{max-width:520px;color:var(--muted);font-size:17px}
.portal-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:32px}.portal-card{display:block;border-radius:28px;overflow:hidden;background:#fff;box-shadow:0 14px 36px rgba(16,38,49,.12);transition:.25s}.portal-card:hover{transform:translateY(-7px);box-shadow:0 26px 64px rgba(16,38,49,.18)}.portal-image{display:block;width:100%;aspect-ratio:4/3;background-repeat:no-repeat;background-size:300% 100%;background-color:#eef4f2}.sprite-fans{background-image:url('/assets/portals/fans-sprite.webp?v=20260719-3')}.sprite-electric{background-image:url('/assets/portals/electric-sprite.webp?v=20260719-3')}.portal-image.p0{background-position:0 50%}.portal-image.p1{background-position:50% 50%}.portal-image.p2{background-position:100% 50%}
.selector{padding-top:20px}.selector-box{background:linear-gradient(120deg,#008f4f,#00683b);color:#fff;border-radius:32px;padding:45px;display:grid;grid-template-columns:auto 1fr auto;gap:32px;align-items:center;box-shadow:0 25px 65px rgba(0,104,59,.22)}.selector-mark{width:92px;height:92px;border-radius:26px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.23);display:grid;place-items:center;font-size:32px;font-weight:900}.selector-box span{font-size:12px;font-weight:900;letter-spacing:2px;color:#bcebd2}.selector-box h2{font-size:clamp(31px,4vw,46px);margin-bottom:12px}.selector-box p{margin:0;color:#d8f2e4}.selector-box>a{background:#fff;border-color:#fff;color:var(--green);white-space:nowrap}
.why{background:var(--soft)}.features{display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid #cedbd5}.features article{padding:32px 25px 0 0}.features b{color:var(--green);font-size:13px}.features p{color:var(--muted)}
.sectors{background:var(--navy);color:#fff}.sector-grid{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center}.sector-grid>div:first-child p{color:#afc1c8;font-size:17px}.sector-grid>div:first-child a{font-weight:800}.sector-list{display:grid;grid-template-columns:1fr 1fr;gap:14px}.sector-list span{padding:19px;border:1px solid rgba(255,255,255,.13);border-radius:15px;background:rgba(255,255,255,.04);font-weight:700}
.cta{background:var(--green);color:#fff}.cta .container{display:grid;grid-template-columns:1.1fr .9fr;gap:50px;align-items:end}.cta span{font-size:12px;letter-spacing:2px;font-weight:900;color:#bfead3}.cta p{color:#d8f2e4;font-size:17px}.cta a{background:#fff;border-color:#fff;color:var(--green)}
.pagehero{background:linear-gradient(135deg,#061820,#0d3440);color:#fff;padding:90px 0}.pagehero p{max-width:690px;color:#bdcdd3;font-size:19px}.content{padding:90px 0}.two-col{display:grid;grid-template-columns:1fr 1fr;gap:70px;margin-bottom:55px}.two-col p{color:var(--muted);font-size:18px}.ref-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}.ref-grid article{padding:32px;border:1px solid var(--line);border-radius:22px}.ref-grid b{color:var(--green)}.ref-grid p{color:var(--muted)}
.contact-grid{display:grid;grid-template-columns:.8fr 1.2fr;gap:60px}.contact-info{display:flex;flex-direction:column;gap:20px}.contact-info>a,.contact-info>div{padding:20px 0;border-bottom:1px solid var(--line);font-size:18px}.contact-info small{display:block;color:var(--green);font-size:11px;letter-spacing:1.5px;font-weight:900}.contact-grid form{padding:34px;background:var(--soft);border-radius:24px}.form-row{display:grid;grid-template-columns:1fr 1fr;gap:14px}.contact-grid label{display:block;font-weight:800;font-size:13px;margin-bottom:13px}.contact-grid input,.contact-grid textarea{width:100%;padding:14px;border:1px solid #cad7d1;border-radius:11px;background:#fff;font:inherit;margin-top:6px}.contact-grid textarea{min-height:150px;resize:vertical}.hp{position:absolute;left:-9999px}
footer{background:#020b0f;color:#a9bac1;padding:62px 0 24px}.footer-grid{display:grid;grid-template-columns:1.4fr .8fr 1fr .9fr;gap:38px}.footer-brand img{width:310px;margin-bottom:20px}.footer-brand p{max-width:350px}.footer-grid h4{color:#fff;margin:0 0 17px}.footer-grid a{display:block;margin:8px 0}.copyright{border-top:1px solid rgba(255,255,255,.1);margin-top:34px;padding-top:20px;display:flex;justify-content:space-between;font-size:12px}
@media(max-width:1060px){.nav nav{display:none;position:absolute;top:92px;left:20px;right:20px;flex-direction:column;align-items:stretch;padding:18px;background:#061820;border:1px solid rgba(255,255,255,.13);border-radius:16px;box-shadow:0 20px 50px rgba(0,0,0,.28)}.nav nav.open{display:flex}.nav nav a{padding:10px}.nav nav a:after{display:none}.header-cta{display:none}#toggle{display:block}.hero-grid,.sector-grid,.two-col,.contact-grid{grid-template-columns:1fr}.features{grid-template-columns:repeat(2,1fr)}.selector-box{grid-template-columns:auto 1fr}.selector-box>a{grid-column:1/-1;width:max-content}.footer-grid{grid-template-columns:1fr 1fr}.cta .container{grid-template-columns:1fr}}
@media(max-width:680px){.container{width:min(var(--max),calc(100% - 28px))}.topbar .container{height:auto;min-height:42px;flex-direction:column;justify-content:center;gap:0;padding:5px 0;text-align:center}.topbar span:first-child{display:none}.nav{min-height:74px}.brand{width:220px}.nav nav{top:74px}.hero{padding:68px 0 58px}.hero-grid{gap:35px}h1{font-size:47px;letter-spacing:-2px}.hero-copy>p{font-size:17px}.hero-actions{align-items:stretch;flex-direction:column;gap:14px}.hero-actions .primary{width:100%;text-align:center}.plain{text-align:center}.proof{display:grid;grid-template-columns:1fr 1fr;gap:8px 18px;margin-top:30px}.hero-logo{padding:14px;border-radius:18px}.section-head{display:block}.section-head>p{font-size:16px}.portal-grid,.features,.sector-list,.ref-grid,.footer-grid,.form-row{grid-template-columns:1fr}.portal-grid{gap:22px}.portal-card{border-radius:22px}.selector-box{grid-template-columns:1fr;padding:28px 22px}.selector-mark{width:68px;height:68px}.selector-box>a{width:100%}.features article{padding:25px 0;border-bottom:1px solid #d3dfd9}.cta .container{display:block}.cta a{margin-top:12px}.footer-brand img{width:260px}.copyright{display:block}.copyright span{display:block;margin:5px 0}section,.content{padding:64px 0}.pagehero{padding:64px 0}}
</style>
</head>
<body>
<div class="topbar"><div class="container"><span>Vensis Havalandırma Ltd. Şti.</span><span><a href="tel:+903129451360">0312 945 13 60</a> · <a href="mailto:vensis@vensis.com.tr">vensis@vensis.com.tr</a></span></div></div>
<header><div class="container nav">
<a class="brand" href="/"><img src="/assets/logo.svg?v=20260719-3" alt="Vensis Fan Elektrik Ex-Proof"></a>
<nav id="menu"><?=nav('home','Ana Sayfa')?> <a href="/#cozumler">Çözümler</a> <?=nav('hakkimizda','Bizi Tanıyın')?> <?=nav('referanslar','Referanslar')?> <?=nav('iletisim','İletişim')?></nav>
<a class="header-cta" href="/iletisim">Projenizi Konuşalım</a><button id="toggle" aria-label="Menü">☰</button>
</div></header>
<main>
<?php if($page==='home'): ?>
<section class="hero"><div class="container hero-grid">
<div class="hero-copy"><span class="eyebrow">VENSİS ENDÜSTRİYEL ÇÖZÜM AĞI</span><h1>Tek merkez.<br><em>Altı uzmanlık.</em><br>Doğru çözüm.</h1><p>Fan, havalandırma ve ex-proof elektrik ihtiyaçlarınız için uzmanlaşmış sitelerimizi tek çatı altında buluşturuyoruz.</p><div class="hero-actions"><a class="primary" href="#cozumler">Çözüm Sitelerini İncele</a><a class="plain" href="https://select.vitlofan.com.tr" target="_blank" rel="noopener">Fan seçim aracını aç ↗</a></div><div class="proof"><span><b>2010</b>’dan beri</span><span>ATEX odaklı</span><span>Ankara merkezli</span></div></div>
<div class="hero-logo"><img src="/assets/logo.svg?v=20260719-3" alt="Vensis"></div>
</div></section>
<section id="cozumler" class="solutions"><div class="container"><div class="section-head"><div><span class="eyebrow green">UZMANLIK SİTELERİ</span><h2>İhtiyacınıza göre<br>doğru siteye geçin.</h2></div><p>Her görsel ilgili uzmanlık sitesine doğrudan bağlanır.</p></div><?=portalCards($portals)?></div></section>
<section class="selector"><div class="container selector-box"><div class="selector-mark">AI</div><div><span>VENSİS ENGINEERING SUITE</span><h2>Debi ve basıncı yazın,<br>uygun fanı saniyeler içinde bulun.</h2><p>Standart ve ex-proof fan seçimlerini teknik kriterlere göre filtreleyin.</p></div><a href="https://select.vitlofan.com.tr" target="_blank" rel="noopener">Programı Aç ↗</a></div></section>
<section class="why"><div class="container"><div class="section-head"><div><span class="eyebrow green">NEDEN VENSİS?</span><h2>Ürün satmaktan fazlası.</h2></div></div><div class="features"><article><b>01</b><h3>Teknik seçim</h3><p>Debi, basınç, ortam ve sertifika koşullarına göre doğru ürünü belirleriz.</p></article><article><b>02</b><h3>Uzman marka ağı</h3><p>Farklı uygulamalar için uzmanlaşmış ürün portföyü sunarız.</p></article><article><b>03</b><h3>Proje odaklı tedarik</h3><p>Termin ve dokümantasyon ihtiyaçlarını birlikte değerlendiririz.</p></article><article><b>04</b><h3>Satış sonrası destek</h3><p>Tekliften teslimata kadar hızlı ve ulaşılabilir iletişim sağlarız.</p></article></div></div></section>
<section class="sectors"><div class="container sector-grid"><div><span class="eyebrow light">ÇALIŞTIĞIMIZ SEKTÖRLER</span><h2>Zorlu projelerde<br>güvenilir çözüm ortağı.</h2><p>Savunma sanayisi ve yüksek güvenlik gerektiren endüstriyel tesislerde teknik ürün seçimi ve tedarik desteği sunuyoruz.</p><a href="/referanslar">Referans alanlarını incele →</a></div><div class="sector-list"><span>Savunma Sanayisi</span><span>Enerji Tesisleri</span><span>Kimya & Petrokimya</span><span>Üretim Tesisleri</span><span>Hastaneler</span><span>Ticari Yapılar</span></div></div></section>
<section class="cta"><div class="container"><div><span>PROJENİZ İÇİN</span><h2>Doğru çözümü birlikte belirleyelim.</h2></div><div><p>Teknik ihtiyacınızı gönderin; uygun ürün grubu ve uzman siteye sizi yönlendirelim.</p><a href="/iletisim">İletişime Geç</a></div></div></section>
<?php elseif($page==='hakkimizda'): ?>
<section class="pagehero"><div class="container"><span class="eyebrow light">KURUMSAL</span><h1>Vensis’i Tanıyın</h1><p>Endüstriyel havalandırma, fan ve ex-proof sistemlerde teknik çözüm ve tedarik desteği.</p></div></section><section class="content"><div class="container two-col"><div><h2>Teknik bilgi, doğru ürün ve güvenilir tedarik.</h2></div><div><p>Vensis Havalandırma Ltd. Şti., Ankara merkezli endüstriyel ekipman tedarikçisidir.</p><p>Fan, havalandırma ve patlamaya dayanıklı elektrik ekipmanlarında farklı marka ve ürün gruplarını yönetir.</p><p>Özellikle savunma sanayisi, enerji, kimya ve üretim tesisleri gibi yüksek güvenlik gerektiren projelere odaklanır.</p></div></div><?=portalCards($portals)?></section>
<?php elseif($page==='referanslar'): ?>
<section class="pagehero"><div class="container"><span class="eyebrow light">DENEYİM ALANLARI</span><h1>Referans Sektörler</h1><p>Farklı teknik koşullara sahip projelerde ürün seçimi ve tedarik desteği.</p></div></section><section class="content"><div class="container ref-grid"><?php foreach(['Savunma Sanayisi','Enerji Santralleri','Kimya & Petrokimya','Üretim Tesisleri','Hastaneler & Laboratuvarlar','Ticari & Endüstriyel Yapılar'] as $i=>$s): ?><article><b>0<?=$i+1?></b><h2><?=$s?></h2><p>Projeye özel fan, havalandırma ve ex-proof ekipman seçimi.</p></article><?php endforeach; ?></div></section>
<?php elseif($page==='iletisim'): ?>
<section class="pagehero"><div class="container"><span class="eyebrow light">İLETİŞİM</span><h1>Projenizi Konuşalım</h1><p>İhtiyacınızı iletin; doğru çözüm için dönüş yapalım.</p></div></section><section class="content"><div class="container contact-grid"><div class="contact-info"><h2>Vensis Havalandırma Ltd. Şti.</h2><a href="tel:+903129451360"><small>TELEFON</small>0312 945 13 60</a><a href="mailto:vensis@vensis.com.tr"><small>E-POSTA</small>vensis@vensis.com.tr</a><div><small>ADRES</small>Aşağı Öveçler Mah. 1332. Cadde No:3 D:7<br>Çankaya / Ankara</div></div><form method="post" action="/contact.php"><input class="hp" name="website"><div class="form-row"><label>Ad Soyad<input name="name" required></label><label>Firma<input name="company"></label></div><div class="form-row"><label>E-posta<input type="email" name="email" required></label><label>Telefon<input name="phone"></label></div><label>Konu<input name="subject"></label><label>Mesaj<textarea name="message" required></textarea></label><button type="submit">Gönder</button></form></div></section>
<?php else: ?><section class="pagehero"><div class="container"><h1>Sayfa bulunamadı</h1><p><a href="/">Ana sayfaya dönün.</a></p></div></section><?php endif; ?>
</main>
<footer><div class="container footer-grid"><div class="footer-brand"><img src="/assets/logo.svg?v=20260719-3" alt="Vensis"><p>Fan, elektrik ve ex-proof çözümlerini tek merkezde buluşturan endüstriyel çözüm platformu.</p></div><div><h4>Vensis</h4><a href="/hakkimizda">Bizi Tanıyın</a><a href="/referanslar">Referanslar</a><a href="/iletisim">İletişim</a></div><div><h4>Uzmanlık Siteleri</h4><a href="https://vitlofan.com.tr" target="_blank">Vitlo</a><a href="https://vorticefan.com.tr" target="_blank">Vortice</a><a href="https://elicentfan.com.tr" target="_blank">Elicent</a><a href="https://exprooffan.com.tr" target="_blank">Exproof Fan</a><a href="https://exproofelektrik.com.tr" target="_blank">Exproof Elektrik</a><a href="https://vensiselektrik.com.tr" target="_blank">Vensis Elektrik</a></div><div><h4>İletişim</h4><p>0312 945 13 60<br>vensis@vensis.com.tr<br>Ankara / Türkiye</p></div></div><div class="container copyright"><span>© <?=date('Y')?> Vensis Havalandırma Ltd. Şti.</span><span>Fan · Elektrik · Ex-Proof</span></div></footer>
<script>const toggle=document.getElementById('toggle');const menu=document.getElementById('menu');if(toggle&&menu){toggle.addEventListener('click',()=>menu.classList.toggle('open'));menu.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>menu.classList.remove('open')))}</script>
</body></html>