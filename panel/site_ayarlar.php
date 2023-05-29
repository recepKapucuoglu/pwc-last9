<?php include('_header.php'); ?>				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Site Genel Ayarlar</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Site Genel Ayarlar</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Site Genel Ayarlar Güncelleme
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['eski_id'])
			{
				$eski_id=$_POST['eski_id'];
				$data = Array (
					'cust_name' 	=> $_POST['cust_name'],
					'title' 		=> $_POST['title'], 
					'title_en' 		=> $_POST['title_en'], 
					'keywords' 		=> $_POST['keywords'],
					'keywords_en' 	=> $_POST['keywords_en'],
					'description' 	=> $_POST['description'],
					'description_en'=> $_POST['description_en'],
					'slogan' 		=> $_POST['slogan'],
					'slogan_en' 	=> $_POST['slogan_en'],
					'site_url' 		=> $_POST['site_url'],
					'site_url_en' 	=> $_POST['site_url_en'],
					'facebook' 		=> $_POST['facebook'],
					'instagram' 	=> $_POST['instagram'],
					'twitter' 		=> $_POST['twitter'],
					'youtube' 		=> $_POST['youtube'],
					'linkedin' 		=> $_POST['linkedin']
				);
				$db->where ('id', $eski_id);
				$id = $db->update ('settings', $data);
				if ($id) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
						  </div>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
			}
			$db->where('id', 1);
			$results = $db->get('settings');
			foreach ($results as $value) {
				$eski_id			=	$value['id'];
				$cust_name			=	$value['cust_name'];
				$title				=	$value['title'];
				$title_en			=	$value['title_en'];
				$keywords			=	$value['keywords'];
				$keywords_en		=	$value['keywords_en'];
				$description		=	$value['description'];
				$description_en		=	$value['description_en'];
				$slogan				=	$value['slogan'];
				$slogan_en			=	$value['slogan_en'];
				$site_url			=	$value['site_url'];
				$site_url_en		=	$value['site_url_en'];
				$facebook			=	$value['facebook'];
				$instagram			=	$value['instagram'];
				$twitter			=	$value['twitter'];
				$youtube			=	$value['youtube'];
				$linkedin			=	$value['linkedin'];
			}

			
		?> 
		<div class="row">
			<div class="col-md-12">
						<form action="site_ayarlar.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<input name="eski_id" type="hidden" id="kime_mail" value="1" />
							<div class="form-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Site Adı</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-map-marker"></i></span>
											</span>
											<input class="form-control" placeholder="Site Adı" name="cust_name" value="<?php echo $cust_name; ?>" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Slogan</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-tags"></i></span>
											</span>
											<input class="form-control" placeholder="Slogan" name="slogan" value="<?php echo $slogan; ?>" type="text">
										</div>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Meta Title</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-star"></i></span>
											</span>
											<input class="form-control" placeholder="Meta Title" name="title" value="<?php echo $title; ?>" type="text">
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Meta Description</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" name="description" maxlength="10000" rows="2"><?php echo $description; ?></textarea>
									</div>
								</div>

								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Meta Keywords</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="form-control" name="keywords" maxlength="10000" rows="2"><?php echo $keywords; ?></textarea>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Site Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Site Url" name="site_url" value="<?php echo $site_url; ?>" type="text">
											
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Facebook Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Facebook Url" name="facebook" value="<?php echo $facebook; ?>" type="text">
											
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Instagram Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Instagram Url" name="instagram" value="<?php echo $instagram; ?>" type="text">
											
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Twitter Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Twitter Url" name="twitter" value="<?php echo $twitter; ?>" type="text">
											
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Youtube Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="Youtube Url" name="youtube" value="<?php echo $youtube; ?>" type="text">
											
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">LinkedIn Url</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-link"></i></span>
											</span>
											<input class="form-control" placeholder="LinkedIn Url" name="linkedin" value="<?php echo $linkedin; ?>" type="text">
											
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
			
		