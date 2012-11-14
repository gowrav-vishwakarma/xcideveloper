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
?><?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of product
 *
 * @author Xavoc
 */
class component extends CI_Controller {
    function  __construct() {
        parent::__construct();
    }

    function addNew(){
        xDeveloperToolBars::newProjectToolBar("Component");
        $this->load->view('newcomponent.html');
    }

    function saveNewComponent(){
        jimport('joomla.filesystem.file');
        $this->load->model('com_creator');
        $safefoldername = JFile::makeSafe($this->input->get("componentName"));
        if($safefoldername == ""){
            xRedirect("index.php?option=com_xcideveloper","Component Name is not accepted. Please user variable name rules","error");
        }
        $prjDetails=array(
                'version' => $this->input->get('version'),
                'name'=>$this->input->get('ComponentTitle'),
                'author'=>$this->input->get('author'),
                'creationDate'=>$this->input->get('creationDate'),
                'copyright'=>$this->input->get('copyright'),
                'license'=>$this->input->get('license'),
                'authorEmail'=>$this->input->get('authorEmail'),
                'authorUrl'=>$this->input->get('authorUrl'),
                'version'=>$this->input->get('version'),
                'description'=>$this->input->get('description'),
                'configtable'=>$this->input->get('configtable')
                );
        
        $prjConfig=array(
                'includeCISystem'=>$this->input->get("includeCISystem")
        );

        if(!$this->com_creator->createNewComponent($safefoldername,$prjDetails,$prjConfig))
                xRedirect("index.php?option=com_xcideveloper","Component Already Exists.. Either Uninstall it or remove directory","error");

        xRedirect("index.php?option=com_xcideveloper","Component Created and Registered, Start developing or managing the component");
    }

    function generatePackage($compile=false){
        $this->load->model('com_creator');
        
        $prj=$this->com_creator->getDetails(JRequest::getCmd('xprjid'));

        $mainframe = JFactory::getApplication();
        $tmpDir=$mainframe->getCfg('tmp_path');
        $tmpComp=$tmpDir.DS."com_".$prj->component;

        jimport('joomla.filesystem.file');
        if(is_dir($tmpComp)){
            JFolder::delete($tmpComp);
        }
        JFolder::create($tmpComp);
        JFolder::copy(JPATH_ADMINISTRATOR.DS."components".DS."com_".$prj->component,$tmpComp.DS."admin");
        JFolder::copy(JPATH_SITE.DS."components".DS."com_".$prj->component,$tmpComp.DS."site");
        JFile::copy(JPATH_ADMINISTRATOR.DS."components".DS."com_".$prj->component .DS."manifest.xml",$tmpComp.DS."manifest.xml" );
        JFile::delete($tmpComp.DS."admin".DS."manifest.xml" );
//        JFile::write($tmpComp.DS."manifest.xml",$prj->manifest);

        if($compile){
            $this->load->helper('directory');
            $dirs=directory_map($tmpComp,TRUE);
            $this->compile($dirs);
        }

        jimport( 'joomla.filesystem.archive' );

        $this->load->library("zip");
        $this->load->helper('download');

        $path = $tmpComp.DS;
        $folder_in_zip = "";

        $this->zip->add_dir($folder_in_zip);  // Create folder in zip
        $this->zip->get_files_from_folder($path, $folder_in_zip);
        $this->zip->download('com_'.$prj->component.'.zip');
    }


    function removeProject(){
        $this->db->where("id",$this->input->get("xprjid"));
        $this->db->delete("xcideveloper_projects");
        xRedirect("index.php?option=com_xcideveloper","XCI project removed but NOT UNISTALLED, uninstall it manually from joomla system");
    }

    function manage(){
        jimport('joomla.filesystem.file');
        $xprjid=$this->input->get("xprjid");
        $this->db->where("id",$xprjid);
        $r=$this->db->get("xcideveloper_projects")->row();
         xDeveloperToolBars::getManageToolBar($r->com_name);
        $this->load->library("form");

        $installsql=JFile::read(JPATH_ADMINISTRATOR. DS."components".DS."com_$r->component".DS."install.sql");
        

        $this->form->open("installScript","index.php?option=com_xcideveloper&task=component.saveinstallscript")
                ->setColumns(1)
                ->textArea("Sql","name='sql' rows=30 cols=150 class='req-string'","",$installsql)
                ->hidden("","name='xprjid' value='$xprjid'")
                ->submit("Save");


        $this->jq->addtab(1,"Install Script",$this->form->get());

        $uninstallsql=JFile::read(JPATH_ADMINISTRATOR. DS."components".DS."com_$r->component".DS."uninstall.sql");
        $this->form->open("uninstallScript","index.php?option=com_xcideveloper&task=component.saveuninstallscript")
                ->setColumns(1)
                ->textArea("Sql","name='sql' rows=30 cols=150","",$uninstallsql)
                ->hidden("","name='xprjid' value='$xprjid'")
                ->submit("Save");

        $this->jq->addtab(1,"UNInstall Script",$this->form->get());

        $configFile=JFile::read(JPATH_ADMINISTRATOR. DS."components".DS."com_$r->component".DS."config.xml");
        $this->form->open("configUpdate","index.php?option=com_xcideveloper&task=component.saveconfig")
                ->setColumns(1)
                ->textArea("Global Config XML","name='xml' rows=30 cols=150","",$configFile)
                ->hidden("","name='xprjid' value='$xprjid'")
                ->submit("Save");

        $this->jq->addtab(1,"Config File",$this->form->get());

        $data['content']=$this->jq->getTab(1);
        $this->load->view('managecomponent.html',$data);
        $this->jq->getHeader();
    }

    function saveinstallscript(){
        jimport('joomla.filesystem.file');
        $xprjid=$this->input->post("xprjid");
        $this->db->where("id",$xprjid);
        $r=$this->db->get("xcideveloper_projects")->row();
        $sql=$this->input->post("sql");
        $sql=str_replace("\n\n", "\n", $sql);
        JFile::write(JPATH_ADMINISTRATOR. DS."components".DS."com_$r->component".DS."install.sql",$sql);
        xRedirect("index.php?option=com_xcideveloper&task=component.manage&xprjid=$xprjid","Install SQL Saved");
    }

    function saveuninstallscript(){
        jimport('joomla.filesystem.file');
        $xprjid=$this->input->post("xprjid");
        $this->db->where("id",$xprjid);
        $r=$this->db->get("xcideveloper_projects")->row();
        $sql=$this->input->post("sql");
        $sql=str_replace("\n\n", "\n", $sql);
        JFile::write(JPATH_ADMINISTRATOR. DS."components".DS."com_$r->component".DS."uninstall.sql",$sql);
        xRedirect("index.php?option=com_xcideveloper&task=component.manage&xprjid=$xprjid","UNInstall SQL Saved");
    }

    function saveconfig(){
        jimport('joomla.filesystem.file');
        $xprjid=$this->input->post("xprjid");
        $this->db->where("id",$xprjid);
        $r=$this->db->get("xcideveloper_projects")->row();
        $xml=$this->input->post("xml");
        $xml=str_replace("\n\n", "\n", $xml);

        JFile::write(JPATH_ADMINISTRATOR. DS."components".DS."com_$r->component".DS."config.xml",$xml);
        xRedirect("index.php?option=com_xcideveloper&task=component.manage&xprjid=$xprjid","Conif File Saved");
    }
}
?>