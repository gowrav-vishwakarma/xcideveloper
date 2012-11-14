This XML designed here can be used as Config.xml in 'Manage'. This will be component level configuration or you can use this
xml file as menu configuration. copy generated xml and save as the same name of layout (in views/{your_view}/tmpl/{layout}) and these
option will be available at the time of making menus. To use anywhere just declare <b>global $com_params</b> and use <b>$com_params->get('key')</b> or use
<b>global $menu_params</b> to get menu specific and/or overrided config values in menu