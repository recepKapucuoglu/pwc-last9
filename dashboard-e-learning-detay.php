<?php include('dosyalar/dahili/header.php');
include('dosyalar/dahili/elearning_connect.php');


$db->where('elearning_detail_path', $_GET['path']);
$isHaving = $db->getValue('web_education_order_list', "count(id)");
if ($_SESSION['dashboardUser'] && $isHaving) { ?>
    <?php
    $db->where('elearning_detail_path', $_GET['path']);
    $sonuc = $db->getOne('web_education_order_list');
    $db->where('order_id', $sonuc['order_id']);
    $edu_cal_id = $db->getOne('education_order_person_list');
    $email = $edu_cal_id['email'];
    $db->where('id', $edu_cal_id['edu_cal_id']);
    $education = $db->getOne('education_calender_list');
    $aciklama = $education['edu_aciklama'];
    $egitim_adi = $education['egitim_adi'];
    $resim = $education['resim'];
    $kisa_aciklama = $education['kisa_aciklama'];
    ?>

    <section class="ortakisim">

        <div class="rbt-course-details-area">
            <div class="egitim-detay_bread">
                <div class="container">
                <div class="dashboard-egitim-breadcrumb_baslik">EĞİTİMLERİMİZ</div>
                    <ol class="breadcrumb dashboard-egitim-breadcrumb" style="background:transparent" itemscope itemtype="http://schema.org/BreadcrumbList">
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="dashboard-e-learning"><span itemprop="name">E-Learning Eğitimlerim</span></a>
                            <meta itemprop="position" content="2" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="javascript:;"><span itemprop="name"><?php echo $egitim_adi; ?></span></a>
                            <meta itemprop="position" content="3" />
                        </li>
                    </ol>
                </div>
            </div>
            <div class="egitim-detay_container">
                <div class="container ">
                    <div class="row g-5">
                        <div class="col-lg-12">
                            <div class="egitim-detay_section">
                                <a class="video-popup-with-text video-popup-wrapper text-center popup-video sidebar-video-hidden mb--15"
                                    href="elearning_redirect.php" target="_blank" style="display: block;">
                                    <div class="course-sidebar">
                                        <!-- Start Viedo Wrapper  -->
                                        <input type="hidden" class="data-post" value="<?php echo $email; ?>">
                                        <img class="dashboard-elearning_image" src="<?php echo $resim; ?>"
                                            alt="Video Images">
                                        <div class="signal-container">

                                            <span class="rbt-btn rounded-player-2 with-animation" id="signals">
                                                <span class="play-icon"></span>
                                                <span class="signal s1"></span>
                                                <span class="signal s2"></span>
                                            </span>

                                        </div>
                                    </div>
                                </a>
                                <div class="egitim-detay_desc">
                                    <div class="egitim-detay_text">
                                        <!-- <p>
                                        Kişisel Konunması jjdsajsdı kerwekrwkerk wekwerkwerkwerkkw krekere  Mevzuatına Uygum için Neler Yapılmalı? asd jasdhqwhejqwe j
                                        </p> -->
                                        <p>
                                            <?php echo t_decode($kisa_aciklama); ?>
                                        </p>
                                    </div>
                                    <div class="egitim-detay_button" style="cursor:pointer;">
                                        <a href="elearning_redirect.php" target="_blank" style="display: block;">

                                            Eğitime Git
                                        </a>
                                    </div>
                                </div>
                                <img class="education-arrow" src="dosyalar/images/education-arrow.png" />
                                <div class="education-boxes">
                                    <div class="education-box">
                                        <img src="dosyalar/images/play-icon-egitim.png" />
                                        Eğitime Başla!
                                    </div>
                                    <hr class="education-line">
                                    <div class="education-box">
                                        <img src="dosyalar/images/cap.png" />
                                        Eğitimi Tamamla!
                                    </div>
                                    <hr class="education-line">
                                    <div class="education-box">
                                        <img src="dosyalar/images/sertifika.png" />
                                        Sertifikanı Al!
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container egitim-icerik" style="margin-bottom:25px">
                <h2 style="font-weight:bold">EĞİTİM İÇERİĞİ</h2>
            </div>
            <div class="egitim-icerigi">
                <div class="container">
                    <div class="left-side-egitim" style="display:flex; justify-content:space-between; ">
                        <div class="egitim-icerigi_text">
                            <h2>Eğitim Programında
                                Ele Alınacak Konu
                                Başlıkları
                            </h2>
                            <p>
                                Eğitimimiz online olarak gerçekleştirilecektir.
                            </p>
                            <img class="image-content" src="./dosyalar/images/contentimage.png" />
                        </div>
                        <div class="egitim-icerik_exp">
                            <!-- Kişisel Verilerin Korunması Kanunu'nun amacı -->
                            <?php echo t_decode($aciklama); ?>
                            <!-- <li>· Kanun'a uyum süreci ve yol haritası</li>
                                <li>· Kişisel veri, özel nitelikli veri, veri sorumlusu vb. Kanun’da yer alan tanımlar</li>
                                <li>· Veri işlerken uyulması gereken ilkeler</li>
                                <li>· Kanun’un öngördüğü istisnalar</li>
                                <li>· Yurtdışına veri aktarmaya ilişkin kurallar</li>
                                <li>· Hukuka uygun kişisel veri işleme</li>
                                <li>· İK departmanları ve kişisel verilerin korunması mevzuat</li>
                                <li>· İşe alım ve iş ilişkisinde işlenen kişisel veriler</li>
                                <li>· Aydınlatma metni ve açık rıza beyanlarının içerikleri</li>
                                <li>· Kişisel veri faaliyet envanteri</li>
                                <li>· Alt işveren ilişkilerinde kişisel veriler</li>
                                <li>· Bulut bilişim çözümleri ve kişisel verilerin korunması mevzuatına uyum</li>
                                <li>· Çerezler ve kişisel veriler</li>
                                <li>· Yaptırımlar ve Kişisel Verileri Koruma Kurulu kararları</li>
                                <li>· Kurul kararları doğrultusunda güncel gelişmeler ve alınması gereken aksiyonlar</li> -->

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
    <script>
    // 	$('.video-popup-with-text').click(function(e) {
    //       e.preventDefault();

    //   var email = $(".data-post").val();

    //   // Send the AJAX request with the email as data
    //   $.ajax({
    //     type: 'POST',
    //     url: 'elearning_redirect.php',
    //     data: {
    //       email: email
    //     },
    //     success: function(response) {
    //       // Handle the response from the server
    //       console.log(response);
    //     },
    //     error: function(xhr, status, error) {
    //       // Handle the error
    //       console.error(error);
    //     }
    //   });
    // });
    </script>
<?php } else {

    echo "<script language=\"JavaScript\">location.href=\"/login.php\";</script>";

}
include('dosyalar/dahili/footer.php'); ?>
<script>$('body').addClass('dashboard');</script>