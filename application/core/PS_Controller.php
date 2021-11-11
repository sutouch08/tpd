<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PS_Controller extends CI_Controller
{
  public $pm;
  public $home;
  public $ms;
  public $mc;
	public $error;
  public $_user;
  public $_SuperAdmin = FALSE;
  public $isGM = FALSE;
  public $uid;

  public function __construct()
  {
    parent::__construct();
    //--- check is user has logged in ?
    _check_login();

    $this->uid = get_cookie('uid');
    $this->_user = $this->user_model->get_user_by_uid($this->uid);
    $this->_SuperAdmin = $this->_user->ugroup_id == -987654321 ? TRUE : FALSE;
    $this->isGM = $this->_user->isGM == 1 ? TRUE : FALSE;
    //--- get permission for user
    $this->pm = get_permission($this->menu_code);

    $this->ms = $this->load->database('ms', TRUE); //--- SAP database
    $this->mc = $this->load->database('mc', TRUE); //--- Temp Database

  }



  public function _response($sc = TRUE)
	{
		echo $sc === TRUE ? 'success' : $this->error;
	}


  public function deny_page()
  {
    return $this->load->view('deny_page');
  }


  public function error_page()
  {
    return $this->load->view('page_error');
  }
}

?>
