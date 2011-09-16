<body>
<table class="top_table" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table class="header_table" width="900" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="760"><a href="#" onclick="location.reload(true); return false;"><img src="<?php echo BASEURL; ?>/images/logo_admin.png" alt="grafik CMS" /></a></td>
          <td width="30" align="right">
	  <?php
	      if ( isset($_SESSION['username']) ) {

		  $icon_home_admin = $html->img(array('src' => 'images/Home.png',
						'alt' => __('Accueil'),
						'title' => __('Acceuil administration')
					    )
					);
		  echo $html->url(BACK_END_URL, $icon_home_admin, array('target' => '_blank'));

	     }
	     else {
			 
			echo $html->img(array('src' => 'images/Home_nb.png', 'alt' => __('Accueil'), 'title' => __('Acceuil administration')));
	    }
	  ?>
	  </td>
          <td width="30" align="right">
	      <?php
		  $icon_preview_admin = $html->img(array('src' => 'images/view.png',
						    'alt' => __('Visualiser'),
						    'title' => __('Visualiser le site')
						   )
					    );
		  echo $html->url(FRONT_END_URL, $icon_preview_admin, array('target' => '_blank'));
	      ?>
	  </td>
          <td width="30" align="right">
	  <?php
	    if ( isset($_SESSION['username']) ) {

		  $icon_logout_admin = $html->img(array('src' => 'images/Lock.png',
						'alt' => __('Se déconnecter'),
						'title' => __('Se déconnecter'),
						'id' => 'logout'
					    )
					);
		  echo $html->url('core/logout.php', $icon_logout_admin);

	     }
	     else {
		 echo $html->img(array('src' => 'images/Lock_nb.png', 'alt' => __('Se déconnecter'), 'title' => __('Se déconnecter')));
	    }
	    ?>
	  </td>
          <td width="30" align="right">
	       <?php
		  $icon_support_admin = $html->img(array('src' => 'images/hey.png',
						'alt' => __('Aide'),
						'title' => __('Demande de soutien')
					       )
					);
		  echo $html->url('http://www.activedev.net/activecms/content.php', $icon_support_admin, array('target' => '_blank'));
	      ?>
	  </td>
          <td width="30" align="right">
	      	   <?php
	    if ( isset($_SESSION['username']) ) {

		  $icon_info_admin = $html->img(array('src' => 'images/Info.png',
						'alt' => __('Info sur l\'application'),
						'title' => __('Info sur l\'application')
					    )
					);
		  echo $html->url('#', $icon_info_admin, array('onclick' => '$(\'#about\').fadeIn(1000); return false;'));

	     }
	     else {
		 echo $html->img(array('src' => 'images/Info_nb.png', 'alt' => __('Info sur l\'application'), 'title' => __('Info sur l\'application')));
	    }
	    ?>
	  </td>
          <td width="30" align="right">
	      <?php
		  $icon_email_admin = $html->img(array('src' => 'images/Letter.png',
						'alt' => __('Email'),
						'title' => __('Email')
					       )
					);
		  echo $html->mailto(ADMIN_EMAIL, $icon_email_admin, array('target' => '_blank'));
	      ?>
	  </td>
          <td width="20" align="right"><a href="admin.php?ln=fr">FR</a><br /><a href="admin.php?ln=en">EN</a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>