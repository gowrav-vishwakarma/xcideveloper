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
?><?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

 jimport('joomla.html.toolbar');

 class xDeveloperToolBars extends JObject
 {
        function getDefaultToolBar() {

              JToolBarHelper::title( 'Project Developed By xCIDeveloper', 'generic.png' );
              JToolBarHelper::preferences(JRequest::getCmd('option'), '500');
        }
        
        function configToolBar() {
        JToolBarHelper::title('Manage Configurations Here', 'generic.png');
        JToolBarHelper::preferences(JRequest::getVar('option'), '500');
        JToolBarHelper::cancel('welcome.index');
//        JToolBarHelper::addNewX('config_cont.index', "Configuration");
    }

    function configEditToolBar($configFile) {
        JToolBarHelper::title("Edit $configFile Config Here", 'generic.png');
        JToolBarHelper::save('config_cont.saveConfig');
        JToolBarHelper::cancel('config_cont.index');
        JToolBarHelper::addNewX('config_cont.edit', "Configuration");
    }
        
        function getSettingToolBar(){
            JToolBarHelper::addNewX('config_cont.index','Settings');
        }
 }
?>