<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\ORM\DataExtension;

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Apr 27, 2018 - 12:20:34 AM
 */
class ReferenceExtension_BelongsMany
        extends DataExtension {

    private static $belongs_many_many = [
        'References' => Reference::class
    ];

    public function extraTabs(&$lists) {
        $list = $this->owner->References();
        if ($list->Count()) {
            $lists[] = [
                'Title' => _t('Reference.REFERENCES', 'References'),
                'Content' => $this->owner
                        ->customise([
                            'Results' => $list
                        ])
                        ->renderWith('Includes/List_MiniGrid')
            ];
        }
    }

    public function updateCMSFields(FieldList $fields) {
        $field = $fields->fieldByName('Root.References.References');
        if ($field != null) {
            $config = $field->getConfig();

            $config->removeComponentsByType('GridFieldAddExistingAutocompleter');
            $config->addComponent(new GridFieldAddExistingAutocompleter('buttons-before-right', ['Name']));

            $field->setConfig($config);
        }
    }

}
