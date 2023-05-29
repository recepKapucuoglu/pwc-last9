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
				'seo_url' 			=> tirnak_replace($_POST['seo_url']),
				'meta_title' 		=> $_POST['meta_title'],
				'meta_description' 	=> $_POST['meta_description'],
				'meta_keywords' 	=> $_POST['meta_keywords'],
				'kayit_user' 		=> $usr_id,
				'kayit_tarihi' 		=> $db->now()
			);
			$db->where ('id', $eski_id);
			$id = $db->update ('education', $data);
			if ($id) {
				echo "<div class=\"alert alert-success\">
						<strong>Tebrikler !</strong> Bilgiler Başarıyla Güncellenmiştir...
					  </div>";
			} else
				echo "<div class=\"alert alert-danger\">
						<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
					  </div>";
					  
		} 
		$db->where('id', intval($_GET["id"]));
		$results = $db->get('education');
		foreach ($results as $value) {
			$eski_id			=	$value['id'];
			$baslik				=	$value['baslik'];
			$kisa_aciklama		=	$value['kisa_aciklama'];
			$aciklama			=	$value['aciklama'];
			$aciklama			=	$value['aciklama'];
			$durum			=	$value['durum'];
			$kimler_katilmali	=	$value['kimler_katilmali'];
			$neden_katilmali	=	$value['neden_katilmali'];
			$egitim_suresi		=	$value['egitim_suresi'];
			$seo_url			=	$value['seo_url'];
			$meta_title			=	$value['meta_title'];
			$meta_keywords		=	$value['meta_keywords'];
			$meta_description	=	$value['meta_description'];
			$resim_alt_etiket	=	$value['resim_alt_etiket'];
			$resim				=	$value['resim'];
		}
		
	?> 
	<?php 
						
		$db->where('edu_id',  $eski_id);
		$totalEgitim = $db->getValue ("education_calender", "count(id)");
	?>
	<div class="tabs tabs-primary">
		<ul class="nav nav-tabs">
			
			<li class="nav-item active">
				<a class="nav-link" href="#egitimTakvim" data-toggle="tab"><span class="badge badge-primary"><?php echo $totalEgitim; ?></span> Eğitim Takvimleri</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="egitimTakvim" class="tab-pane active">
					
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
			
		