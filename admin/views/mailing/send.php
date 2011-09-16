<?php

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Envoi Newsletters email ', 'images/title/32/send_email.png', '1' );

$post = new SimpleSanitize('get', 'html', 0); // POST PARAMS

if ( isset($_POST['submit']) AND $_POST != null ) {
	
	if ( isset($_GET) AND !empty($_GET) ) {

		$SubscribeID = $post->getInt('id');
		$Requete = $Mysql->TabResSQL('SELECT sub_email FROM '.TBL_MAILING.' WHERE ID = '.$SubscribeID.'');
		
		foreach ( $Requete as $Donnees ) {
			
			$EmailReceiver = $Donnees['sub_email'];
		}
	}
	
	$post->setDataType('post');
	
	$msg_subject    = html_entity_decode($post->get('mail_subject'));
	$msg_content    = html_entity_decode($post->get('mail_message'));
	$EmailSender    = $ini->setVariables($ini_file, $author_section, 'EmailAuthor');
	
	if ( empty($msg_subject) OR empty($msg_content) ) {
	
		$erreur = __('Veuiller entrer le sujet et le message !');
		
	}
	else {
	
		mail($EmailReceiver, $msg_subject, $msg_content, "From: $EmailSender\r\nReply-To: $EmailReceiver\r\nReturn-Path: $EmailReceiver\r\n");
		
		if ( mail == true ) {
			$message = __('Le message a été envoyé pour '.$EmailReceiver.'');
		}
		else {
			$erreur = __('Le message n\'a pas été envoyé !');
		}
	}

}

$page_info = __('Ce fichier contient tout les paramètres qui définissant les paramètres de Active CMS <br />
    			 Ne touchez pas à ce fichier si vous ne savez pas exactement ce que vous faites !');

?>
<?php get_result($message, $erreur, $page_info); ?>
<form action="" method="post" id="ctrl_submit">
    <table width="100%" border="0">
      <tr>
        <td width="10%"><?php echo __('Sujet'); ?></td>
        <td width="90%">
            <input name="mail_subject" type="text" size="50" tabindex="1" />
          <a href="#" class="tooltips"><img src="images/help.png" alt="aide" /><span class="tooltip"><?php echo __('Le sujet est important !'); ?></span></a>
      </tr>
      <tr>
        <td valign="top"><?php echo __('Message'); ?></td>
        <td width=""><textarea id="wysiwyg" class="textinput" name="mail_message" cols="100" rows="20"></textarea></td>
      </tr>
      <tr>
          <td>&nbsp;</td>
        <td><div id="submit_form">
            <input type="submit" id="submit_new" name="submit" style="float: left;" value="<?php echo __('Envoyer le message'); ?>" />
          </div>
            <div id="loading" style="display: none;"><img src="images/loading.gif" alt=""/></div></td>
      <td>&nbsp;</td>
      </tr>
    </table>
</form>