<style type="text/css" media="screen">
	code {
		white-space: pre;
	}
</style>

<!-- START NAVIGATION -->
<div id="masthead">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
<tr>
<td><h1>xCIDEVELOPER IMPORTANT WORK FLOWS</h1></td>
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

<h2>Few Very Special and must Notice point about xCIDeveloper 1.0</h2>

    <p><strong>xCI 1.0 is fully compatible with joomla menu style. for each view you need to make a controller and for each layout in view need to make a function for same names thats it </strong><br />
    So now onwards no more external URL required.</p>
    <h2>*How to:</h2>
    <p>in your <i>FRONTEND</i> in views folder make a folder (it will be your view name), copy view.html.php file from welcome view to here (just copy, No change required), and make another folder in this new folder named 'tmpl' files in here will be your layout, default layout is the file with name 'index.php' </p>
    </p>
    <p class="important"><strong>* --This xCIDeveloper can be installed in joomla 1.5, 1.6 or even in 1.7 in same way and components developed with xCI can also work in any joomla as far as you don't use any joomla version specific features (use CI way instead and CI is also very powerfull capable to do all the things) and config files are maintained for J1.5 and 1.6 and above both.</strong></p>
    <p> There is just a simple change required in config files. insted of params and param tag in config there should be fieldset and field tag for Joomla 1.6 and above and fieldset should have attribute name and lable. This can be more understand my making a component and study its config.xml file in administrator/your_component directory.
    </p>
    --instead of redirect of CI you have to use xRedirect in the following manner <code>xRedirect('index.php?option=com_{yourcomponent}&view={yourController}&layout={yourFunction}','Any Message to display on next redirected page [optional]','info/error [option]')</code> </p>
</div>