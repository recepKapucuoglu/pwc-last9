<?php include('_header.php'); ?>
<section role="main" class="content-body">
		<header class="page-header">
			<h2>Eğitim</h2>
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li><a href="index.php"><i class="fa fa-home"></i></a></li>
					<li><span>Eğitim Silme İşlemleri</span></li>
				</ol>
			</div>
		</header>
		<section class="card card-featured card-featured-primary">
			<header class="card-header">
				<h2 class="card-title">Eğitim Silme İşlemleri</h2>
			</header>
			<div class="card-body">
				<?php
					if($_GET['id'])
					{
						$db->where('edu_id', intval($_GET["id"]));
						$totalTakvim = $db->getValue ("education_calender", "count(id)");;
						
						if($totalTakvim==0) {
						
							$db->where('id', intval($_GET["id"]));
							if($db->delete('education')) 
								$db->where('edu_id', intval($_GET["id"]));
								if($db->delete('education_categories')) 
								echo "<div class=\"alert alert-success\">
										<strong>Tebrikler !</strong> Silme İşlemi Başarıyla Gerçekleştirilmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
									  </div>
									  <script language=\"JavaScript\">
										  function Git() {
											 location.href=\"egitim_list.php\";
										  }
										  setTimeout(\"Git()\",4000);
									  </script>";
							else
								echo "<div class=\"alert alert-danger\">
										<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
									  </div>";
						} else {
							echo "<div class=\"alert alert-danger\">
										<strong>Hata !</strong> Silmek istediğiniz eğitim için ".$totalTakvim." adet takvim oluşturulduğundan dolayı silinemez.
									  </div>";
						}
					} 
				?> 
			</div>
		</div>
	</section>
</section>
<?php include('_footer.php'); ?>
