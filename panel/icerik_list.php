<?php include('_header.php'); 
error_reporting(E_ALL & ~E_NOTICE);
?>	

<section role="main" class="content-body">
	<header class="page-header">
		<h2>İçerikler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>İçerikler Listesi</span></li>
			</ol>
		</div>
	</header>
	
	<div class="row">
		<div class="col-md-12">
			<section class="card panel-featured card-featured-primary">
			<?php
				if($_POST['sira']) {
					foreach ($_POST['id'] as $k => $row)
					{
						$data = Array (
							'sira' => $_POST['sira'][$k]
						);
						$db->where ('id', $_POST['id'][$k]);
						$db->update ('page', $data);
					}
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Sıralama Güncellenmiştir.
						  </div>";
				}
				?>
				<form name="icerikForm" action="icerik_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a rel="tooltip"  data-placement="bottom" data-toggle="tooltip" title="Sıralama Güncelle"  href="#" onclick="icerikForm.submit();return false;" class="fa fa-save"></a>
						<a rel="tooltip" data-placement="bottom" data-toggle="tooltip" title="Yeni İçerik Ekle"  href="icerik_ekle.php" class="fa fa-plus"></a>
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">İçerik Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Banner</th>
										<th>Başlık</th>
										<th>Sıra</th>
										<th>Sayfa URL</th>
										<th>Durum</th>
										<th>Site Konum</th>
										<th>Güncellenme Tarihi</th>
										<th width="5px"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										$db->orderBy("anamenu","desc");
										$db->orderBy("sira","asc");
										$results = $db->get('page');
										foreach ($results as $value) {
											$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php if($value['banner']<>"") { ?><img src="../<?php echo $value['banner']; ?>" width="150" height:auto; /><?php } ?> </td>
										<td><?php echo $value['baslik']; ?> </td>
										<td>
											<input name="id[]" class="InputStyle2" type="hidden" value="<?=$value['id']?>" size="3" maxlength="3" />
											<input name="sira[]" class="InputStyle2" type="text" value="<?=$value['sira']?>" size="3" maxlength="3" />
										</td>
										<td><?php echo $value['seo_url']; ?> </td>
										<td><span class="badge badge-<?php echo ($value['durum']==0 ? 'danger' : 'success');?>"><?php echo ($value['durum']==0 ? 'Pasif' : 'Aktif');?></span></td>
										<td><span class="badge badge-<?php echo ($value['anamenu']==0 ? 'warning' : 'primary');?>"><?php echo ($value['anamenu']==0 ? 'Diğer' : 'Anamenü');?></span></td>
										<td><?php echo date2Human($value['kayit_tarihi']); ?> </td>
										<td align="right">
											<a  href="icerik_edit.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-info"><i class="fa fa-edit"></i></a>
										</td>	
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				</form>
			</section>
		</div>
	</div>
</section>
			

<?php include('_footer.php'); ?>		