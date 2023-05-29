<?php include('inc.php'); ?>
<div class="table-responsive">
	<table class="table table-striped mb-none">
		<thead>
			<tr>
				<th>#</th>
				<th>Resim</th>
				<th>Kategoriler</th>
				<th>Başlık</th>
				<th>Güncelleme Tarihi</th>
				<th>Durum</th>
				<th style="width: 130px;"></th>
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
				if($_POST['baslik']<>"")
					$db->where("baslik", "%".$_POST['baslik']."%", 'like');
				if($_POST['kategori']<>"0")
					$db->where("kategoriler", "%".$_POST['kategori']."%", 'like');
				
				if($_POST['edu_type']<>"0")
					$db->where("type_ismi", "%".$_POST['edu_type']."%", 'like');	
				$results = $db->get('education_list', Array (0, 500));
				$i=0;
				foreach ($results as $value) {
					$i++;
					$kategoriler = explode(',',$value['kategoriler']);
			?>
			<tr onclick="window.location.href = 'egitim_takvim_detay.php?id=<?php echo $value['id']; ?>';">
				<td><?php echo $i; ?></td>
				<td><img src="../<?php echo $value['resim']; ?>" width="100" height:auto; /> </td>
				<td><?php foreach($kategoriler as $key) { echo '<span class="badge badge-warning">'.$key.'</span><br/>'; } ?></td>
				<td><?php echo $value['baslik']; ?> </td>
				<td><?php echo date2Human($value['kayit_tarihi']); ?> </td>
				<td><span class="badge badge-<?php echo ($value['durum']==0 ? 'danger' : 'success');?>"><?php echo ($value['durum']==0 ? 'Pasif' : 'Aktif');?></span></td>
				<td align="right">
					<a data-placement="top" data-toggle="tooltip" title="Eğitim Takvimi Oluştur" href="egitim_takvim_ekle.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-xs btn-warning"><i class="fa fa-clock-o"></i></a>
				
					<a data-placement="top" data-toggle="tooltip" title="Eğitim Güncelle" href="egitim_edit.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
				
					<a data-placement="top" data-toggle="tooltip" title="Eğitim Sil" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="mb-1 mt-1 mr-1 btn btn-xs btn-danger" href="egitim_del.php?id=<?php echo $value['id']; ?>"><i class="fa fa-trash-o"></i></a>
				</td>	
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