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
		$oModuleModel = &getModel('module');
		$config = $oModuleModel->getModuleConfig('app');
	
		$oMenuAdminModel = &getAdminModel('menu');
		$menu_srl = $config->menu_srl;
		$oMenuItems = $oMenuAdminModel->getMenuItems($menu_srl);
		
		if ($oMenuItems->data)
		{
			$this->add('menu_srl',$menu_srl);
			// $oMenuItems->data = parent_sort($oMenuItems->data);
			
			foreach ($oMenuItems->data as $key => $menu)
			{
				$moduleInfo = $oModuleModel->getModuleInfoByMenuItemSrl($menu->menu_item_srl);
				$menu->module = $moduleInfo->module;
				
				// for Simplestrap Layout
				$menu->name = explode('|fa-', $menu->name)[0];
			}
		}
		$this->add('results', $oMenuItems->data);
	}
	
	function dispAppBasicInfo()
	{
		$db_info = Context::getDBInfo();
		
		// default_url
		if(strpos($db_info->default_url, 'xn--') !== false)
		{
			$db_info->default_url = Context::decodeIdna($db_info->default_url);
		}
		$this->add('default_url', $db_info->default_url);
		
		// site_title
		$oModuleModel = getModel('module');
		$config = $oModuleModel->getModuleConfig('module');
		$this->add('site_title', $config->siteTitle);
		
		// languages
		$this->add('lang_selected', Context::loadLangSelected());
		$this->add('selected_lang', $db_info->lang_type);
		
		// mobicon
		$oAdminModel = getAdminModel('admin');
		$mobicon_url = $oAdminModel->getMobileIconUrl();
		$this->add('mobicon_url', $mobicon_url.'?'.$_SERVER['REQUEST_TIME']);
		
		// member
		$oMemberModel = &getModel('member');
		$config = $oMemberModel->getMemberConfig();
		$this->add('enable_join', $config->enable_join);
		
		// socialxe
		$socialxe_config = getModel('module')->getModuleConfig('socialxe');
		if (!empty($socialxe_config))
		{
			$dic = [
				"sns_services" => $socialxe_config->sns_services,
				"sns_login" => $socialxe_config->sns_login,
				"default_login" => $socialxe_config->default_login,
			];
			$this->add('socialxe', $dic);
		}
	}
	
	function dispAppMemberInfo() {
		$oMemberModel = getModel('member');
		$logged_info = Context::get('logged_info');
		
		// Don't display member info to non-logged user
		if(!$logged_info->member_srl) return $this->stop('msg_not_permitted');

		$member_srl = Context::get('member_srl');
		if(!$member_srl && Context::get('is_logged'))
		{
			$member_srl = $logged_info->member_srl;
		}
		$results = [
			'user_id' => $logged_info->user_id,
			'email_address' => $logged_info->email_address,
			'nick_name' => $logged_info->nick_name,
			'profile_image' => $logged_info->profile_image,
			'menu_list' => $logged_info->menu_list,
		];
		$this->add('results', $results);
	}
}
/* End of file app.model.php */
/* Location: ./modules/app/app.model.php */
