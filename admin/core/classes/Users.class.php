<?php

class Users {

	  protected $msgs	= array();
	  
	  private $uTable	= "users";
	  public $uid		= null;
	  
	  protected $showMsg;


	  /**
	   * Users::__construct()
	   * 
	   * @return
	   */
	  function __construct()
	  {
		  $this->getUid();
	  }

	  /**
	   * Users::getUid()
	   * 
	   * @return
	   */
	  private function getUid()
	  {
		  global $core;
		  if (isset($_GET['uid'])) {
			  $uid = (is_numeric($_GET['uid']) && $_GET['uid'] > -1) ? intval($_GET['uid']) : false;
			  $uid = sanitize($uid);

			  if ($uid == false) {
				  $core->error("You have selected an Invalid Uid","Users::getUid()");
			  } else
				  return $this->uid = $uid;
		  }
	  }  

	  /**
	   * Users::loginCheck()
	   * 
	   * @return
	   */
	  function loginCheck()
	  {
		  return isset($_SESSION['userid']);

	  }

	  /**
	   * Users::is_loggedin()
	   * 
	   * @param mixed $redirect
	   * @return
	   */
	  function is_loggedin($redirect = "login.php")
	  {
		  if (!$this->loginCheck())
			  redirect_to($redirect);
	  }

	  /**
	   * Users::login()
	   * 
	   * @param mixed $username
	   * @param bool $password
	   * @return
	   */
	  public function login($username, $password)
	  {
		  global $db, $msgError;

		  if ($username == "" && $password == "") {
			  $msgError = _LG_ERROR1;
		  } else {
			  $result = $this->checkStatus($username, $password);

			  if ($result == 0) {
				  $msgError = _LG_ERROR2;
			  } elseif ($result == 1) {
				  $msgError = _LG_ERROR3;
			  }

			  if (count($msgError) == 0 && $result == 5) {
				  $row = $this->getUserInfo($username);
				  $_SESSION['userid'] = $row['id'];
				  $_SESSION['username'] = $row['username'];
				  $_SESSION['userlevel'] = $row['userlevel'];

				  return true;
			  } else {
				  return false;
			  }
		  }
	  }

	  /**
	   * Users::getUserInfo()
	   * 
	   * @param mixed $username
	   * @return
	   */
	  function getUserInfo($username)
	  {
		  global $db;
		  $username = sanitize($username);
		  $username = $db->escape($username, true);

		  $sql = "SELECT * FROM users WHERE username = '" . $username . "'";
		  $row = $db->first($sql);
		  if (!$username)
			  return false;

		  if ($row > 0) {
			  return $row;
		  } else
			  return NULL;
	  }

	  /**
	   * Users::checkStatus()
	   * 
	   * @param mixed $username
	   * @param bool $password
	   * @return
	   */
	  public function checkStatus($username, $password)
	  {
		  global $db;

		  $username = sanitize($username);
		  $username = $db->escape($username, true);
		  $password = sanitize($password);

		  $sql = "SELECT password, active FROM " . $this->uTable . ""
		  . "\n WHERE username = '".$username."'";
		  $result = $db->query($sql);

		  if ($db->numrows($result) == 0)
			  return 0;

		  $row = $db->fetch($result);
		  $entered_pass = sha1($password);

		  if ($row['active'] == 0) {
			  return 1;
		  } elseif ($row['active'] == 1 && $entered_pass == $row['password']) {
			  return 5;
		  }
	  }

	  /**
	   * Users::getUsers()
	   * 
	   * @return
	   */
	  public function getUsers()
	  {
		  global $db;

		  $sql = "SELECT * FROM " . $this->uTable . ""
		  . "\n ORDER BY username";
		  $row = $db->fetch_all($sql);

		  if ($row) {
			  return $row;
		  } else
			  return 0;
	  }

	  /**
	   * Users::processUser()
	   * 
	   * @return
	   */
	  public function processUser()
	  {
		  global $db, $core, $msgAlert;

		  if (empty($_POST['username']))
			  $this->msgs['username'] = _UR_USERNAME_R;

		  if (!$this->uid) {
			  if (empty($_POST['password']))
				  $this->msgs['password'] = _UR_PASSWORD_R;
		  }

		  if (empty($_POST['email']))
			  $this->msgs['email'] = _UR_EMAIL_R;

		  if (empty($this->msgs)) {
			  $data = array(
			  'username' => sanitize($_POST['username']), 
			  'email' => sanitize($_POST['email']), 
			  'lname' => sanitize($_POST['lname']), 
			  'fname' => sanitize($_POST['fname']), 
			  'userlevel' => intval($_POST['userlevel']), 
			  'active' => intval($_POST['active'])
			  );

			  if ($this->uid)
				  $userrow = $core->getRowById($this->uTable, $this->uid);

			  if ($_POST['password'] != "") {
				  $data['password'] = sha1($_POST['password']);
			  } else
				  $data['password'] = $userrow['password'];

			  $edit_redirect = "index.php?do=users&updated=1";
			  $add_redirect = "index.php?do=users&added=1";

			  ($this->uid) ? $db->update($this->uTable, $data, "id='" . (int)$this->uid . "'") : $db->insert($this->uTable, $data);
			  $redirect = ($this->uid) ? $edit_redirect : $add_redirect;

			  if ($db->affected()) {
				  redirect_to($redirect);
			  } else
				  $msgAlert = _SYSTEM_PROCCESS;
		  } else
			  $this->msgStatus();
	  } 	  	  	  	  	  	  	   
	  /**
	   * Users::msgStatus()
	   * 
	   * @return
	   */
	  private function msgStatus()
	  {
		  global $showMsg;
		  $showMsg = "<div id=\"fader\"><div class=\"msgError\">" ._SYSTEM_ERR . "<ul class=\"error\">";
		  foreach ($this->msgs as $msg) {
			  $showMsg .= "<li>" . $msg . "</li>\n";
		  }
		  $showMsg .= "</ul></div></div>";

		  return $this->showMsg;
	  }
}