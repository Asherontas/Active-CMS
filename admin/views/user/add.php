<?php

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Créer un nouveau utilisateur', 'images/title/32/add_user.png', '1' );
    
$post		= new SimpleSanitize( 'post', 'mysql', 0 ); // INSTANCIATION : PROTECT POST FORM
$UserLogin 	= null;
$UserMail 	= null;

if ( isset($_POST['submit']) AND $_POST != null ) {

        $UserLogin      = strip_tags($post->get('user_login'));
        $UserMail       = strip_tags($post->get('user_email'));
        $UserPassword   = $post->untouched('user_password');
        $UserPassVerif  = $post->untouched('user_password_verif');

    if ( !empty($UserLogin) OR !empty($UserMail) OR !empty($UserPassword) OR !empty($UserPassVerif) ) {

        if (empty($UserLogin)) {
            $erreur = __('Veuillez entrer votre Username');
        }
        elseif (!Validator::Length($UserLogin, $UsernameMaxLength, $UsernameMinLength)){
            $erreur = __('Votre nom d\'utilisateurs doit contenir au moin '. $UsernameMinLength .' charactères et '. $UsernameMaxLength .' caractères maximum !');
        }
        else {

            if (empty($UserMail)) {
                $erreur = __('Veuillez entrer votre Mail');
            }
            elseif (!Validator::Email($UserMail)) {
                $erreur = __('Votre addresse email est invalide');
            }
            else {
                if (empty($UserPassword) OR empty($UserPassVerif)) {
                    $erreur = __('Veuillez entrer votre Mot de passe !');
                }
                elseif (!Validator::Length($UserPassword, $PasswordMaxLength, $PasswordMinLength)) {
                    $erreur = __('Votre mot de passe doit contenir entre '. $PasswordMinLength .' et '. $PasswordMaxLength .' charactères ');
                }
                elseif ($UserPassword !== $UserPassVerif) {
                    $erreur = __('Les mot de passe ne sont pas identiques');
                }
                else {
                    $UserPasswordHash = md5($UserPassword);

                    $Resultat = $Mysql->TabResSQL("SELECT user_login FROM ".TBL_USERS." WHERE user_email = '$UserMail'");

                    foreach ( $Resultat as $Donnees ) {

                        $VerifUserExists = $Donnees['user_login'];
                    }
                    if ( $VerifUserExists == true ) {

                         $erreur = __('Utilisateur éxiste déjà Réessayer encore !');

                    }
                    else {

                        $MysqlQuery = $Mysql->ExecuteSQL("INSERT INTO ".TBL_USERS." (`user_login`,
                                                                                        `user_pass`,
                                                                                        `user_email`,
                                                                                        `user_registered`,
                                                                                        `user_status`,
                                                                                        `user_level`)
                                                          VALUES ( '$UserLogin',
                                                                   '$UserPasswordHash',
                                                                   '$UserMail',
                                                                   '$DatePublished',
                                                                   '$UserDefaultStatus',
                                                                   '$UserDefaultLevel')"
                                                    );
                        if ( $MysqlQuery ) {

                            $message = __('Utilisateur ajouté avec success.');

                        }else {

                            $erreur  = __('Une erreur est survenue, réssayer plus tard !');

                        } //fin de la verification de l'occurance
                    }
                }
            }
        }
    }
    else {
        $erreur = __('Veuillez remplir tout les champs !');
    }
}

$page_info = __('Voici la liste de tout les utilisateurs inscrits sur le site.<br />
		     Dans la colonne Actions, vous pouvez activer, editer et supprimer un utilisateur !');

get_result($message, $erreur, $page_info);

// Form Start
echo $form->form_open('add');

?>
<table width="100%" border="0">
      <tr>
	<td width="152"><?php echo __('Nom d\'utilisateur'); ?></td>
	<td width="480">
	<?php
	    echo $form->form_input(array('name'	 => 'user_login',
					 'value' => $UserLogin,
					 'size'	 => '50')
		    	    );
	    
	    echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Votre identifiant pour vous connecter à l\'administration').'</span>',
			    array('class' => 'tooltips'));
	?>
	</td>
      </tr>
      <tr>
	<td><?php echo __('Addresse Email'); ?></td>
	<td>
	<?php
	    echo $form->form_input(array('name'	 => 'user_email',
					 'value' => $UserMail,
					 'size'	 => '50')
		    	    );
	    echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Votre address email<br />peut être utilisé pour l\'envoi du mail par exemple').'</span>',
			    array('class' => 'tooltips'));
	?>
	</td>
      </tr>
      <tr>
	<td><?php echo __('Mot de passe'); ?></td>
	<td>
	<?php

	    echo $form->form_password(array('name'  => 'user_password',
					    'value' => '',
					    'size'  => '50')
		    	    );
	    echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Ceci est votre mot de passe pour vous connecter à l\'administration').'</span>',
			    array('class' => 'tooltips'));

	?>
	</td>
      </tr>
      <tr>
	<td><?php echo __('Confirmer mot de passe'); ?></td>
	<td>
	<?php
	    echo $form->form_password(array('name'  => 'user_password_verif',
					    'value' => '',
					    'size'  => '50')
		    	    );
	    echo $html->url('#', $html->img('images/help.png').'<span class="tooltip">'.__('Retapez votre mot de passe pour le confirmer').'</span>', 
			    array('class' => 'tooltips'));
	?>
	</td>
      </tr>
      <tr>
	<td>&nbsp;</td>
	<td><?php get_submit_button('Ajouter l\'utilisateur'); ?></td>
      </tr>
</table>
<?php echo $form->form_close();