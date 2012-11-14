<?php
/*------------------------------------------------------------------------
# com_xcideveloper - Seamless merging of CI Development Style with Joomla CMS
# ------------------------------------------------------------------------
# author    Xavoc International / Gowrav Vishwakarma
# copyright Copyright (C) 2011 xavoc.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.xavoc.com
# Technical Support:  Forum - http://xavoc.com/index.php?option=com_discussions&view=index&Itemid=157
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?><?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class com_xcideveloper extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
            xDeveloperToolBars::getDefaultToolBar();
            $this->load->model('xprojects');
            $data['result']=$this->xprojects->getAll()->result();
            $this->load->view('xcideveloper.html',$data,false,true);
	}
        
        function help(){
            xDeveloperToolBars::helpToolBar();
            JRequest::setVar('layout','important');
            $c=$this->load->view('help.html',null,true);
            $this->jq->addTab(1,"Important Points",$c);
            
            JRequest::setVar('layout','formlibrary');
            $this->jq->addTab(1,"New Form Library",$this->load->view('help.html',null,true));
//            $this->jq->addTab(1,"New jQuery Library","jq");

            $data['tabs']=$this->jq->getTab(1);
            
            JRequest::setVar('layout','default');
            $this->load->view('help.html',$data);
            $this->jq->getHeader();
        }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */