<?php

/**
 * Page title 
 * @param Title, Icon
 * Icon path images/title/<icon>
 */
get_current_page_title( 'Paramètres des pages', 'images/title/32/params_page.png', '1' );

$page_info = __('Voici la liste des pages qui ont été crées.<br /> 
		 Dans la colonne Actions, vous pouvez activer, editer et supprimer une page !');

get_result(null, null, $page_info);


$Requete = $Mysql->TabResSQL('SELECT COUNT(*) AS count FROM '.TBL_PAGES);

foreach ( $Requete as $nbItems ) {
    $nbItems = $nbItems['count'];
}

$itemsParPage = $ini->setVariables($ini_file, $site_section, 'NbItemsPerPage');

//Nombre de pages
$nbPages = $nbItems/$itemsParPage;

//Numéro de Page courante
if(!isset($_GET['page'])) {

    $pageCourante = 1;
}
elseif(is_numeric($_GET['page']) && $_GET['page']<=$nbPages) {
    
    $pageCourante = $_GET['page'];
}
else {

    $pageCourante = $nbPages;
}

//Calcul de la clause LIMIT
$limitstart = $pageCourante*$itemsParPage-$itemsParPage;

$getAllPagesQuery = $Mysql->TabResSQL('SELECT * FROM '.TBL_PAGES.'
				       ORDER BY id DESC LIMIT '.$limitstart.','.$itemsParPage.'');

?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" id="table_sorter" class="tablesorter table_liste">
    <tr>
      <th width="5%" align="center"><?php echo __('ID'); ?></th>
      <th width="50%" align="center"><?php echo __('Menu'); ?></th>
      <th width="20%" align="center"><?php echo __('Modification'); ?></th>
      <th width="20%" align="center"><?php echo __('Publication'); ?></th>
      <th width="10%" align="center" colspan="3"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ( $getAllPagesQuery as $Donnees ) { ?>
     <tr id="row_<?php echo $Donnees['ID']; ?>" class="vertical_rows">
      <td align="center"><?php echo $Donnees['ID']; ?></td>
      <td align="center"><?php if ( empty($Donnees['page_link']) ) echo 'Undefined menu'; else echo $Donnees['page_link']; ?></td>
      <td align="center"><?php echo date($PublishedDateFormat, $Donnees['page_modified']); ?></td>
      <td align="center"><?php echo date($PublishedDateFormat, $Donnees['page_published']); ?></td>
      <td align="center">
		  <?php
			  // Enable/Disable this page
			  echo $html->clear_url('', $html->img( array( 'src' => 'images/status_'.$Donnees['page_status'].'.png',
									'class' => 'page_status',
									'id' => $Donnees['ID'].'-'.$Donnees['page_status'].'')
									).'<span class="tooltip">'.__('Publier/Cacher cette page !').'</span>',
									array( 'class' => 'tooltips'));
		  ?>
      </td>
      <td align="center">
		  <?php
			  // Edit this page
			  echo $html->url('content/edit&id='.$Donnees['ID'],
					  $html->img('images/edit.png').'<span class="tooltip">'.__('Mettre à jour cette page.').'</span>',
					  array( 'class' => 'tooltips')
					);
		  ?>
      </td>
      <td align="center">
	  <?php
	   // Delete user
	   echo $html->url('#', $html->img( array( 'src' => 'images/delete.png',
						   'class' => 'delete_page',
						   'id' => $Donnees['ID'])
						    ).'<span class="tooltip">'.__('Supprimer cette page !').'</span>',
						 array( 'class' => 'tooltips')
			);
      ?>
    </tr>
  <?php  } ?>
</table>
<?php

if ( $nbItems >= $itemsParPage ) {
    include_once ( ABSBOPATH . DS . CLASSES . DS . 'paginate.class.php' ); // CLASSE PAGINATION
    Pagination::affiche('admin.php?action=liste_pages','&page', $nbPages, $pageCourante, 10);
}