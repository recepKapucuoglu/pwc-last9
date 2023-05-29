<?php include('_header.php'); ?>				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Kategoriler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Kategori İşlemleri</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Kategori Güncelleme
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['soru'])
			{
				$eski_id=$_POST['eski_id'];
		
				$data = Array (
					'soru' 			=> $_POST['soru'],
					'cevap' 			=> t_code($_POST['cevap']),
					'durum' 			=> $_POST['durum'],
					'sira' 			=> $_POST['sira'],
					'kayit_tarihi' 		=> $db->now()
				);
			
				$db->where ('id', $eski_id);
				$id = $db->update ('sss', $data);
				if ($id) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
						  </div>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
			}
			$db->where('id', intval($_GET["id"]));
			$results = $db->get('sss');
			foreach ($results as $value) {
				$eski_id			=	$value['id'];
				$soru				=	$value['soru'];
				$cevap			=	$value['cevap'];
				$durum				=	$value['durum'];
				$sira				=	$value['sira'];
			}

			
		?> 
		<div class="row">
			<div class="col-md-12">
				
						<form action="sss_edit.php?id=<?=$eski_id?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" />
							<div class="card-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Soru</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-text-width"></i></span>
											</span>
											<input class="form-control" placeholder="Başlık" id="url_generator" name="soru" value="<?php echo $soru; ?>" type="text">
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Cevap</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="cevap" maxlength="10000" rows="10"><?php echo $cevap; ?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Durum</label>
									<div class="col-md-3">
										<div class="switch switch-sm switch-success">
											<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($durum=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Sıra</label>
									<div class="col-md-3">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-sort-numeric-asc"></i></span>
											</span>
											<input class="form-control" placeholder="Sıra" name="sira" value="<?php echo $sira; ?>" type="text">
										</div>
									</div>
								</div>
								
								
								
								
								<div class="modal-footer">
									<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Güncelle</button>
								</div>
							</div>
						</form>
					
			</div>
		</div>
	</section>
</section>
<?php include('_footer.php'); ?>			
			
		