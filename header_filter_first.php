<?php
require_once('dosyalar/dahili/_db.php');
$secilenTip = $_POST['type_id'];
$gelenData = $_POST['category_id'];


//elearning eğitimi olmayanlar
if ($secilenTip == "another_filter") {
    // bir category seçilmişse
    if ($gelenData) {
        //egitim takvimi aktif olanları getir
        // $db->where('kategoriler', '%' . $gelenData . '%', 'LIKE');
        // $dateToday = date("Y-m-d");
        // $db->where('egitim_tarih', $dateToday, '>=');
        // $db->orderBy("egitim_tarih", "asc");
        // $sonuc = $db->get("education_calender_list");
        // $sonucSayisiAktifEgitim = count($sonuc);

        $query = "SELECT * FROM egitimlerimiz_filter WHERE kategoriler LIKE '%$gelenData%' AND (types IS NULL OR types != 'E-Learning')";
        $query .= "ORDER BY 
        CASE WHEN `source`='education' THEN 1 ELSE 0 END, 
        `kayit_tarihi` DESC,
        CASE WHEN `source` = 'education-calender' THEN 0 ELSE 1 END,
        `egitim_tarih` DESC ";
        // echo $query; //SORGUYU GOSTER
        $sonuc = $db->rawQuery($query);

        $sonucSayisi = count($sonuc);

        if ($sonucSayisi > 0) {

            $sayac = 0;
            foreach ($sonuc as $egitim) {
                if($egitim['source']=='education-calender'){

                echo '<li class="child-altmenu_item">
        <div class="child-altmenu_left">
            <div class="navbar-image">
                <img src="' . $egitim['resim'] . '" />
            </div>
            <a href="' . $egitim['seo_url'] . '">' . $egitim['egitim_adi'] . '</a>
        </div>
        <div class="child-altmenu_right">
        <p  <time> ' . date2Human($egitim['egitim_tarih']) . '</span> </time></p>
        <p style="padding:0px;">' . $egitim['ucret'] . ' TL + KDV</p>
        </div>
    </li>';
                }
                else {
                    echo '<li class="child-altmenu_item">
                    <div class="child-altmenu_left">
                        <div class="navbar-image">
                            <img src="' . $egitim['resim'] . '" />
                        </div>
                        <a href="' . $egitim['seo_url'] . '">' . $egitim['egitim_adi'] . '</a>
                    </div>
                </li>';
                }
                $sayac++;
                if ($sayac == 3) {
                    break;
                }
            }

            $db->where('baslik', $gelenData);
            $categoryPath = $db->getOne('categories');
            $categoryPathUrl = $categoryPath['seo_url'];
            $kalanGoruntulenmeyenEgitim= $sonucSayisi-$sayac;
            if ($sonucSayisi > 3) {
                echo '<li class="child-altmenu_item" style="justify-content:end">
                <div class="child-altmenu_left">
                </div>
                <div class="child-altmenu_right">
                <div class="show-all_btn"><a style="background:transparent !important; color:white !important;" href="' . $categoryPathUrl . '"> Diğer (' . $kalanGoruntulenmeyenEgitim . ') eğitimi gör ></a></div>
                </div>
            </li>';
            }
           
        }
                
    }
}
//elearning egitimleri
if ($secilenTip == "elearning_filter") {

    $query = "SELECT * FROM egitimlerimiz_filter WHERE kategoriler LIKE '%$gelenData%' AND (types = 'E-Learning')";
    $query .= "ORDER BY 
    CASE WHEN `source`='education' THEN 1 ELSE 0 END, 
    `kayit_tarihi` DESC,
    CASE WHEN `source` = 'education-calender' THEN 0 ELSE 1 END,
    `egitim_tarih` DESC ";
    // echo $query; //sORGUYU GOSTER
    $sonuc = $db->rawQuery($query);

    $sonucSayisi = count($sonuc);
    // $db->where('kategoriler', '%' . $gelenData . '%', 'LIKE');
    // $db->where('types', 'E-Learning');
    // $db->orderBy('kayit_tarihi', "desc");
    // $sonuc = $db->get("education_calender_list");
    // $sonucSayisi = count($sonuc);
    $sayac = 1;

    
    foreach ($sonuc as $egitim) {
        echo '<li class="child-altmenu_item">
        <div class="child-altmenu_left">
            <div class="navbar-image">
                <img src="' . $egitim['resim'] . '" />
            </div>
            <a href="' . $egitim['seo_url'] . '">' . $egitim['egitim_adi'] . '</a>
        </div>
        <div class="child-altmenu_right">
            <p style="padding:0px;">' . $egitim['ucret'] . ' TL + KDV</p>
        </div>
    </li>';
        $sayac++;
        if ($sayac == 4) {
            break;
        }
    }
    $db->where('baslik', $gelenData);
    $categoryPath = $db->getOne('categories');
    $categoryPathUrl = $categoryPath['seo_url'];
    $kalanGoruntulenmeyenEgitim = $sonucSayisi - $sayac + 1;
    if ($sonucSayisi > 3) {
        echo '<li class="child-altmenu_item" style="justify-content:end">
        <div class="child-altmenu_left">
        </div>
        <div class="child-altmenu_right">
        <div class="show-all_btn"><a style="background:transparent !important;" href="' . $categoryPathUrl . '"> Diğer (' . $kalanGoruntulenmeyenEgitim . ') eğitimi gör ></a></div>
        </div>
    </li>';
    }
    if ($sonucSayisi == 0) {
        echo "Bu kategoride henüz elearning eğitimimiz yoktur.";
    }
}
?>