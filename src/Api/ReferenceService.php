<?php

use SilverStripe\Control\Director;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\NumericField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextField;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataObject;

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Apr 25, 2018 - 10:41:35 AM
 */
class ReferenceService
        extends Controller {

    private static $allowed_actions = [
        'add',
        // Edit Photo
        'Form_AddReference',
        'doAddReference',
    ];
    private static $url_handlers = [
        'add/$ID' => 'add',
    ];

    public function Link($action = null) {
        return Director::BaseURL() . Controller::join_links('api-reference', $action) . '/';
    }

    public function add($object) {
        return $this
                        ->customise([
                            'OwnerClass' => $object->ClassName,
                            'OwnerID' => $object->ID
                        ])
                        ->renderWith('Includes/References_Add');
    }

    /// Forms
    public function Form_AddReference($ownerClass = null, $ownerID = null) {
        $items = self::get_add_items($ownerClass, $ownerID);
        // Create fields
        $fields = new FieldList(
                $items
        );

        // Create action
        $actions = new FieldList(
                FormAction::create('doAddReference', _t('Reference.ADD', 'Add'))
                        ->addExtraClass('btn-primary btn-block-center')
        );

        // Create Validators
        $validator = new RequiredFields('Name');

        return Form::create($this, 'Form_AddReference', $fields, $actions, $validator);
    }

    public function doAddReference($data, $form) {
        $reference = new Reference();
        $form->saveInto($reference);
        $reference->write();

        $ownerClass = $data['OwnerClass'];
        $ownerID = $data['OwnerID'];
        $owner = DataObject::get_by_id($ownerClass, $ownerID);
        $owner->References()->add($reference);

        return $this->owner->redirectBack();
    }

    public static function get_add_items($ownerClass, $ownerID) {
        // Create fields
        $items = [];
        $items[] = HiddenField::create('OwnerClass', 'OwnerClass', $ownerClass);
        $items[] = HiddenField::create('OwnerID', 'OwnerID', $ownerID);

        $items[] = TextField::create('Name', _t('Reference.NAME', 'Name'));
        $items[] = TextField::create('Author', _t('Reference.AUTHOR', 'Author'));
        $items[] = TextField::create('Edition', _t('Reference.EDITION', 'Edition'));
        $items[] = TextField::create('Publisher', _t('Reference.PUBLISHER', 'Publisher'));
        $items[] = TextField::create('Description', _t('Reference.DESCRIPTION', 'Description'));
        $items[] = TextField::create('Details', _t('Reference.DETAILS', 'Details'));
        $items[] = NumericField::create('Page', _t('Reference.PAGE', 'Page'));
        $items[] = TextField::create('Link', _t('Reference.LINK', 'Link'));
        $items[] = DateField::create('Date', _t('Reference.DATE', 'Date'));

        return $items;
    }

}
