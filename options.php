<?
use Bitrix\Main\Localization\Loc;
use	Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);
$request = HttpApplication::getInstance()->getContext()->getRequest();
$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);
Loader::includeModule($module_id);

$arTabs = array(
	array(
		"DIV" 	  => "edit",
		"TAB" 	  => Loc::getMessage("S_OPTIONS_NAME"),
		"TITLE"   => Loc::getMessage("S_OPTIONS_TAB_NAME"),
		"OPTIONS" => array(
			array(
				"database_name",
				Loc::getMessage("S_OPTIONS_DATABASE_NAME"),
				Option::get($module_id, 'database_name'),
				array("text", 12)
			),
		)
	)
);

$tabControl = new CAdminTabControl(
	"tabControl",
	$arTabs
);

if($request->isPost() && check_bitrix_sessid()) {
	foreach($arTabs as $tab) {
		foreach($tab["OPTIONS"] as $option) {
			if(is_array($option)) {
				$optionValue = '';
				if($request["apply"]) {
					$optionValue = $request->getPost($option[0]);
				}
				Option::set($module_id, $option[0], $optionValue);
			}
		}
	}
	LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
}

$tabControl->Begin();
?>
<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">
	<?
	foreach($arTabs as $aTab){
		if($aTab["OPTIONS"]){
			$tabControl->BeginNextTab();
			__AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
		}
	}
	$tabControl->Buttons();
	?>
	<input type="submit" name="apply" value="<? echo(Loc::GetMessage("S_OPTIONS_APPLY")); ?>" class="adm-btn-save" />
	<input type="submit" name="default" value="<? echo(Loc::GetMessage("S_OPTIONS_DEFAULT")); ?>" />
	<?
	echo(bitrix_sessid_post());
	?>
</form>
<?
$tabControl->End();

?>