<?php
require_once("inc.php");
	
$db->where('id', intval($_POST["id"]));
$results = $db->get('platform_workshop');
foreach ($results as $value) {
	$resim				=	$value['resim'];
	$saat				=	$value['saat'];
	$salon				=	$value['salon'];
	$baslik				=	$value['baslik'];
	$konusmacilar		=	$value['konusmacilar'];
	$kimler_katilmali	=	$value['kimler_katilmali'];
	$neler_bekliyor		=	$value['neler_bekliyor'];
}
?>
<div class="row">
	<div class="col-lg-6">
	   <div class="ts-speaker-popup-img">
		  <img class="company-logo" src="images/<?php echo $resim; ?>" alt="<?php echo $baslik; ?>">
	   </div>
	</div><!-- col end-->
	<div class="col-lg-6">
	   <div class="ts-speaker-popup-content">
		  <h3 class="ts-title"><?php echo $baslik; ?></h3>
		  <span class="speakder-designation">
			<?php echo $konusmacilar; ?>
		  </span>
		  <h4>Kimler Katılmalı</h4>
		  <p>
			 <?php echo $kimler_katilmali; ?>
		  </p>
		  <h4>Katılımcıları Neler Bekliyor?</h4>
		  <p>
			 <?php echo $neler_bekliyor; ?>
		  </p>
		  <div class="row">
			 <div class="col-lg-12">
				<div class="speaker-session-info">
				   <span><?php echo $saat; ?></span>
				   <p><?php echo $salon; ?></p>
				</div>
			 </div>
		  </div>
	   </div><!-- ts-speaker-popup-content end-->
	</div><!-- col end-->
	 <button title="Close (Esc)" type="button" class="mfp-close">×</button>
 </div><!-- row end-->
