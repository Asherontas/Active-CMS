<table id="page_global" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <tr>
	<td align="center"><h1><?php echo $WebSiteName; ?></h1></td>
    </tr>
    <td>
	<table id="content_global" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="32%" id="page_menu" valign="top">
	    <table width="100%" border="0">
              <tr>
                <td><table class="title_menu" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="8%"><?php echo $html->img('images/user.png'); ?></td>
                      <td width="92%" align="left">
			  <?php echo __('Bienvenue'); ?> [<?php echo $html->url('user/list', $_SESSION['username']); ?>]
		      </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td><table align="left" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="7%"><?php echo $html->img('images/panneau.png'); ?></td>
                      <td width="93%"><?php echo $html->url('', __('Tableau de bord')); ?></td>
                    </tr>
                    <tr>
                      <td width="7%"><?php echo $html->img('images/ajouter_page.png'); ?></td>
                      <td width="93%"><?php echo $html->url('content/add', __('Ajouter une page')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/list_page.png'); ?></td>
                      <td><?php echo $html->url('content/list', __('Paramètre des pages')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/site_parametre.png'); ?></td>
                      <td><?php echo $html->url('edit/site', __('Paramètre du site')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/silk_folder.png'); ?></td>
                      <td><?php echo $html->url('edit/template', __('Editeur de template')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/mailing.png'); ?></td>
                      <td><?php echo $html->url('mailing/list', __('Gestionnaire de Mail')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/ini.png'); ?></td>
                      <td><?php echo $html->url('edit/ini', __('Configuration de fichier INI')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/modules.png'); ?></td>
                      <td><?php echo $html->url('modules/list', __('Modules complémentaires')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/voir.png'); ?></td>
                      <td><?php echo $html->url(FRONT_END_URL, __('Prévisualiser'), array('target' => '_blank')); ?></td>
                    </tr>
                    <tr>
                      <td><p>&nbsp;</p></td>
                      <td><p>&nbsp;</p></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/add-user.png'); ?></td>
                      <td><?php echo $html->url('user/add', __('Ajouter un utilisateur')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/users.png'); ?></td>
                      <td><?php echo $html->url('user/list', __('Paramètre des utilisateurs')); ?></td>
                    </tr>
                    <tr>
                      <td><?php echo $html->img('images/ip.png'); ?></td>
                      <td><strong><?php echo __('Votre iP : '); ?><?php echo $_SERVER["REMOTE_ADDR"]; ?></strong></td>
                    </tr>
                    <tr>
                        <div id="datepicker"></div>
                    </tr>
                  </table></td>
              </tr>
            </table>
	  </td>
	<td width="75%" id="contenu" valign="top">
    <div class="main">