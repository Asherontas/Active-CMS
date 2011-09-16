<?php

	include ('../config/config.inc.php');
	
	define ('CURRENT_PAGE', 'apps');
	
	include ('../_inc/_head.php');
	include ('../_inc/header.php');
	
	//Afficher les visiteur de la demo
	$fp = fopen("compteur_cms.txt","r+"); 
	$nbvisites = fgets($fp,255);
?>
<div id="page_content">
  <div id="page_main_content"> <img src="<?php echo SITE_ROOT; ?>/assets/cog.png" alt="Applications" class="icone_h" />
    <h1>Activedev // Applications</h1>
    <div id="blog_article">
      <div class="entry-previewimage rounded"> <a href="<?php echo SITE_ROOT; ?>/activecms/"><img src="<?php echo SITE_ROOT; ?>/assets/grafikcms.jpg" alt="Grafik CMS" title="Grafik CMS" width="190" height="180" /></a></div>
      <div class="entry-content">
        <h2 class="entry-heading"><a href="<?php echo SITE_ROOT; ?>/activecms/" title="Grafik CMS">ACTIVE CMS</a></h2>
        <div class="entry-head">
          <div class="meta">
            <ul>
              <li class="date-meta">26 Janvier 2010</li>
              <li class="params-meta">PHP4, PHP5, MySQL, jQuery</li>
              <li class="category-meta">Version 1.1.2 final</li>
              <li class="view-meta"><?php echo $nbvisites; ?> ont essayé la démonstration en ligne</li>
              <?php
			  	//Connexion
              	database_connect();
			
				$requete = mysql_query("SELECT compteur FROM telecharger");
				while ($donnees	= mysql_fetch_array($requete)) {
				?>	
              <li class="download-meta"><?php echo $donnees['compteur']; ?> fois téléchargé</li>
              <?php } ?>
            </ul>
          </div>
          <div class="entry-bottom"> <a href="<?php echo SITE_ROOT; ?>/activecms/" class="more-link">Plus de détails &raquo;</a> </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
    <div id="blog_article">
      <div class="entry-previewimage rounded"> <a href="<?php echo SITE_ROOT; ?>/apps/grafikcms/"><img src="<?php echo SITE_ROOT; ?>/assets/prochainement.gif" alt="Grafik CMS" title="Grafik CMS" width="190" height="180" /></a></div>
      <div class="entry-content">
        <h2 class="entry-heading"><a href="<?php echo SITE_ROOT; ?>/apps/grafikcms/" title="Grafik CMS">ACTIVE BOOK</a></h2>
        <div class="entry-head">
          <div class="meta">
            <ul>
              <li class="date-meta">26 Janvier 2010</li>
              <li class="params-meta">PHP4, PHP5, MySQL5, jQuery</li>
              <li class="category-meta">Version 1.0 Dev</li>
              <li class="view-meta"><?php echo $nbvisites; ?> ont essayé la démonstration en ligne</li>
              <?php
			  	//Connexion
              	database_connect();
			
				$requete = mysql_query("SELECT compteur FROM telecharger");
				while ($donnees	= mysql_fetch_array($requete)) {
				?>	
              <li class="download-meta"><?php echo $donnees['compteur']; ?> fois téléchargé</li>
              <?php } ?>
            </ul>
          </div>
          <div class="entry-bottom"> <a href="<?php echo SITE_ROOT; ?>/apps/grafikcms/" class="more-link">Plus de détails &raquo;</a> </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
<?php include ('../_inc/_sidebar.php'); ?>
<?php include ('../_inc/footer.php'); ?>
<?php include ('../_inc/javascript.php'); ?>