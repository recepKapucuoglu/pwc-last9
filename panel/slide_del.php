<?php include('_header.php'); ?>
<section role="main" class="content-body">
		<header class="page-header">
			<h2>Slide</h2>
			<div class="right-wrapper pull-right">
				<ol class="breadcrumbs">
					<li><a href="index.php"><i class="fa fa-home"></i></a></li>
					<li><span>Slide Silme İşlemleri</span></li>
				</ol>
			</div>
		</header>
		<section class="card card-featured card-featured-primary">
			<header class="card-header">
				<h2 class="card-title">Slide Silme İşlemleri</h2>
			</header>
			<div class="card-body">
				<?php
					if($_GET['id'])
					{
						$db->where('id', intval($_GET["id"]));
						if($db->delete('slide')) 
							echo "<div class=\"alert alert-success\">
									<strong>Tebrikler !</strong> Silme İşlemi Başarıyla Gerçekleştirilmiştir. İşlem Listesi Bölümüne Yönlendiriliyorsunuz...
								  </div>
								  <script language=\"JavaScript\">
									  function Git() {
										 location.href=\"slide_list.php\";
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
