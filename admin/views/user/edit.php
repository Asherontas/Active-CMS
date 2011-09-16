<?php

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Paramètres du compte', 'images/title/32/edit_user.png', '1' );

if(isset($_FILES['user_avatar'])) {

    if(is_file($_FILES['user_avatar']['tmp_name'])) {

            define('DESTINATION', 'storage/avatar/');
            define('RESIZEBY', 'w');
            define('RESIZETO', 50);
            define('QUALITY', 100);

            $image = new Image($_FILES['user_avatar']['tmp_name']);

            $image->destination = DESTINATION.$_FILES['user_avatar']['name'];
            $image->constraint = RESIZEBY;
            $image->size = RESIZETO;
            $image->quality = QUALITY;

            $image->render();

    }
    else {
            $erreur = true;
    }
}

$post   = new SimpleSanitize( 'get', 'mysql', 0 ); // INSTANCIATION : PROTECT POST FORM

$UserID = $post->getInt('id');

if( isset($_POST['submit']) AND $_POST != null) {

    $post->setDataType('post');
    $post->setLevel('html');
  
      $FirstName 	= $post->get('user_first_name');
      $LastName 	= $post->get('user_last_name');
      $AdressEmail 	= $post->get('user_email');
      $PseudoName	= $post->get('user_login');
      $Password 	= $post->untouched('user_password');
      $Permission	= $post->getInt('user_permission');

      if (empty($PseudoName)) {
            $erreur = __('Veuillez entrer votre Nom d\'utilisateur.');
        }
        elseif (!Validator::Length($PseudoName, $UsernameMaxLength, $UsernameMinLength)){
            $erreur = __('Votre nom d\'utilisateurs doit contenir au moin '. $UsernameMinLength .' charactères et '. $UsernameMaxLength .' caractères maximum !');
        }
        else {

            if (empty($AdressEmail)) {
                $erreur = __('Veuillez entrer votre Adresse email');
            }
            elseif (!Validator::Email($AdressEmail)) {
                $erreur = __('Your email is invalid');
            }
            else {

                if (!empty($Password) AND !Validator::Length($Password, $PasswordMaxLength, $PasswordMinLength)) {
                    $erreur = __('Votre mot de passe doit contenir entre '. $PasswordMinLength .' et '. $PasswordMaxLength .' charactères !');
                }
                else {

                    $Resultat = $Mysql->TabResSQL('SELECT user_login FROM '.TBL_USERS.'
                                                   WHERE user_email = "'.$AdressEmail.'"
                                                   AND ID NOT IN ('.$UserID.')');
                    foreach ( $Resultat as $Donnees ) {

                        $VerifUserExists = $Donnees['user_login'];
                    }
                    if ( $VerifUserExists != null ) {

                         $erreur = __('Utilisateur éxiste déjà, veuillez choisir un autre identifiant !');

                    }
                    else {
                        
                         if ( isset($_FILES['user_avatar']) ) {
                             $FileImg  = '<img src="'. DESTINATION . $_FILES['user_avatar']['name'].'" class="user_avatar" />';
                         }
                         
                         $ImgAvatar    = $_FILES['user_avatar']['name'];
                         
                         if ( !empty($Password) ) {
                                $UserPasswordHash = 'user_pass = "'.md5($Password).'",';
                         }
                        $MysqlQuery = $Mysql->ExecuteSQL('UPDATE '.TBL_USERS.' SET user_login = "'.$PseudoName.'",
							  user_firstname = "'.$FirstName.'",
							  user_lastname = "'.$LastName.'",
							  '.$UserPasswordHash.'
							  user_email = "'.$AdressEmail.'",
							  user_avatar = "'.$ImgAvatar.'",
							  user_level = "'.$Permission.'"
                                                          WHERE id = "'.$UserID.'"');
                        if ( $MysqlQuery ) {

                            $message = __('Utilisateur à été mis à jour.');

                        }else {

                            $page_info  = __('Aucune Modification !');

                        } //fin de la verification de l'occurance
                    }
                }
            }
	    
       } // End if
}

$page_info = __('Voici la liste de tout les utilisateurs inscrits sur le site.<br />
		 Dans la colonne Actions, vous pouvez activer, editer et supprimer un utilisateur !');

get_result($message, $erreur, $page_info);

$getProfileUserData = $Mysql->TabResSQL('SELECT * FROM '.TBL_USERS.' WHERE ID = '.$UserID);

foreach ( $getProfileUserData as $Donnees ) {

    $UserFirstName  = $Donnees['user_firstname'];
    $UserLastName   = $Donnees['user_lastname'];
    $UserEmail      = $Donnees['user_email'];
    $UserLevel      = $Donnees['user_level'];
    $UserAvatar     = $Donnees['user_avatar'];
    $UserLogin      = $Donnees['user_login'];

    
}

// Form Start
echo $form->form_open('');

?>
<table width="100%" border="0">
    <tr>
	<td width="20%"><?php echo __('Nom / Prénom'); ?></td>
	<td width="80%">
	<?php
		echo $form->form_input(array('name'	=> 'user_first_name',
					     'type'	=> 'text',
					     'value'	=> $UserFirstName,
					     'size'	=> '20'));
		
		echo $form->form_input(array('name'	=> 'user_last_name',
					     'type'	=> 'text',
					     'value'	=> $UserLastName,
					     'size'	=> '21'));

		echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Votre Nom et prénom').'</span>',
				array('class' => 'tooltips'));
	?>
	</td>
   </tr>
   <tr>
    <td width="152"><?php echo __('Nom d\'utilisateur'); ?></td>
    <td width="480">
    <?php

	echo $form->form_input(array('name'	=> 'user_login',
				     'type'	=> 'text',
				     'value'	=> $UserLogin,
				     'size'	=> '50'));

	echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Votre identifiant !').'</span>',
			array('class' => 'tooltips'));

    ?>
    </td>
    </tr>
   <tr>
    <td width="152"><?php echo __('Addresse email'); ?></td>
    <td width="480">
    <?php

	echo $form->form_input(array('name'	=> 'user_email',
				     'type'	=> 'text',
				     'value'	=> $UserEmail,
				     'size'	=> '50'));

	echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Votre Addresse Email.').'</span>',
			array('class' => 'tooltips'));

    ?>
    </td>
   </tr>
  <tr>
    <td><?php echo __('Mot de passe'); ?></td>
    <td>
    <?php

	echo $form->form_password(array('name'	=> 'user_password',
					'value' => '',
					'size'	=> '50'));

	echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Laisser ce champ vide si vous ne souhaiter pas modifier votre mot de passe.').'</span>',
			array('class' => 'tooltips'));

    ?>
    </td>
  </tr>
  <tr>
      <td><?php __('Permission'); ?></td>
    <td>
	<div class="demo-dark" id="demo2">
	 <?php

	 if ( $Donnees['user_level'] == 1 ) {
	     $checked_1 = TRUE; $checked_2 = FALSE; $checked_3 = FALSE;
	 }
	 elseif ( $Donnees['user_level'] == 2 ) {
	     $checked_1 = FALSE; $checked_2 = TRUE; $checked_3 = FALSE;
	 }
	 else {
	     $checked_1 = FALSE; $checked_2 = FALSE; $checked_3 = TRUE;
	 }

	    echo $form->form_label(__('Admin'), 'radio1');
	    echo $form->form_radio(array( 'name'        => 'user_permission',
					  'id'          => 'radio1',
					  'class'	=> 'radioSlider',
					  'value'       => '1',
					  'checked'     => $checked_1,
					  'style'       => ''
				    )
				);

	    echo $form->form_label(__('Membre'), 'radio2');
	    echo $form->form_radio(array( 'name'        => 'user_permission',
					  'id'          => 'radio2',
					  'class'	=> 'radioSlider',
					  'value'       => '2',
					  'checked'     => $checked_2,
					  'style'       => ''
					)
				);
	    
	    echo $form->form_label(__('Utilisateur'), 'radio3');
	    echo $form->form_radio(array( 'name'        => 'user_permission',
					  'id'          => 'radio3',
					  'class'	=> 'radioSlider',
					  'value'       => '3',
					  'checked'     => $checked_3,
					  'style'       => ''
					)
				);
	    ?>
	</div>
    </td>
  </tr>
  <tr>
    <td><?php echo __('Photo du profil'); ?></td>
    <td>
    <?php
    
	echo $form->form_upload('user_avatar');
	echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Votre image du profil (Avatar).').'</span>',
		    array('class' => 'tooltips'));
    ?>
    </td>
	<td>
	<?php
	    if ( isset( $FileImg ) ) {
		echo $FileImg;
	    }
	    elseif ( !empty($UserAvatar) ) {
		echo $html->img(array('src' => 'storage/avatar/'.$UserAvatar, 'class' => 'user_avatar'), TRUE);
	    }else {
		echo $html->img(array('src' => 'storage/avatar/edit_users.png', 'class' => 'user_avatar'), TRUE);
	    }
	?>
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>
	<?php
	    echo $form->form_submit(array(  'name'  => 'submit',
					    'type'  => 'submit',
					    'id'    => 'submit_new',
					    'value' => __('Mettre à jour'),
					    'style' => 'float:left;'
					)
				);
	    
	    echo $html->img(array('src' => 'images/loading.gif', 'id' => 'loading', 'style' => 'display:none;'));
	?>
    </td>
  </tr>
</table>
<?php echo $form->form_close();