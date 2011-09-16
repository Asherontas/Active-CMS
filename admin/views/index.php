<?php

/**
 * Page title 
 * @param Title, Icon
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Tableau de bord <span> Nous Somme le '. date('d-m-Y') .'</span>', 'images/title/32/home.png', '1' );

$warning = __('Le répertoire de l\'installation est toujours présent !<br />
		Veuillez supprimer, déplacer ou renommer ce répertoire avant d\'utiliser votre site.');

if ( file_exists('../install/index.php') AND is_dir( '../install/')) {

	get_result(null, null, null, $warning);
}

?>
<table width="100%" border="0">
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="0">
              <tr>
                <td valign="bottom">
					<table width="100%" border="0">
						<tr>
							<td><div class="icon"><?php echo $html->url('content/add', $html->img('images/add_page.png').'<span>'.__('Ajouter une page').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('content/list', $html->img('images/edit_page.png').'<span>'.__('Gestion des pages').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('user/list', $html->img('images/edit_users.png').'<span>'.__('Gestion des utilisateurs').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('editeur', $html->img('images/gestion.png').'<span>'.__('Gestion de template').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('editeur', $html->img('images/gestion.png').'<span>'.__('Gestion de template').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('editeur', $html->img('images/gestion.png').'<span>'.__('Gestion de template').'</span>'); ?></div></td>
						</tr>
						<tr>
							<td><div class="icon"><?php echo $html->url('content/settings', $html->img('images/config.png').'<span>'.__('Configuration').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('mailing/', $html->img('images/mail_send.png').'<span>'.__('Newsletters').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url(FRONT_END_URL, $html->img('images/icon_screen.png').'<span>' . __('Prévisulaiser') . '</span>', array('target' => '_blank')); ?></div></td>
							<td><div class="icon"><?php echo $html->url('http://www.activedev.net/questions/', $html->img('images/questions.png').'<span>'.__('Aide').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('http://www.activedev.net/questions/', $html->img('images/questions.png').'<span>'.__('Aide').'</span>'); ?></div></td>
							<td><div class="icon"><?php echo $html->url('http://www.activedev.net/questions/', $html->img('images/questions.png').'<span>'.__('Aide').'</span>'); ?></div></td>
						</tr>
					</table>
				</td>
                <td align="right">
					<?php echo $html->img( array( 'src' => 'images/bienvenue.jpg', 'alt' => __('Bienvenue'), 'width' => '200', 'height' => '200' ) ); ?>
				</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>