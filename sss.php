<?php include('dosyalar/dahili/header.php');

?>
<section id="sayfaust" style="background-image:url(dosyalar/images/sayfaust-bg.jpg);">
		<div class="basliklar">
			<div class="baslik">SIKÇA SORULAN SORULAR</div>
			<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="/"><span itemprop="name">Anasayfa</span></a>
					<meta itemprop="position" content="1" />
				</li>
				<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" href="javascript:;"><span itemprop="name">Sıkça sorulan sorular</span></a>
					<meta itemprop="position" content="2" />
				</li>
			</ol>
		</div>
	</section>

<section class="ortakisim container">
<div id="faq">
  <ul>
    
    <?php 
            $db->where('durum',1);
            $db->orderBy('sira','asc');
     $datas = $db->get('sss'); 
  foreach ($datas as $data) {
    echo ' <li>
    <input type="checkbox" checked>
    <i></i>
    <h2>'. $data['soru'] .'</h2>
    <p>'. t_decode($data['cevap']) .'</p>
    </li>';
  }
    ?>
   
    <!-- <li>
      <input type="checkbox" checked>
      <i></i>
      <h2>Hvorfor..?</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quasi, quia provident facere recusandae itaque assumenda fuga veniam dicta earum dolorem architecto facilis nisi pariatur.</p>
    </li>
    <li>
      <input type="checkbox" checked>
      <i></i>
      <h2>Hvad..?</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quas placeat assumenda mollitia magni consequatur dolorum, quod nihil distinctio aperiam officia alias! Voluptate dolore ex officiis sit, magnam non a, eligendi pariatur aut, earum dolores tenetur ipsam id illo deleniti. Laudantium deserunt eaque ipsam voluptatum consequuntur voluptatibus sed minima ad accusamus debitis eos similique laboriosam, molestiae? Consequatur neque tempore quis. Eligendi, in ut aspernatur esse nesciunt libero.</p>
    </li> -->
  </ul>
</div>
</div>
</section>
<?php include('dosyalar/dahili/footer.php');?>