<?php

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Apr 27, 2018 - 12:13:54 AM
 */
class Reference
        extends DataObject {

    private static $db = [
        'Name' => 'Varchar(255)',
        'Description' => 'Varchar(255)',
        'Details' => 'Varchar(255)',
        'Page' => 'Int',
        'Link' => 'Varchar(255)',
        'Date' => 'Date',
    ];
    private static $has_one = [
        'Objects' => DataObject::class,
    ];
    private static $translate = [
        'Name',
        'Description',
        'Details',
        'Date',
    ];
    private static $searchable_fields = [
        'Name' => [
            'field' => TextField::class,
            'filter' => 'PartialMatchFilter'
        ]
    ];

    public function fieldLabels($includerelations = true) {
        $labels = parent::fieldLabels($includerelations);

        $labels['Name'] = _t('Reference.NAME', 'Name');
        $labels['Description'] = _t('Reference.DESCRIPTION', 'Description');
        $labels['Page'] = _t('Reference.PAGE', 'Page');
        $labels['Link'] = _t('Reference.LINK', 'Link');
        $labels['Date'] = _t('Reference.DATE', 'Date');

        return $labels;
    }

    public function getTitle() {
        return $this->Name;
    }

}
