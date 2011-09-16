<?php

$html_title = 'Active CMS | Se connecter';

include TPL . '_head.php'; // HEAD LOGIN
include TPL . 'header.php'; // HEADER

$post  = new SimpleSanitize( 'post', 'strict', 0 ); // INSTANCIATION : PROTECT POST FORM

if ( isset($_POST['submit']) ) {

    $UserLogin      = $post->get('username');
    $UserPassword   = md5($post->get('password'));

    if ( !empty($UserLogin) AND !empty($UserPassword) ) {

	$Resultat = $Mysql->TabResSQL('SELECT user_login, user_pass FROM '.TBL_USERS.'
								   WHERE user_login = "'.$UserLogin.'"
								   AND user_pass = "'.$UserPassword.'"
								   AND user_status = "1"');

	if ( $Resultat ) {

	    $_SESSION['username'] = $UserLogin;
	    $_SESSION['password'] = $UserPassword;
	    
	    $message =  __('Préparation de l\'dministration en cours...');
	    header('Refresh: 2;');
	}
	else {
		$erreur =  __('Mot de passe ou identifiant incorrect !');
	}
    }
    else {
	$erreur =  __('Veuillez saisir votre nom d\'utilisateur !');
    }

}

?>
<form name="form" method="post" action="">
  <table id="login" width="400" border="0">
    <tr>
      <td><table width="100%" border="0">
          <tr>
            <td>
		<?php echo $html->img(array('src' => 'images/logo.jpg',
				     'alt' => 'ActiveCMS',
				     'width' => '350',
				     'height' => '70'
				    )
				);
		?>
	    </td>
          </tr>
          <tr>
            <td><?php get_result($message, $erreur, $page_info); ?></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
          <tr>
            <td valign="top">
		<?php echo $html->img(array('src' => 'images/unlock.png',
				     'alt' => 'Login',
				     'style' => 'margin-top:15px'
				    )
				);
		?>
	    </td>
            <td><table width="100%" border="0" cellspacing="5">
                <tr>
                  <td width="48%"><?php echo __('Utilisateur : ') ?></td>
                  <td width="52%"><input type="text" name="username" id="username" style="float:right;" size="25" /></td>
                </tr>
                <tr>
                  <td><?php echo __('Mot de passe : '); ?></td>
                  <td><input type="password" name="password" id="password" style="float:right;" size="25" /></td>
                </tr>
                <tr>
                  <td></td>
                  <td>
		      <?php
			echo $form->form_submit(array(  'name'  => 'submit',
							'type'  => 'submit',
							'id'    => 'submit_new',
							'value' => __('Se connecter'),
							'style' => 'float:left;'
						    )
					    );

			echo $html->img(array('src' => 'images/loading.gif', 'id' => 'loading', 'style' => 'display:none;'));
		    ?>
		  </td>
                </tr>
              </table></td>
          </tr>
        </table></td>
    </tr>
    <tr>
      <td align="center">Active <sup style="font-size:0.7em;">CMS</sup> | <a href="http://www.activedev.net">Activedev.net</a></td>
    </tr>
  </table>
</form>
