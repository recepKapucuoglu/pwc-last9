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
				<li><span>Slide İşlemleri</span></li>
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
				Yeni Slide Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['baslik'])
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
					move_uploaded_file($_FILES["resim"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/slide/".$resim);
					$resim="/dosyalar/images/icerik/slide/".$resim;
				}
				
				
		
				$data = Array (
					'id' 				=> NULL,
					'baslik' 			=> t_code($_POST['baslik']),
					'aciklama' 			=> t_code($_POST['aciklama']),
					'resim_alt_etiket' 	=> tirnak_replace($_POST['resim_alt_etiket']),
					'durum' 			=> tirnak_replace($_POST['durum']),
					'resim' 			=> $resim,
					'url' 				=> tirnak_replace($_POST['url']),
					'sira' 				=> tirnak_replace($_POST['sira']),
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
				$id = $db->insert ('slide', $data);
				if ($id) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
						  </div>
						  <script language=\"JavaScript\">
							  function Git() {
								 location.href=\"slide_list.php\";
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
				
						<form action="slide_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Slide Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-image"></i></span>
											</span>
											<input class="form-control" placeholder="Slide Başlık" name="baslik" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Alt Başlık</label>
									<div class="col-md-8">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-image"></i></span>
											</span>
											<input class="form-control" placeholder="Alt Başlık" name="aciklama" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Url/Link</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Yönlendirilecek Sayfa Linki" name="url" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Durum</label>
									<div class="col-md-3">
										<div class="switch switch-sm switch-primary">
											<input type="checkbox" name="durum" data-plugin-ios-switch value="1" checked="checked" />
										</div>
										
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Resim Sırası</label>
									<div class="col-md-3">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-sort-numeric-asc"></i></span>
											</span>
											<input class="form-control" placeholder="Gösterilme Sırası" name="sira" type="text">
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
											 Yükseklik. <code>945</code> Genişlik. <code>1920</code>
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
			
		