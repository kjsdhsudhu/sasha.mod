<?php
if (is_file($_SERVER["DOCUMENT_ROOT"] . "/local/modules/sasha.mod/admin/sasha_mod.php")) {
    require($_SERVER["DOCUMENT_ROOT"] . "/local/modules/sasha.mod/admin/sasha_mod.php");
} else {
    require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sasha.mod/admin/sasha_mod.php");
}
