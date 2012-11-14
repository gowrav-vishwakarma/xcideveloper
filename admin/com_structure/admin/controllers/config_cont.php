<?php

class config_cont extends CI_Controller {

    function __construct() {
        parent::__construct();
        $u = JFactory::getUser();
        if ($u->usertype != "Super Administrator") {
            xRedirect("index.php?option=".JRequest::getVar('option')."&task=".JRequest::getVar('option').".index", "You are not Authorised to Configure the system", "error");
        }
    }

    function index() {
        xDeveloperToolBars::configToolBar();
        JRequest::setVar("layout","index");
        $this->load->view('config.html');
        $this->jq->getHeader();
    }

    function edit() {
        xDeveloperToolBars::configEditToolBar($this->input->get("config"));
        $c = new xConfig($this->input->get("config"));

        $data['configFile'] = $this->input->get("config");
        $data['config'] = $c;

        JRequest::setVar("layout", "edit");
        $this->load->view('config.html', $data);
    }

    function saveConfig() {
        if ($this->input->post("task") == "config_cont.index")
            xRedirect("index.php?option=".JRequest::getVar('option')."&task=config_cont.index", "Back To Configuration Dashboard");
        $config = $this->input->post('config');
        $c = new xConfig($config);
        $params = $this->input->post('params');
        foreach ($params as $key => $value)
            $c->setkey($key, $value);
        $c->save();
        xRedirect("index.php?option=".JRequest::getVar('option')."&task=config_cont.index", "Configuration Saved");
    }

}

?>
