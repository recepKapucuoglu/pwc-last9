<?php include('inc.php'); ?>
<div class="table-responsive">
	<table class="table table-striped mb-none">
		<thead>
			<tr>
				<th>#</th>
				<th>Resim</th>
				<th>Dil</th>
				<th>Blok Yeri</th>
				<th>Başlık</th>
				<th>Güncellenme Tarihi</th>
				<th width="5px"></th>
			</tr>
		</thead>
		<tbody>
			<?php
				global $db;
				$i=0;
				$db->orderBy("dil","desc");
				if($_POST['dil']<>"")
					$db->where("dil",$_POST['dil']);
				if($_POST['baslik']<>"")
					$db->where("baslik", "%".$_POST['baslik']."%", 'like');
				if($_POST['site_yeri']<>"")
					$db->where("site_yeri", "%".$_POST['site_yeri']."%", 'like');
				$results = $db->get('page');
				foreach ($results as $value) {
					$i++;
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php if($value['resim']<>"") { ?><img src="../<?php echo $value['resim']; ?>" width="150" height:auto; /><?php } ?> </td>
				<td><?php echo $value['dil']; ?> </td>
				<td><?php echo $value['site_yeri']; ?> </td>
				<td><?php echo $value['baslik']; ?> </td>
				<td><?php echo date2Human($value['kayit_tarihi']); ?> </td>
				<td align="right">
					<a  href="icerik_edit.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-info"><i class="fa fa-edit"></i></a>
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