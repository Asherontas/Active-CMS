<div class="page_title"><?php echo __('Page introuvable'); ?></div>
<?php

$warning = __('La page que vous avez demandée n\'existe plus ou vous n\'avez pas les droit suffisant pour y accéder !<br />
		<a href="'.BASEADMINURL.'">Retourner vers la page d\'accueil</a>');

get_result(null, null, null, $warning);

echo $html->img(array('src' => 'images/404.jpg', 'width' => '200', 'height' => '200'));