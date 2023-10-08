<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Bizproc\FieldType;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$arActivityDescription = [
    'NAME' => Loc::getMessage('ACTIVITY_NAME'),
    'DESCRIPTION' => Loc::getMessage('ACTIVITY_DESCRIPTION'),
    'TYPE' => 'activity',
    'CLASS' => 'CrmDealSummary',
    'JSCLASS' => 'BizProcActivity',
    'CATEGORY' => [
        'ID' => 'other',
        'OWN_ID' => 'crm',
        'OWN_NAME' => 'CRM',
    ],
    'RETURN' => [
        'ProcessDealCount' => [
            'NAME' => Loc::getMessage('PROCESS_DEAL_COUNT'),
            'TYPE' => FieldType::INT,
        ],
        'LoseDealCount' => [
            'NAME' => Loc::getMessage('LOSE_DEAL_COUNT'),
            'TYPE' => FieldType::INT,
        ],
        'WinDealCount' => [
            'NAME' => Loc::getMessage('WIN_DEAL_COUNT'),
            'TYPE' => FieldType::INT,
        ],
        'WinDealSum' => [
            'NAME' => Loc::getMessage('WIN_DEAL_SUM'),
            'TYPE' => FieldType::DOUBLE,
        ],
        'OpenInvoiceSum' => [
            'NAME' => Loc::getMessage('OPEN_INVOICE_SUM'),
            'TYPE' => FieldType::DOUBLE,
        ],
        'CloseInvoiceSum' => [
            'NAME' => Loc::getMessage('CLOSE_INVOICE_SUM'),
            'TYPE' => FieldType::DOUBLE,
        ],
    ],
];
