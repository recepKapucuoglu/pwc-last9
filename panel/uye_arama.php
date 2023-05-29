<?php include('inc.php'); ?>
<div class="table-responsive">
	<table class="table table-striped mb-none">
		<thead>
			<tr>
				<th>#</th>
				<th>Kayıt Tarih</th>
				<th>Ad Soyad</th>
				<th>Unvan</th>
				<th>E-mail</th>
				<th>Telefon</th>
				<th>Şirket Adı</th>
			</tr>
		</thead>
		<tbody>
			<?php
				global $db;
				$tarih_bas = toMysqlDate($_POST['tarih_bas']);
				$tarih_son = toMysqlDate($_POST['tarih_son']);
				
				
				$db->orderBy("id","desc");
				if($tarih_bas<>"") {
					$db->where ('created_date', $tarih_bas, ">=");
				}
				if($tarih_son<>"") {
					$db->where ('created_date', $tarih_son, "<=");
				}
				if($_POST['adsoyad']<>"")
					$db->where("fullname", "%".$_POST['adsoyad']."%", 'like');
				if($_POST['email']<>"")
					$db->where("email", "%".$_POST['email']."%", 'like');
				if($_POST['sirket']<>"")
					$db->where("company", "%".$_POST['sirket']."%", 'like');
				$results = $db->get('web_user', Array (0, 2000));
				foreach ($results as $value) {
					$i++;
					
			?>
			<tr onclick="window.location.href = 'uye_detay.php?id=<?php echo $value['id']; ?>';"> 
				<td><?php echo $i; ?></td>
				<td><?php echo date2Human($value['created_date']); ?></td>
				<td><?php echo $value['fullname']; ?></td>
				<td><?php echo $value['title']; ?></td>
				<td><?php echo $value['email']; ?></td>
				<td><?php echo $value['phone']; ?></td>
				<td><?php echo $value['company']; ?></td>
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