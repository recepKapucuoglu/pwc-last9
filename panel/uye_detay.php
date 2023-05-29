<?php include('_header.php'); ?>	
				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Üyeler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Üye İşlemleri</span></li>
			</ol>
		</div>
	</header>
	
	<?php
		 
		$db->where('id', intval($_GET["id"]));
		$results = $db->get('web_user');
		foreach ($results as $value) {
			$eski_id			=	$value['id'];
			$fullname				=	$value['fullname'];
			$company			=	$value['company'];
			$title	=	$value['title'];
			$email	=	$value['email'];
			$phone		=	$value['phone'];
			$created_date			=	$value['created_date'];
			$notification			=	$value['notification'];
			
		}
		
		
		
	?> 
	<?php 
						
		
		$db->where('user_id',$eski_id);
		$favoriTotal = $db->getValue ('web_user_favorite', "count(id)");
		
		
		$db->where('user_id',$eski_id);
		$egitimlerimTotal = $db->getValue ('education_order_form', "count(id)");
	?>
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li class="nav-item active">
				<a class="nav-link" href="#egitimDetay" data-toggle="tab"><i class="fa fa-star"></i> Üye Bilgileri</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#egitimTalep" data-toggle="tab"><span class="badge badge-primary"><?php echo $egitimlerimTotal; ?></span> Eğitim Talepleri</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#egitimSiparis" data-toggle="tab"><span class="badge badge-success"><?php echo $favoriTotal; ?></span> Favorilere Eklenen Eğitimler</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="egitimDetay" class="tab-pane active">
				<form action="uye_detay.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" />
						<div class="form-body">
							
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Kayıt Tarihi</label>
									<div class="col-md-3">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-calendar"></i></span>
											</span>
											<input type="text" name="kayit_tarihi" data-plugin-datepicker value="<?php echo date2Human($created_date); ?>" class="form-control" readonly/>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Ad Soyad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" value="<?php echo $fullname; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Unvan</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user-plus"></i></span>
											</span>
											<input class="form-control" value="<?php echo $title; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">E-mail</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-envelope"></i></span>
											</span>
											<input class="form-control" value="<?php echo $email; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Telefon</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-phone"></i></span>
											</span>
											<input class="form-control" value="<?php echo $phone; ?>" readonly type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Şirket</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-map-marker"></i></span>
											</span>
											<input class="form-control" value="<?php echo $company; ?>" readonly type="text">
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="control-label col-md-3 text-lg-right pt-2" for="inputDefault">Yeni açılan eğitimler için haberdar olmak istiyorum.</label>
									<div class="col-md-6" style="pointer-events:none;">
										<div class="switch switch-sm switch-danger">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($notification=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								
							
						</div>
					</form>
			</div>
			<div id="egitimTalep" class="tab-pane">
					
					<section class="card">
						<header class="card-header card-header-transparent">
							<h2 class="card-title">Eğitim Talepleri</h2>
							<p><?php echo $baslik; ?></p>
						</header>
						<div class="card-body">
							<?php if($egitimlerimTotal>0){ 
							
							echo "<div class=\"alert alert-success\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> Bu üyenin ".$egitimlerimTotal." adet eğitim talebi bulunmamaktadır. 
									</div>";
							?>
							<table class="table table-responsive-md table-striped mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Kayıt Tarihi</th>
										<th>Kayıt Numarası</th>
										<th>Eğitim Adı</th>
										<th>Katılımcı Sayısı</th>
										<th>Toplam Tutar</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=0;
										$db->where('user_id',  $eski_id);
										$resultsCalender = $db->get('web_education_order_list');
										foreach ($resultsCalender as $valueCalender) {
											$i++;
									?>			
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo date2Human($valueCalender['kayit_tarihi']); ?></td>
										<td><?php echo $valueCalender['siparis_id']; ?></td>
										<td><?php echo $valueCalender['baslik']; ?></td>
										<td><?php echo $valueCalender['katilimci_sayisi']; ?></td>
										<td><?php echo number_format($valueCalender['tutar'], 2, ',', '.'); ?> TL</td>
										<td align="right">
											
											<a data-placement="top" data-toggle="tooltip" title="Kayıt Detaylarını Göster" href="siparis_detay.php?id=<?php echo $valueCalender['order_id']; ?>" class="mb-1 mt-1 mr-1 btn btn-xs btn-danger"><i class="fa fa-eye"></i></a>
										
										</td>	
									</tr>
										<?php } ?>
									
									
								</tbody>
							</table>
							<?php } else {
									echo "<div class=\"alert alert-danger\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> Kayıt yapılan eğitim bulunmamaktadır. 
									</div>";
								} 
							?>
						</div>
					</section>
			</div>
			<div id="egitimSiparis" class="tab-pane">
					
					<section class="card">
						<header class="card-header card-header-transparent">
							<h2 class="card-title">Favorilere Eklenen Eğitimler</h2>
							
						</header>
						<div class="card-body">
							<?php if($favoriTotal>0){ 
							
							echo "<div class=\"alert alert-success\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> Bu üyenin ".$favoriTotal." adet favorilerine eklediği eğitim bulunmaktadır. 
									</div>";
							?>
							<table class="table table-responsive-md table-striped mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Tarih</th>
										<th>Eğitim Adı</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=0;
										$db->where('user_id', $eski_id);
										$resultsCalender = $db->get('web_favorite_list');
										foreach ($resultsCalender as $valueCalender) { 
											$i++;
									?>			
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo date2Human($valueCalender['created_date']); ?></td>
										<td><?php echo $valueCalender['baslik']; ?></td>
									
										
									</tr>
										<?php } ?>
									
									
								</tbody>
							</table>
							<?php } else {
									echo "<div class=\"alert alert-danger\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> Favorilere eklenen eğitim bulunmamaktadır. 
									</div>";
								} 
							?>
						</div>
					</section>
			</div>
		</div>
		
	</div>
	
	

</section>

			
<?php include('_footer.php'); ?>			
			
		