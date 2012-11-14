<?php

/* ------------------------------------------------------------------------
  # com_xcideveloper - Seamless merging of CI Development Style with Joomla CMS
  # ------------------------------------------------------------------------
  # author    Xavoc International / Gowrav Vishwakarma
  # copyright Copyright (C) 2011 xavoc.com. All Rights Reserved.
  # @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
  # Websites: http://www.xavoc.com
  # Technical Support:  Forum - http://xavoc.com/index.php?option=com_discussions&view=index&Itemid=157
  ------------------------------------------------------------------------- */
// no direct access
defined('_JEXEC') or die('Restricted access');
?><?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class com_creator extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getAll() {
        $this->db->where('extension_type', 'com');
        $result = $this->db->get('xcideveloper_projects');
        return $result;
    }

    function getDetails($prjID) {
        $this->db->where('id', $prjID);
        return $this->db->get('xcideveloper_projects')->row();
    }

    function createNewComponent($safefoldername, $prjDetails, $prjConfig) {
        jimport('joomla.filesystem.file');
        //CHECK and copy FOLDERS (FOLDER MANAGEMENT)
        if (is_dir(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_" . $safefoldername) or is_dir(JPATH_SITE . DS . "components" . DS . "com_" . $safefoldername)) {
            return false;
        }
        JFolder::copy(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_xcideveloper" . DS . "com_structure" . DS . "admin", JPATH_ADMINISTRATOR . DS . "components" . DS . "com_" . $safefoldername);
        JFolder::copy(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_xcideveloper" . DS . "com_structure" . DS . "site", JPATH_SITE . DS . "components" . DS . "com_" . $safefoldername);

        if ($prjConfig['includeCISystem'] == "1") {
            JFolder::copy(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_xcideveloper" . DS . "com_structure" . DS . "system", JPATH_ADMINISTRATOR . DS . "components" . DS . "com_" . $safefoldername . DS . "system");
        }

        return $this->_initComponent($safefoldername, $prjDetails, $prjConfig);
    }

    private function _initComponent($comp, $prjDetails, $prjConfig) {
        //COpy FILES (FILES MANAGEMENT)
//        JFile::copy(JPATH_ADMINISTRATOR. "\\components\\com_$comp\\xcideveloper.php", JPATH_ADMINISTRATOR ."\\components\\com_".$comp."\\$comp.php");
//        JFile::copy(JPATH_SITE. "\\components\\com_$comp\\xcideveloper.php", JPATH_SITE ."\\components\\com_".$comp."\\$comp.php");

        $entryFileAdmin = JFile::read(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_$comp" . DS . "xcideveloper.php");
        $entryFileAdmin = str_replace("{component}", "admin." . $comp, $entryFileAdmin);
        JFile::write(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_" . $comp . DS . "$comp.php", $entryFileAdmin);

        $entryFileSite = JFile::read(JPATH_SITE . DS . "components" . DS . "com_$comp" . DS . "xcideveloper.php");
        $entryFileSite = str_replace("{component}", "site." . $comp, $entryFileSite);
        JFile::write(JPATH_SITE . DS . "components" . DS . "com_" . $comp . DS . "$comp.php", $entryFileSite);

        JFile::delete(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_$comp" . DS . "xcideveloper.php");
        JFile::delete(JPATH_SITE . DS . "components" . DS . "com_$comp" . DS . "xcideveloper.php");

        //Set new components admin /site side route for default cntroller, changee welcome.php to default controller and its class in default controller
//        $this->replace_component(JPATH_ADMINISTRATOR. DS."components".DS."com_$comp".DS."config".DS."routes.php","{component}","com_".$comp);
//        $this->replace_component(JPATH_SITE. DS."components".DS."com_$comp".DS."config".DS."routes.php","{component}","com_".$comp);
//
//        $this->replace_component(JPATH_ADMINISTRATOR. DS."components".DS."com_$comp".DS."controllers".DS."welcome.php","{component}","com_".$comp);
//        $this->replace_component(JPATH_SITE. DS."components".DS."com_$comp".DS."controllers".DS."welcome.php","{component}","com_".$comp);
//
//        JFile::move(JPATH_ADMINISTRATOR. DS."components".DS."com_$comp".DS."controllers".DS."welcome.php",JPATH_ADMINISTRATOR. DS."components".DS."com_$comp".DS."controllers".DS."com_$comp.php");
//        JFile::move(JPATH_SITE. DS."components".DS."com_$comp".DS."controllers".DS."welcome.php",JPATH_SITE. DS."components".DS."com_$comp".DS."controllers".DS."com_$comp.php");
        // Enter in Joomlas conponents Table as well as in our xcideveloper_project table
        jimport('joomla.version');
        $version = new JVersion();

        if ($version->RELEASE < 1.6) {
            $data = array(
                'name' => $prjDetails['name'],
                'link' => 'option=com_' . $comp,
                'admin_menu_link' => 'option=com_' . $comp,
                'admin_menu_alt' => $prjDetails['name'],
                'option' => 'com_' . $comp,
                'admin_menu_img' => 'js/ThemeOffice/component.png',
                'enabled' => 1
            );
            $this->db->insert('components', $data);
        } elseif ($version->RELEASE >= 1.6 and $version->RELEASE < 1.7) {
            
        } elseif ($version->RELEASE >= 1.7) {
            $data = array(
                'name' => $prjDetails['name'],
                'type' => 'component',
                'element' => 'com_' . $comp,
                'client_id' => 1,
                'enabled' => 1
            );
            $this->db->insert('extensions', $data);
        }
        $xml = JFile::read(JPATH_COMPONENT_ADMINISTRATOR . DS . "com_structure" . DS . "manifest.base");

        $xml = str_replace("{name}", $prjDetails['name'], $xml);
        $xml = str_replace("{author}", $prjDetails['author'], $xml);
        $xml = str_replace("{creationDate}", $prjDetails['creationDate'], $xml);
        $xml = str_replace("{copyright}", $prjDetails['copyright'], $xml);
        $xml = str_replace("{license}", $prjDetails['license'], $xml);
        $xml = str_replace("{authorEmail}", $prjDetails['authorEmail'], $xml);
        $xml = str_replace("{authorUrl}", $prjDetails['authorUrl'], $xml);
        $xml = str_replace("{version}", $prjDetails['version'], $xml);
        $xml = str_replace("{description}", $prjDetails['description'], $xml);
        $xml = str_replace("{component}", $comp, $xml);
        if ($prjConfig['includeCISystem'] == '1') {
            $xml = str_replace("{systemfolder}", "<folder>system</folder>", $xml);
        } else {
            $xml = str_replace("{systemfolder}", "", $xml);
        }


        /* Creating Config table script */
        if ($prjDetails['configtable']) {
            $conf =& JFactory::getConfig();
            $query = "CREATE TABLE IF NOT EXISTS `".$conf->getvalue('config.dbprefix')."".$prjDetails['configtable']."` (
                `id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `Title`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
                `params`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
                 PRIMARY KEY (`id`)
                );";
            $this->db->query($query);
            $this->replace_component(JPATH_ADMINISTRATOR. DS."components".DS."com_$comp".DS."install.sql","{configtable}","CREATE TABLE IF NOT EXISTS `#__".$prjDetails['configtable']."` (
                `id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `Title`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
                `params`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
                 PRIMARY KEY (`id`)
                );", JPATH_SITE. DS."components".DS."com_$comp".DS."install.sql");
        }
        else{
            $this->replace_component(JPATH_ADMINISTRATOR. DS."components".DS."com_$comp".DS."install.sql","{configtable}",'', JPATH_SITE. DS."components".DS."com_$comp".DS."install.sql");
        }
        /* done */
        JFile::write(JPATH_ADMINISTRATOR . DS . "components" . DS . "com_" . $comp . DS . "manifest.xml", $xml);

        $data = array(
            'com_name' => $prjDetails['name'],
            'component' => $comp,
            'extension_type' => 'com',
            'published' => 1,
            'manifest' => $xml
        );
        $this->db->insert('xcideveloper_projects', $data);

        return true;
    }

    function replace_component($path, $replacewhat, $replacewith) {
        $file = JFile::read($path);
        $file = str_replace($replacewhat, $replacewith, $file);
        JFile::write($path, $file);
    }

}

?>