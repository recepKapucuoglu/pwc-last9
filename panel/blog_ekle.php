<?php include('_header.php'); ?>				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Bloglar</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Blog İşlemleri</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Blog Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['baslik'])
			{
                $resim_alt_etiket = $_POST['resim_alt_etiket'];
				if($resim_alt_etiket=="") $resim_alt_etiket = $_POST['baslik'];
                $resim_baslik=url_baslik_yarat($resim_alt_etiket);
                $resim = $_FILES["banner"]["name"];
         		$fileType=$_FILES["banner"]["type"]; 
                 switch($fileType){ 
                    case "image/jpg"            :$typeResult="A"; $typeUzanti=".jpg"; break;
                    case "image/jpeg"           :$typeResult="A"; $typeUzanti=".jpg"; break;
                    case "image/pjpeg"          :$typeResult="A"; $typeUzanti=".pjpeg"; break;
                    case "image/gif"            :$typeResult="A"; $typeUzanti=".gif"; break;
                    case "image/png"            :$typeResult="A"; $typeUzanti=".png"; break;
                  }			
                  if(($resim <> "") && ($typeResult=="A")) {
				echo	$resim = $resim_baslik.$typeUzanti;
					define ('SITE_ROOT', realpath(dirname(__FILE__)));
					
					move_uploaded_file($_FILES["banner"]["tmp_name"],SITE_ROOT."/../dosyalar/images/blog/".$resim);
					$resim="/dosyalar/images/blog/".$resim;
				}
                		$data = Array (
					'baslik' 			=> $_POST['baslik'],
					'resim_alt_etiket' 	=> tirnak_replace($_POST['resim_alt_etiket']), 
                    'banner'=>$resim,
					'site_yeri' 		=> $_POST['site_yeri'], 
					'alt_baslik' 		=> $_POST['alt_baslik'],
					'aciklama' 			=> t_code($_POST['aciklama']),
					'seo_url' 		=> tirnak_replace($_POST['seo_url']),
					'durum' 		=> tirnak_replace($_POST['durum']),
					'anamenu' 		=> $_POST['anamenu'],
					'meta_title' 		=> $_POST['meta_title'],
					'meta_description' 		=> $_POST['meta_description'],
					'meta_keywords' 		=> $_POST['meta_keywords'],
					'dil' 				=> $_POST['dil'],
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
                $id = $db->insert ('blog', $data);
				if ($id) {
					
					echo $id."<br/>";
				
					
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
						  </div>
						  <script language=\"JavaScript\">
							  function Git() {
								 location.href=\"egitim_list.php\";
							  }
							  setTimeout(\"Git()\",4000);
						  </script>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
            //     $resim_alt_etiket = $_POST['resim_alt_etiket'];
			// 	if($resim_alt_etiket=="") $resim_alt_etiket = $_POST['baslik'];
			// 	$eski_id=$_POST['eski_id'];
				
			// 	if($_FILES["resim"]["name"]) {
			// 		$resim_baslik=url_baslik_yarat($_POST['resim_alt_etiket']);		
			// 		$resim = $_FILES["resim"]["name"];
			// 		$fileType=$_FILES["resim"]["type"]; 
			// 			switch($fileType){ 
			// 			  case "image/jpg"            :$typeResult="A"; $typeUzanti=".jpg"; break;
			// 			  case "image/jpeg"           :$typeResult="A"; $typeUzanti=".jpg"; break;
			// 			  case "image/pjpeg"          :$typeResult="A"; $typeUzanti=".pjpeg"; break;
			// 			  case "image/gif"            :$typeResult="A"; $typeUzanti=".gif"; break;
			// 			  case "image/png"            :$typeResult="A"; $typeUzanti=".png"; break;
			// 			}			
			// 		if(($resim <> "") && ($typeResult=="A")) {
			// 			$resim = $resim_baslik.$typeUzanti;
			// 			define ('SITE_ROOT', realpath(dirname(__FILE__)));
			// 			move_uploaded_file($_FILES["resim"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/banner/".$resim);
			// 			$resim="/dosyalar/images/blog/banner/".$resim;
			// 			$data = Array (
			// 				'resim' => $resim,
			// 			);
			// 			$db->where ('id', $eski_id);
			// 			$db->update ('page', $data);
			// 		}
					
			// 	}
				
			// 	if($_FILES["banner"]["name"]) {
			// 		$banner_baslik=url_baslik_yarat($_POST['resim_alt_etiket'])."-banner";		
			// 		$banner = $_FILES["banner"]["name"];
			// 		$fileType=$_FILES["banner"]["type"]; 
			// 			switch($fileType){ 
			// 			  case "image/jpg"            :$typeResult="A"; $typeUzanti=".jpg"; break;
			// 			  case "image/jpeg"           :$typeResult="A"; $typeUzanti=".jpg"; break;
			// 			  case "image/pjpeg"          :$typeResult="A"; $typeUzanti=".pjpeg"; break;
			// 			  case "image/gif"            :$typeResult="A"; $typeUzanti=".gif"; break;
			// 			  case "image/png"            :$typeResult="A"; $typeUzanti=".png"; break;
			// 			}			
			// 		if(($banner <> "") && ($typeResult=="A")) {
			// 			$banner = $banner_baslik.$typeUzanti;
			// 			define ('SITE_ROOT', realpath(dirname(__FILE__)));
			// 			move_uploaded_file($_FILES["banner"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/banner/".$banner);
			// 			$banner="/dosyalar/images/blog/banner/".$banner;
			// 			$data = Array (
			// 				'banner' => $banner,
			// 			);
			// 			$db->where ('id', $eski_id);
			// 			$db->update ('blog', $data);
			// 		}
					
			// 	}
		
			// 	$data = Array (
			// 		'baslik' 			=> $_POST['baslik'],
			// 		'resim_alt_etiket' 	=> $_POST['resim_alt_etiket'], 
			// 		'site_yeri' 		=> $_POST['site_yeri'], 
			// 		'alt_baslik' 		=> $_POST['alt_baslik'],
			// 		'aciklama' 			=> t_code($_POST['aciklama']),
			// 		'seo_url' 		=> $_POST['seo_url'],
			// 		'durum' 		=> $_POST['durum'],
			// 		'anamenu' 		=> $_POST['anamenu'],
			// 		'meta_title' 		=> $_POST['meta_title'],
			// 		'meta_description' 		=> $_POST['meta_description'],
			// 		'meta_keywords' 		=> $_POST['meta_keywords'],
			// 		'dil' 				=> $_POST['dil'],
			// 		'kayit_user' 		=> $usr_id,
			// 		'kayit_tarihi' 		=> $db->now()
			// 	);
			
			// 	$db->where ('id', $eski_id);
			// 	$id = $db->update ('blog', $data);
			// 	if ($id) {
			// 		echo "<div class=\"alert alert-success\">
			// 				<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
			// 			  </div>";
			// 	} else
			// 		echo "<div class=\"alert alert-danger\">
			// 				<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
			// 			  </div>";
			// }
			// $db->where('id', intval($_GET["id"]));
			// $results = $db->get('blog');
			// foreach ($results as $value) {
			// 	$eski_id			=	$value['id'];
			// 	$baslik				=	$value['baslik'];
			// 	$dil				=	$value['dil'];
			// 	$site_yeri			=	$value['site_yeri'];
			// 	$alt_baslik			=	$value['alt_baslik'];
			// 	$aciklama			=	$value['aciklama'];
			// 	$seo_url			=	$value['seo_url'];
			// 	$durum			=	$value['durum'];
			// 	$anamenu			=	$value['anamenu'];
			// 	$meta_title			=	$value['meta_title'];
			// 	$meta_keywords		=	$value['meta_keywords'];
			// 	$meta_description	=	$value['meta_description'];
			// 	$resim_alt_etiket	=	$value['resim_alt_etiket'];
			// 	$banner				=	$value['banner'];
			}

			
		?> 
		<div class="row">
			<div class="col-md-12">
				
						<form action="blog_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<!-- <input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" /> -->
							<div class="card-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-text-width"></i></span>
											</span>
											<input class="form-control" placeholder="Başlık" id="url_generator" name="baslik" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Alt Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-tags"></i></span>
											</span>
											<input class="form-control" placeholder="Alt Başlık" name="alt_baslik"  type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">İçerik</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="aciklama" maxlength="10000" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Seo-Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Seo-Url" id="seo_url" name="seo_url" type="text">
											
										</div>
									</div>
									<div class="col-md-2">
										<a class="mb-1 mt-1 mr-1 btn btn-warning" onclick="url_generator();"><i class="fa fa-refresh"></i> Url Oluştur</a>
									</div>
								</div>
                             
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Durum</label>
									<div class="col-md-3">
										<div class="switch switch-sm switch-success">
											<input type="checkbox" name="durum" data-plugin-ios-switch value="1" checked="checked" />
										</div>
									</div>
								</div>
                         
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Anamenü'de Göster</label>
									<div class="col-md-3">
										<div class="switch switch-sm switch-warning">
											<input type="checkbox" name="anamenu" value="1" data-plugin-ios-switch <?php echo ($anamenu=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Title</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-star"></i></span>
											</span>
											<input class="form-control" placeholder="Meta Title" name="meta_title" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Description</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" name="meta_description" maxlength="10000" rows="2"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Keywords</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" name="meta_keywords" maxlength="10000" rows="2"></textarea>
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
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Banner</label>
									<div class="col-md-3">
										<input type="file" class="default"  name="banner"/>
										<span class="help-block">
											 <b>Banner:</b> Yükseklik. <code>727</code> Genişlik. <code>1920</code><br/>
										</span>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Ekle</button>
								</div>
							</div>
						</form>
					
			</div>
		</div>
	</section>
</section>
<?php include('_footer.php'); ?>			
			
		