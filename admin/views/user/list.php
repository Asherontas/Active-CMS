<?php 

/**
 * Page title 
 * @param Title, Icon, headers
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Liste des utilissateurs', 'images/title/32/list_users.png', '1' );

$page_info = __('Voici la liste de tout les utilisateurs inscrits sur le site.<br />
		 Dans la colonne Actions, vous pouvez activer, editer et supprimer un utilisateur !');

get_result(null, null, $page_info); 

$getUsersCount = $Mysql->TabResSQL('SELECT COUNT(*) AS count FROM '.TBL_USERS);

foreach ( $getUsersCount as $nbItems ) {
    $nbItems = $nbItems['count'];
}

$itemsParPage = $ini->setVariables($ini_file, $site_section, 'NbItemsPerPage');

//Nombre de pages
$nbPages = $nbItems/$itemsParPage;

//Numéro de Page courante
if ( !isset( $_GET['page'] ) ) {

    $pageCourante = 1;
}
elseif ( is_numeric($_GET['page']) && $_GET['page']<=$nbPages ) {

    $pageCourante = $_GET['page'];
}
else {

    $pageCourante = $nbPages;
}
//Calcul de la clause LIMIT
$limitstart = $pageCourante * $itemsParPage - $itemsParPage;

//Affichage
$getAllUsersQuery = $Mysql->TabResSQL('SELECT * FROM '.TBL_USERS.'
				       ORDER BY user_registered ASC
				       LIMIT '. $limitstart .', '. $itemsParPage .'');

?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_sorter" class="tablesorter table_liste">
    <tr>
      <th width="4%" align="center"><?php echo __('ID'); ?></th>
      <th width="30%" align="center"><?php echo __('Nom et Prénom'); ?></th>
      <th width="35%" align="center"><?php echo __('Adresse Email'); ?></th>
      <th width="15%" align="center"><?php echo __('Publication'); ?></th>
      <th width="15%" align="center"><?php echo __('Permission'); ?></th>
      <th width="15%" align="center" colspan="3"><?php echo __('Actions'); ?></th>
    </tr>    
    <?php foreach ( $getAllUsersQuery as $Donnees ) { ?>
    <tr id="row_<?php echo $Donnees['ID']; ?>" class="vertical_rows">
      <td align="center"><?php echo $Donnees['ID']; ?></td>
      <td align="center"><?php if ( empty($Donnees['user_firstname']) AND empty($Donnees['user_lastname']) ) echo 'Undefined'; else echo $Donnees['user_firstname'] .' '. $Donnees['user_lastname'];?></td>
      <td align="center"><?php echo $html->mailto($Donnees['user_email'], $Donnees['user_email']); ?></td>
      <td align="center"><?php echo date($PublishedDateFormat, $Donnees['user_registered']); ?></td>
      <td align="center"><?php if ( $Donnees['user_level'] == 1 ) echo 'Admin'; elseif ( $Donnees['user_level'] == 2 ) echo 'Utilisateur'; else echo 'Anonyme'; ?></td>
      <td align="center">
      <?php
	echo $html->clear_url('', $html->img( array('src'   => 'images/status_'.$Donnees['user_status'].'.png',
						    'class' => 'user_status',
						    'id'    => $Donnees['ID'].'-'.$Donnees['user_status'].'')
						    ).'<span class="tooltip">'.__('Activer/Désactiver cet utilisateur !').'</span>',
			    array( 'class' => 'tooltips')
			);
      ?>
      </td>
      <td align="center">
      <?php
	  // Edit user
	  echo $html->url('user/edit&id='.$Donnees['ID'],
			  $html->img('images/edit.png').'<span class="tooltip">'.__('Mettre à jour cet utilisateur.').'</span>',
			  array( 'class' => 'tooltips')
			);
       ?>
      </td>
      <td align="center">
      <?php
	   // Delete user
	   echo $html->url('#', $html->img( array( 'src' => 'images/delete.png',
						   'class' => 'delete_user',
						   'id' => $Donnees['ID'])
						    ).'<span class="tooltip">'.__('Supprimer cet utilisateur !').'</span>',
			    array( 'class' => 'tooltips')
			);
      ?>
      </td>
    </tr>
  <?php  } ?>
</table>
<?php Pagination::affiche('list','&page', $nbPages, $pageCourante, 10);