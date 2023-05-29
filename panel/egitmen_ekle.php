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
			<div class="card-actions">

				<a href="#" class="fa fa-caret-down"></a>
				<a href="#" class="fa fa-times"></a>
			</div>
			<h2 class="card-title">
				Yeni Eğitmen Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['adsoyad'])
			{
				
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
				}
				
				$linkedin = isset($_POST['linkedin']) ? t_code($_POST['linkedin']) : null;
		
				$data = Array (
					'id' 				=> NULL,
					'linkedin'          => $linkedin,
					'adsoyad' 			=> t_code($_POST['adsoyad']),
					'aciklama' 			=> t_code($_POST['aciklama']),
					'resim_alt_etiket' 	=> tirnak_replace($_POST['resim_alt_etiket']),
					'resim' 			=> $resim,
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
				$id = $db->insert ('instructor', $data);
				if ($id) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
						  </div>
						  <script language=\"JavaScript\">
							  function Git() {
								 location.href=\"egitmen_list.php\";
							  }
							  setTimeout(\"Git()\",4000);
						  </script>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
			}
		?> 
		<div class="row">
			<div class="col-md-12">
				
						<form action="egitmen_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Ad Soyad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" placeholder="Ad Soyad" name="adsoyad" type="text">
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
											<input class="form-control" placeholder="Eğitmen linkedin hesabı" name="linkedin" type="text">
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
											<input class="form-control" placeholder="Kısa Açıklama" name="aciklama" type="text">
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
											<input class="form-control" placeholder="Resim Alt Başlık" name="resim_alt_etiket" type="text">
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
									</div>
								</div>
								
								
								<div class="modal-footer">
									<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Kaydet</button>
								</div>
							</div>
						</form>
					
			</div>
		</div>
	</section>
</section>

			
<?php include('_footer.php'); ?>			
			
		