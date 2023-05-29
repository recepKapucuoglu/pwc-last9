<?php include('_header.php'); ?>
<section role="main" class="content-body">
		<header class="page-header">
			<h2>Kullanıcı Ayarları</h2>
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li><a href="index.php"><i class="fa fa-home"></i></a></li>
					<li><span>Kullanıcı Silme İşlemleri</span></li>
				</ol>
			</div>
		</header>
		<section class="panel panel-featured panel-featured-primary">
			<header class="panel-heading">
				<h2 class="panel-title">Kullanıcı Silme İşlemleri</h2>
			</header>
			<div class="panel-body">
				<?php
					if($_GET['id'])
					{
						$db->where('id', intval($_GET["id"]));
						if($db->delete('netia_admin')) 
							echo "<div class=\"alert alert-success\">
									<strong>Tebrikler !</strong> Silme İşlemi Başarıyla Gerçekleştirilmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
								  </div>
								  <script language=\"JavaScript\">
									  function Git() {
										 location.href=\"kullanici_list.php\";
									  }
									  setTimeout(\"Git()\",4000);
								  </script>";
						else
							echo "<div class=\"alert alert-danger\">
									<strong>Hata !</strong> Hata mesajı:". $db->getLastError()."
								  </div>";
					} 
				?> 
			</div>
		</div>
	</section>
</section>
<?php include('_footer.php'); ?>
