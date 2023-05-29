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
	<section class="panel panel-featured panel-featured-primary">
		<header class="panel-heading">
			<h2 class="panel-title">
				Kullanıcı Güncelleme
			</h2>
		</header>
		<div class="panel-body">
		<?php
		$variable = true;
			if($_POST['eski_id'])
			{
				$eski_id=$_POST['eski_id'];
				
				if(($_POST['email']<>'') and ($_POST['password']<>'') and ($_POST['pasword_again']<>'')){
					if(($_POST['pasword_again'])<>($_POST['password'])){ 
						echo "<div class=\"alert alert-danger\">
								<strong>Hata !</strong> Girmiş  olduğunuz şifreler birbirleriyle eşleşmiyor.
							  </div>";
						$variable = false;
					}
					elseif(!preg_match("#.*^(?=.{20,30})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $_POST['password']))
					{
						echo '<div class="alert alert-danger">• Şifreniz en az 20 karakter uzunluğunda olmalı, <br/>• Büyük/küçük harf, rakam veya özel karakter içermelidir.</div>';
						$variable = false;
					}
					elseif(adminUserUsedThisPasswordBefore($_POST["email"], $_POST["password"]))
					{
						echo "<div class=\"alert alert-danger\">
						<strong>Hata !</strong> Lütfen son 10 şifrenizden farklı bir şifre giriniz.
					  </div>";
					  $variable = false;
					}
					 else {
							$data = Array (
								'password' 			=> passwordHash($_POST['password'])
							);
							$db->where ('id', $eski_id);
							$id = $db->update ('netia_admin', $data);
							saveAdminPasswordHistory(tirnak_replace($_POST['email']), $_POST['password']);
					}
				}
				
				
				$data = Array (
					'surname' 			=> tirnak_replace($_POST['surname']),
					'name' 				=> tirnak_replace($_POST['name']),
					'title' 			=> tirnak_replace($_POST['title']),
					'email' 			=> tirnak_replace($_POST['email']),
					'status' 			=> tirnak_replace($_POST['status']),
					'kayit_user' 		=> $usr_id,
					'kayit_tarihi' 		=> $db->now()
				);
				$db->where ('id', $eski_id);
				$id = $db->update ('netia_admin', $data);
				if ($id && $variable) {
					echo "<div class=\"alert alert-success\">
							<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
						  </div>";
				} else
					echo "<div class=\"alert alert-danger\">
							<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
						  </div>";
			}else {
				$db->where('id', intval($_GET["id"]));
				$results = $db->get('netia_admin');
				foreach ($results as $value) {
					$eski_id			=	$value['id'];
					$surname				=	$value['surname'];
					$name				=	$value['name'];
					$title				=	$value['title'];
					$email				=	$value['email'];
					$status				=	$value['status'];
				}

			}
		?> 
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-body form">
						<form action="kullanici_edit.php?id=<?=$eski_id?>" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
							<input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" />
							<div class="form-body">
								<div class="form-group">
									<label class="control-label col-md-3">Ad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" placeholder="Ad" name="name" type="text" value="<?php echo $name; ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Soyad</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-user"></i></span>
											</span>
											<input class="form-control" placeholder="Soyad" name="surname" type="text" value="<?php echo $surname; ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Title</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-star"></i></span>
											</span>
											<input class="form-control" placeholder="Title" name="title" type="text" value="<?php echo $title; ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Durum</label>
									<div class="col-md-3">
									
										<div class="switch switch-sm switch-success">
											<input type="checkbox" name="status" value="1" data-plugin-ios-switch <?php echo ($status=='1' ? 'checked' : '');?> />
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">E-mail</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-envelope"></i></span>
											</span>
											<input class="form-control" placeholder="E-mail" name="email" type="text" value="<?php echo $email; ?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Şifre</label>
									<div class="col-md-6">
										<div class="input-group input-group-icon">
											<span class="input-group-addon">
												<span class="icon"><i class="fa fa-question"></i></span>
											</span>
											<input class="form-control" name="password" type="password">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Şifre Tekrar</label>
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
									<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Güncelle</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>
<?php include('_footer.php'); ?>			
			
		