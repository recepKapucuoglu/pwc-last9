<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Slide</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Slide Listesi</span></li>
			</ol>
		</div>
	</header>
	<div class="row">
		<div class="col-md-12">

			<section class="card card-featured card-featured-primary">
				<?php
				if($_POST['sira']) {
					foreach ($_POST['id'] as $k => $row)
					{
						$data = Array (
							'sira' => $_POST['sira'][$k]
						);
						$db->where ('id', $_POST['id'][$k]);
						$db->update ('slide', $data);
					}
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Sıralama Güncellenmiştir.
						  </div>";
				}
				?>
				<form name="slideForm" action="slide_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a rel="tooltip"  data-placement="bottom" data-toggle="tooltip" title="Slide Sıralama Güncelle"  href="#" onclick="slideForm.submit();return false;" class="fa fa-save"></a>
						<a rel="tooltip" data-placement="bottom" data-toggle="tooltip" title="Yeni Slide Ekle"  href="slide_ekle.php" class="fa fa-plus"></a>
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Slide Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Resim</th>
										<th>Başlık</th>
										<th>Sıra</th>
										<th>Kayıt Tarihi</th>
										<th>Durum</th>
										<th width="5px"></th>
										<th width="5px"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										$db->orderBy("dil","desc");
										$db->orderBy("sira","asc");
										$results = $db->get('slide');
										foreach ($results as $value) {
											$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><img src="../<?php echo $value['resim']; ?>" width="100" height:auto; /> </td>
										<td><?php echo $value['baslik']; ?> </td>
										<td>
											<input name="id[]" class="InputStyle2" type="hidden" value="<?=$value['id']?>" size="3" maxlength="3" />
											<input name="sira[]" class="InputStyle2" type="text" value="<?=$value['sira']?>" size="3" maxlength="3" />
										</td>
										<td><?php echo date2Human($value['kayit_tarihi']); ?> </td>
										<td><span class="badge badge-<?php echo ($value['durum']==0 ? 'danger' : 'success');?>"><?php echo ($value['durum']==0 ? 'Pasif' : 'Aktif');?></span></td>
										<td align="right">
											<a data-placement="top" data-toggle="tooltip" title="Slide Güncelle" href="slide_edit.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-info"><i class="fa fa-edit"></i></a>
										</td>
										<td align="right">
											<a data-placement="top" data-toggle="tooltip" title="Slide Sil" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="mb-1 mt-1 mr-1 btn btn-danger" href="slide_del.php?id=<?php echo $value['id']; ?>"><i class="fa fa-trash-o"></i></a>
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