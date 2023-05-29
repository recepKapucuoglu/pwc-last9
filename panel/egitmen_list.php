<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eğitmenler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eğitmen Listesi</span></li>
			</ol>
		</div>
	</header>
	<div class="row">
		<div class="col-md-12">

			<section class="card card-featured card-featured-primary">
			
				<form name="slideForm" action="slide_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a rel="tooltip" data-placement="bottom" data-toggle="tooltip" title="Yeni Eğitmen Ekle"  href="egitmen_ekle.php" class="fa fa-plus"></a>
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Eğitmen Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Resim</th>
										<th>Ad Soyad</th>
										<th>Açıklama</th>
										<th>Kayıt Tarihi</th>
										<th width="5px"></th>
										<th width="5px"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										$db->orderBy("adsoyad","asc");
										$results = $db->get('instructor');
										foreach ($results as $value) {
											$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><img src="../<?php echo $value['resim']; ?>" width="100" height:auto; /> </td>
										<td><?php echo $value['adsoyad']; ?> </td>
										<td><?php echo $value['aciklama']; ?> </td>
										
										<td><?php echo date2Human($value['kayit_tarihi']); ?> </td>
										<td align="right">
											<a data-placement="top" data-toggle="tooltip" title="Eğitmen Güncelle" href="egitmen_edit.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-info"><i class="fa fa-edit"></i></a>
										</td>
										<td align="right">
											<a data-placement="top" data-toggle="tooltip" title="Eğitmen Sil" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="mb-1 mt-1 mr-1 btn btn-danger" href="egitmen_del.php?id=<?php echo $value['id']; ?>"><i class="fa fa-trash-o"></i></a>
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