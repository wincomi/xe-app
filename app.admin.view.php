<?php
/**
 * @class	appAdminView
 * @author	Wincomi (admin@wincomi.com)
 * @package	/modules/app
 */
 
class appAdminView extends app
{

	/**
	 * @brief initialization
	 */
	function init()
	{		
		// setup template path (board admin panel templates is resided in the tpl folder)
		$template_path = sprintf("%stpl/",$this->module_path);
		$this->setTemplatePath($template_path);
	}
	
	function dispAppAdminConfig() {
		// generate module model object
		$oModuleModel = getModel('module');
		
		$config = $oModuleModel->getModuleConfig('app');
		Context::set('config', $config);

		// get menus
		$oMenuAdminModel = &getAdminModel('menu');
		$oMenuList = $oMenuAdminModel->getMenuList()->data;

		Context::set('menu_list', $oMenuList);
		

        $this->setTemplateFile('config');
    }
}
/* End of file app.admin.view.php */
/* Location: ./modules/app/app.admin.view.php */
