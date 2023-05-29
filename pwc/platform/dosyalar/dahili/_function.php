
<?php
// Aldığı değer içindeki verileri temizler
function valueClear($veri) 
{
$veri = str_replace("`","",$veri); 
$veri = str_replace("=","",$veri ); 
$veri = str_replace("&","",$veri ) ;
$veri = str_replace("%","",$veri ) ;
$veri = str_replace("!","",$veri ) ;
$veri = str_replace("#","",$veri ) ;
$veri = str_replace("<","",$veri ) ;
$veri = str_replace(">","",$veri ) ;
$veri = str_replace("*","",$veri ) ;
$veri = str_replace("And","",$veri ); 
$veri = str_replace("'","&#39",$veri ) ;
$veri = str_replace("Chr(34)","",$veri ) ; 
$veri = str_replace("Chr(39)","",$veri ) ;
return $veri;
}
function valueClearMaps($veri) 
{
$veri = str_replace("`","",$veri); 
$veri = str_replace("=","",$veri ); 
$veri = str_replace("&","",$veri ) ;
$veri = str_replace("%","",$veri ) ;
$veri = str_replace("!","",$veri ) ;
$veri = str_replace("#","",$veri ) ;
$veri = str_replace("<","",$veri ) ;
$veri = str_replace(">","",$veri ) ;
$veri = str_replace("*","",$veri ) ;
$veri = str_replace(" ","%20",$veri ) ;
$veri = str_replace("And","",$veri ); 
$veri = str_replace("'","&#39",$veri ) ;
$veri = str_replace("Chr(34)","",$veri ) ; 
$veri = str_replace("Chr(39)","",$veri ) ;
return $veri;
}
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
function clearPhone($phone){
	$in = array('(',')');
	$out = array('','');
	$phone = str_replace($in,$out,$phone);

	return $phone;
}
function amountClear($veri) 
{
$veri = str_replace(".","",$veri); 
$veri = str_replace(" TL","",$veri ); 
return $veri;
} 
function valuePlus($veri) 
{
$veri = str_replace("+","plus",$veri); 
return $veri;
}
function virgulToNokta($veri) 
{
$veri = str_replace(",",".",$veri); 
return $veri;
}
function date2Human($date)
    {
        if ($date == '0000-00-00' || $date == '0000-00-00 00:00:00' || empty($date))
        {
            $output = null;
        }
        else
        {
            // datetime ise
            if (strlen($date) == 19)
            {
                $format = 'd.m.Y H:i:s';
            }
            // date ise
            else
            {
                $format = 'd.m.Y';
            }

            try
            {
                $output = date($format, strtotime($date) + 10800);
				
            }
            catch (Exception $e)
            {
                $output = null;
            }
        }

        return $output;
    }

function plusChange($veri) 
{
$veri = str_replace(" ","+",$veri); 
return $veri;
}
function tirnak_replace ($par)
{
   return str_replace(
      array(
         "'", "\""
         ),
      array(
         "&#39;", "&quot;"
      ),
      $par
   );
}
function toMysqlDate($date)
{
	if ($date == '1970-01-01' || $date == '0000-00-00' || $date == '00.00.0000' || $date == '0000-00-00 00:00:00' || empty($date))
	{
		$output = null;
	} else {

		$output = date('Y-m-d', strtotime(str_replace('/', '.', $date)));
	}
	return $output;
}
function url_baslik_yarat ($baslik="")
{ 
 //de?i?tirelecek türkçe karakterler
 $TR=array('ç','Ç','ğ','Ğ','ö','Ö','ü','Ü','Ş','ş','İ','ı');
 $EN=array('c','c','g','g','o','o','u','u','s','s','i','i');
 //türkçe karakterleri de?i?tirir
 $baslik= str_replace($TR,$EN,$baslik);
 //tüm karakterleri küçüklür
 $baslik=strtolower($baslik);
 // a'dan z'ye olan harfler, 0'dan 9 a kadar sayylar, tire (-), bo?luk ve alt çizgi (_)
 // dy?yndaki tüm karakteri siler
 $baslik=preg_replace('#[^-a-zA-Z0-9_ ]#','',$baslik);
 //cümle aralaryndaki fazla bo?lu?ü kaldyryr
 $baslik=trim($baslik);
 //cümle aralaryndaki bo?lu?un yerine tire (-) koyar
 $baslik=preg_replace('#[-_ ]+#','-',$baslik);
 return $baslik;
}

function full_url_yarat ($id, $baslik,  $type="")
{
  //type bilgisi varsa uygun url üretilir
  if ($type!="") 
   return sprintf('haberler/%s/%s/%s.html',$type,$id,url_baslik_yarat($baslik));
  else
   return sprintf('haberler/%s/%s.html',$id,url_baslik_yarat($baslik));
}

function trReplace($veri) 
{
$veri = str_replace("İ","&#304;",$veri); 
$veri = str_replace("ı","&#305;",$veri ); 
$veri = str_replace("Ö","&#214;",$veri); 
$veri = str_replace("ö","&#246;",$veri ); 
$veri = str_replace("Ü","&#220;",$veri ); 
$veri = str_replace("ü","&#252;",$veri); 
$veri = str_replace("Ç","&#199;",$veri ); 
$veri = str_replace("ç","&#231;",$veri); 
$veri = str_replace("Ğ","&#286;",$veri ); 
$veri = str_replace("ğ","&#286;",$veri); 
$veri = str_replace("Ş","&#350;",$veri ); 
$veri = str_replace("ş","&#351;",$veri); 
return $veri;
} 


function ayacevir($veri) 
{
	switch ($veri) {
		case "01": $aycevir = "Ocak"; break;
		case "02": $aycevir = "Şubat"; break;
		case "03": $aycevir = "Mart"; break;
		case "04": $aycevir = "Nisan"; break;
		case "05": $aycevir = "Mayıs"; break;
		case "06": $aycevir = "Haziran"; break;
		case "07": $aycevir = "Temmuz"; break;
		case "08": $aycevir = "Ağustos"; break;
		case "09": $aycevir = "Eylül"; break;
		case "10": $aycevir = "Ekim"; break;
		case "11": $aycevir = "Kasım"; break;
		case "12": $aycevir = "Aralık"; break;
	}
	return $aycevir;
}

function totalForm($table,$val)
{
	global $db;
	$db->where('kid', $val);
	$total['total'] = $db->getValue ($table, "count(id)");
	$db->where('kid', $val);
	$db->where("date", "%".date('Y-m-d')."%", 'like');
	$total['today'] = $db->getValue ($table, "count(id)");
	return $total;
}

function chartAylik() 
{
	global $db;
	$buay[6] = intval(date('m'));
	$buyil[6] = intval(date('Y'));
	$buay_toplam['ay'][6]= ayacevir($buay[6]);


	$buay[5] = $buay[6]-1;
	$buyil[5] = $buyil[6];
	if($buay[5]<1){
		$buay[5] = 12;
		$buyil[5]=$buyil[5]-1;
	}
	$buay_toplam['ay'][5]= ayacevir($buay[5]);

	$buay[4] = $buay[5]-1;
	$buyil[4] = $buyil[6];
	if($buay[4]<1){
		$buay[4] = 12;
		$buyil[4]=$buyil[4]-1;
	}
	$buay_toplam['ay'][4]= ayacevir($buay[4]);

	$buay[3] = $buay[4]-1;
	$buyil[3] = $buyil[6];
	if($buay[3]<1){
		$buay[3] = 12;
		$buyil[3]=$buyil[3]-1;
	}
	$buay_toplam['ay'][3]= ayacevir($buay[3]);

	$buay[2] = $buay[3]-1;
	$buyil[2] = $buyil[6];
	if($buay[2]<1){
		$buay[2] = 12;
		$buyil[2]=$buyil[2]-1;
	}
	$buay_toplam['ay'][2]= ayacevir($buay[2]);

	$buay[1] = $buay[2]-1;
	$buyil[1] = $buyil[6];
	if($buay[1]<1){
		$buay[1] = 12;
		$buyil[1]=$buyil[1]-1;
	}
	$buay_toplam['ay'][1]= ayacevir($buay[1]);

	if($buay[6]<10)
		$buay[6] = "0".$buay[6];

	if($buay[5]<10)
		$buay[5] = "0".$buay[5];

	if($buay[4]<10)
		$buay[4] = "0".$buay[4];

	if($buay[3]<10)
		$buay[3] = "0".$buay[3];

	if($buay[2]<10)
		$buay[2] = "0".$buay[2];

	if($buay[1]<10)
		$buay[1] = "0".$buay[1];

	$buay_baslangic[6] = $buyil[6]."-".$buay[6]."-01";
	$buay_bitis[6] = $buyil[6]."-".$buay[6]."-31";
	$db->where('date', $buay_baslangic[6], ">=");
	$db->where('date', $buay_bitis[6], "<=");
	$db->where('kid', 1);
	$buay_toplam[6] = $db->getValue ("netia_contact_form", "count(id)");

	$buay_baslangic[5] = $buyil[5]."-".$buay[5]."-01";
	$buay_bitis[5] = $buyil[5]."-".$buay[5]."-31";
	$db->where ('date', $buay_baslangic[5], ">=");
	$db->where ('date', $buay_bitis[5], "<=");
	$db->where ('kid', 1);
	$buay_toplam[5] = $db->getValue ("netia_contact_form", "count(id)");

	$buay_baslangic[4] = $buyil[4]."-".$buay[4]."-01";
	$buay_bitis[4] = $buyil[4]."-".$buay[4]."-31";
	$db->where ('date', $buay_baslangic[4], ">=");
	$db->where ('date', $buay_bitis[4], "<=");
	$db->where ('kid', 1);
	$buay_toplam[4] = $db->getValue ("netia_contact_form", "count(id)");

	$buay_baslangic[3] = $buyil[3]."-".$buay[3]."-01";
	$buay_bitis[3] = $buyil[3]."-".$buay[3]."-31";
	$db->where ('date', $buay_baslangic[3], ">=");
	$db->where ('date', $buay_bitis[3], "<=");
	$db->where ('kid', 1);
	$buay_toplam[3] = $db->getValue ("netia_contact_form", "count(id)");

	$buay_baslangic[2] = $buyil[2]."-".$buay[2]."-01";
	$buay_bitis[2] = $buyil[2]."-".$buay[2]."-31";
	$db->where ('date', $buay_baslangic[2], ">=");
	$db->where ('date', $buay_bitis[2], "<=");
	$db->where ('kid', 1);
	$buay_toplam[2] = $db->getValue ("netia_contact_form", "count(id)");

	$buay_baslangic[1] = $buyil[1]."-".$buay[1]."-01";
	$buay_bitis[1] = $buyil[1]."-".$buay[1]."-31";
	$db->where ('date', $buay_baslangic[1], ">=");
	$db->where ('date', $buay_bitis[1], "<=");
	$db->where ('kid', 1);
	$buay_toplam[1] = $db->getValue ("netia_contact_form", "count(id)");
	return $buay_toplam;
}

function kisalt($metin, $uzunluk){
  	// substr ile belirlenen uzunlukta kesiyoruz
        $metin = substr($metin, 0, $uzunluk)."...";
	// kesilen metindeki son kelimeyi buluyoruz
        $metin_son = strrchr($metin, " ");
	// son kelimeyi " ..." ile değiştiriyoruz
        $metin = str_replace($metin_son," ...", $metin);
        
        return $metin;
}

 function t_decode($degisken){
	$degisken= html_entity_decode($degisken, ENT_QUOTES,"UTF-8");
    return $degisken;
}

?>