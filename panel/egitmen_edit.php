<?php include('_header.php'); ?>				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eğitmen</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eğitmen İşlemleri</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Eğitmen Güncelleme
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['adsoyad'])
			{
				$eski_id=$_POST['eski_id'];
				
				if($_FILES["resim"]["name"]) {
					$resim_baslik=url_baslik_yarat($_POST['resim_alt_etiket']);		
					$resim = $_FILES["resim"]["name"];
					$fileType=$_FILES["resim"]["type"]; 
						switch($fileType){ 
						  case "image/jpg"            :$typeResult="A"; $typeUzanti=".jpg"; break;
						  case "image/jpeg"           :$typeResult="A"; $typeUzanti=".jpg"; break;
						  case "image/pjpeg"          :$typeResult="A"; $typeUzanti=".pjpeg"; break;
						  case "image/gif"            :$typeResult="A"; $typeUzanti=".gif"; break;
						  case "image/png"            :$typeResult="A"; $typeUzanti=".png"; break;
						}			
					if(($resim <> "") && ($typeResult=="A")) {
						$resim = $resim_baslik.$typeUzanti;
						define ('SITE_ROOT', realpath(dirname(__FILE__)));
						move_uploaded_file($_FILES["resim"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/egitmen/".$resim);
						$resim="/dosyalar/images/icerik/egitmen/".$resim;
						$data = Array (
							'resim' => $resim,
						);
						$db->where ('id', $eski_id);
						$db->update ('instructor', $data);
					}
					
				}
				
				
				$linkedin = isset($_POST['linkedin']) ? t_code($_POST['linkedin']) : null;
		
				$data = Array (
					'adsoyad' 			=> t_code($_POST['adsoyad']),
					'aciklama' 			=> t_code($_POST['aciklama']),
					'linkedin' => $linkedin,
					'resim_alt_etiket' 	=> tirnak_replace($_POST['resim_alt_etiket']),
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
				$db->where ('id', $eski_id);
				$id = $db->update ('instructor', $data);
				if ($id) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
						  </div>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
			}else {
				$db->where('id', intval($_GET["id"]));
				$results = $db->get('instructor');
				foreach ($results as $value) {
					$eski_id			=	$value['id'];
					$adsoyad				=	$value['adsoyad'];
					$aciklama			=	$value['aciklama'];
					
					$resim_alt_etiket	=	$value['resim_alt_etiket'];
					$resim				=	$value['resim'];
					$old_linkedin = $value['linkedin'];
				}

			}
		?> 
		<div class="row">
			<div class="col-md-12">
						<form action="egitmen_edit.php?id=<?=$eski_id?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" />
							<div class="form-body">
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Ad Soyad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" placeholder="Ad Soyad" name="adsoyad" value="<?php echo $adsoyad; ?>" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Linkedin</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-linkedin"></i></span>
											</span>
											<input class="form-control" placeholder="Linkedin hesabı" name="linkedin" value="<?php echo $old_linkedin; ?>" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Kısa Açıklama</label>
									<div class="col-md-8">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-edit"></i></span>
											</span>
											<input class="form-control" placeholder="Kısa Açıklama" name="aciklama" value="<?php echo $aciklama; ?>" type="text">
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Resim Alt Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-tags"></i></span>
											</span>
											<input class="form-control" placeholder="Resim Alt Başlık" name="resim_alt_etiket" value="<?php echo $resim_alt_etiket; ?>" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Resim</label>
									<div class="col-md-3">
										<input type="file" class="default"  name="resim"/>
										<span class="help-block">
											  Yükseklik. <code>400</code> Genişlik. <code>400</code>
										</span>
										<div class="fileupload-new thumbnail" style="width: 200px; height: 200px;">
											<img src="../<?php echo $resim; ?>" width="200" height:auto/>
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
			
		