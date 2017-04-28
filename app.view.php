<?php
/**
 * @class	appView
 * @author	Wincomi (admin@wincomi.com)
 * @package	/modules/app
 */
 
class appView extends app
{
	/**
	 * @brief initialization
	 */
    function init()
    {
		Context::setRequestMethod('JSON');
		Context::setResponseMethod('JSON');
    }
    
	function dispAppSitemap()
	{
		$oModuleModel = getModel('module');
		$config = $oModuleModel->getModuleConfig('app');
	
		$oMenuAdminModel = getAdminModel('menu');
		$menu_srl = $config->menu_srl;
		$oMenuItems = $oMenuAdminModel->getMenuItems($menu_srl);
		
		if ($oMenuItems->data)
		{
			$this->add('menu_srl',$menu_srl);
			
			$menu_items = array();
			foreach ($oMenuItems->data as $key => $menu)
			{
				$moduleInfo = $oModuleModel->getModuleInfoByMenuItemSrl($menu->menu_item_srl);
				$menu_item = new stdClass();
				$menu_item->module = $moduleInfo->module;
				
				$menu_item->name = $menu->name; // explode('|fa-', $menu->name)[0]; (for Simplestrap Layout)
				$menu_item->desc = $menu->desc;
				$menu_item->url = $menu->url;
				
				$menu_items[] = $menu_item;
			}
			
			$this->add('menu_list', $menu_items);
		}
	}
	
	function dispAppBasicInfo()
	{
		$db_info = Context::getDBInfo();
		
		// default_url
		// TODO(Wincomi): check again
		if(strpos($db_info->default_url, 'xn--') !== false)
		{
			$db_info->default_url = Context::decodeIdna($db_info->default_url);
		}
		$this->add('default_url', $db_info->default_url);
		
		// site_title
		$oModuleModel = getModel('module');
		$module_config = $oModuleModel->getModuleConfig('module');
		$this->add('site_title', $module_config->siteTitle);
		
		// languages
		$this->add('lang_selected', Context::loadLangSelected());
		$this->add('selected_lang', $db_info->lang_type);
		
		// mobicon
		$oAdminModel = getAdminModel('admin');
		$mobicon_url = $oAdminModel->getMobileIconUrl();
		$this->add('mobicon_url', $mobicon_url.'?'.$_SERVER['REQUEST_TIME']);
		
		// member
		$oMemberModel = getModel('member');
		$member_config = $oMemberModel->getMemberConfig();
		$this->add('enable_join', $member_config->enable_join);
		
		// socialxe
		$socialxe_config = $oModuleModel->getModuleConfig('socialxe');
		if (!empty($socialxe_config))
		{
			$dic = array(
				"sns_services" => $socialxe_config->sns_services,
				"sns_login" => $socialxe_config->sns_login,
				"default_login" => $socialxe_config->default_login,
			);
			$this->add('socialxe', $dic);
		}
	}
	
	function dispAppMemberInfo()
	{
		$oMemberModel = getModel('member');
		$logged_info = Context::get('logged_info');
		$is_logged = Context::get('is_logged');
		
		if (!$is_logged)
		{
			return $this->stop('msg_not_permitted');
		}

		$results = array(
			'user_id' => $logged_info->user_id,
			'email_address' => $logged_info->email_address,
			'nick_name' => $logged_info->nick_name,
			'profile_image' => $logged_info->profile_image,
			'menu_list' => $logged_info->menu_list,
		);
		$this->add('results', $results);
	}
}
/* End of file app.model.php */
/* Location: ./modules/app/app.model.php */
