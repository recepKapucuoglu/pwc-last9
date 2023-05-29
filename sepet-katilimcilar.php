<?php
include('dosyalar/dahili/header.php');
$page_url = $_SERVER['REQUEST_URI'];
$page_url = explode("/",$page_url);
$page_url = end($page_url);
$page_url = t_decode($page_url);
$db->where('seo_url', $page_url);
$results = $db->get('url_list');
foreach ($results as $value) {
    $source=$value['source'];
}

if($_SESSION['katilimcilar']['adet']>0) $adet = $_SESSION['katilimcilar']['adet']; else $adet =1;

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
    $genel_toplam = $ucret * $adet * 1.18;
    $kdv = $genel_toplam - ($genel_toplam / 1.18);

}

if($edu_cal_id==""){
    header("Location: https://www.okul.pwc.com.tr");
    exit;
}
?>
<?php
$db->where('email', $_SESSION['dashboardUser']);
$results = $db->get('web_user');
foreach ($results as $value) {
    $fullName = $value['fullname'];
    $title = $value['title'];
    $company = $value['company'];
    $email = $value['email'];
    $phone = $value['phone'];
    $user_id = $value['id'];
}
// eğer üye bu işlemi yapıyorsa
$non_user = false;
if(!$_SESSION['dashboardUser'] AND $_SESSION['withoutEmail']){
    $email = $_SESSION['withoutEmail'];
    // Eğer üye girişi yapmadan kayıt yapıyorsa
    $non_user = true;
}
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
                <a itemprop="item" href="javascript:;"><span itemprop="name">Katılımcılar</span></a>
                <meta itemprop="position" content="4" />
            </li>
        </ol>
    </div>
</section>
<section class="ortakisim">
    <div class="formMessage col-md-10 col-md-push-1"></div>

    <form id="contact-form" class="sepetform" method="post" action="sepet-odeme/<?php echo $seo_url; ?>">
        <input type="hidden" name="edu_cal_id" id="edu_cal_id" value="<?php echo $edu_cal_id; ?>"/>
        <input name="user_id" type="hidden" id="user_id" value="<?php echo $user_id; ?>" />
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="sepet-adimlar">
                        <div class="adim ok"><a href="javascript:;"><i class="icon user-icon"></i> Katılımcı</a></div>
                        <div class="adim"><a href="javascript:;"><i class="icon kk-icon"></i> Fatura Bilgilerim</a></div>
                        <div class="adim"><a href="javascript:;"><i class="icon ozet-icon"></i> Kayıt Özeti</a></div>
                        <div class="adim"><a href="javascript:;"><i class="icon ss-icon"></i> Kaydınız Tamamlandı</a></div>
                    </div>
                    <div class="sepet-div">
                        <div class="row">
                            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                                <h3><b>Katılımcı</b></h3>
								<?php
								if($_SESSION['dashboardUser']){
									echo '<p>Bilgilerinizi güncellemek için <a href="https://www.okul.pwc.com.tr/dashboard-hesabim.php" target="_blank">profil sayfanızı</a> ziyaret edebilir ya da <a href="mailto:egitim@pwc.com.tr" target="_blank">egitim@pwc.com.tr</a> adresine mail atabilirsiniz.</p>';
								} else {
									echo '<p>Katılımcı bilgilerini giriniz.</p>';
								}
                                ?>
								<table class="tablesepet sepetlist sepetozeti">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="urunkutusu">
                                                <div class="resim"><img src="<?php echo $site_url.$resim; ?>" alt="<?php echo $resim_alt_etiket; ?>" /></div>
                                                <div class="adi"><?php echo $egitim_adi; ?> <br /><small>Eğitim Tarihi: <?php echo date2human($egitim_tarih); ?></small></div>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div class="fiyat">

                                                <b><?php echo number_format($ucret, 2, ',', '.'); ?> TL</b>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>


                                <table class="tablesepet katilimcibilgileri">
                                    <thead>
                                    <th>Katılımcı Bilgileri</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <table>
                                                <tbody class="katilimci_satirlari">
                                                <?php if($_SESSION['katilimcilar']){


                                                    $toplam_katilimci = count($_SESSION['katilimcilar']['katilimci_adsoyad']);
													$if_not_user = ($non_user) ? "" : "style='border: none !important; background-color: #ccc;' readonly";
                                                    for($sayi = 0; $sayi < $toplam_katilimci; $sayi++) { ?>

                                                        <tr class="katilimci_satir">
                                                            <td style="padding:0px">
                                                                <?php if($sayi>0) echo "<span class='removeTr'>Katılımcı Çıkart</span>"; ?>
                                                                <table>

                                                                    <tr style="border:0px">
                                                                        <td colspan="3" style="padding: 0px 20px; display: none;"><h4 style="color: #d3202e;"><b><?php echo $sayi + 1; ?>. Katılımcı</b></h4></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>
                                                                            <div class="label-div3">
                                                                                <label>Ad Soyad*</label>
                                                                                <input type="text" name="katilimci_adsoyad[]" <?php echo $if_not_user; ?> id="katilimci_adsoyad" value="<?php echo $_SESSION['katilimcilar']['katilimci_adsoyad'][$sayi]; ?>"/> <br/>
                                                                                <label>Firma Adı</label>
                                                                                <input type="text" name="katilimci_firma[]" <?php echo $if_not_user; ?> value="<?php echo $_SESSION['katilimcilar']['katilimci_firma'][$sayi]; ?>"/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="label-div3">
                                                                                <label>Unvan *</label>
                                                                                <input type="text" name="katilimci_unvan[]" <?php echo $if_not_user; ?> id="katilimci_unvan" value="<?php echo $_SESSION['katilimcilar']['katilimci_unvan'][$sayi]; ?>"/><br/>
                                                                                <label>Firma Telefon</label>
                                                                                <input type="tel" name="katilimci_firma_telefon[]" <?php echo $if_not_user; ?> id="katilimci_firma_telefon" value="<?php echo $_SESSION['katilimcilar']['katilimci_firma_telefon'][$sayi]; ?>"/>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="label-div3">
                                                                                <label>Telefon*</label>
                                                                                <input type="tel" name="katilimci_telefon[]" <?php echo $if_not_user; ?> id="katilimci_telefon" value="<?php echo $_SESSION['katilimcilar']['katilimci_telefon'][$sayi]; ?>"/><br/>
                                                                                <label>E-Posta *</label>
                                                                                <input type="email" name="katilimci_email[]" <?php echo $if_not_user; ?> id="katilimci_email" value="<?php echo $_SESSION['katilimcilar']['katilimci_email'][$sayi]; ?>"/>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>


                                                        <?php
                                                    }

                                                    ?>


                                                <?php } else {
                                                    // eğer misafir ise inputları doldurabilsin.
                                                    $if_not_user = ($non_user) ? "" : "style='border: none !important; background-color: #ccc;' readonly";
                                                    ?>
                                                    <tr class="katilimci_satir">
                                                        <td style="padding:0px">
                                                            <table>
                                                                <tr style="border:0px; display: none;"><td colspan="3" style="padding: 0px 20px;"><h4 style="color: #d3202e; display: none;"><b>1. Katılımcı</b></h4></td></tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="label-div3">
                                                                            <label>Ad Soyad*</label>
                                                                            <input type="text" name="katilimci_adsoyad[]" id="katilimci_adsoyad" value="<?php echo $fullName; ?>" <?php echo $if_not_user; ?> /> <br/><br/>
                                                                            <label>Firma Adı *</label>
                                                                            <input type="text" name="katilimci_firma[]" id="katilimci_firma" value="<?php echo $company; ?>" <?php echo $if_not_user; ?> />
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="label-div3">
                                                                            <label>Unvan *</label>
                                                                            <input type="text" name="katilimci_unvan[]" id="katilimci_unvan" value="<?php echo $title; ?>"  <?php echo $if_not_user; ?> /><br/><br/>
                                                                            <label>Firma Telefon </label>
                                                                            <input type="tel" name="katilimci_firma_telefon[]" value=""/>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="label-div3">
                                                                            <label>Telefon*</label>
                                                                            <input type="tel" name="katilimci_telefon[]" id="katilimci_telefon" value="<?php echo $phone; ?>"  <?php echo $if_not_user; ?> /><br/><br/>
                                                                            <label>E-Posta *</label>
                                                                            <input type="email" name="katilimci_email[]" id="katilimci_email" value="<?php echo $email; ?>" style="border: none !important; background-color: #ccc;" readonly />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                            <!-- Katılımcı eklenmesi için alan -->
                                            <!--
													<div class="adetsec">
														<span class="minus">-</span>
														<input type="hidden" class="adet" id="adet" name="adet"  value="<?php echo $adet; ?>" onkeyup="this.setAttribute('value', this.value);" />
														<span class="addTr" style="display:none;">Katılımcı Ekle</span>
													</div>
													-->
                                            <table>
                                                <tr>
                                                    <td style="padding: 0px 20px">
                                                        <div class="label-div3">
                                                            <label>Not</label>
                                                            <input type="text" name="katilimci_notu" value="<?php echo $_SESSION['katilimcilar']['katilimci_notu']; ?>"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <aside>
                                    <div class="bilesen">
                                        <div class="baslik" style=" color:#2d2d2d;">Toplam Ücret</div>
                                        <div class="bilesenic">
                                            <div class="sepettoplam" id="sepettoplam">
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
                                                    <b><?php echo number_format($genel_toplam, 2, ',', '.'); ?> TL</b>
                                                </div>
												<div class="satir">
													<span style="font-size: 11px; margin-top: .5rem; color: #e0301e; font-weight: 900;">İndirim oranına göre değişiklik gösterebilir.</span>
												</div>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="font-size:14px; line-height:16px; text-align:left; font-weight:bold"><a href="iptal_ve_indirim_politikasi.php" target="_blank">İptal ve İndirim Politikamızı incelemek için tıklayınız.</a></p>


                                    <div class="satinal buton renk1 button13"><a  href="javascript:;" onclick="return katilimcilar_gonder();" ><i class="odemeyap"></i><span>Devam Et</span></a></div>


                                    <!--<div class="label-div3">
                                        <input type="text" name="kupon" class="kuponinput" placeholder="Çek / Promosyon Kodu" value=""/>
                                    </div>-->
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