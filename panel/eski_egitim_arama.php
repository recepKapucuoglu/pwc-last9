<?php include('inc.php'); ?>
<div class="table-responsive">
	<table class="table table-striped mb-none">
			<thead>
				<tr>
					<th>#</th>
					<th>Kategori</th>
					<th>Başlık</th>
					<th>Tarihi</th>
					<th style="width: 130px;"></th>
				</tr>
			</thead>
			<tbody>
			<?php
				global $db;
				$db->orderBy("edu_id","desc");
			
				if($_POST['baslik']<>"")
					$db->where("edu_name", "%".$_POST['baslik']."%", 'like');
				if($_POST['kategori']<>"0")
					$db->where("edu_cat_id", $_POST['kategori']);
				
				$results = $db->get('eski_education_list');
				foreach ($results as $value) {
					$i++;

			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $value['edu_cat_name']; ?> </td>
				<td><?php echo $value['edu_name']; ?> </td>
				<td><?php echo $value['edu_createdate']; ?> </td>
				<td align="right">
					<a data-placement="top" data-toggle="tooltip" title="Eğitim Göster" href="eski_egitim_edit.php?id=<?php echo $value['edu_id']; ?>" class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
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