<?php 

$bugun = date("d-m-Y");

$customerReport = "Satın-Alma-Talebi-".$bugun."-report.xls";
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$customerReport);  //File name extension was wrong
header("Expires: 0");

include('inc.php');
?>

	<table class="table table-striped mb-none">
		<thead>
			<tr style="height:40px;">
                <th colspan="7" style="background-color:#f9f9f9; text-align: center; font-size: 15px; border-bottom: 1px dashed #666" width="150">SATIN ALMA TALEP LİSTESİ (<?php echo date("d.m.Y"); ?>)</th>
            </tr>
			<tr>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="25">#</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="120">Tarih</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="600">Eğitim Adı</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="120">Eğitim Tarihi</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="250">Fatura Adı</th>
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="100">Tutar</th>	
				<th style="background-color:#c5b2b2; text-align: center; border-bottom: 1px dashed #666" width="70">Katılımcı Sayısı</th>					
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
					
				} elseif($_GET['ozel_id']>0){
					
					$db->where("edu_cal_id", intval($_GET['ozel_id']));
				}
				
				
				
				
				$results = $db->get('education_order_form_list', Array (0, 2000));
				foreach ($results as $value) {
					$i++;
			?> 
			<tr>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $i; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo date2Human($value['kayit_tarihi']); ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['egitim_adi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><span class="badge badge-warning"><?php echo date2Human($value['egitim_tarih']); ?></span></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['fatura_adi']; ?></td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo number_format($value['tutar'], 2, ',', '.'); ?> TL</td>
				<td style="text-align:center; background-color: <?php echo $bgColor; ?>"><?php echo $value['katilimci_sayisi']; ?></td>
				
				
			</tr>
			<?php } ?>
			
			  
		</tbody>
	</table>
