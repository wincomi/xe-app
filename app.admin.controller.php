<?php
/**
 * @class	appAdminController
 * @author	Wincomi (admin@wincomi.com)
 * @package	/modules/app
 */

class appAdminController extends app
{

	/**
	 * @brief initialization
	 */
	function init()
	{
		
	}
	
	function procAppAdminSaveConfig()
	{
		$module_config = Context::getRequestVars();
		getDestroyXeVars($module_config);
		unset($module_config->module);
		unset($module_config->act);
		unset($module_config->mid);
		unset($module_config->vid);

		if(!$module_config || !is_object($module_config))
		{
			$module_config = new stdClass();
		}

		$oModuleController = getController('module');
		$output = $oModuleController->updateModuleConfig('app', $module_config);
		if($output->toBool())
		{
			unset($this->module_config);
		}

		$success_return_url = Context::get('success_return_url');
		if($success_return_url)
		{
			$return_url = $success_return_url;
		}

		$this->setMessage('success_updated');
		$this->setRedirectUrl($return_url);		
	}

}
/* End of file app.admin.controller.php */
/* Location: ./modules/app/app.admin.controller.php */
