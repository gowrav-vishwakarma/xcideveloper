<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class helper extends CI_Controller{
    function xmlDesigner(){
        xDeveloperToolBars::helperToolBar();
        JRequest::setVar("layout","manifest");
        $this->load->view("helper.html");
        $this->jq->getHeader();
    }
}