<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class xConfig extends DataMapper {

    var $table = 'xconfig';
    var $_params;

    function __construct($title){
        $query="CREATE TABLE IF NOT EXISTS `#__$this->table` (
                `id`  int(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
                `Title`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
                `params`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
                 PRIMARY KEY (`id`)
                );";
        $this->db->query($query);
        parent::__construct();
        $this->where('Title', $title)->get();
        $this->_params = new JParameter($this->params,'components/'.JRequest::getVar('option').'/config/'.$title.".xml");
        $this->Title=$title;
    }

    function getkey($key,$fromsave=false){
        $x=$this->_params->get($key);
        if($x==''){
            $temp=$this->_params->renderToArray();
            if(isset($temp[$key])){
                $this->setkey($key,$temp[$key][4]);
                if($fromsave) return;
                $this->save();
                return $temp[$key][4]; // 4 number is for default value
            }
        }
         
        return $x;
    }

    function setkey($key, $value) {
        $this->_params->set($key, $value);
    }

    function save() {
        $temp=$this->_params->renderToArray();
        $this->params='';
        foreach($temp as $key=>$values){
            $this->params .= ($key ."=".$this->getkey($key,true)."\n");
        }
        parent::save();
    }

    function render(){
        return $this->_params->render('params');
    }

}

?>