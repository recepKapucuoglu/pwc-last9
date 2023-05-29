<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eğitimler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eğitim Listesi</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Talep Filtreleme
			
			</h2>
		</header>
		<div class="card-body">
			<form id="quicksearch" method="post" onsubmit="return egitim_search();">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<label for="">
							Tarih Aralığı<br>
							<label for="" class="w50">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-calendar"></i></span>
									</span>
									<input type="text" name="tarih_bas" data-plugin-datepicker class="form-control"/>
								</div>
							</label>
							<label for="" class="w50">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-calendar"></i></span>
									</span>
									<input type="text" name="tarih_son" data-plugin-datepicker class="form-control"/>
								</div>
							</label>
						</label>
					</div>
					<div class="col-md-3 col-sm-6">
						<label for="">Kategori Seçiniz<br/>
								<select data-plugin-selectTwo class="form-control populate" name="kategori">
									<option value="0">Tümünü Göster</option>
									<?php
										$db->orderBy("sira","asc");
										$results = $db->get('categories');
										foreach ($results as $value) {
											echo "<option value=\"".$value['baslik']."\">".$value['baslik']."</option>";
										}
									?>
								</select>
						</label>
					</div>
					<div class="col-md-3 col-sm-6">
						<label for="">Eğitim Tipi Seçiniz<br/>
								<select data-plugin-selectTwo class="form-control populate" name="edu_type">
									<option value="0">Tümünü Göster</option>
									<?php
										// $db->orderBy("sira","asc");
										$results = $db->get('education_type');
										foreach ($results as $value) {
											echo "<option value=\"".$value['type']."\">".$value['type']."</option>";
										}
									?>
								</select>
						</label>
					</div>
					<div class="col-md-3 col-sm-6">
						<label for="">
							Eğitim Adı<br>
							<label for="">
								<div class="input-group input-group-icon">
									<span class="input-group-addon">
										<span class="icon"><i class="fa fa-building"></i></span>
									</span>
									<input type="text" name="baslik" class="form-control" placeholder="Eğitim Adı" />
								</div>
							</label>
						</label>
					</div>
					
					
					<div class="col-md-2 col-sm-6">
						<label for="">&nbsp;<br>
							<button class="btn btn-sm btn-success" type="submit"><i class="fa fa-search"></i> Sonuçları Listele</button><br/><br/>
						</label>
					</div>
				</div>
			</form>
		</div>
	</section>
	<br/>
	<div class="row">
		<div class="col-md-12">

			<section class="card card-featured card-featured-primary">
				
				<form name="slideForm" action="egitim_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a rel="tooltip" data-placement="bottom" data-toggle="tooltip" title="Yeni Eğitim Ekle"  href="egitim_ekle.php" class="fa fa-plus"></a>
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
										<th>Kategoriler</th>
										<th>Başlık</th>
										<th>Güncelleme Tarihi</th>
										<th>Durum</th>
										<th style="width: 130px;"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										$db->orderBy("id","desc");
										$results = $db->get('education_list');
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
					</div>
				</div>
				</form>
			</section>
		</div>
	</div>
</section>
			

<?php include('_footer.php'); ?>		