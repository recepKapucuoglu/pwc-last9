<?php
// // echo phpversion();
// require_once("dosyalar/dahili/libs/MysqliDb.php");
// require_once("dosyalar/dahili/libs/dbObject.php");
// $db = new Mysqlidb('localhost', 'root', '', 'school');

// $db->where('sehir_adi','Cisco Webex');
// $totals= $db->getValue ('egitimlerimiz_filter', "count(id)");

// $query = "SELECT  kategoriler FROM egitimlerimiz_filter WHERE kategoriler IS NOT NULL AND (egitim_tarih > CURDATE() OR (YEAR(egitim_tarih) = YEAR(CURDATE()) AND MONTH(egitim_tarih) > MONTH(CURDATE())) OR YEAR(egitim_tarih) > YEAR(CURDATE()) OR types = 'E-Learning') ";
// $category_list = $db->rawQuery($query);
// $uniqueCategories = array();

// foreach ($category_list as $value) {
//     $categories = explode(", ", $value['kategoriler']);
//     foreach ($categories as $category) {
//         $uniqueCategories[$category] = true;
//     }
// }

// // Display the unique categories
// foreach ($uniqueCategories as $category => $value) {
//     echo $category;
// }

// 						//   var_dump($uni);
//                           die();
// echo  date("Y-m-d");
// // die();
//  $db = new Mysqlidb('localhost', 'root', '', 'school');



// $sql = "SELECT kategoriler, GROUP_CONCAT(DISTINCT kategoriler SEPARATOR ',') AS kategoriler FROM education_list WHERE type_ismi = 'E-Learning' GROUP BY kategoriler";

// $categories = $db->query($sql);

// $allCategories = implode(',', array_map(function($item) {
//     return $item['kategoriler'];
// }, $categories));

// // Tüm kategorileri virgülle ayrılmış bir diziye dönüştürün ve yinelenen öğeleri çıkarın
// $uniqueCategories = array_unique(explode(',', $allCategories));

// // Tekrar eden öğeleri çıkarın ve sonuç dizisini oluşturun
// $result = array();
// foreach($uniqueCategories as $category) {
//     $result[] = array('kategoriler' => $category);
// }

// $output = array();
// foreach ($result as $value) {
//     $categories = explode(',', $value['kategoriler']);
//     foreach ($categories as $category) {
//         $trimmed_category = trim($category);
//         if (!in_array($trimmed_category, $output)) {
//             $output[] = $trimmed_category;
//         }
//     }
// }

// print_r($output);


?>
