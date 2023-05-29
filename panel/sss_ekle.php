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
				<li><span>Sıkça Sorulan Sorular İşlemleri</span></li>
			</ol>
		</div>
	</header>
	<section class="card card-featured card-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Sıkça Sorulan Sorular Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['soru'])
			{
               
                		$data = Array (
					'soru' 			=> $_POST['soru'],
					'cevap' 			=> t_code($_POST['cevap']),
					'durum' 		=> tirnak_replace($_POST['durum']),
					'anamenu' 		=> $_POST['anamenu'],
					'sira' 				=> t_code($_POST['sira']),
					// 'dil' 				=> $_POST['dil'],
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
                $id = $db->insert ('sss', $data);
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
			}

			
		?> 
		<div class="row">
			<div class="col-md-12">
				
						<form action="sss_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<!-- <input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" /> -->
							<div class="card-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Soru</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-text-width"></i></span>
											</span>
											<input class="form-control" placeholder="soruyu yaziniz" id="url_generator" name="soru" type="text">
										</div>
									</div>
								</div>
							
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Cevap</label>
									<div class="col-md-8">
										<textarea id="maxlength_textarea" class="ckeditor form-control" name="cevap" maxlength="10000" rows="10"></textarea>
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
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Sıra</label>
									<div class="col-md-3">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-sort-numeric-asc"></i></span>
											</span>
											<input class="form-control" placeholder="Sıra" name="sira" type="text">
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
			
		