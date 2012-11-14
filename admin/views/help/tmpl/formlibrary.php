<?php
$document = JFactory::getDocument();
$document->addStyleSheet("components/" . JRequest::getVar('option') . "/assets/userguide.css");
?>
<style type="text/css" media="screen">
    code {
        white-space: pre;
    }
</style>

<!-- START NAVIGATION -->
<div id="masthead">
    <table cellpadding="0" cellspacing="0" border="0" style="width:100%">
        <tr>
            <td><h1>xCIDeveloper User Guide Version 1.0 </h1></td>
            <td id="breadcrumb_right"><a href="../../toc.html"> </a></td>
        </tr>
    </table>
</div>
<!-- END NAVIGATION -->


<!-- START BREADCRUMB -->
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
    <tr>
        <td id="breadcrumb">

        </td>
        <td id="searchbox"></td>
    </tr>
</table>
<!-- END BREADCRUMB -->

<br clear="all" />


<!-- START CONTENT -->
<div id="content">


    <h1>Form Class</h1>

    <p>The Form class enables you to dynamically create HTML Forms. Your   forms can be formatted through the use of form attributes, allowing 100% control over every aspect of its design.</p>

    <h2>Table of Contents</h2>
    <ul class="minitoc">
        <li><a href="#form">Form</a></li>
        <li><a href="#open">Open</a></li>
        <li><a href="#set_column">SetColumn</a></li>
        <li><a href="#text">Text</a></li>
        <li><a href="#datebox">DateBox</a></li>
        <li><a href="#text_area">TextArea</a></li>
        <li><a href="#password">Password</a></li>
        <li><a href="#check_box">CheckBox</a></li>
        <li><a href="#radio">Radio</a></li>
        <li><a href="#hidden">Hidden</a></li>
        <li><a href="#file_upload">FileUpload</a></li>
        <li><a href="#select">Select</a></li>
        <li><a href="#select_ajax">SelectAjax</a></li>
        <li><a href="#Lookup_DB">LookupDB</a></li>
        <li><a href="#div">Div</a></li>
        <li><a href="#submit">Submit</a></li>
        <li><a href="#SubmitNo_Hide">SubmitNoHide</a></li>
        <li><a href="#Confirm_Button">ConfirmButton</a></li>
        <li><a href="#Reset_Button">ResetButton</a></li>
        <li><a href="#Get">Get</a></li>
        <li><a href="#DateBoxMultiSelect">DateBoxMultiSelect</a></li>
        <li><a href="#FormValidations">Form Validations</a></li>
        <li><a href="#Form Class Example">Example</a></li>
    </ul>



    <h2><a name="form"></a>Initializing the Class</h2>
    <div class="guidelineDetails">
        <p>Like most other classes in CodeIgniter, the Form class is   initialized in your controller using the $this-&gt;load-&gt;library   function:</p>




        <code> $this->load->library("form");</code>	Once loaded, the Form object will be available using: $this->form</div>



    <h2><a name="open"></a>Creating a Form </h2>
    <div class="guidelineDetails">
        <p>The open() function creates a form and is eqivalent to < form > tag in HTML. It accepts form-id, action and attributes as parameters. </p>


        <p><code>$this-&gt;form-&gt;open($id, $action, $attributes='')</code></p>
        <p><code>$this->form->open("formname", "index.php?option=com_employee&view=con_enquiry&layout=departmentsave")</code> </p>
        The above code will create a form with id 'formname' and action='index.php?option=com_employee&view=con_enquiry&layout=departmentsave'.
    </div>
    <p class="important">Note : The form class functions work as a single line of code, one after the other, without ending with a semicolon. </p>

    <h2><a name="set_column"></a>Set the Number of Columns</h2>
    <div class="guidelineDetails">
        <p>SetColumn() function divides the form into the number of columns specified.  </p>



        <code>->setColumns(2)</code>

    </div>


    <h2><a name="text"></a>Displaying a Text Field </h2>
    <div class="guidelineDetails">
        <p><code>function text($lable, $attributes, $style="text-transform:capitalize;")</code>

            Here is a very simple example showing how you can display a text field:

            <code>->text("Father Name", "name='txtfat'")<br />// Displays a text field with label 'Father Name', name 'txtfat' without any validation <br /><br />->text("Student Name", "name='txtstd' class='input req-string'")<br />// Displays a text field with label 'Student Name', name 'txtstd' with validation that a string is required. </code> </p>
    </div>


    <h2><a name="datebox"></a>Displaying a Calendar</h2>
    <div class="guidelineDetails">
        <p>DateBox shows the calender to enter the date in a text field.</p>

        <code>function dateBox($lable, $attributes)</code>



        <code>->dateBox("Joining Date", "name='date'")</code>	The above code shows a calendar with the label 'Joining Date'	</div>


    <h2><a name="text_area"></a>Displaying a TextArea</h2>
    <div class="guidelineDetails">

        <p>Defines a multi-line text input control.</p>

        <code>function textArea($lable, $attributes, $style="text-transform:capitalize;", $value="")</code>



        <code>->textArea("Address", "name='address'")</code></div>


    <h2><a name="password"></a>Displaying a Password</h2>
    <div class="guidelineDetails">
        <p>Displays a password field. </p>
        <p class="important">Note: The characters in a password field are masked (shown as asterisks or circles).</p>

        <code>function password($lable, $attributes)</code>



        <code>->password("Password", "name='password' class='input req-string'")</code>		</div>



    <h2><a name="check_box"></a>Displaying a Check Box</h2>
    <div class="guidelineDetails">

        <p>Checkboxes let a user select ONE or MORE options out of a limited number of choices.</p>

        <code>function checkBox($lable, $attributes, $checked=false)</code>



        <code>->checkbox("Register Member", "name='register' value='yes'")</code> The above code displays an unchecked checkbox with value = yes. 	</div>



    <h2><a name="radio"></a>Displaying Radio Button </h2>
    <div class="guidelineDetails">
        <p>Radio buttons let a user select ONLY ONE one of a limited number of choices.</p>

        <code>function radio($lable, $attributes, $values, $defaultSelectedValue='')</code>


        <code>->radio("Gender", "name='gender' ", array("male" => "male", "female" => "female"), "male")</code>		</div>


    <h2><a name="hidden"></a>Hidden</h2>
    <div class="guidelineDetails">

        <p>The Hidden element represents a hidden input field in an HTML form (this input field is invisible for the user)..</p>

        <code>function hidden($lable, $attributes)</code>


        <code>->hidden("","name='student' value='student'")</code></div>



    <h2><a name="file_upload"></a>file Upload</h2>
    <div class="guidelineDetails">

        <p>File Upload transfers a copy of the file to the server. </p>

        <code>function fileUpload($label, $attributes, $selected='-1')</code>



        <code>->fileUpload("Avatar", "name='userfile' ");</code>				</div>


    <h2><a name="select"></a>Select</h2>
    <div class="guidelineDetails">
        <p>The Select element allows to select ONE value from a drop-down list. </p>
        <code>function select($label, $attributes, $values, $selected='-1')</code>


        <code>->select("Staff Type", "name='member_type' class='input not-req' not-req-val='-1'", array("Select" => "-1", "Satff" => "Staff", "Faculty" => "Faculty"))</code>		</div>



    <h2><a name="select_ajax"></a>Select Ajax</h2>
    <div class="guidelineDetails">
        <p>The SelectAjax element allows to select ONE value from a limited number of values. The difference between Select and SelectAjax is that SelectAjax suggests values based on the text entered in SelectAjax box. </p>

        <code>function selectAjax($label, $attributes, $values, $selected='-1')</code>



        <code>->selectAjax("To Whom", "name='bywhom' class='input not-req' not-req-val='-1'", array("Select"=>"-1","Satff"=>"Staff","Faculty"=>"Faculty"))</code>		</div>






    <h2><a name="Lookup_DB"></a>LookupDB</h2>
    <div class="guidelineDetails">
        <p>The element lookupDB lets a user select database values. User has to define a URL of the function which retrieves the values from the database. The values in $labelfield should match the values in the list array of the called function. </p>
        <code>  function lookupDB($lable, $attributes, $url, $labelField, $valueField='', $style='')</code>


        <code>->lookupDB("Search", "name='search'", "index.php?option=com_xinstitute&view=confirmstudent&layout=searchStudent&format=raw",<br>array("id", "name", "mobile_no", "father_name"), "id")<br />
            // function searchStudent which is defined in $url of lookupDB
            function searchStudent() {
            $list = array();
            $q = "select e.* from jos_enquiry e where e.id like '%" .$this->input->post("term"). "%' or e.name like '%" .$this->input->post("term")."%'";
            $result = $this->db->query($q)->result();
            foreach ($result as $dd) {
            $list[] = array('id' => $dd->id, 'name' => $dd->name, "father_name" => $dd->father_name, "mobile_no" => $dd->mobile_no);
            }
            echo '{"tags":' . json_encode($list) . '}';
            }
        </code>
        <p class="important"><strong>Note: </strong>1. The values passed in the array $labelField should be same as the key values of the $list[] array of the called function.<br />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. The text entered in the lookupDB field is caught by $this->input->post("term") in the called function.</p>

    </div>



    <h2><a name="div"></a>Div</h2>
    <div class="guidelineDetails">
        <p>The div element defines a division or a section in a form..</p>
        <code>  function div($id, $attributes, $matter='')</code>


        <code>-&gt;div(&quot;div&quot;,&quot;name='divs' class='ui-widget-content'&quot;,&quot;Div Matter&quot;)</code>		</div>



    <h2><a name="submit"></a>Submit</h2>
    <div class="guidelineDetails">
        <p>A submit button is used to send form data to a server. The data is sent to the page specified in the form's action attribute. The file defined in the action attribute usually does something with the received input. The Submit button hides itself when it is clicked, hence no resubmitting allowed.</p>
        <code>   function submit($value, $attributes='',$action='',$id='')</code>


        <code> ->submit("Submit");</code>		</div>



    <h2><a name="SubmitNo_Hide"></a>SubmitNoHide</h2>
    <div class="guidelineDetails">
        <p>Same as submit button, but does not hide on submission.</p>
        <code>   function submitNoHide($value, $attributes='',$action='',$id='')</code>


        <code> ->submitNoHide("Submit");</code>		</div>


    <h2><a name="Confirm_Button"></a>ConfirmButton</h2>
    <div class="guidelineDetails">
        <p>The element confirmButton promts user to give his confirmation before submitting values from a Form. </p>
        <code>   function confirmButton($value, $title, $url, $fullScreen=true)</code>


        <code>->confirmButton("Confirm", "Are u sure?", "index.php?option=com_xinstitute&view=staff&layout=confirmEditStaff&id=$id&format=raw");</code>		</div>



    <h2><a name="Reset_Button"></a>ResetButton</h2>
    <div class="guidelineDetails">
        <p>The reset element is an input type element with type = reset. </p>
        <code>   function resetBtn($value)</code>



        <code>-&gt;resetBtn('Reset')</code>		</div>



    <h2><a name="Get"></a>Get</h2>
    <div class="guidelineDetails">
        <p>The get function gemerates the form.</p>
        <code>   function get($btns=array())</code>



        <code>echo $this-&gt;form-&gt;get();</code>		</div>








    <h2><a name="DateBoxMultiSelect"></a>Selecting multiple dates from Calendar</h2>
    <div class="guidelineDetails">
        <p>The function DateBoxMultiSelect lets a user to select multiple dates from a calendar at single point of time. </p>
        <code>   function dateBoxMultiSelect($lable, $attributes)</code>



        <code>-&gt;dateBoxMultiSelect(&quot;Multi select date box&quot;,&quot;class='input'&quot;)</code>		</div>


    <h2><a name="FormValidations"></a>Applying Validations on Form</h2>
    <div class="guidelineDetails">
        <p>Form library  provides  comprehensive form validation classes that helps minimize the amount of code you'll write.
            Major validations which form library provides are listed below.</p>
        <code>req-string			:	'Required field validation',
            req-date			:	'Date validation',
            req-numeric		:	'Numeric field validation',
            req-email			:	'E-mail required validation',
            req-same			:	'The two fields Must Be same, like in password and rePassword.  the too fields are connected with rel attributes value, if two components have same rel attribute as in example',
            req-both			:	'Both Field are required. If one field entered, the others should too. the too fields are connected with rel attributes value, if two components have same rel attribute as in example',
            req-min			:	'Minimum required field validation',
            not-req			:	'Select Value not Acceptable Validation',
            req-selected		:	'Check Box Acceptable Validation'
        </code>

        Here are a few examples showing the form validations.
        <code>
            ->text("Staff ID","name='StaffID' class='input req-string'")	// A string is always required
            ->text("Staff ID","name='StaffID' class='input req-numeric'")	// A number is always required
            ->password("Password","name='Password' class='input req-same' rel='pass'")	// Password field which should be same as re-password field. Related to re-password field by attribute 'rel'
            ->password("Re Password", "name='RePassword' class='input req-same' rel='pass'")
            ->text("Age", "name='Age' class='input req-numeric req-min' minlength ='1'")	//Numeric field is required with minimum length 1
        </code>
    </div>



    <h2><a name="Form Class Example"></a>Example</h2>
    <div class="guidelineDetails">

        <code>
            function index() {
            $this->load->library("form");
            $this->form->open('One','index.php?option=com_sample&view=mod_controller&layout=myfunction')
            ->setColumns(2)
            ->text('My Text Box',"name='txtbox' class='input req-string'")
            ->password('My Password',"name='Password' class='input req-string'")
            ->dateBox("My Calendar","name='mycalendar' class='input'")
            ->textArea("My TextArea","name='txtarea'")
            ->select("Select", "name='select_type' class='input not-req' not-req-val='-1'",
            array("Select" => "-1", "Satff" => "Staff", "Faculty" => "Faculty"))
            ->selectAjax("Select Ajax", "name='select_ajax_type' class='input not-req' not-req-val='-1'",
            array("Select" => "-1", "Satff" => "Staff", "Faculty" => "Faculty"))
            ->div("div","name='divs' class='ui-widget-content'","Div Matter")
            ->dateBoxMultiSelect("Multi select date box","class='input'")
            ->lookupDB("LookupDB","name='branch' class='input req-string'",
            "index.php?option=com_xinstitute&task=batchdetail.addstudentbatch&format=raw",
            array("id", "name"), "id")
            ->_("mylabel")
            ->confirmButton("Confirm", "Confirm Box", "index.php?option=com_sample&view=mod_controller&layout=confirmFunction", true)
            ->submit('Submit');
            $data['contents'] = $this->form->get();
            $this->load->view("template",$data);
            }
            <br />
            // function addstudentbatch() which is defined in $url of lookupDB
            function addstudentbatch() {
            $list = array();
            $q = "select e.* from jos_enquiry e join jos_member m on e.id=m.enquiry_id where member_type='student' and
            e.name like '%".$this->input->post("term")."%'";
            $result = $this->db->query($q)->result();
            foreach ($result as $d) {
            $list[] = array('id' => $d->id, 'name' => $d->name);
            }
            echo '{"tags":' . json_encode($list) . '}';
            }

        </code>



    </div>


</div>
