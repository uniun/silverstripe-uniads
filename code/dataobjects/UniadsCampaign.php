<?php

/**
 * Description of UniadsCampaign
 *
 * @author Elvinas Liutkevičius <elvinas@unisolutions.eu>
 * @author Marcus Nyeholt <marcus@silverstripe.com.au>
 * @license BSD http://silverstripe.org/BSD-license
 */
class UniadsCampaign extends DataObject
{

    private static $db = array(
        'Title' => 'Varchar',
        'Starts' => 'Date',
        'Expires' => 'Date',
        'Active' => 'Boolean',
    );

    private static $summary_fields = array(
        'Title' => 'Title',
        'Starts' => 'Starts',
        'Expires' => 'Expires',
        'Active' => 'Active',
    );

    private static $has_many = array(
        'Ads' => 'UniadsObject',
    );

    private static $has_one = array(
        'Client' => 'UniadsClient',
    );

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $Starts = $fields->fieldByName('Root.Main.Starts');
        $Starts->setConfig('showcalendar', true);
        $Starts->setConfig('dateformat', i18n::get_date_format());
        $Starts->setConfig('datavalueformat', 'yyyy-MM-dd');

        $Expires = $fields->fieldByName('Root.Main.Expires');
        $Expires->setConfig('showcalendar', true);
        $Expires->setConfig('dateformat', i18n::get_date_format());
        $Expires->setConfig('datavalueformat', 'yyyy-MM-dd');
        $Expires->setConfig('min', date('Y-m-d', strtotime($this->Starts ? $this->Starts : '+1 days')));

        $fields->changeFieldOrder(array(
            'Title',
            'ClientID',
            'Starts',
            'Expires',
            'Active',
        ));

        return $fields;
    }
}
