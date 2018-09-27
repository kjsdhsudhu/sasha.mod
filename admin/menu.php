<?
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
$aMenu = array(
    "parent_menu" => "global_menu_settings",
    "section" => "Sasha_mod",
    "sort" => 50,
    "text" => Loc::getMessage("S_ADMIN_MENU_PARENT_TEXT"),
    "icon" => "sys_menu_icon",
    "page_icon" => "sys_page_icon",
    "items_id" => "Sasha_mod_items",
    "items" => array(
		array(
			"text" => Loc::getMessage("S_ADMIN_MENU_ITEM_TEXT"),
			"url" => "sasha_mod.php",
			"more_url" => array(),
			"title" => Loc::getMessage("S_ADMIN_MENU_ITEM_TITLE"),
		)
	)
);
return $aMenu;

?>