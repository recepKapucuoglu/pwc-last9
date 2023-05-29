<?php include('_header.php'); ?>	
				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eski Eğitimler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eski Eğitim Görüntüleme</span></li>
			</ol>
		</div>
	</header>
	
	<?php
		
		$db->where('edu_id', intval($_GET["id"]));
		$results = $db->get('eski_education_list');
		foreach ($results as $value) {
			$eski_id			=	$value['id'];
			$kategori				=	$value['edu_cat_name'];
			$baslik				=	$value['edu_name'];
			$aciklama			=	$value['edu_desc'];
			$kimler_katilmali	=	$value['edu_who'];
			$neden_katilmali	=	$value['edu_why'];
			$kelimeler		=	$value['edu_keyword'];
			$not			=	$value['edu_ip'];
			$tarih			=	$value['edu_createdate'];

		}
		
	?> 
	
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li class="nav-item active">
				<a class="nav-link" href="#egitimDetay" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Eğitim Detayları</a>
			</li>
		
		</ul>
		<div class="tab-content">
			<div id="egitimDetay" class="tab-pane active">
				<form action="eski_egitim_edit.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" />
						<div class="form-body">
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Tarih</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-clock-o"></i></span>
										</span>
										<input class="form-control" placeholder="Tarih" name="tarih" value="<?php echo $tarih; ?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Kategori</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-graduation-cap"></i></span>
										</span>
										<input class="form-control" placeholder="Eğitim Kategori"  value="<?php echo $kategori; ?>" name="kategori" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Başlık</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-graduation-cap"></i></span>
										</span>
										<input class="form-control" placeholder="Eğitim Başlık"  value="<?php echo $baslik; ?>" name="baslik" type="text">
									</div>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Açıklama</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="aciklama" maxlength="10000" rows="10"><?php echo $aciklama; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Kimler Katılmalı</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="kimler_katilmali" maxlength="10000" rows="10"><?php echo $kimler_katilmali; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Neden Katılmalı</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="neden_katilmali" maxlength="10000" rows="10"><?php echo $neden_katilmali; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Not</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="not" maxlength="10000" rows="10"><?php echo $not; ?></textarea>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Anahtar Kelime</label>
								<div class="col-md-8">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-link"></i></span>
										</span>
										<input class="form-control" placeholder="kelimeler" value="<?php echo $kelimeler; ?>" name="kelimeler" type="text">
										
									</div>
								</div>
								
							</div>
							

						</div>
					</form>
			</div>
			
		</div>
		
	</div>
	
	

</section>

			
<?php include('_footer.php'); ?>			
			
		