<?php 

$bugun = date("d-m-Y");

$customerReport = "Talep-Listesi".$bugun."-report.xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$customerReport);  //File name extension was wrong
header("Expires: 0");

include('inc.php');
?>

	<table class="table table-striped mb-none">
		<thead>
			<tr style="height:40px;">
                <th colspan="11" style="background-color:#f9f9f9; text-align: center; font-size: 15px; border-bottom: 1px dashed #666" width="150">BİLGİ TALEP LİSTESİ (<?php echo date("d.m.Y"); ?>)</th>
            </tr>
			<tr>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="25">#</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="120">Tarih</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="600">Eğitim Adı</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="120">Eğitim Tarihi</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Şirket Adı</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Ad Soyad</th>	
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Email</th>	
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Telefon</th>	
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Eğitim Konu</th>					
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="70">Katılımcı Sayısı</th>					
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="100">Lokasyon</th>					
			</tr>
		</thead>
		<tbody>
			<?php 
				global $db;
				$tarih_bas = toMysqlDate($_POST['tarih_bas']);
				$tarih_son = toMysqlDate($_POST['tarih_son']);
				$talepTipi = $_POST['talepTipi'];
				
				if($talepTipi==1){
					$db->where('edu_id', 0, '<>');
				}
				$db->orderBy("id","desc");
				if($tarih_bas<>"") {
					$db->where ('kayit_tarihi', $tarih_bas, ">=");
				}
				if($tarih_son<>"") {
					$db->where ('kayit_tarihi', $tarih_son, "<=");
				}
				if($_POST['adsoyad']<>"")
					$db->where("adsoyad", "%".$_POST['adsoyad']."%", 'like');
				if($_POST['edu_id']<>"" AND $_POST['edu_id']<>"0")
					$db->where("edu_id", $_POST['edu_id']);
				if($_POST['sirket']<>"")
					$db->where("sirket", "%".$_POST['sirket']."%", 'like');
				$results = $db->get('education_info_form_list', Array (0, 2000));
				foreach ($results as $value) {
					$i++;
			?> 
			<tr>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $i; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo date2Human($value['kayit_tarihi']); ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['egitim_adi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><span class="badge badge-warning"><?php echo date2Human($value['egitim_tarih']); ?></span></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['sirket']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['adsoyad']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['telefon']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['email']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['egitim_konu']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['katilimci_sayisi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['lokasyon']; ?></td>
				
				
			</tr>
			<?php } ?>
			
			  
		</tbody>
	</table>
