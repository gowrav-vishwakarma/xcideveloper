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
?><form id="form1" name="form1" method="get" action="index.php">
  <table width="100%" border="0" cellpadding="3">
    <tr>
      <td width="30%" valign="top"><table border="0" cellpadding="3" class="adminlist" width="100%">
          <thead>
            <tr>
              <th class="title">New Component</th>
              <th><label>
                  <div align="right">
                    <input name="ComponentTitle" type="text" id="ComponentTitle" size="35" />
                  </div>
                </label></th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th class="title">Component Folder</th>
              <th><label>
                  <div align="right">com_
                    <input name="componentName" type="text" class="input" id="componentName" size="35" />
                  </div>
                </label></th>
            </tr>
          
          <tr class="row0">
            <th>Author</th>
            <td><div align="right">
                <label>
                  <input name="author" type="text" id="author" value="Gowrav Vishwakarma" size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row1">
            <th>Creation Date</th>
            <td><div align="right">
                <label>
                  <input name="creationDate" type="text" id="creationDate" value="7-april-1980" size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row0">
            <th>Copy Right</th>
            <td><div align="right">
                <label>
                  <input name="copyright" type="text" id="copyright" value="Copyright (C) 2011 Xavoc International. All rights reserved." size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row1">
            <th>License</th>
            <td><div align="right">
                <label>
                  <input name="license" type="text" id="license" value="http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL" size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row0">
            <th>Author Email</th>
            <td><div align="right">
                <label>
                  <input name="authorEmail" type="text" id="authorEmail" value="gowravvishwakarma@gmail.com" size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row1">
            <th>Author URL</th>
            <td><div align="right">
                <label>
                  <input name="authorUrl" type="text" id="authorUrl" value="http://www.xavoc.com" size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row0">
            <th>Version</th>
            <td><div align="right">
                <label>
                  <input name="version" type="text" id="version" value="0.0.1" size="35" />
                </label>
              </div></td>
          </tr>
          <tr class="row1">
            <th>Description</th>
            <td><div align="right">
                <label>
                  <input name="description" type="text" id="description" value="My New Component For Joomla" size="35" />
                </label>
              </div></td>
          </tr>
          
          <tr>
            <td><input name="task" type="hidden" id="task" value="component.saveNewComponent" />
              <input name="option" type="hidden" id="option" value="com_xcideveloper" /></td>
            <td><label>
                <input type="submit" name="Create" id="Create" value="Create" />
              </label></td>
          </tr>
          </tbody>
        </table></td>
      <td valign="top"><?php
                jimport('joomla.html.pane');
                //1st Parameter: Specify 'tabs' as appearance
                //2nd Parameter: Starting with third tab as the default (zero based index)
                //open one!
                $pane = & JPane::getInstance('Sliders');
                echo $pane->startPane('pane');
                echo $pane->startPanel('Global Configuration', 'panel1');
                echo xCILoadTemplate('global_config');
                echo $pane->endPanel();
                echo $pane->startPanel('Compatibility', 'panel3');
                echo "<h3>Components Generated with xCI will work same in Joomla V 1.5, 1.6 and 1.7 .. Wao...</h3><br/>You just have to manage config and manifest file for param and fieldset ";
                echo $pane->endPanel();
                echo $pane->endPane();
                ?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
