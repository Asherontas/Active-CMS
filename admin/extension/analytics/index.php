<?php include ('php/module.analitycs.php'); 	

include_once ('../../config.php' ); // HEAD
include_once ( ADMIN_ROOT . DS . CLASSES . DS . 'lang.class.php' ); // CLASSE LANGUE

#include_once ( ADMIN_ROOT . DS . CLASSES . DS . 'cache.class.php' ); // CLASSE CACHE

// VERIF LANGUE
if (isset($_GET['ln'])) $_SESSION['language'] = $_GET['ln'];

	Language::Set($_SESSION['language']);

	Language::SetAuto(true);
include ( ADMIN_ROOT . DS . TPL . DS . '_head.php' ); // HEAD

?>
<script type="text/javascript">
			var minimal=false;
		</script>

<!--[if IE 6]>
			<script type="text/javascript">	
					minimal=true;
			</script>
		<![endif]-->

<!-- Jquery directly from google servers-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" ></script>
<script type="text/javascript" src="js/seeAnalytics.js" ></script>
<link rel="stylesheet" type="text/css" media="all" href="css/default.css" />
<?php        
include ( ADMIN_ROOT . DS . TPL . DS . 'header.php' ); // HEADER
include ( ADMIN_ROOT . DS . TPL . DS . 'navigation.php' ); //MENU NAVIGATION
?>
<h2>www.site.com </h2>
(<?php echo $analytics->getStartDate().' au '.$analytics->getEndDate();  ?>)</span> 

<!-- dropdown menu --> 
<a class="theme" href="#">Metrics &amp; Colors</a> 

<!-- hidden loading state --> 
<span class="loader">Loading metric</span>
</div>

<!-- chart bars -->
<ul class="chart clearfix">
  <?php
					foreach($data as $key=>$item){
						// format date
						$date = substr($key,0,4).'-'.substr($key,-4,2).'-'.substr($key,-2);
						
						echo '<li><div class="c2 pr'.$item['ch:visits'].'"><strong>'.$date.'</strong> &nbsp;&nbsp;&nbsp;'.$item['ga:visitors'].' Visitors, '.$item['ga:visits'].' Visits</div><div class="c1 pr'.$item['ch:visitors'].'"></div></li>';
					}
				?>
</ul>
<div class="details"> 
  <!-- Current day selection --> 
  <span>&nbsp;</span> 
  
  <!-- Chart Legend -->
  <ol>
    <li class="c2">
      <div class="thBlack"></div>
      <a rel="c2">Visites</a></li>
    <li class="c1">
      <div class="thBlue"></div>
      <a rel="c1">Visiteurs</a></li>
  </ol>
</div>

<!-- dropdown settings -->
<div class="settings"> 
  
  <!-- metrics -->
  <div class="metrics right"> <span>Bounces</span> <span>New visits</span> <span class="selected">Visitors</span> </div>
  <div class="metrics left"> <span class="selected">Visits</span> </div>
  
  <!-- colors -->
  <div class="colors">
    <div class="thRed right" onclick="changeTheme('c2','thRed')"></div>
    <div class="thGreen right" onclick="changeTheme('c2','thGreen')"></div>
    <div class="thPink right" onclick="changeTheme('c2','thPink')"></div>
    <div class="thBrown right" onclick="changeTheme('c2','thBrown')"></div>
    <div class="thBlue left" onclick="changeTheme('c1','thBlue')"></div>
    <div class="thOrange left" onclick="changeTheme('c1','thOrange')"></div>
    <div class="thBlack left" onclick="changeTheme('c1','thBlack')"></div>
    <div class="thViolet left" onclick="changeTheme('c1','thViolet')"></div>
  </div>
</div>
</div>
<?php
include ( ADMIN_ROOT . DS . TPL . DS . 'footer.php' ); // FOOTER
?>
</body>
</html>