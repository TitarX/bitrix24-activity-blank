<?php
/**
 * @var array $arCurrentValues
 */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (!Loader::includeModule('crm')) {
    return;
}
?>

<tr>
    <td align="right" width="40%">
        <span class="adm-required-field"><?= Loc::getMessage('CONTACT_ID_PROP_NAME') ?>:</span>
    </td>
    <td width="60%">
        <input type="text" name="contact_id" id="contact_id"
               value="<?= htmlspecialcharsbx($arCurrentValues['contact_id']) ?>" size="50">
        <input type="button" value="..." onclick="BPAShowSelector('contact_id', 'string');">
    </td>
</tr>