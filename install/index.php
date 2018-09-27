<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\EventManager;
use Bitrix\Main\Application;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);

Class sasha_mod extends CModule {
	var $MODULE_ID = "sasha.mod";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "N";
	
	public function __construct() {
		$arModuleVersion = array();
		include_once(__DIR__ . '/version.php');
		$this->MODULE_NAME = Loc::getMessage("S_MODULE_NAME");
		$this->MODULE_DESCRIPTION = Loc::getMessage("S_MODULE_DESCRIPTION");
		$this->MODULE_VERSION = $arModuleVersion['VERSION'];
		$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
	}
	
    function DoInstall() {
        ModuleManager::RegisterModule($this->MODULE_ID);
		CopyDirFiles(__DIR__ . "/admin", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
    }

    function DoUninstall() {
        ModuleManager::UnRegisterModule($this->MODULE_ID);
		DeleteDirFiles(__DIR__ . "/admin", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/admin");
    }
	
}
?>