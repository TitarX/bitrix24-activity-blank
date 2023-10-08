<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

class CBPCrmDealSummary extends CBPActivity
{
    public function __construct($name)
    {
        parent::__construct($name);

        $this->arProperties = [
            'Title' => '',
            'ContactId' => '',
            'ProcessDealCount' => 0,
            'LoseDealCount' => 0,
            'WinDealCount' => 0,
            'WinDealSum' => 0,
            'OpenInvoiceSum' => 0,
            'CloseInvoiceSum' => 0,
        ];
    }

    public function Execute(): int
    {
        if (!Loader::includeModule('crm')) {
            return CBPActivityExecutionStatus::Closed;
        }

        // $arFilter = [
        //     'CONTACT_ID' => $this->ContactId,
        //     'OPENED' => 'Y'
        // ];
        //
        // $arSelect = ['ID'];

        //

        return CBPActivityExecutionStatus::Closed;
    }

    public static function ValidateProperties($arTestProperties = [], CBPWorkflowTemplateUser $user = null): array
    {
        $arErrors = [];

        if ($arTestProperties['ContactId'] <= 0) {
            $arErrors[] = [
                'code' => 'emptyCode',
                'message' => Loc::getMessage('ERROR_MESSAGE_EMPTY_CONTACT_ID'),
            ];
        }

        return array_merge($arErrors, parent::ValidateProperties($arTestProperties, $user));
    }

    public static function GetPropertiesDialog(
        $documentType,
        $activityName,
        $arWorkflowTemplate,
        $arWorkflowParameters,
        $arWorkflowVariables,
        $arCurrentValues = null,
        $formName = '',
        $popupWindow = null,
        $siteId = ''
    ): string {
        $runtime = CBPRuntime::GetRuntime();

        if (!is_array($arWorkflowParameters)) {
            $arWorkflowParameters = [];
        }
        if (!is_array($arWorkflowVariables)) {
            $arWorkflowVariables = [];
        }

        if (!is_array($arCurrentValues)) {
            $arCurrentValues = [
                'contact_id' => ''
            ];

            $arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
            if (is_array($arCurrentActivity['Properties'])) {
                $arCurrentValues['contact_id'] = $arCurrentActivity['Properties']['ContactId'];
            }
        }

        return $runtime->ExecuteResourceFile(
            __FILE__,
            'properties_dialog.php',
            [
                'arCurrentValues' => $arCurrentValues,
                'formName' => $formName,
            ]
        );
    }

    public static function GetPropertiesDialogValues(
        $documentType,
        $activityName,
        &$arWorkflowTemplate,
        &$arWorkflowParameters,
        &$arWorkflowVariables,
        $arCurrentValues,
        &$arErrors
    ): bool {
        $arErrors = [];

        $runtime = CBPRuntime::GetRuntime();

        $arProperties = [
            'ContactId' => $arCurrentValues['contact_id'],
        ];

        $arErrors = self::ValidateProperties(
            $arProperties,
            new CBPWorkflowTemplateUser(CBPWorkflowTemplateUser::CurrentUser)
        );
        if (is_array($arErrors) && count($arErrors) > 0) {
            return false;
        }

        $arCurrentActivity = &CBPWorkflowTemplateLoader::FindActivityByName($arWorkflowTemplate, $activityName);
        $arCurrentActivity['Properties'] = $arProperties;

        return true;
    }
}
