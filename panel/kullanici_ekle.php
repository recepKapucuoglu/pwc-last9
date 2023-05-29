<?php include('_header.php'); ?>	
				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Kullanıcı Ayarları</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Kullanıcı İşlemleri</span></li>
			</ol>
		</div>
	</header>
	<section class="card panel-featured panel-featured-primary">
		<header class="card-header">
			<h2 class="card-title">
				Yeni Kullanıcı Ekle
			</h2>
		</header>
		<div class="card-body">
		<?php
			if($_POST['email'])
			{
				
				if(($_POST['email']=='') or ($_POST['password']=='') or ($_POST['pasword_again']=='')){
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Email ".$_POST['pasword_again']." adresi ve şifre kısımları boş bırakılamaz.
						  </div>";
				} else if(($_POST['pasword_again'])<>($_POST['password'])){ 
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Girmiş  olduğunuz şifreler birbirleriyle eşleşmiyor.
						  </div>";
				}
				elseif(!preg_match("#.*^(?=.{20,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $_POST['password']))
				{
					echo '<div class="alert alert-danger">• Şifreniz en az 20 karakter uzunluğunda olmalı, <br/>• Büyük/küçük harf, rakam veya özel karakter içermelidir.</div>';
					die();
				}
				else {
					$data = Array (
						'id' 				=> NULL,
						'surname' 			=> tirnak_replace($_POST['surname']),
						'name' 				=> tirnak_replace($_POST['name']),
						'title' 			=> tirnak_replace($_POST['title']),
						'email' 			=> tirnak_replace($_POST['email']),
						'status' 			=> tirnak_replace($_POST['status']),
						'password' 			=> passwordHash($_POST['password']),
						'kayit_user' 		=> $usr_id,
						'kayit_tarihi' 		=> $db->now()
					);
					$id = $db->insert ('netia_admin', $data);
					$p_id = saveAdminPasswordHistory(tirnak_replace($_POST['email']), $_POST['password']);
					if ($id) {
						echo "<div class=\"alert alert-success\">
								<strong>Tebrikler !</strong> İşlem Başarıyla Sisteme Eklenmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
							  </div>
							  <script language=\"JavaScript\">
								  function Git() {
									 location.href=\"kullanici_list.php\";
								  }
								  setTimeout(\"Git()\",4000);
							  </script>";
					} else
						echo "<div class=\"alert alert-danger\">
								<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
							  </div>";
				}
			}
		?> 
		<div class="row">
			<div class="col-md-12">
						<form action="kullanici_ekle.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<div class="form-body">
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Ad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" placeholder="Ad" name="name" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Soyad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" placeholder="Soyad" name="surname" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Title</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-star"></i></span>
											</span>
											<input class="form-control" placeholder="Title" name="title" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Durum</label>
									<div class="col-md-3">
									
										<div class="switch switch-sm switch-success">
											<input type="checkbox" name="status" value="1" data-plugin-ios-switch checked="checked" />
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">E-mail</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-envelope"></i></span>
											</span>
											<input class="form-control" placeholder="E-mail" name="email" type="text">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Şifre</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-question"></i></span>
											</span>
											<input class="form-control" name="password" type="password">
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2">Şifre Tekrar</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-question"></i></span>
											</span>
											<input class="form-control" name="pasword_again" type="password">
										</div>
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
			
		