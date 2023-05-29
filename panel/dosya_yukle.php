<?php include('_header.php'); ?>	
				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Dosya Yükleme İşlemleri</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Dosya İşlemleri</span></li>
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
				Yeni Dosya Yükle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['baslik'])
			{
				
				$resim_baslik=url_baslik_yarat($_POST['baslik']);		
				$resim = $_FILES["resim"]["name"];
				$fileType=$_FILES["resim"]["type"]; 
					switch($fileType){ 
					  case "application/pdf"            :$typeResult="A"; $typeUzanti=".pdf"; break;
					  case "application/msword"           :$typeResult="A"; $typeUzanti=".doc"; break;
					  case "application/vnd.openxmlformats-officedocument.wordprocessingml.document"          :$typeResult="A"; $typeUzanti=".docx"; break;
					 
					}			
				if(($resim <> "") && ($typeResult=="A")) {
					$resim = $resim_baslik.$typeUzanti;
					define ('SITE_ROOT', realpath(dirname(__FILE__)));
					move_uploaded_file($_FILES["resim"]["tmp_name"],SITE_ROOT."/../dosyalar/images/docs/".$resim);
					$resim="/dosyalar/images/docs/".$resim;
					
					
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Dosya Başarıyla Sisteme Eklenmiştir. Yönlendiriliyorsunuz...
						  </div>
						  <script language=\"JavaScript\">
							  function Git() {
								 location.href=\"dosya_yukle.php\";
							  }
							  setTimeout(\"Git()\",4000);
						  </script>";
				} else {
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Desteklenmeyen dosya tipi.
						  </div>";
				}
				
				
		
					
				
			}
		?> 
		<div class="row">
			<div class="col-md-12">
				
						<form action="dosya_yukle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Dosya Başlık</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-image"></i></span>
											</span>
											<input class="form-control" placeholder="Dosya Başlık" name="baslik" type="text">
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Dosya</label>
									<div class="col-md-3">
										<input type="file" class="default"  name="resim"/>
										<span class="help-block">
											 Sadece <code>pdf,docx, doc</code>
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
	
	<div class="row">
		<div class="col-md-12">

			<section class="card card-featured card-featured-primary">
				
				<header class="card-header">
					<div class="card-actions">
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Dosya Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
							<?php $dizin = glob("../dosyalar/images/docs/*.{pdf,doc,docx}", GLOB_BRACE);
							asort($dizin);
							
							$i=0;
							foreach($dizin as $dosya){
								$i++;
								echo "<a href='https://www.okul.pwc.com.tr/".substr($dosya,3,100)."' target='_blank'>".$i."- https://www.okul.pwc.com.tr/".substr($dosya,3,100).'</a><br>';
								
								
							}

							?>
					</div>
				</div>
				</form>
			</section>
		</div>
	</div>
</section>

			
<?php include('_footer.php'); ?>			
			
		