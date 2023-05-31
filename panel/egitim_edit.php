<?php include('_header.php'); ?>	
				
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Eğitimler</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Eğitim İşlemleri</span></li>
			</ol>
		</div>
	</header>
	
	<?php
		if($_POST['baslik'])
		{
			
			$eski_id=$_POST['eski_id'];
			
			if($_FILES["resim"]["name"]) {
				$resim_alt_etiket = $_POST['resim_alt_etiket'];
				if($resim_alt_etiket=="") $resim_alt_etiket = $_POST['baslik'];
				$resim_baslik=url_baslik_yarat($resim_alt_etiket);		
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
					move_uploaded_file($_FILES["resim"]["tmp_name"],SITE_ROOT."/../dosyalar/images/icerik/egitim/".$resim);
					$resim="/dosyalar/images/icerik/egitim/".$resim;
					$data = Array (
						'resim' => $resim,
					);
					$db->where ('id', $eski_id);
					$db->update ('education', $data);
				}
				
			}
			
			
			
	
			$data = Array (
				'baslik' 			=> $_POST['baslik'],
				'kisa_aciklama' 	=> t_code($_POST['kisa_aciklama']),
				'aciklama' 			=> t_code($_POST['aciklama']),
				'kimler_katilmali' 	=> t_code($_POST['kimler_katilmali']),
				'neden_katilmali' 	=> t_code($_POST['neden_katilmali']),
				'egitim_suresi' 	=> t_code($_POST['egitim_suresi']),
				'resim_alt_etiket' 	=> tirnak_replace($_POST['resim_alt_etiket']),
				'durum' 			=> tirnak_replace($_POST['durum']),
				'video'             => isset($_POST['video']) ? t_code($_POST['video']) : NULL,
				'seo_url' 			=> tirnak_replace($_POST['seo_url']),
				'meta_title' 		=> $_POST['meta_title'],
				'meta_description' 	=> $_POST['meta_description'],
				'meta_keywords' 	=> $_POST['meta_keywords'],
				'kayit_user' 		=> $usr_id,
				'kayit_tarihi' 		=> $db->now(),
				'education_level_id'=> $_POST['egitim_level'],
				'type_id'			=>$_POST['egitim_type'],
				'not' 				=> t_code($_POST['not']),
			);
			$db->where ('id', $eski_id);
			$id = $db->update ('education', $data);
			if ($id) {
				$db->where('edu_id', $eski_id);
				if($db->delete('education_categories')) {
					if(count($_POST['egitim_kategori'])>0){
						foreach ($_POST['egitim_kategori'] as $categories) {
							$data_cate = Array (
								'id' 			=> NULL,
								'edu_id' 	=> $eski_id,
								'cate_id' 		=> $categories,
							//	'type_id'		=> $_POST['egitim_type'],
							);
							$id_cate = $db->insert ('education_categories', $data_cate);
						}
					}
				}
				
				echo "<div class=\"alert alert-success\">
						<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
					  </div>";
			} else
				echo "<div class=\"alert alert-danger\">
						<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
					  </div>";
					  
		} 
		if(isset($_GET['id'])){
		$db->where('id', intval($_GET["id"]));}
		if(isset($_POST['baslik'])){
			$db->where('id', intval($_POST["eski_id"]));}

		$results = $db->get('education');
		foreach ($results as $value) {
			$eski_id			=	$value['id'];
			$baslik				=	$value['baslik'];
			$kisa_aciklama		=	$value['kisa_aciklama'];
			$aciklama			=	$value['aciklama'];
			$aciklama			=	$value['aciklama'];
			$durum			    =	$value['durum'];
			$kimler_katilmali	=	$value['kimler_katilmali'];
			$neden_katilmali	=	$value['neden_katilmali'];
			$egitim_suresi		=	$value['egitim_suresi'];
			$seo_url			=	$value['seo_url'];
			$meta_title			=	$value['meta_title'];
			$meta_keywords		=	$value['meta_keywords'];
			$meta_description	=	$value['meta_description'];
			$resim_alt_etiket	=	$value['resim_alt_etiket'];
			$resim				=	$value['resim'];
			$video              =   $value['video'];
			$level              =   $value['education_level_id'];
			$type				=	$value['type_id'];
			$not				= 	$value['not'];
		}
		// $db->where('id',intval($_GET["id"]));
		// $res=$db->getOne('education_categories');	
		// $type=$res['type_id'];

	?> 
	<?php 
						
		$db->where('edu_id',  $eski_id);
		$totalEgitim = $db->getValue ("education_calender", "count(id)");
	?>
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			<li class="nav-item active">
				<a class="nav-link" href="#egitimDetay" data-toggle="tab"><i class="fa fa-graduation-cap"></i> Eğitim Detayları</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#egitimTakvim" data-toggle="tab"><span class="badge badge-primary"><?php echo $totalEgitim; ?></span> Eğitim Takvimleri</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="egitimDetay" class="tab-pane active">
				<form action="egitim_edit.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
						<input name="eski_id" type="hidden" id="kime_mail" value="<?=$eski_id?>" />
						<div class="form-body">
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Kategorileri</label>
								<div class="col-md-6">
									<select multiple data-plugin-selectTwo class="form-control populate" name="egitim_kategori[]">
										<?php
											$db->orderBy("sira","asc");
											$results = $db->get('categories');
											foreach ($results as $value) {
												
												$selected = "";
												$db->where('cate_id', $value['id']);
												$db->where('edu_id', $eski_id);
												$resultsCate = $db->get('education_categories');
												foreach ($resultsCate as $valueCate) {
													$selected = "selected";
												}
												echo "<option ".$selected." value=\"".$value['id']."\">".$value['baslik']."</option>";
											}
										?>
	
									</select>
								</div>
							</div>
							<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Tipi</label>
									<div class="col-md-6">
										<select data-plugin-selectTwo class="form-control populate" name="egitim_type">
											<?php
												$results = $db->get('education_type');
												foreach ($results as $value) {
													
													// $selected = "";
													// $db->where('type_id', $value['id']);
													// $db->where('edu_id', $eski_id);
													// $resultsCate = $db->getOne('education_categories');
													$selected = "";
													$db->where('type_id', $value['id']);
													$db->where('id', $eski_id);
													$resultsCate = $db->getOne('education');
													foreach ($resultsCate as $valueCate) {
														$selected = "selected";
													}
													echo "<option ".$selected." value=\"".$value['id']."\">".$value['type']."</option>";
												}	 

											?>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Derecesi</label>
									<div class="col-md-6">
										<select data-plugin-selectTwo class="form-control populate" name="egitim_level">
											<?php
												$results = $db->get('education_level');
												foreach ($results as $value) {
													
													$selected = "";
													$db->where('education_level_id', $value['id']);
													$db->where('id', $eski_id);
													$resultsCate = $db->getOne('education');
													foreach ($resultsCate as $valueCate) {
														$selected = "selected";
													}
													echo "<option ".$selected." value=\"".$value['id']."\">".$value['level']."</option>";
												}
											?>
										</select>
									</div>
								</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Başlık</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-graduation-cap"></i></span>
										</span>
										<input class="form-control" placeholder="Eğitim Başlık" id="url_generator" value="<?php echo $baslik; ?>" name="baslik" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Tanıtım Videosu</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-youtube"></i></span>
										</span>
										<input class="form-control" placeholder="Eğitim Tanıtım Videosu" id="video" value="<?php echo $video; ?>" name="video" type="url">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Kısa Açıklama</label>
								<div class="col-md-8">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-edit"></i></span>
										</span>
										<input class="form-control" placeholder="Eğitim Kısa Açıklama" value="<?php echo $kisa_aciklama; ?>" name="kisa_aciklama" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Açıklama</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="aciklama" maxlength="10000" rows="10"><?php echo $aciklama; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Kimler Katılmalı</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="kimler_katilmali" maxlength="10000" rows="10"><?php echo $kimler_katilmali; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Neden Katılmalı</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="neden_katilmali" maxlength="10000" rows="10"><?php echo $neden_katilmali; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Not</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="ckeditor form-control" name="not" maxlength="10000" rows="10"><?php echo $not; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Eğitim Süresi</label>
								<div class="col-md-3">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-clock-o"></i></span>
										</span>
										<input class="form-control" placeholder="Örn: 12 Saat" name="egitim_suresi" value="<?php echo $egitim_suresi; ?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Seo-Url</label>
								<div class="col-md-6">
									<div class="input-group input-group-icon">
										<span class="input-group-addon">
											<span class="icon"><i class="fa fa-link"></i></span>
										</span>
										<input class="form-control" placeholder="Seo-Url" id="seo_url" value="<?php echo $seo_url; ?>" name="seo_url" type="text">
										
									</div>
								</div>
								<div class="col-md-2">
									<a class="mb-1 mt-1 mr-1 btn btn-warning" onclick="url_generator();"><i class="fa fa-refresh"></i> Url Oluştur</a>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Durum</label>
								<div class="col-md-3">
									<div class="switch switch-sm switch-primary">
										<input type="checkbox" name="durum" value="1" data-plugin-ios-switch <?php echo ($durum=='1' ? 'checked' : '');?> />
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
										<input class="form-control" placeholder="Meta Title" name="meta_title" value="<?php echo $meta_title; ?>" type="text">
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Description</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="form-control" name="meta_description" maxlength="10000" rows="2"><?php echo $meta_description; ?></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-lg-3 control-label text-lg-right pt-2" for="inputDefault">Meta Keywords</label>
								<div class="col-md-8">
									<textarea id="maxlength_textarea" class="form-control" name="meta_keywords" maxlength="10000" rows="2"><?php echo $meta_keywords; ?></textarea>
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
										 Yükseklik. <code>500</code> Genişlik. <code>982</code>
									</span>
									<?php if($resim<>"") { ?>
									<div class="fileupload-new thumbnail" style="width: 150px; height: auto;">
										<img src="../<?php echo $resim; ?>" width="150"/>
									</div>
									<?php } ?>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn btn-sm btn-success" data-dismiss="modal">Bilgileri Güncelle</button>
							</div>
						</div>
					</form>
			</div>
			<div id="egitimTakvim" class="tab-pane">
					
					<section class="card">
						<header class="card-header card-header-transparent">
							<h2 class="card-title">Eğitim Takvimleri</h2>
							<p><?php echo $baslik; ?></p>
						</header>
						<div class="card-body">
							<?php if($totalEgitim>0){ 
							
							echo "<div class=\"alert alert-success\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> İlgili eğitim için toplam ".$totalEgitim." adet takvim bulunmamaktadır. <a href=\"egitim_takvim_ekle.php?id=".$eski_id."\" target=\"_blank\" class=\"alert-link\">Yeni takvim eklemek için tıklayınız.</a>
									</div>";
							?>
							<table class="table table-responsive-md table-striped mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Tarih</th>
										<th>Şehir</th>
										<th>Gün</th>
										<th>Fiyat</th>
										<th>Bilgi Talebi</th>
										<th>Satış Yapılan</th>
										<th>Durum</th>
										<th style="width: 130px;"></th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i=0;
										$db->where('edu_id',  $eski_id);
										$resultsCalender = $db->get('education_calender_list');
										foreach ($resultsCalender as $valueCalender) {
											$i++;
									?>			
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo date2Human($valueCalender['egitim_tarih']); ?></td>
										<td><?php echo $valueCalender['sehir_adi']; ?></td>
										<td><?php echo $egitim_suresi; ?></td>
										<td><?php echo number_format($valueCalender['ucret'], 2, ',', '.'); ?> TL</td>
										<td><a data-placement="top" data-toggle="tooltip" title="Bilgi Taleplerini Göster" class="mt-3 mb-3 btn btn-xs btn-warning" target="_blank" href="talep_list.php?id=<?php echo $valueCalender['id']; ?>"><?php echo $valueCalender['kayit']; ?> Talep</a></td>
										<td><a data-placement="top" data-toggle="tooltip" title="Satın Alma Taleplerini Göster"  class="mt-3 mb-3 btn btn-xs btn-success" target="_blank" href="siparis_list.php?id=<?php echo $valueCalender['id']; ?>"><?php echo $valueCalender['satin_alma']; ?> Katılımcı</a></td>
										<td><span class="badge badge-<?php echo ($valueCalender['durum']==0 ? 'danger' : 'success');?>"><?php echo ($valueCalender['durum']==0 ? 'Pasif' : 'Aktif');?></span></td>
										<td align="right">
											
											<a data-placement="top" data-toggle="tooltip" title="Eğitim Takvim Güncelle" href="egitim_takvim_edit.php?id=<?php echo $valueCalender['id']; ?>&edu_id=<?php echo $eski_id; ?>" class="mb-1 mt-1 mr-1 btn btn-xs btn-info"><i class="fa fa-edit"></i></a>
										
											<a data-placement="top" data-toggle="tooltip" title="Eğitim Takvim Sil" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="mb-1 mt-1 mr-1 btn btn-xs btn-danger" href="egitim_takvim_del.php?id=<?php echo $valueCalender['id']; ?>&edu_id=<?php echo $eski_id; ?>"><i class="fa fa-trash-o"></i></a>
										</td>	
									</tr>
										<?php } ?>
									
									
								</tbody>
							</table>
							<?php } else {
									echo "<div class=\"alert alert-danger\">
										<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
										<strong>Bilgilendirme!</strong> İlgili eğitim için kayıtlı takvim bulunmamaktadır. <a href=\"egitim_takvim_ekle.php?id=".$eski_id."\" target=\"_blank\" class=\"alert-link\">Yeni takvim eklemek için tıklayınız.</a>
									</div>";
								} 
							?>
						</div>
					</section>
			</div>
		</div>
		
	</div>
	
	

</section>

			
<?php include('_footer.php'); ?>			
			
		