<?php 	
		/**
			Chart.php handles ajax request, the url is :  chart.php?show=metric
		**/
	
		// Set the header to json for jquery
		header('content-type:application/json');
		
		include ('php/module.analitycs.php');
		
		$json_data =array();
		$encoded = null;
		
		if (is_array($_GET)  &&  array_key_exists('show',$_GET)){
			$title = trim(ucfirst($_GET['show']));
			
			$c1 = strtolower(substr($title,0,1)).substr($title,1);
			$c2 = 'visits';
			$count = 0;
			
			$json_data['title'] = $title;
			$json_data['metric'] = 'ch:'.$c1;
			
			// Loop to analytics data
			foreach($data as $key=>$item){
				$date = substr($key,0,4).'-'.substr($key,-4,2).'-'.substr($key,-2);
				$label = '<strong>'.$date.'</strong> &nbsp;&nbsp;&nbsp;'.$item['ga:visitors'].' Visitors, '.$item['ga:'.$c1].' '.$title;
				
				$json_data['items'][$count]['value'] = $item['ch:'.$c1];
				$json_data['items'][$count]['label'] = $label;
				$count++;
			}
		}
		
		if (count($json_data)>0){ 
		
			// encode array to json
			$encoded = json_encode($json_data);
			
		}
		
		echo $encoded;
?>