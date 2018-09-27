<?
namespace Sasha\Mod;

use \Bitrix\Main\Application;
use \Bitrix\Main\DB;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

class Brains {
	var $dbName = NULL;
	
	public function __construct() {
		//по умолчанию в настройках этого модуля нет значения database_name проверяем его, потом наличие модуля sprint.migration
		$dbValue = Option::get('sasha.mod', 'database_name');
		if(strlen($dbValue) > 0) {
			//задаем название таблицы
			$this->dbName = $dbValue;
		} else if(Loader::includeModule('sprint.migration')) {
			//наличие модуля sprint.migration
			//модуль есть, забираем название таблицы
			$versionManager = new \Sprint\Migration\VersionManager;
			$arVersionManager = $versionManager->getConfigCurrent();
			if(is_array($arVersionManager)) {
				$this->dbName = $arVersionManager['values']['migration_table']; //получено название таблицы
			}
		}
	}
	//получение данных из таблицы $dbName или ответа если таблицы не существует
	public function getTableValues() {
		$result = array();
		if(!is_null($this->dbName)) {
			$exception = new DB\Exception;
			try {
				$connect = Application::getConnection();
				$sqlHelper = $connect->getSqlHelper();
				$res = $connect->query("SELECT * FROM " . $sqlHelper->forSql($this->dbName));
				$result = array(
					'result' => 'success',
					'values' => array()
				);
				while($re = $res->fetch()) {
					$result['values'][] = $re;
				}
			} catch (\Exception $exception) {
				$result = array(
					'result' => 'error',
					'message' => $exception->getDatabaseMessage()
				);
			}
		} else {
			$result = array(
				'result' => 'error',
				'message' => Loc::getMessage('S_CLASS_ERROR')
			);
		}
		return $result;
	}
}
?>