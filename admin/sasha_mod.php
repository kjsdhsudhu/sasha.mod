<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin.php");
use Bitrix\Main\Loader;  
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
?>
<p><?=Loc::getMessage('S_PREVIEW')?></p><br />
<?
if(Loader::includeModule("sasha.mod")) {
	echo '<table>';
	$res = new \Sasha\Mod\Brains;
	$result = $res->getTableValues();
	if($result['result'] == 'success') {
		echo '<table>';
			echo '<tr>';
			foreach($result['values'][0] as $key=>$value) {
				echo '<td>'.$key.'</td>';
			}
			echo '</tr>';
		
			foreach($result['values'] as $resultElement) {
				echo '<tr>';
					foreach($resultElement as $valElem) {
						echo '<td>' . $valElem . '</td>';
					}
				echo '</tr>';
			}
		echo '</table>';
	} else if($result['error']) {
		echo '<p>'.$result['message'].'</p>';
	}
	
}
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin.php");
?>