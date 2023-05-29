<?php 

$bugun = date("d-m-Y");

$customerReport = "Satın-Alma-Detayli-Talep-Listesi-".$bugun."-report.xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$customerReport);  //File name extension was wrong
header("Expires: 0");

include('inc.php');
?>

	<table class="table table-striped mb-none">
		<thead>
			<tr style="height:40px;">
                <th colspan="12" style="background-color:#f9f9f9; text-align: center; font-size: 15px; border-bottom: 1px dashed #666" width="150">SATIN ALMA DETAYLI TALEP LİSTESİ (<?php echo date("d.m.Y"); ?>)</th>
            </tr>
			<tr>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="25">#</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="120">Tarih</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="500">Eğitim Adı</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="120">Eğitim Tarihi</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="100">Ad Soyad</th>	
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="100">Unvan</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="200">Telefon</th>					
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">E-mail</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="300">Firma</th>	
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="150">Firma Telefon</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="100">Fatura Tipi</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="400">Fatura Adı</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Fatura Email</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="150">Fatura Telefon</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="200">Vergi Dairesi</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="100">Vergi No</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="400">Adres</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="200">Not</th>
				

			</tr>
		</thead>
		<tbody>
			<?php 
				global $db;
				
				if($_GET['tarih_bas']<>"" OR $_GET['tarih_son']<>"" OR $_GET['edu_id']<>"" OR $_GET['sirket']<>""){
					$tarih_bas = toMysqlDate($_GET['tarih_bas']);
					$tarih_son = toMysqlDate($_GET['tarih_son']);
					
					$db->orderBy("id","desc");
					if($tarih_bas<>"") {
						$db->where ('kayit_tarihi', $tarih_bas, ">=");
					}
					if($tarih_son<>"") {
						$db->where ('kayit_tarihi', $tarih_son, "<=");
					}
					
					if($_GET['edu_id']<>"" AND $_GET['edu_id']<>"0")
						$db->where("edu_id", $_GET['edu_id']);
					if($_GET['sirket']<>"")
						$db->where("fatura_adi", "%".$_GET['sirket']."%", 'like');
					if($_GET['adsoyad']<>"")
						$db->where("adsoyad", "%".$_GET['adsoyad']."%", 'like');
					if($_GET['email']<>"")
						$db->where("email", "%".$_GET['email']."%", 'like');
				} elseif($_GET['ozel_id']>0){
					
					$db->where("edu_cal_id", intval($_GET['ozel_id']));
				}
				
				$results = $db->get('education_order_person_list', Array (0, 2000));
				

				foreach ($results as $value) {
					$db->where('id', $value['order_id']);
					$orderResults = $db->getOne('education_order_form_list');
					$i++;
			?> 
			<tr>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $i; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo date2Human($value['kayit_tarihi']); ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['egitim_adi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><span class="badge badge-warning"><?php echo date2Human($value['egitim_tarih']); ?></span></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['adsoyad']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['unvan']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['telefon']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['email']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['firma']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['firma_telefon']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $orderResults['fatura_tipi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['fatura_adi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['email']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['telefon']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $orderResults['vergi_dairesi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $orderResults['vergi_no']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $orderResults['adres']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['not']; ?></td>
				
			</tr>
			<?php } ?>
			
			  
		</tbody>
	</table>
