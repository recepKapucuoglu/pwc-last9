<?php
require_once('dosyalar/dahili/_db.php');

$gelenVeri = $_POST['selectedTypes'];
$gelenCategory = $_POST['selectedCategories']; //egitim kategorisi
$gelenLocation =$_POST['selectedLocations']; //lokasyon 
$veri = $gelenVeri;
$page = isset($_POST['pagination']) ? $_POST['pagination'] : 1; // varsayılan olarak 1. sayfa
$rakamsiz = array(); //egitim tipi
$rakamli = array(); // egitim level

foreach ($veri as $eleman) {
   $rakam_sonuc = preg_match('/\d+/', $eleman);
   if ($rakam_sonuc === 1) {
      array_push($rakamli, $eleman);
   } else {
      array_push($rakamsiz, $eleman);
   }
}
// kategori seçilmişse  
$query = "SELECT * FROM education_calender_list ";
$i = 1;
if (count($gelenCategory) > 0) {
   foreach ($gelenCategory as $category) {
      //birden fazla kategori ise
      if ($i > 1) {
         $query .= "OR kategoriler LIKE '%$category%' ";
      } else {
         $query .= "WHERE ( kategoriler LIKE '%$category%' ";
      }
      $i++;
   }
   $query = rtrim($query, 'OR '); // Son "OR" ifadesini silmek için
   $query .= ") ";
}
// type seçilmişse
if(count($rakamsiz)>0){
   $i=1;
foreach ($rakamsiz as $type) {
   if ($i > 1) {
      $query .= "OR types = '$type' ";
   } else {
      if(substr($query, -strlen("education_calender_list ")) === "education_calender_list ") {
         $query .= "WHERE (types = '$type' ";
      }
      else{
         $query .= "AND (types = '$type' ";
      }      
   }
   $i++;

}
$query .= ")";
}
//level seçilmişse
if(count($rakamli)>0){
   $i=1;
  foreach ($rakamli as $level) {
     if ($i > 1) {
        $query .= "OR level_id = $level ";
     } else {
      if(substr($query, -strlen("education_calender_list ")) === "education_calender_list ") {
         $query .= "WHERE (level_id = $level ";
      }
      else{
         $query .= "AND (level_id = $level ";
      }
   }
     $i++;
  }
  $query .= ")";
  }
//lokasyon seçilmişse
if(count($gelenLocation)>0){  
   $i=1;
  foreach ($gelenLocation as $lokasyon) {
     if ($i > 1) {
        $query .= "OR sehir_adi = '$lokasyon' ";
     } else {
      if(substr($query, -strlen("education_calender_list ")) === "education_calender_list ") {
         $query .= "WHERE (sehir_adi = '$lokasyon' ";
      }
      else{
         $query .= "AND (sehir_adi = '$lokasyon' ";
      }
   }
     $i++;
  }
  $query .= ")";
  }
  //silinmiş eğitimleri göstermeyelim
  if(substr($query, -strlen("education_calender_list ")) === "education_calender_list ") {
   $query .= "WHERE (egitim_adi IS NOT NULL AND (egitim_tarih > CURDATE() OR(
      YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR (YEAR(egitim_tarih) > YEAR(CURDATE()))  OR types = 'E-Learning' ))";
}
else {
   $query .= "AND (egitim_adi IS NOT NULL AND ( egitim_tarih > CURDATE() OR(
      YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR (YEAR(egitim_tarih) > YEAR(CURDATE()))  OR types = 'E-Learning' ))";
}

//toplam veri sayısını öğrenelim
$countQuery= $query." ORDER BY CASE WHEN
`egitim_tarih` IS NULL THEN 1 ELSE 0
END,
`egitim_tarih`";
$results = $db->rawQuery($countQuery);
$totalDataCount = count($results);
//1 sayfadaki data sayısı
$perPage=4;
//toplam sayfa sayısı
$totalPageCount = ceil($totalDataCount / $perPage);
echo $totalPageCount;
//son sayfaya gelindimi'

  //pagination işlemi
  if($page == 1) $limit = 4;
   $limit = 4  + ( ($page -1 ) * 4);
   if($totalPageCount==$page){
      echo '
      <script> 
      $(".dfazla_goruntule").hide();
      </script>';
   }
 $query.="ORDER BY CASE WHEN
 `egitim_tarih` IS NULL THEN 1 ELSE 0
 END,
 `egitim_tarih` LIMIT $limit";
//$query.="ORDER BY kayit_tarihi DESC ";

echo $query; //sORGUYU GOSTER
$results = $db->rawQuery($query);
// Sonuçları işleme
if ($db->count > 0) {
   $i=1;
   foreach ($results as $row) {
      // if($i==13) break;
      $dateToday = date("Y-m-d");
      if ($row['egitim_tarih'] > $dateToday || $row['types']=="E-Learning" ) {
      echo '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
      <a href="' . $row['seo_url'] . '" class="card-href">
      <div class="card">
      <div class="card__thumb">
      <a href="' . $row['seo_url'] . '"><img src="' . $row['resim'] . '" alt="' . $row['resim_alt_etiket'] . '" /></a>
      </div>';
      if ($row['types'] == "E-Learning") {
      echo '<div class="card__category"><a href="#">E-Learning</a><img src="dosyalar/images/pointer.png" style="width:19px; filter: brightness(0) invert(1);"/></div>';
      }
      echo '<div class="card__body">
      <div>
      <!-- <div class="favoriiptal">Favorilerimden Çıkar!</div> -->
      <h2 class="card__title">
      <a href="' . $row['seo_url'] . '">
      ' . $row['egitim_adi'] . '
      </a>
      </h2>
      <span class="card__description">
      ' . $row['kisa_aciklama'] . '
      </span>
      </div>
      <div class="card__dates">';
      if ($row['types'] != "E-Learning") {
      echo '<div class="card__time">
      <img src="dosyalar/images/calendar-alt.svg"/>
      
      <time>' . date2Human($row['egitim_tarih']) . '</time>
      </div>'; }
      echo '<div class="card__location">
      <img src="dosyalar/images/location-arrow.svg"/>
      <lokasyon>';
      if ($row['webex'] == 1) {
      echo "Webex";
      } else {
      echo $row['sehir_adi'];
      }
      echo '</lokasyon>
      </div>
      <div class="fiyat">
      <!--<del>1.673,99 TL</del>-->
      <img src="dosyalar/images/money-bill.svg"/>
      <b>';
      if ($row['webex'] == 1) {
      echo "Ücretsiz";
      } else {
      echo number_format($row['ucret'], 2, ',', '.') . '<span> TL + KDV</span>';
      }
      echo '</b>
      </div>
      </div>
      <div class="kutu-buttons">
      <a class="online-button">';
      if ($row['sehir_adi'] != "") {
      echo $row['sehir_adi'];
      }
      echo '</a>';
      if ($row['level_id'] == 1) {
      $derece = "Başlangıç";
      } elseif ($row['level_id'] == 2) {
      $derece = "Orta";
      } elseif ($row['level_id'] == 3) {
      $derece = "İleri";
      }
      echo '<a class="baslangic-button">' . $derece . '</a>
      </div>
      </div>
      </div>
      </a>
      </div>';
      }

       
      if ($row['egitim_tarih'] < $dateToday && $row['types'] != 'E-Learning' ) { //tarihi geçmiş egitimler
          echo  '<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">

              <a href="'.$row['education_seo_url'].'" class="card-href">
                  <div class="card">
                      <div class="card__thumb">';
          echo '<a href="'.$row['education_seo_url'].'"><img src="'.$row['resim'].'" alt="'.$row['resim_alt_etiket'].'" /></a>
                      </div>
                      <div class="card__body">
                          <div>
                              <h2 class="card__title"><a href="egitimlerimiz/'.$row['education_seo_url'].'">'.$row['egitim_adi'].'</a></h2>
                              <span class="card__description">'.$row['kisa_aciklama'].'</span>
                          </div>
                          <div class="card__dates">
                              <time>Bu eğitim için açık bir tarih bulunmamaktadır. <br/>* Bilgi al formunu doldurarak ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi sağlayabilirsiniz.</time>
                          </div>
                      </div>
                  </div>
              </a>
          </div>';
      }
      $i++;
  } 
  
} else {
   // Sonuç yoksa yapılacak işlemler
   echo "Sonuç bulunamadı.";
}

// //EGİTİM TİPİ filteri işaretli ise. 
// if (count($rakamsiz) > 0 && count($rakamli) == 0) {
//    $page=$_POST['pagination'];
//    $db->where('types', $rakamsiz[0]);
//    for ($i = 1; $i < count($rakamsiz); $i++) {
//         $db->orWhere('types', $rakamsiz[$i]);
//    }
//    $db->pageLimit = 12;
//    $query = $db->arraybuilder()->paginate("education_calender_list", $page);
//    if(count($query)<1){

//       echo   ' <div class="alert alert-danger">Daha fazla eğitim bulunmamaktadır.</div>
//       ';

//    }
//     foreach ($query as $row) {

//         echo '				<div class="col-md-3">
//  <div class="card" style="margin-top:15px" >

//   <div class="card__thumb">
// <a href="'.$row['seo_url'].'">
// <img src="https://www.okul.pwc.com.tr/"'. $r['resim'] .' " />
// </a>
// </div>
// <div class="card__body">
// <div>
//    <h2 class="card__title">
//       <a href="'.$row['seo_url'].'">
//       "' . $row['egitim_adi'] . '"
//       </a>
//    </h2>
//    <span class="card__description">
//    "' . $row['kisa_aciklama'] . '"
//    </span>
// </div>
// <div class="card__dates">
//    <time>Bu eğitim için açık bir tarih bulunmamaktadır. <br/>* Bilgi al formunu doldurarak ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi sağlayabilirsiniz.</time>
// </div>
// <div class="kutu-buttons">
// <a class="online-button">'.$row['types'].'</a>
// <a class="baslangic-button">'.$level.'</a>
// </div>
// </div> </div></div>';
//     }
// }
// //Eğitim level filteri işaretli ise
// else if(count($rakamsiz) == 0 && count($rakamli) > 0){
//    $page=$_POST['pagination'];

//    $db->where('level_id', $rakamli[0]);
//    for ($i = 1; $i < count($rakamli); $i++) {
//        $db->orWhere('level_id', $rakamli[$i]);
//    }
//    $db->pageLimit = 12;
//    $query = $db->arraybuilder()->paginate("education_calender_list", $page);

//    // $query = $db->get('education_calender_list');
//    foreach ($query as $row) {
//       if( $row['level_id']==1) {
//          $level="Başlangıç";
//         } 
//         if( $row['level_id']==2) {
//          $level="Orta";
//         } 
//         if( $row['level_id']==3) {
//          $level="İleri";
//         }   
//        echo '				<div class="col-md-3">
// <div class="card" style="margin-top:15px" >

//  <div class="card__thumb">
// <a href="'.$row['seo_url'].'">
// <img src="https://www.okul.pwc.com.tr/"'. $r['resim'] .' " />
// </a>
// </div>
// <div class="card__body">
// <div>
//   <h2 class="card__title">
//      <a href="'.$row['seo_url'].'">
//      ' . $row['egitim_adi'] . '
//      </a>
//   </h2>
//   <span class="card__description">
//   ' . $row['kisa_aciklama'] . '
//   </span>
// </div>
// <div class="card__dates">
//   <time>Bu eğitim için açık bir tarih bulunmamaktadır. <br/>* Bilgi al formunu doldurarak ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi sağlayabilirsiniz.</time>
// </div>
// <div class="kutu-buttons">
// <a class="online-button">'.$row['types'].'</a>
// <a class="baslangic-button">'.$level.'</a>
// </div>
// </div> </div></div>';
//    }
// }
// // Her ikiside işaretli ise 
// else if(count($rakamsiz) > 0 && count($rakamli) > 0){
//    $page=$_POST['pagination'];

//    //egitim tipini filtrele
//    $db->where('types', $rakamsiz[0]); 
//    for ($i = 1; $i < count($rakamsiz); $i++) {
//        $db->orWhere('types', $rakamsiz[$i]);
//    }
//    //sonra bu eğitim tipleri üzerinden  levelleri filtreleyelim
//    $db->where('level_id', $rakamli[0]); 
//    for ($i = 1; $i < count($rakamli); $i++) {
//        $db->orWhere('level_id', $rakamli[$i]);
//    }
//    $db->pageLimit = 8;
//    $query = $db->arraybuilder()->paginate("education_calender_list", $page);
//    // $query = $db->get('education_calender_list');

//    foreach ($query as $row) {
//      if( $row['level_id']==1) {
//       $level="Başlangıç";
//      } 
//      if( $row['level_id']==2) {
//       $level="Orta";
//      } 
//      if( $row['level_id']==3) {
//       $level="İleri";
//      }        echo '				<div class="col-md-3">
// <div class="card" style="margin-top:15px" >

//  <div class="card__thumb">
// <a href="'.$row['seo_url'].'">
// <img src="https://www.okul.pwc.com.tr/"'. $r['resim'] .' " />
// </a>
// </div>
// <div class="card__body">
// <div>
//   <h2 class="card__title">
//      <a href="'.$row['seo_url'].'">
//      '. $row['egitim_adi'] . '
//      </a>
//   </h2>
//   <span class="card__description">
//   ' . $row['kisa_aciklama'].'
//   </span>
// </div>
// <div class="card__dates">
//   <time>Bu eğitim için açık bir tarih bulunmamaktadır. <br/>* Bilgi al formunu doldurarak ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi sağlayabilirsiniz.</time>
// </div>
// <div class="kutu-buttons">
//   <a class="online-button">'.$row['types'].'</a>
//   <a class="baslangic-button">'.$level.'</a>
// </div>
// </div> </div></div>';
//    }
// }
// //filter yok ise tüm eğitimleri çek.
// else { 
//    $page=$_POST['pagination'];
//    $db->pageLimit = 8;
//    $dateToday = date("Y-m-d");
//    $db->where('egitim_tarih', $dateToday, '>=');
//    $db->orWhere('types',"E-Learning");
//    $db->orderBy('egitim_tarih',"asc");
// $query = $db->arraybuilder()->paginate("education_calender_list", $page);
//     foreach ($query as $row) {
//       if( $row['level_id']==1) {
//          $level="Başlangıç";
//         } 
//         if( $row['level_id']==2) {
//          $level="Orta";
//         } 
//         if( $row['level_id']==3) {
//          $level="İleri";
//         }   


//         echo '				<div class="col-md-3">
//  <div class="card" style="margin-top:15px" >

//   <div class="card__thumb">
//   <a href="'.$row['seo_url'].'">
//   <img src="https://www.okul.pwc.com.tr/"'.$r['resim'].'" />
//   </a>
//   </div>
// <div class="card__body">
// <div>
// <h2 class="card__title">
// <a href="'.$row['seo_url'].'">
// ' . $row['egitim_adi'] . '
// </a>
// </h2>
//    <span class="card__description">
//    ' . $row['kisa_aciklama'] . '
//    </span>
// </div>
// <div class="card__dates">
//    <time>Bu eğitim için açık bir tarih bulunmamaktadır. <br/>* Bilgi al formunu doldurarak ilgili eğitim takvimi planlandığında sizinle iletişime geçmemizi sağlayabilirsiniz.</time>
// </div>
// <div class="kutu-buttons">
// <a class="online-button">'.$row['types'].'</a>
// <a class="baslangic-button">'.$level.'</a>
// </div>
// </div> </div></div>';
//     }
// }

?>