<body>
<div id="wrapper">
  <div id="header">
    <div id="header-inner">
      <h1><a href="<?php echo SITE_URL; ?>" title="<?php echo SITE_NAME; ?>" id="logo"><?php echo SITE_NAME; ?></a></h1>
      <div id="openCloseIdentifier"></div>
      <div id="social">
        <div id="social-content" class="ie6">
          <ul>
            <li><a href="#" id="rss" class="ie6">RSS</a></li>
            <li><a href="#" id="facebook" class="ie6">Facebook</a></li>
            <li><a href="#" id="twitter" class="ie6">Twitter</a></li>
            <li><a href="#" id="flickr" class="ie6">Flickr</a></li>
            <li><a href="#" id="linkedin" class="ie6">Linked in</a></li>
            <li><a href="#" id="myspace" class="ie6">MySpace</a></li>
            <li><a href="#" id="youtube" class="ie6">Facebook</a></li>
            <li><a href="#" id="digg" class="ie6">Digg</a></li>
          </ul>
        </div>
        <div class="clear"></div>
        <div id="social-tab"> <a href="javascript:void(0);" class="btn-slide ie6" title="Connect With Us"></a> </div>
      </div>
    </div>
    <div id="menu-wrapper">
      <ul id="menu">
        <li class="menu-home"><a href="<?php echo SITE_URL; ?>" title="">Accueil</a></li>
        <?php get_links($LinksQuery); ?>
      </ul>
    </div>
  </div>
