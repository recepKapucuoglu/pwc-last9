<?php include('inc.php'); ?>
<div class="table-responsive">
	<table class="table table-striped mb-none">
		<thead>
			<tr>
				<th>#</th>
				<th>Tarih</th>
				<th>Eğitim Adı</th>
				<th>Eğitim Tarihi</th>
				<th>Fatura Adı</th>
				<th>Ad Soyad</th>
				<th>Email</th>
				<th>Telefon</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
				global $db;
				$tarih_bas = toMysqlDate($_POST['tarih_bas']);
				$tarih_son = toMysqlDate($_POST['tarih_son']);
				
				$db->orderBy("id","desc");
				if($tarih_bas<>"") {
					$db->where ('kayit_tarihi', $tarih_bas, ">=");
				}
				if($tarih_son<>"") {
					$db->where ('kayit_tarihi', $tarih_son, "<=");
				}
				
				if($_POST['edu_id']<>"" AND $_POST['edu_id']<>"0")
					$db->where("edu_id", $_POST['edu_id']);
				if($_POST['sirket']<>"")
					$db->where("fatura_adi", "%".$_POST['sirket']."%", 'like');
				if($_POST['adsoyad']<>"")
					$db->where("adsoyad", "%".$_POST['adsoyad']."%", 'like');
				if($_POST['email']<>"")
					$db->where("email", "%".$_POST['email']."%", 'like');
				$results = $db->get('education_order_person_list', Array (0, 2000));
				foreach ($results as $value) {
					$i++;
					
			?>
			<tr onclick="window.location.href = 'siparis_detay.php?id=<?php echo $value['id']; ?>';"> 
				<td><?php echo $i; ?></td>
				<td><?php echo date2Human($value['kayit_tarihi']); ?></td>
				<td><?php echo $value['egitim_adi']; ?></td>
				<td><span class="badge badge-warning"><?php echo date2Human($value['egitim_tarih']); ?></span></td>
				<td><?php echo $value['fatura_adi']; ?></td>
				<td><?php echo $value['adsoyad']; ?></td>
				<td><?php echo $value['email']; ?></td>
				<td><?php echo $value['telefon']; ?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script>
		$('.ajax-popup-link').magnificPopup({
		  type: 'ajax'
		});

</script>