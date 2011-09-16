<?php
	session_start(); 
	
	define ('CHART_SESSION' ,'see_chart');
	
	$data = array();
	$analytics = new GoogleAnalytics('achoor.omar@gmail.com','volkswagen$$','ga:39514078');

	if( !isset( $_SESSION[CHART_SESSION][$analytics->_intervalId])){
		$_SESSION[CHART_SESSION][$date_id] = $analytics->getInterval();
		}
	
	$data =$_SESSION[CHART_SESSION][$date_id];
	ksort($data);

	
class GoogleAnalytics {

	private $_email;
	private $_password;
	private $_authCode;
	private $_profileId;
	
	private $_endDate;
	private $_startDate;
	
	public $_intervalId;
	
	public function __construct($email, $password, $profile_id) {
		// set the email and password
		$this->_email = $email;
		$this->_password = $password;
		
		$this->_endDate = date('Y-m-d',strtotime("-1 day"));
		$this->_startDate = date('Y-m-d',strtotime("-28 days"));

		$this->_intervalId = $this->_endDate.'##'.$this->_startDate;
			
		if (!preg_match('/^ga:\d{1,10}/',$profile_id)) {
			throw new Exception('Invalid GA Profile ID set. The format should ga:XXXXXX');
		}
		
		$this->_profileId = $profile_id; 
	}
	
	function getStartDate(){
		return $this->_startDate;
	}

	function getEndDate(){
		return $this->_endDate;
	}
	
	function getInterval(){
		$data = array();
			
		if (!$this->_authenticate()) {
			throw new Exception('Failed to authenticate, please check your email and password.');
		}
			
		$data = $this->getReport(
			array('dimensions'=>urlencode('ga:date'),
				'metrics'=>urlencode('ga:bounces,ga:entrances,ga:exits,ga:newVisits,ga:pageviews,ga:visitors,ga:visits'),
				'sort'=>'-ga:date')
			);

			$max = $this->getMax($data,'ga:visits');
			
			$this->procData($data,'ga:visitors','ch:visitors',$max);
			$this->procData($data,'ga:visits','ch:visits',$max);
			$this->procData($data,'ga:bounces','ch:bounces',$max);
			$this->procData($data,'ga:newVisits','ch:newVisits',$max);
			$this->procData($data,'ga:entrances','ch:entrances',$max);
			$this->procData($data,'ga:exits','ch:exits',$max);
			
			return $data;
	}
	
	public function getReport($properties = array()) {
		if (!count($properties)) {
			die ('getReport requires valid parameter to be passed');
			return FALSE;
		}
		
		//arrange the properties in key-value pairing
		foreach($properties as $key => $value){
            $params[] = $key.'='.$value;
        }
		//compose the apiURL string
        $apiUrl = 'https://www.google.com/analytics/feeds/data?ids='.$this->_profileId.'&start-date='.$this->_startDate.'&end-date='.$this->_endDate.'&'.implode('&', $params);
		
		//call the API
		$xml = $this->_callAPI($apiUrl);
		
		//get the results
		if ($xml) {
			$dom = new DOMDocument();
			$dom->loadXML($xml);
			$entries = $dom->getElementsByTagName('entry');
			foreach ($entries as $entry){
				$dimensions = $entry->getElementsByTagName('dimension');
				foreach ($dimensions as $dimension) {
					$dims .= $dimension->getAttribute('value').'~~';
				}

				$metrics = $entry->getElementsByTagName('metric');
				foreach ($metrics as $metric) {
					$name = $metric->getAttribute('name');
					$mets[$name] = $metric->getAttribute('value');
				}
				
				$dims = trim($dims,'~~');
				$results[$dims] = $mets;
				
				$dims='';
				$mets='';
			}
		} else {
			throw new Exception('getReport() failed to get a valid XML from Google Analytics API service');
		}
		return $results;
	}
	

	private function _callAPI($url) {
		return $this->_postTo($url,array(),array("Authorization: GoogleLogin auth=".$this->_authCode));
	}
	
	function procData(&$arr, $dimension, $proc_dimension, $max){
		foreach($arr as $key=>$item){
			$arr[$key][$proc_dimension] = floor((intval($item[$dimension])/$max)*100);
		}
	}


	function getMax($arr, $dimension="ga:visits"){
		$max = 0;
		
		foreach($arr as $key=>$item){
			if (intval($item[$dimension])>$max){
				$max = intval($item[$dimension]);
			}
		}
		
		return $max;
	}
	
	private function _authenticate() {	
		$postdata = array(
            'accountType' => 'GOOGLE',
            'Email' => $this->_email,
            'Passwd' => $this->_password,
            'service' => 'analytics',
            'source' => 'seeInterface-Analytics'
        );
		
		$response = $this->_postTo("https://www.google.com/accounts/ClientLogin", $postdata);
		//process the response;
		if ($response) {
			preg_match('/Auth=(.*)/', $response, $matches);
			if(isset($matches[1])) {
				$this->_authCode = $matches[1];
				return TRUE;
			}
		}
		return FALSE;
	}
		
	/**
    * Performs the curl calls to the $url specified. 
	*
    * @param string $url
	* @param array $data - specify the data to be 'POST'ed to $url
	* @param array $header - specify any header information
	* @return $response from submission to $url
    */
	private function _postTo($url, $data=array(), $header=array()) {
		
		//check that the url is provided
		if (!isset($url)) {
			return FALSE;
		}
		
		//send the data by curl
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		if (count($data)>0) {
			//POST METHOD
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		} else {
			$header[] = array("application/x-www-form-urlencoded");
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		}
		
		$response = curl_exec($ch);
        $info = curl_getinfo($ch);
		
        curl_close($ch);
		
		//echo '<pre>';
		//print_r($info);
		//print $response;
		//echo '</pre>';
		
		if($info['http_code'] == 200) {
			return $response;
		} elseif ($info['http_code'] == 400) {
			throw new Exception('Bad request - '.$response);
		} elseif ($info['http_code'] == 401) {
			throw new Exception('Permission Denied - '.$response);
		} else {
			return FALSE;
		}
		
	}
}

?>