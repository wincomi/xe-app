<?php
/**
 * @class	app
 * @author	Wincomi (admin@wincomi.com)
 * @package	/modules/app
 */
 
class app extends ModuleObject
{

	/**
	 * Install adminlogging module
	 * @return Object
	 */
	function moduleInstall()
	{
		return new Object();
	}

	/**
	 * If update is necessary it returns true
	 * @return bool
	 */
	function checkUpdate()
	{
		return FALSE;
	}

	/**
	 * Update module
	 * @return Object
	 */
	function moduleUpdate()
	{
		return new Object();
	}

	/**
	 * Regenerate cache file
	 * @return void
	 */
	function recompileCache()
	{
		
	}

}
/* End of file app.class.php */
/* Location: ./modules/app/app.class.php */
