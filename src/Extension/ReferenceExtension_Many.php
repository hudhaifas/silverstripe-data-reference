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
                'Key' => 'references',
                'Rank' => 10,
                'Title' => _t('Reference.REFERENCES', 'References'),
            ];
        }

        if ($this->owner->canEdit()) {
            $lists[] = [
                'Key' => 'add_reference',
                'Rank' => 2,
                'Title' => _t('Reference.ADD_REFERENCE', 'Add Reference'),
            ];
        }
    }

    public function extraTabContent($tabKey) {
        switch ($tabKey) {
            case 'references':
                $list = $this->owner->References();
                return $this->owner
                    ->customise([
                        'Results' => $list
                    ])
                    ->renderWith('Includes/References');

            case 'add_reference':
                return ReferenceService::singleton()->add($this->owner);
        }

        return null;
    }
}
