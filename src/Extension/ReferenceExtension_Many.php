<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\ORM\DataExtension;

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Apr 27, 2018 - 12:20:34 AM
 */
class ReferenceExtension_Many
        extends DataExtension {

    private static $has_many = [
        'References' => Reference::class
    ];

    public function updateCMSFields(FieldList $fields) {
        $field = $fields->fieldByName('Root.References.References');
        if ($field != null) {
            $config = $field->getConfig();

            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingAutocompleter('buttons-before-right', ['Name']));

            $field->setConfig($config);
        }
    }

    public function extraTabs(&$lists) {
        $list = $this->owner->References();
        if ($list->Count()) {
            $lists[] = [
                'Rank' => 10,
                'Title' => _t('Reference.REFERENCES', 'References'),
                'Content' => $this->owner
                        ->customise([
                            'Results' => $list
                        ])
                        ->renderWith('Includes/References')
            ];
        }

        if ($this->owner->canEdit()) {
            $this->insertAddTab($lists);
        }
    }

    private function insertAddTab(&$lists) {
        $form = ReferenceService::singleton()->add($this->owner);
        $lists[] = [
            'Rank' => 2,
            'Title' => _t('Reference.ADD_REFERENCE', 'Add Reference'),
            'Content' => $form
        ];
    }

}
