<div class="bultenFormList col-md-6 col-md-offset-3" style="padding-top:10px"></div>
<section id="ebulten" style="display: none;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<div class="basliklar">
					<b>E-Bülten Aboneliği</b>
					<p>Yaklaşan eğitimlerimizden ve duyurularımızdan<br/>haberdar olmak için e-bültenimize kayıt olun.</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
				<form id="bulten_form" method="post" onsubmit="return bulten_form_gonder();">
					<div class="label-div">
						<input type="email" id="email" name="email" value="" onkeyup="this.setAttribute('value', this.value);"/>
						<label for="email">E-Posta</label>
					</div>
					<a href="javascript:;" onclick="return bulten_form_gonder();"><span>Gönder</span>
					
				</form>
			</div>
		</div>
	</div>
</section>