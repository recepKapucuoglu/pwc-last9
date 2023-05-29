<?php include('dosyalar/dahili/header.php');

$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('url_list');
foreach ($results as $value) {
	$source=$value['source'];
}


if($source=="education-calender"){

	$db->where('seo_url', $page_url);
	$results = $db->get('education_calender_list');
	foreach ($results as $value) {
		$edu_cal_id=$value['id'];
		$edu_id=$value['edu_id'];
		$resim=$value['resim'];
		$resim_alt_etiket=$value['resim_alt_etiket'];
		$sehir=$value['sehir_adi'];
		$egitim_suresi=$value['egitim_suresi'];
		$egitim_tarih=$value['egitim_tarih'];
		$ucret=$value['ucret'];
		$egitim_adi=$value['egitim_adi'];
		$seo_url=$value['seo_url'];
	}
	$genel_toplam = $ucret;
	$kdv = $ucret - ($ucret / 1.18);
}

if($edu_cal_id==""){
	header("Location: https://www.okul.pwc.com.tr");
	exit;
}
?>
<?php
if($_POST){
//Fatura Bilgileri
$fatura_turu = valueClear($_POST['fatura-turu']);
$fatura_adsoyad = valueClear($_POST['fatura_adsoyad']);
$tc_no = valueClear($_POST['tc_no']);
$firma_unvani = valueClear($_POST['firma_unvani']);
$vergi_dairesi = valueClear($_POST['vergi_dairesi']);
$vergi_no = valueClear($_POST['vergi_no']);
$adres = valueClear($_POST['adres']);

$_SESSION['fatura_bilgileri'] = $_POST;
}
$adet = intval($_SESSION['katilimcilar']['adet']);
$adet = ($adet == 0) ? 1 : $adet;
$db->where("id",$edu_cal_id);
$results = $db->get('education_calender');
foreach ($results as $value) {
	$fiyat = $value['ucret'];
}

$toplam_fiyat = ($fiyat * $adet) * 1.18;


$kdv = $toplam_fiyat - ($toplam_fiyat / 1.18);

?>
	<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">EĞİTİM KAYIT FORMU</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="egitimlerimiz.php"><span itemprop="name">Eğitimlerimiz</span></a>
					<meta itemprop="position" content="2" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="<?php echo $seo_url; ?>"><span itemprop="name"><?php echo $egitim_adi; ?></span></a>
					<meta itemprop="position" content="3" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name">Sipariş Özeti</span></a>
					<meta itemprop="position" content="4" />
				</li>
			</ol>
		</div>
	</section>
	<section class="ortakisim">
		<div class="formMessage col-md-10 col-md-push-1"></div>
		<form id="contact-form" class="sepetform" method="post" action="siparis-sonuc/">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="sepet-adimlar">
							<div class="adim ok"><a href="katilimcilar/<?php echo $seo_url; ?>"><i class="icon user-icon"></i> Katılımcı</a></div>
							<div class="adim ok"><a href="sepet-odeme/<?php echo $seo_url; ?>"><i class="icon kk-icon"></i> Fatura Bilgileri</a></div>
							<div class="adim ok"><a href="javascript:;"><i class="icon ozet-icon"></i> Kayıt Özeti</a></div>
							<div class="adim"><a href="javascript:;"><i class="icon ss-icon"></i> Kaydınız Tamamlandı</a></div>
						</div>
						<div class="sepet-div">
							<div class="row">
								<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
									<h3><b>Sipariş Özeti</b></h3>
									<?php /* print "<pre>"; print_r($_SESSION['katilimcilar']); print_r($_SESSION['fatura_bilgileri']);  print "</pre>";*/ ?>
									<p>Lütfen sipariş bilgilerinizi gözden geçirip onaylayın.</p>
									<table class="tablesepet sepetlist sepetozeti">
										<tbody>
											<tr>
												<td>
													<div class="urunkutusu">
														<div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
														<div class="adi"><?php echo $egitim_adi; ?> <br /><small>Eğitim Tarihi: <?php echo date2human($egitim_tarih); ?><br />Ödeme Yöntemi: Havale/EFT</small></div>
													</div>
												</td>
												<td style="display: none;"><?php echo $_SESSION['katilimcilar']['adet']; ?> Katılımcı</td>
												<td>
													<div class="fiyat">
														
														<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
									<h3><b>Sözleşme ve Formlar</b></h3>
									<h4><b>Ön Bilgilendirme Formu</b></h4>
									<br />
									<div class="sozlesmemetinleri">
										<div class="scrollbar-rail">
											
<p><strong>MADDE 1 - TARAFLAR</strong></p>

<p><strong><u>PwC T&uuml;rkiye: </u></strong><br />
Unvan: PwC Y&ouml;netim Danışmanlığı Anonim Şirketi<br />
MERSİS No: 0-7330-4406-4400016<br />
Adres: S&uuml;leyman Seba Cad. BJK Plaza B Blok Kat:4 34357 Akaretler / Beşiktaş<br />
Telefon: 0 (212) 376 59 80<br />
E-mail: egitim@tr.pwc.com</p>

<p><strong><u>M&Uuml;ŞTERİ: </u></strong><br />
Ad Soyad/Firma: <?php if($_SESSION['fatura_bilgileri']['fatura-turu']==2) echo $_SESSION['fatura_bilgileri']['firma_unvani']; else echo $_SESSION['fatura_bilgileri']['fatura_adsoyad']; ?><br />
Adres: <?php echo $_SESSION['fatura_bilgileri']['adres']; ?><br />
Telefon: <?php echo $_SESSION['fatura_bilgileri']['fatura_telefon']; ?><br />
E-mail: <?php echo $_SESSION['fatura_bilgileri']['fatura_email']; ?></p>

<p><strong>MADDE 2 - S&Ouml;ZLEŞMENİN KONUSU</strong></p>

<p>İşbu S&ouml;zleşmenin konusu, M&uuml;şteri&#39;nin PwC T&uuml;rkiye&rsquo;ye ait <a href="http://www.okul.pwc.com.tr">www.okul.pwc.com.tr</a> alan alan adlı internet sitesinden (&quot;Platform&quot;) elektronik ortamda siparişini verdiği, işbu s&ouml;zleşmenin &uuml;&ccedil;&uuml;nc&uuml; maddesinde &ouml;zellikleri ve satış fiyatı belirtilen hizmet ile ilgili olarak tarafların hak ve y&uuml;k&uuml;ml&uuml;l&uuml;klerinin tespitidir. İşbu s&ouml;zleşme başta T&uuml;keticinin Korunması Hakkında Kanun ve Mesafeli S&ouml;zleşmeler Y&ouml;netmeliği&rsquo;ne uygun olarak d&uuml;zenlenmiştir ve taraflar işbu s&ouml;zleşmeyle birlikte T&uuml;keticinin Korunması Hakkında Kanun ve Abonelik S&ouml;zleşmeleri Y&ouml;netmeliği ve Mesafeli S&ouml;zleşmeler Y&ouml;netmeliği&#39;nden kaynaklanan y&uuml;k&uuml;ml&uuml;l&uuml;k ve sorumluluklarını bildiklerini ve anladıklarını kabul ve beyan ederler.</p>

<p><strong>MADDE 3 - HİZMET BİLGİLERİ</strong></p>

<p>Hizmetin; T&uuml;r&uuml;, &Ouml;zellikleri ve S&uuml;resi, aşağıda belirtildiği gibidir.</p>

<p>Hizmet Başlığı: <?php echo $egitim_adi; ?></p>

<p>Hizmet T&uuml;r&uuml;: Online/Sınıf Eğitimi</p>

<p><b>Hizmet Süresi:</b> Tercih edilen online video eğitimlere M&uuml;şteri&rsquo;nin bu s&ouml;zleşmeyi kabul ederek kayıt olması, www.okul.pwc.com.tr internet sitesinde beyan edilen bedelin &ouml;denmesiyle beraber başlar ve 3 (&uuml;&ccedil;) ay s&uuml;re ile devam eder.</p>


<p>Hizmet A&ccedil;ıklaması: &ldquo;PwC T&uuml;rkiye erişime sunduğu Platform ile M&uuml;şterilere internet &uuml;zerinden PwC T&uuml;rkiye&rsquo;nin eğitimlerine kayıt olma, &uuml;cretli eğitimlerini satın alma ve &uuml;cretli/&uuml;cretsiz online eğitimlerini izleyebilme imk&acirc;nı sağlayacaktır.</p>

<p>M&uuml;şteri burada belirtilen hizmet a&ccedil;ıklamasının kendi ihtiya&ccedil;larına uygun olduğunu d&uuml;ş&uuml;nerek bu hizmeti tercih etmesi halinde ve &ouml;deme yapmasının ardından Platform&rsquo;u kullanmaya ve/veya eğitime kayıt olmaya hak kazanacaktır.&rdquo;</p>

<p>Online eğitime katılmak i&ccedil;in ihtiyacınız olan şeyler: bilgisayar, tablet ya da akıllı telefon, aktif internet bağlantısıdır.&rdquo;</p>

<p>Fiyatı (KDV d&acirc;hil) : <?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</p>

<p>Fatura Adresi: <?php echo $_SESSION['fatura_bilgileri']['adres']; ?></p>

<p><strong>MADDE 5 &ndash; GENEL H&Uuml;K&Uuml;MLER</strong></p>

<p><b>5.1</b> İşbu s&ouml;zleşme tarafları M&uuml;şteri ile PwC T&uuml;rkiye olup işbu s&ouml;zleşmenin yerine getirilmesi ile ilgili t&uuml;m y&uuml;k&uuml;ml&uuml;l&uuml;k ve sorumluluklar taraflara aittir. İşbu s&ouml;zleşme M&uuml;şteri tarafından elektronik olarak onaylandığı tarihte (<?php echo date("d.m.Y"); ?>) y&uuml;r&uuml;rl&uuml;ğe girer. M&uuml;şteri, hizmetin işbu s&ouml;zleşmenin kendisi tarafından onaylandığı tarihte başlatılacağını kabul eder</p>
<p><b>5.2</b> M&uuml;şteri, PwC T&uuml;rkiye&#39;ye ait Platform&#39;da sunulan s&ouml;zleşme konusu hizmetin Platform&#39;da belirtilen ve yukarıda yer alan temel nitelikleri, satış fiyatı, fiyatların ge&ccedil;erlilik s&uuml;resi ve &ouml;deme şekline ilişkin bilgileri okuyup doğru ve eksiksiz şekilde bilgi sahibi olduğunu ve elektronik ortamda satın almaya ilişkin gerekli teyidi verdiğini kabul ve beyan eder.</p>
<p><b>5.3</b> PwC T&uuml;rkiye, s&ouml;zleşme konusu hizmetin, Platform&#39;da yer alan kullanım koşulları ve sair metinlerde belirtilen niteliklere uygun ifa edilmesinden sorumludur.</p>
<p><b>5.4</b> Herhangi bir nedenle hizmet bedeli &ouml;denmez veya banka kayıtlarında iptal edilir ise, PwC T&uuml;rkiye hizmeti ifa y&uuml;k&uuml;ml&uuml;l&uuml;ğ&uuml;nden kurtulmuş kabul edilir. Bu durumda PwC T&uuml;rkiye, ifasına başlanmış olan hizmeti derhal durdurma hakkına sahip olacaktır.</p>
<p><b>5.5</b> Hizmetin ifasından sonra M&uuml;şteri&#39;ye ait kredi kartının M&uuml;şteri&rsquo;nin kusurundan kaynaklanmayan bir şekilde yetkisiz kişilerce haksız veya hukuka aykırı olarak kullanılması nedeni ile ilgili banka veya finans kuruluşunun hizmet bedelini PwC T&uuml;rkiye&#39;ye &ouml;dememesi halinde, PwC T&uuml;rkiye&#39;nin ilgili &ouml;deme yapılana kadar hizmeti askıya alma/iptal etme hakkı saklıdır.</p>
<p><b>5.6</b> S&ouml;zleşme konusu hizmete ilişkin &ouml;demenin M&uuml;şteri tarafından kredi kartı ile yapılması durumunda, M&uuml;şteri ile kredi kartı sahibinin ya da hizmetin ifa edileceği kişinin farklı olmasından kaynaklanabilecek olan, kredi kartının yetkisiz kişilerce haksız ve hukuka aykırı olarak kullanılması da dahil olmak &uuml;zere t&uuml;rl&uuml; hukuki risk, M&uuml;şteri&rsquo;ye aittir. M&uuml;şteri, bahsi ge&ccedil;en durumlarda herhangi bir şekilde zarara uğraması halinde PwC T&uuml;rkiye&#39;den hi&ccedil;bir talepte bulunmayacağını kabul ve taahh&uuml;t eder.</p>
<p><b>5.7</b> M&uuml;şteri, y&uuml;r&uuml;rl&uuml;kte bulunan mevzuat h&uuml;k&uuml;mleri gereğince faiz ve temerr&uuml;t faizi ile ilgili h&uuml;k&uuml;mlerin banka ve M&uuml;şteri arasındaki kredi kartı s&ouml;zleşmesi kapsamında uygulanacağını kabul, beyan ve taahh&uuml;t eder.</p>
<p><b>5.8</b> PwC T&uuml;rkiye, M&uuml;şteri tarafından kendisine eğitim tarihinden 3 (&uuml;&ccedil;) g&uuml;n &ouml;ncesine kadar haber verilmesi kaydıyla M&uuml;şteri&rsquo;nin eğitim kaydını iptal eder. Tamamlanan eğitimlerin &uuml;cret iadesi yapılmayacaktır. M&uuml;şteri tarafından PwC T&uuml;rkiye&rsquo;ye eğitim tarihinden 3 (&uuml;&ccedil;) g&uuml;n &ouml;ncesine kadar haber verilmesi kaydıyla ilgili eğitime katılma hakkı bir &uuml;&ccedil;&uuml;nc&uuml; kişiye devredilebilir.</p>
<p><b>5.9</b> PwC T&uuml;rkiye, eğitim tarihini veya yerini değiştirme/iptal etme hakkını saklı tutar. Eğitim, PwC T&uuml;rkiye tarafından M&uuml;şteri&rsquo;ye haber verilerek iptal edilebilir.. Bu kapsamda PwC T&uuml;rkiye iptal edilen eğitimlerin &uuml;cretleri M&uuml;şteri tarafından &ouml;denmişse M&uuml;şteri&rsquo;ye iade eder. Kart ile &ouml;denen hizmet bedelinin iadesi durumunda PwC T&uuml;rkiye banka ile yapmış olduğu ayrı bir s&ouml;zleşme gereği olarak M&uuml;şteri&rsquo;ye nakit para ile &ouml;deme yapamaz. PwC T&uuml;rkiye bir iade s&ouml;z konusu olduğunda ilgili tutarı bankaya nakden veya mahsuben &ouml;demekle y&uuml;k&uuml;ml&uuml; olduğundan prosed&uuml;r gereğince M&uuml;şteri&#39;ye nakit olarak &ouml;deme yapmayacaktır. Kredi kartına iadelerde ise PwC T&uuml;rkiye&#39;nin, bankaya bedeli tek seferde &ouml;demesinden sonra banka tarafından karta iade ger&ccedil;ekleştirilecektir.</p>
<p><b>5.10</b> M&uuml;şteri, T&uuml;rkiye Cumhuriyeti sınırları dışında ikamet etmekte/bulunmakta ve/veya hizmetin ifa edileceği adres T&uuml;rkiye Cumhuriyeti sınırları dışında bulunmakta ise, ikamet ettiği/bulunduğu ve/veya hizmetin ifa edileceği &uuml;lkenin s&ouml;z konusu hizmetin alımı nedeniyle yasa, y&ouml;netmelik ve ilgili yasal d&uuml;zenlemeleri uyarınca tahakkuk ettireceği vergi, har&ccedil; ve sair her t&uuml;rl&uuml; mali y&uuml;k&uuml;ml&uuml;l&uuml;ğ&uuml;n kendisine ait olacağını, hizmetin ifa edilebilmesi i&ccedil;in talep olunacak t&uuml;m &ouml;demeleri derhal ve aynen yerine getireceğini şimdiden kabul, beyan ve taahh&uuml;t eder.</p>
<p><b>5.11</b> M&uuml;şteri tarafından satın alınan hizmet/hizmetlerin tamamı, bir kısmı ve/veya hizmetten elde edilen herhangi bir bilgi, yazılım veya &uuml;r&uuml;n değiştirilemez, kopyalanamaz, dağıtılamaz, &ccedil;oğaltılamaz, yayınlanamaz, t&uuml;rev niteliğinde &ccedil;alışmalara konu edilemez, aktarılamaz veya satılamaz. M&uuml;şteri işbu S&ouml;zleşme ile satın aldığı hizmeti yasa dışı ama&ccedil;lar i&ccedil;in ve/veya bu yasaklanan şekillerde kullanmayacağını kabul ve taahh&uuml;t eder. Aksi halde doğabilecek t&uuml;m hukuki ve cezai sorumluluk M&uuml;şteri&#39;ye ait olmakla beraber &uuml;&ccedil;&uuml;nc&uuml; kişiler veya yetkili merciler tarafından PwC T&uuml;rkiye&#39;ye karşı ileri s&uuml;r&uuml;lebilecek t&uuml;m iddia ve taleplere karşı, PwC T&uuml;rkiye&#39;nin s&ouml;z konusu izinsiz kullanımdan kaynaklanan her t&uuml;rl&uuml; tazminat ve sair talep hakkı saklıdır.</p>
<p><b>5.12</b> PwC T&uuml;rkiye, M&uuml;şteri ile akdedilen işbu s&ouml;zleşmeye ilişkin bilgileri &uuml;&ccedil; yıl boyunca saklamakla y&uuml;k&uuml;ml&uuml;d&uuml;r.</p>
<p><b>5.13</b> İşbu S&ouml;zleşmeye konu hizmetin ayıpsız olarak ifa edildiğine ilişkin ispat y&uuml;k&uuml;ml&uuml;l&uuml;ğ&uuml; PwC T&uuml;rkiye&#39;ye aittir. Ancak PwC T&uuml;rkiye tarafından sunulan hizmetler &ldquo;olduğu gibi&rdquo; ve &ldquo;m&uuml;mk&uuml;n olduğu&rdquo; temelde sunulmakta ve pazarlanabilirlik, belirli bir amaca uygunluk veya ihlal etmeme konusunda t&uuml;m zımni garantiler de dahil olmak &uuml;zere hizmetler veya uygulama ile ilgili olarak (bunlarda yer alan t&uuml;m bilgiler dahil) sarih veya zımni, kanuni veya başka bir nitelikte hi&ccedil;bir garantide bulunmamaktadır.</p>
<p><b>5.14</b> Platform &uuml;zerinden verilen hizmetler esnasında veya herhangi bir zamanda oluşabilecek arıza veya diğer teknik sebeplerden, yahut hizmetin kesintiye uğramasından; donanım, yazılım ve internet sunucusundan kaynaklanan aksaklıklardan PwC T&uuml;rkiye sorumlu tutulamaz.</p>
<p><b>5.15</b> M&uuml;şteri ve PwC T&uuml;rkiye işbu s&ouml;zleşmenin başında bahsedilen yazışma adreslerinin ge&ccedil;erli tebligat adresi olduğunu ve bu adrese y&ouml;neltilecek t&uuml;m tebligatların ge&ccedil;erli addolunacağını kabul, beyan ve taahh&uuml;t eder.</p>
<p><b>5.16</b> M&uuml;şteri kullanmakta olduğu &uuml;cretli ya da &uuml;cretsiz Platform i&ccedil;in;</p>


<ul style="display: block;  list-style-type: disc;  margin-top: 1em;  margin-bottom: 1 em;  margin-left: 0;  margin-right: 0;  padding-left: 40px;">
	<li>Eğitim i&ccedil;eriklerini kopyalayamaz, &ccedil;oğaltamaz ve 3. şahıslar ile paylaşamaz.</li>
	<li>Kullanıcı verilerini, eğitim i&ccedil;eriklerini, eğitmen bilgisini, PwC T&uuml;rkiye&rsquo;nin veya eğitmenin sunacağı sunum(ları), online video eğitimleri ve eğitim sırasında verilen broş&uuml;r, eğitim kitap&ccedil;ığı vb. materyalleri 3. şahıs, kurum ya da kuruluşlarla paylaşmayacaklarını ve paylaşmaları durumunda veriler ile ilgili t&uuml;m g&uuml;venlik &ouml;nlemlerinin kendi istekleri ile ihlal edildiğini ve bu gibi durumlarda PwC T&uuml;rkiye&rsquo;nin hi&ccedil;bir sorumluluk almayacağını kabul ederler.</li>
	<li>Destek talep edilmesi durumunda sorunun &ccedil;&ouml;z&uuml;lmesi i&ccedil;in talep edilen bilgilerde sorunun analizi i&ccedil;in sebep g&ouml;stermeksizin &ldquo;Durup dururken oldu&rdquo; gibi mantıksal olarak imk&acirc;nı olmayan taleplerde bulunmayacaklarını, aksi takdirde her ne kadar PwC T&uuml;rkiye yapılan işlemleri takip etse de sorunun kaynağını bulmak i&ccedil;in yardımcı olamadığı durumda sorumluluğun PwC T&uuml;rkiye&rsquo;ye ait olmadığını kabul ederler.</li>
	<li>M&uuml;şteri, hesabının kendine ait olduğunu, bu nedenle: (1) g&uuml;&ccedil;l&uuml; ve g&uuml;venli bir şifre se&ccedil;meyi; (2) şifreyi g&uuml;vende ve gizli tutmayı; (3) hesabının herhangi bir kısmını başkasına vermemeyi ve bu kapsamda (4) yasalara ve S&ouml;zleşme&#39;ye uymayı kabul eder.</li>
</ul>

<p>5.17 S&ouml;zleşme s&uuml;resi boyunca PwC T&uuml;rkiye&rsquo;nin, M&uuml;şteri&rsquo;ye destek vereceği konular aşağıdaki şekildedir:</p>


<ul style="display: block;  list-style-type: disc;  margin-top: 1em;  margin-bottom: 1 em;  margin-left: 0;  margin-right: 0;  padding-left: 40px;">
	<li>PwC T&uuml;rkiye, Platform kullanımı ile ilgili M&uuml;şteri&rsquo;ye destek vermeyi ve yaşanacak sorunlar ile ilgili yol g&ouml;stermeyi kabul eder.</li>
	<li>Yaşanacak sorun sistem ile alakalı ise PwC T&uuml;rkiye hizmet i&ccedil;eriklerinde değişiklik yapma hakkına sahiptir.</li>
	<li>PwC T&uuml;rkiye ihtiya&ccedil; olması durumunda telefon ile destek vermeyi kabul eder. Destek talep edilen konunun niteliklerine g&ouml;re PwC T&uuml;rkiye sorunun &ccedil;&ouml;z&uuml;m&uuml; i&ccedil;in M&uuml;şteri&rsquo;yi diğer destek kanallarına y&ouml;nlendirme hakkına sahiptir.</li>
</ul>

<p><strong>MADDE 6 - CAYMA HAKKI</strong></p>

<p>M&uuml;şteri, hi&ccedil;bir hukuki ve cezai sorumluluk &uuml;stlenmeksizin ve hi&ccedil;bir gerek&ccedil;e g&ouml;stermeksizin (ve cezai şart &ouml;demeksizin) malı kendisinin veya kendisi tarafından belirlenen 3. kişinin teslim aldığı veya hizmet sunumlarında ise s&ouml;zleşmenin imzalandığı tarihten itibaren 14 (on d&ouml;rt) g&uuml;n i&ccedil;erisinde malı veya hizmeti reddederek s&ouml;zleşmeden Platform&rsquo;da bulunan &ldquo;Hizmet İade Formunu&rdquo; doldurarak cayma hakkına sahip bulunmaktadır. Cayma hakkı sona ermeden &ouml;nce M&uuml;şteri hizmeti kullanmaya başlarsa işbu madde kapsamında cayma hakkından yararlanamayacaktır.</p>

<p>Cayma hakkının kullanıldığı durumda M&uuml;şteri&rsquo;nin kredi kartı ile yaptığı &ouml;demelerde, hizmet tutarı, M&uuml;şteri&rsquo;nin cayma hakkını kullanmasından sonra 14 g&uuml;n i&ccedil;erisinde ilgili bankaya iade edilir. M&uuml;şteri, PwC T&uuml;rkiye tarafından kredi kartına iade edilen tutarın banka tarafından M&uuml;şteri hesabına yansıtılmasına ilişkin ortalama s&uuml;recin 2 ile 3 haftayı bulabileceğini, bu tutarın bankaya iadesinden sonra M&uuml;şteri&rsquo;nin hesaplarına yansıması halinin tamamen banka işlem s&uuml;reci ile ilgili olduğundan, M&uuml;şteri, olası gecikmeler i&ccedil;in PwC T&uuml;rkiye&rsquo;yi sorumlu tutamayacağını kabul, beyan ve taahh&uuml;t eder. M&uuml;şteri nakit ile &ouml;deme yaptı ise hizmet tutarı 14 g&uuml;n i&ccedil;inde kendisine nakden ve defaten &ouml;denir.</p>

<p>Eğer s&ouml;z konusu hizmet elektronik ortamda anında ifa edilen hizmetlerden ise Mesafeli S&ouml;zleşmeler Y&ouml;netmeliği kapsamında da d&uuml;zenlendiği &uuml;zere M&uuml;şteri&rsquo;ye cayma hakkı tanınmamıştır. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

<p><strong>MADDE 7 - TEMERR&Uuml;T H&Uuml;K&Uuml;MLERİ</strong></p>

<p>Hizmetin ayıplı ifa edildiği durumlarda M&uuml;şteri, hizmetin yeniden g&ouml;r&uuml;lmesi, ayıp oranında bedelden indirim veya S&ouml;zleşme&rsquo;den d&ouml;nme haklarından birini PwC T&uuml;rkiye&rsquo;ye karşı kullanmakta serbesttir. PwC T&uuml;rkiye, M&uuml;şteri&rsquo;nin&nbsp;tercih ettiği bu talebi yerine getirmekle y&uuml;k&uuml;ml&uuml;d&uuml;r. Se&ccedil;imlik hakların kullanılması nedeniyle ortaya &ccedil;ıkan t&uuml;m masraflar PwC T&uuml;rkiye tarafından karşılanır. M&uuml;şteri bu se&ccedil;imlik haklarından biri ile birlikte T&uuml;rk Bor&ccedil;lar Kanunu h&uuml;k&uuml;mleri uyarınca tazminat da talep edebilir. &Uuml;cretsiz onarım veya hizmetin yeniden g&ouml;r&uuml;lmesinin PwC T&uuml;rkiye i&ccedil;in orantısız g&uuml;&ccedil;l&uuml;kleri beraberinde getirecek olması h&acirc;linde M&uuml;şteri bu hakları kullanamaz. Orantısızlığın tayininde hizmetin ayıpsız değeri, ayıbın &ouml;nemi ve diğer se&ccedil;imlik haklara başvurmanın&nbsp;M&uuml;şteri a&ccedil;ısından sorun teşkil edip etmeyeceği gibi hususlar dikkate alınır. M&uuml;şteri&rsquo;nin s&ouml;zleşmeden d&ouml;nme veya ayıp oranında bedelden indirim hakkını se&ccedil;tiği durumlarda, &ouml;demiş olduğu bedelin t&uuml;m&uuml; veya bedelden indirim yapılan tutar derh&acirc;l&nbsp;M&uuml;şteri&rsquo;ye iade edilir. Hizmetin yeniden g&ouml;r&uuml;lmesinin se&ccedil;ildiği h&acirc;llerde, hizmetin niteliği ve&nbsp;t&uuml;keticinin bu hizmetten yararlanma amacı dikkate alındığında, makul sayılabilecek bir s&uuml;re i&ccedil;inde ve&nbsp;M&uuml;şteri&nbsp;i&ccedil;in ciddi sorunlar doğurmayacak şekilde bu talep PwC T&uuml;rkiye tarafından yerine getirilir. Her h&acirc;l&uuml;k&acirc;rda bu s&uuml;re talebin PwC T&uuml;rkiye&rsquo;ye y&ouml;neltilmesinden itibaren otuz iş g&uuml;n&uuml;n&uuml; ge&ccedil;emez. Aksi takdirde&nbsp;M&uuml;şteri diğer se&ccedil;imlik haklarını kullanmakta serbesttir.</p>

<p><strong>MADDE 8 - YETKİLİ MAHKEME</strong></p>

<p>İşbu S&ouml;zleşmenin uygulanmasında, yorumlanmasında ve bu s&ouml;zleşme dahilinde doğan hukuki ilişkilerin y&ouml;netiminde T&uuml;rk Hukuku uygulanacaktır. M&uuml;şteri&#39;nin her t&uuml;rl&uuml; şikayet ve itirazına ilişkin başvurularında ve işbu s&ouml;zleşme ile ilgili &ccedil;ıkacak diğer ihtilaflarda her yıl G&uuml;mr&uuml;k ve Ticaret Bakanlığı tarafından ilan edilen değere kadar M&uuml;şteri veya PwC T&uuml;rkiye&rsquo;nin yerleşim yerindeki T&uuml;ketici Sorunları Hakem Heyetleri, s&ouml;z konusu değerin &uuml;zerindeki ihtilaflarda ise T&uuml;ketici Mahkemeleri yetkilidir.</p>

<p>İşbu s&ouml;zleşme (<?php echo date("d.m.Y"); ?>) tarihinde d&uuml;zenlenmiştir.</p>

											
										</div>
									</div>
									
									<h4><b>Mesafeli Hizmet Sözleşmesi</b></h4>
									<br />
									<div class="sozlesmemetinleri">
										<div class="scrollbar-rail">
												
<p><strong>MADDE 1 - TARAFLAR</strong></p>

<p><strong><u>PwC T&uuml;rkiye: </u></strong><br />
Unvan: PwC Y&ouml;netim Danışmanlığı Anonim Şirketi<br />
MERSİS No: 0-7330-4406-4400016<br />
Adres: S&uuml;leyman Seba Cad. BJK Plaza B Blok Kat:4 34357 Akaretler / Beşiktaş<br />
Telefon: 0 (212) 376 59 80<br />
E-mail: egitim@tr.pwc.com</p>

<p><strong><u>M&Uuml;ŞTERİ: </u></strong><br />
Ad Soyad/Firma <?php if($_SESSION['fatura_bilgileri']['fatura-turu']==2) echo $_SESSION['fatura_bilgileri']['firma_unvani']; else echo $_SESSION['fatura_bilgileri']['fatura_adsoyad']; ?><br />
Adresi: <?php echo $_SESSION['fatura_bilgileri']['adres']; ?><br />
Telefon: <?php echo $_SESSION['fatura_bilgileri']['fatura_telefon']; ?><br />
E-mail: <?php echo $_SESSION['fatura_bilgileri']['fatura_email']; ?></p>

<p><strong>MADDE 2 - S&Ouml;ZLEŞMENİN KONUSU</strong></p>

<p>İşbu S&ouml;zleşmenin konusu, M&uuml;şteri&#39;nin PwC T&uuml;rkiye&rsquo;ye ait <a href="http://www.okul.pwc.com.tr">www.okul.pwc.com.tr</a> alan alan adlı internet sitesinden (&quot;Platform&quot;) elektronik ortamda siparişini verdiği, işbu s&ouml;zleşmenin &uuml;&ccedil;&uuml;nc&uuml; maddesinde &ouml;zellikleri ve satış fiyatı belirtilen hizmet ile ilgili olarak tarafların hak ve y&uuml;k&uuml;ml&uuml;l&uuml;klerinin tespitidir. İşbu s&ouml;zleşme başta T&uuml;keticinin Korunması Hakkında Kanun ve Mesafeli S&ouml;zleşmeler Y&ouml;netmeliği&rsquo;ne uygun olarak d&uuml;zenlenmiştir ve taraflar işbu s&ouml;zleşmeyle birlikte T&uuml;keticinin Korunması Hakkında Kanun ve Abonelik S&ouml;zleşmeleri Y&ouml;netmeliği ve Mesafeli S&ouml;zleşmeler Y&ouml;netmeliği&#39;nden kaynaklanan y&uuml;k&uuml;ml&uuml;l&uuml;k ve sorumluluklarını bildiklerini ve anladıklarını kabul ve beyan ederler.</p>

<p><strong>MADDE 3 - HİZMET BİLGİLERİ</strong></p>

<p>Hizmetin; T&uuml;r&uuml;, &Ouml;zellikleri ve S&uuml;resi, aşağıda belirtildiği gibidir.</p>

<p>Hizmet Başlığı: <?php echo $egitim_adi; ?></p>

<p>Hizmet T&uuml;r&uuml;: Online/Sınıf Eğitimi</p>

<p>Hizmet S&uuml;resi: Tercih edilen online video eğitimlere Müşteri’nin bu sözleşmeyi kabul ederek kayıt olması, www.okul.pwc.com.tr internet sitesinde beyan edilen bedelin ödenmesiyle beraber başlar ve 3 (üç) ay süre ile devam eder. 
Tercih edilen fiziki(sınıf) eğitimlerine Müşteri’nin bu sözleşmeyi kabul ederek kayıt olması, www.okul.pwc.com.tr internet sitesinde beyan edilen tarihten 3 gün öncesine kadar bedelin ödenmesi ile beraber beyan edilen tarihte başlar ve eğitimin gerçekleştirilmesi ile son bulur.
</p>

<p>Hizmet A&ccedil;ıklaması: PwC Türkiye erişime sunduğu Platform ile Müşterilere internet üzerinden PwC Türkiye’nin eğitimlerine kayıt olma, ücretli eğitimlerini satın alma ve ücretli/ücretsiz online eğitimlerini izleyebilme imkânı sağlayacaktır. Müşteri burada belirtilen hizmet açıklamasının kendi ihtiyaçlarına uygun olduğunu düşünerek bu hizmeti tercih etmesi halinde ve ödeme yapmasının ardından Platform’u kullanmaya ve/veya eğitime kayıt olmaya hak kazanacaktır. Online eğitime katılmak için ihtiyacınız olan şeyler: bilgisayar, tablet ya da akıllı telefon, aktif internet bağlantısıdır. </p>

<p>Fiyatı (KDV d&acirc;hil) : <?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</p>

<p>Fatura Adresi: <?php echo $_SESSION['fatura_bilgileri']['adres']; ?></p>

<p>Fiziki eğitimlere ilişkin olarak PwC Türkiye tarafından Müşteri katılımına istinaden rezervasyon alınacaktır. Eğitimin başlangıç tarihine son üç gün kala ödeme için Müşteri’ye bildirim yapılacaktır.</p>

<p><strong>MADDE 5 &ndash; GENEL H&Uuml;K&Uuml;MLER</strong></p>

<p><b>5.1</b> İşbu sözleşme tarafları Müşteri ile PwC Türkiye olup işbu sözleşmenin yerine getirilmesi ile ilgili tüm yükümlülük ve sorumluluklar taraflara aittir. İşbu sözleşme Müşteri tarafından elektronik olarak onaylandığı tarihte (<?php echo date("d.m.Y"); ?>) yürürlüğe girer. Müşteri, hizmetin işbu sözleşmenin kendisi tarafından onaylandığı tarihte başlatılacağını kabul eder.</p>
<p><b>5.2</b> Müşteri, PwC Türkiye'ye ait Platform'da sunulan sözleşme konusu hizmetin Platform'da belirtilen ve yukarıda yer alan temel nitelikleri, satış fiyatı, fiyatların geçerlilik süresi ve ödeme şekline ilişkin bilgileri okuyup doğru ve eksiksiz şekilde bilgi sahibi olduğunu ve elektronik ortamda satın almaya ilişkin gerekli teyidi verdiğini kabul ve beyan eder.</p>
<p><b>5.3</b> Müşteri, şifre ve kullanıcı adının gizli kalması için gerekli dikkat ve özeni göstereceğini, şifreyi ve kullanıcı adını herhangi bir üçüncü şahsa açıklamayacağını, kullandırmayacağını, şifresinin yetkisiz üçüncü şahıslar tarafından ele geçirildiğini öğrenmesi veya bundan şüphelenmesi halinde derhal PwC Türkiye’ye haber vereceğini kabul, beyan ve taahhüt eder.</p>
<p><b>5.4</b> Müşteri, deprem, yangın, sel gibi tabii afetler veya savaş, terör eylemleri gibi sebeplerle, ya da internet altyapısı, veri hatları gibi ağ iletişim altyapısına dayalı unsurlarda meydana gelebilecek ve PwC Türkiye’nin elinde olmayan sebeplerle hizmetin aksaması veya verilememesi durumunda PwC Türkiye’nin herhangi bir sorumluluğunun olmayacağını, herhangi bir nam altında PwC Türkiye’den tazminat veya diğer herhangi bir talepte bulunmayacağını kabul, beyan ve taahhüt eder.</p>
<p><b>5.5</b> Müşteri, almış olduğu ücretli içerik hizmetlerini kullanması veya indirmesi sebebiyle sistemine herhangi bir zarar geldiğini, indirilen içerikten dolayı sistemine virüs, truva atı gibi kötü amaçlı kodların bulaştığını öne sürerek PwC Türkiye’den herhangi bir tazminat talebinde veya diğer herhangi bir talepte bulunamaz.</p>
<p><b>5.6</b> İşbu sözleşmeye konu hizmet ediminin yerine getirilmesinin imkânsızlaştığı hâllerde Müşteri bu durumdan haberdar edilecek ve ödemiş olduğu toplam bedel ve onu borç altına sokan her türlü belge en geç on dört gün içinde kendisine iade edilecektir.</p>
<p><b>5.7</b> PwC Türkiye, sözleşme konusu hizmetin Platform’da yer alan kullanım koşulları ve sair metinlerde belirtilen niteliklere uygun ifa edilmesinden sorumludur.</p>
<p><b>5.8</b> Herhangi bir nedenle hizmet bedeli ödenmez veya banka kayıtlarında iptal edilir ise, PwC Türkiye hizmeti ifa yükümlülüğünden kurtulmuş kabul edilir. Bu durumda PwC Türkiye, ifasına başlanmış olan hizmeti derhal durdurma hakkına sahip olacaktır.</p>
<p><b>5.9</b> Hizmetin ifasından sonra Müşteri’ye ait kredi kartının Müşteri’nin kusurundan kaynaklanmayan bir şekilde yetkisiz kişilerce haksız veya hukuka aykırı olarak kullanılması nedeni ile ilgili banka veya finans kuruluşunun hizmet bedelini PwC Türkiye’ye ödememesi halinde, PwC Türkiye’nin ilgili ödeme yapılana kadar hizmeti askıya alma hakkı saklıdır.</p>
<p><b>5.10</b> Sözleşme konusu hizmete ilişkin ödemenin Müşteri tarafından kredi kartı ile yapılması durumunda, Müşteri ile kredi kartı sahibinin ya da hizmetin ifa edileceği kişinin farklı olmasından kaynaklanabilecek olan, kredi kartının yetkisiz kişilerce haksız ve hukuka aykırı olarak kullanılması da dahil olmak üzere türlü hukuki risk, Müşteri’ye aittir. Müşteri, bahsi geçen durumlarda herhangi bir şekilde zarara uğraması halinde PwC Türkiye’den hiçbir talepte bulunmayacağını kabul ve taahhüt eder.</p>
<p><b>5.11</b> Müşteri, yürürlükte bulunan mevzuat hükümleri gereğince faiz ve temerrüt faizi ile ilgili hükümlerin banka ve Müşteri arasındaki kredi kartı sözleşmesi kapsamında uygulanacağını kabul, beyan ve taahhüt eder.</p>
<p><b>5.12</b> PwC Türkiye, Müşteri tarafından kendisine eğitim tarihinden 3 (üç) gün öncesine kadar haber verilmesi kaydıyla Müşteri’nin eğitim kaydını iptal eder. Tamamlanan eğitimlerin ücret iadesi yapılmayacaktır. Müşteri tarafından PwC Türkiye’ye eğitim tarihinden 3 (üç) gün öncesine kadar haber verilmesi kaydıyla ilgili eğitime katılma hakkı bir üçüncü kişiye devredilebilir.</p>
<p><b>5.13</b> PwC Türkiye, eğitim tarihini veya yerini değiştirme/iptal etme hakkını saklı tutar. Eğitim, PwC Türkiye tarafından Müşteri’ye haber verilerek iptal edilebilir.Bu kapsamda PwC Türkiye iptal edilen eğitimlerin ücretleri Müşteri tarafından ödenmişse Müşteri’ye iade eder. Kart ile ödenen hizmet bedelinin iadesi durumunda PwC Türkiye, banka ile yapmış olduğu ayrı bir sözleşme gereği olarak Müşteri'ye nakit para ile ödeme yapamaz. PwC Türkiye bir iade söz konusu olduğunda ilgili tutarı bankaya nakden veya mahsuben ödemekle yükümlü olduğundan prosedür gereğince Müşteri’ye nakit olarak ödeme yapmayacaktır. Kredi kartına iadelerde ise PwC Türkiye'nin, bankaya bedeli tek seferde ödemesinden sonra banka tarafından karta iade gerçekleştirilecektir.</p>
<p><b>5.14</b> Müşteri, Türkiye Cumhuriyeti sınırları dışında ikamet etmekte/bulunmakta ve/veya hizmetin ifa edileceği adres Türkiye Cumhuriyeti sınırları dışında bulunmakta ise, ikamet ettiği/bulunduğu ve/veya hizmetin ifa edileceği ülkenin söz konusu hizmetin alımı nedeniyle yasa, yönetmelik ve ilgili yasal düzenlemeleri uyarınca tahakkuk ettireceği vergi, harç ve sair her türlü mali yükümlülüğün kendisine ait olacağını, hizmetin ifa edilebilmesi için talep olunacak tüm ödemeleri derhal ve aynen yerine getireceğini şimdiden kabul, beyan ve taahhüt eder.</p>
<p><b>5.15</b> Müşteri tarafından satın alınan hizmet/hizmetlerin tamamı, bir kısmı ve/veya hizmetten elde edilen herhangi bir bilgi, yazılım veya ürün değiştirilemez, kopyalanamaz, dağıtılamaz, çoğaltılamaz, yayınlanamaz, türev niteliğinde çalışmalara konu edilemez, aktarılamaz veya satılamaz. Müşteri işbu sözleşme ile satın aldığı hizmeti yasa dışı amaçlar için ve/veya bu yasaklanan şekillerde kullanmayacağını kabul ve taahhüt eder. Aksi halde doğabilecek tüm hukuki ve cezai sorumluluk Müşteri'ye ait olmakla beraber üçüncü kişiler veya yetkili merciler tarafından PwC Türkiye'ye karşı ileri sürülebilecek tüm iddia ve taleplere karşı, PwC Türkiye'nin söz konusu izinsiz kullanımdan kaynaklanan her türlü tazminat ve sair talep hakkı saklıdır.</p>
<p><b>5.16</b> PwC Türkiye, Müşteri ile akdedilen işbu sözleşmeye ilişkin bilgileri mevzuattan kaynaklanan saklama yükümlülükleri saklı olmak üzere en az üç yıl boyunca saklamakla yükümlüdür.</p>
<p><b>5.17</b> İşbu sözleşmeye konu hizmetin ayıpsız olarak ifa edildiğine ilişkin ispat yükümlülüğü PwC Türkiye'ye aittir. Ancak PwC Türkiye tarafından sunulan hizmetler “olduğu gibi” ve “mümkün olduğu” temelde sunulmakta ve pazarlanabilirlik, belirli bir amaca uygunluk veya ihlal etmeme konusunda tüm zımni garantiler de dahil olmak üzere hizmetler veya uygulama ile ilgili olarak (bunlarda yer alan tüm bilgiler dahil) sarih veya zımni, kanuni veya başka bir nitelikte hiçbir garantide bulunmamaktadır.</p>
<p><b>5.18</b> Platform üzerinden verilen hizmetler esnasında veya herhangi bir zamanda oluşabilecek arıza veya diğer teknik sebeplerden, yahut hizmetin kesintiye uğramasından; donanım, yazılım ve internet sunucusundan kaynaklanan aksaklıklardan PwC Türkiye sorumlu tutulamaz.</p>
<p><b>5.19</b> Müşteri ve PwC Türkiye işbu sözleşmenin başında bahsedilen yazışma adreslerinin geçerli tebligat adresi olduğunu ve bu adrese yöneltilecek tüm tebligatların geçerli addolunacağını kabul, beyan ve taahhüt eder.</p>
<p><b>5.20</b> Müşteri kullanmakta olduğu ücretli ya da ücretsiz Platform için;</p>



<ul style="display: block;  list-style-type: disc;  margin-top: 1em;  margin-bottom: 1 em;  margin-left: 0;  margin-right: 0;  padding-left: 40px;">
	
	<li>Eğitim içeriklerini kopyalayamaz, çoğaltamaz ve 3. şahıslar ile paylaşamaz.</li>
	<li>Kullanıcı verilerini, eğitim içeriklerini, eğitmen bilgisini, PwC Türkiye’nin veya eğitmenin sunacağı sunum(ları), online video eğitimleri ve eğitim sırasında verilen broşür, eğitim kitapçığı vb. materyalleri 3. şahıs, kurum ya da kuruluşlarla paylaşmayacaklarını ve paylaşmaları durumunda veriler ile ilgili tüm güvenlik önlemlerinin kendi istekleri ile ihlal edildiğini ve bu gibi durumlarda PwC Türkiye’nin hiçbir sorumluluk almayacağını kabul ederler.</li>
	<li>Destek talep edilmesi durumunda sorunun çözülmesi için talep edilen bilgilerde sorunun analizi için sebep göstermeksizin “Durup dururken oldu” gibi mantıksal olarak imkânı olmayan taleplerde bulunmayacaklarını, aksi takdirde her ne kadar PwC Türkiye yapılan işlemleri takip etse de sorunun kaynağını bulmak için yardımcı olamadığı durumda sorumluluğun PwC Türkiye’ye ait olmadığını kabul ederler.</li>
	<li>Müşteri, hesabının kendine ait olduğunu, bu nedenle: (1) güçlü ve güvenli bir şifre seçmeyi; (2) şifreyi güvende ve gizli tutmayı; (3) hesabının herhangi bir kısmını başkasına vermemeyi ve bu kapsamda (4) yasalara ve Sözleşme'ye uymayı kabul eder. </li>
</ul>

<p><b>5.21</b> Sözleşme süresi boyunca PwC Türkiye’nin, Müşteri’ye destek vereceği konular aşağıdaki şekildedir:</p>


<ul style="display: block;  list-style-type: disc;  margin-top: 1em;  margin-bottom: 1 em;  margin-left: 0;  margin-right: 0;  padding-left: 40px;">
	<li>PwC Türkiye, Platform kullanımı ile ilgili Müşteri’ye destek vermeyi ve yaşanacak sorunlar ile ilgili yol göstermeyi kabul eder.</li>
	<li>Yaşanacak sorun sistem ile alakalı ise PwC Türkiye hizmet içeriklerinde değişiklik yapma hakkına sahiptir. </li>
	<li>PwC Türkiye ihtiyaç olması durumunda telefon ile destek vermeyi kabul eder. Destek talep edilen konunun niteliklerine göre PwC Türkiye sorunun çözümü için Müşteri’yi diğer destek kanallarına yönlendirme hakkına sahiptir.</li>
</ul>

<p><strong>MADDE 6 - CAYMA HAKKI</strong></p>

<p>Müşteri, hiçbir hukuki ve cezai sorumluluk üstlenmeksizin ve hiçbir gerekçe göstermeksizin (ve cezai şart ödemeksizin) malı kendisinin veya kendisi tarafından belirlenen 3. kişinin teslim aldığı veya hizmet sunumlarında ise sözleşmenin imzalandığı tarihten itibaren 14 (on dört) gün içerisinde malı veya hizmeti reddederek sözleşmeden Platform’da bulunan “Hizmet İade Formunu” doldurarak cayma hakkına sahip bulunmaktadır.    Cayma hakkı sona ermeden önce Müşteri hizmeti kullanmaya başlarsa işbu madde kapsamında cayma hakkından yararlanamayacaktır.</p>

<p>Cayma hakkının kullanıldığı durumda Müşteri’nin kredi kartı ile yaptığı ödemelerde, hizmet tutarı, Müşteri’nin cayma hakkını kullanmasından sonra 14 gün içerisinde ilgili bankaya iade edilir. Müşteri, PwC Türkiye tarafından kredi kartına iade edilen tutarın banka tarafından Müşteri hesabına yansıtılmasına ilişkin ortalama sürecin 2 ile 3 haftayı bulabileceğini, bu tutarın bankaya iadesinden sonra Müşteri’nin hesaplarına yansıması halinin tamamen banka işlem süreci ile ilgili olduğundan, Müşteri, olası gecikmeler için PwC Türkiye’yi sorumlu tutamayacağını kabul, beyan ve taahhüt eder. Müşteri nakit ile ödeme yaptı ise hizmet tutarı 14 gün içinde kendisine nakden ve defaten ödenir.</p>

<p>Eğer söz konusu hizmet elektronik ortamda anında ifa edilen hizmetlerden ise Mesafeli Sözleşmeler Yönetmeliği kapsamında da düzenlendiği üzere Müşteri’ye cayma hakkı tanınmamıştır.          </p>


<p><strong>MADDE 7 - TEMERR&Uuml;T H&Uuml;K&Uuml;MLERİ</strong></p>

<p>Hizmetin ayıplı ifa edildiği durumlarda Müşteri, hizmetin yeniden görülmesi, ayıp oranında bedelden indirim veya Sözleşme’den dönme haklarından birini PwC Türkiye’ye karşı kullanmakta serbesttir. PwC Türkiye, Müşteri’nin tercih ettiği bu talebi yerine getirmekle yükümlüdür. Seçimlik hakların kullanılması nedeniyle ortaya çıkan tüm masraflar PwC Türkiye tarafından karşılanır. Müşteri, bu seçimlik haklarından biri ile birlikte Türk Borçlar Kanunu hükümleri uyarınca tazminat da talep edebilir. Ücretsiz onarım veya hizmetin yeniden görülmesinin PwC Türkiye için orantısız güçlükleri beraberinde getirecek olması hâlinde Müşteri bu hakları kullanamaz. Orantısızlığın tayininde hizmetin ayıpsız değeri, ayıbın önemi ve diğer seçimlik haklara başvurmanın Müşteri açısından sorun teşkil edip etmeyeceği gibi hususlar dikkate alınır. Müşteri’nin sözleşmeden dönme veya ayıp oranında bedelden indirim hakkını seçtiği durumlarda, ödemiş olduğu bedelin tümü veya bedelden indirim yapılan tutar derhâl Müşteri’ye iade edilir. Hizmetin yeniden görülmesinin seçildiği hâllerde, hizmetin niteliği ve tüketicinin bu hizmetten yararlanma amacı dikkate alındığında, makul sayılabilecek bir süre içinde ve Müşteri için ciddi sorunlar doğurmayacak şekilde bu talep PwC Türkiye tarafından yerine getirilir. Her hâlükârda bu süre talebin PwC Türkiye’ye yöneltilmesinden itibaren otuz iş gününü geçemez. Aksi takdirde Müşteri diğer seçimlik haklarını kullanmakta serbesttir.</p>


<p><strong>MADDE 8 - YETKİLİ MAHKEME</strong></p>

<p>İşbu Sözleşmenin uygulanmasında, yorumlanmasında ve bu sözleşme dahilinde doğan hukuki ilişkilerin yönetiminde Türk Hukuku uygulanacaktır. Müşteri'nin her türlü şikayet ve itirazına ilişkin başvurularında ve işbu sözleşme ile ilgili çıkacak diğer ihtilaflarda her yıl Gümrük ve Ticaret Bakanlığı tarafından ilan edilen değere kadar Müşteri veya PwC Türkiye’nin yerleşim yerindeki Tüketici Sorunları Hakem Heyetleri, söz konusu değerin üzerindeki ihtilaflarda ise Tüketici Mahkemeleri yetkilidir.</p>

<p>İşbu s&ouml;zleşme (<?php echo date("d.m.Y"); ?>) tarihinde d&uuml;zenlenmiştir.</p>

<p><strong><u>Ekler</u></strong><strong>:</strong></p>

<p><strong>EK- 1:</strong> Ücret Detay Dokumanı</p>



<table border="1" cellpadding="0" cellspacing="0" style="width:100%;" >
	<tbody>
		<tr>
			<td style="width:50%; padding:20px">
			<p><b>Hizmet Adı:</b> <?php echo $egitim_adi; ?></p>

			<p><b>Hizmet Cinsi:</b> Online/Sınıf Eğitimi</p>

			<p><b>Hizmet Süresi:</b> Tercih edilen online video eğitimlere M&uuml;şteri&rsquo;nin bu s&ouml;zleşmeyi kabul ederek kayıt olması, www.okul.pwc.com.tr internet sitesinde beyan edilen bedelin &ouml;denmesiyle beraber başlar ve 3 (&uuml;&ccedil;) ay s&uuml;re ile devam eder.</p>

			
			<p>Tercih edilen fiziki(sınıf) eğitimlerine M&uuml;şteri&rsquo;nin bu s&ouml;zleşmeyi kabul ederek kayıt olması, www.okul.pwc.com.tr internet sitesinde beyan edilen tarihten 3 g&uuml;n &ouml;ncesine kadar bedelin &ouml;denmesi ile beraber beyan edilen tarihte başlar ve eğitimin ger&ccedil;ekleştirilmesi ile son bulur.&rdquo;</p>

			<p><b>Satış Fiyatı (KDV dahil):</b> <?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</p>

			<p><b>Ara Toplam:</b> <?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</p>

			<p><strong><u>TOPLAM</u>: </strong><?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</p>
			</td>
			<td style="width:50%; padding:20px" valign="top">
			<p><b>Ödeme Şekli ve Planı:</b> EFT / Havale </p>
			<p><b>Fatura Adresi:</b> <?php echo $_SESSION['fatura_bilgileri']['adres']; ?></p>

			
			</td>
		</tr>
	</tbody>
</table>

											
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
									<aside>
										<div class="bilesen">
											<div class="baslik" style="color:#2d2d2d;">Toplam Ücret</div>
											<div class="bilesenic">
												<div class="sepettoplam">
													<div class="satir">
														<span>Birim Fiyat</span>
														<b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir">
														<span>Kişi Sayısı</span>
														<b><?php echo $adet; ?></b>
													</div>
													<div class="satir">
														<span>K.D.V</span>
														<b><?php echo number_format($kdv, 2, ',', '.'); ?> TL</b>
													</div>
													<div class="satir toplamsatiri">
														<span>G. Toplam</span>
														<b><?php echo number_format($toplam_fiyat, 2, ',', '.'); ?> TL</b>
													</div>
												</div>
												<input name="user_login_id" type="hidden" id="user_login_id" value="<?php echo intval($_SESSION['katilimcilar']['user_id']); ?>" />
												
												<div class="label-div">
													<span>
														<input class="magic-checkbox" type="checkbox" id="check1" name="check1" checked />
														<label for="check1" style="font-size:13px"><strong>Ön bilgilendirme formunu</strong> kabul ediyorum.</label>
													</span>
												</div>
												<div class="label-div">
													<span>
														<input class="magic-checkbox" type="checkbox" id="check2" name="check2" checked />
														<label for="check2" style="font-size:13px"><strong>Mesafeli hizmet sözleşmesini</strong> kabul ediyorum.</label>
													</span>
												</div>
											</div>
										</div>
										<p style="font-size:14px; line-height:16px; text-align:left; font-weight:bold"><a href="iptal_ve_indirim_politikasi.php" target="_blank">İptal ve İndirim Politikamızı incelemek için tıklayınız.</a></p>
										
										<div class="satinal buton renk1 button13"><a  href="javascript:;" onclick="return ozet_gonder();" ><i class="odemeyap"></i><span>Kaydınızı Tamamlayın</span></a></div>
										
									</aside>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
<?php include('dosyalar/dahili/footer.php');?>