<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Jan 6, 2017 - 11:10:05 AM
 */
class ReferencesPage
        extends DataObjectPage {

    private static $icon = "hudhaifas/silverstripe-data-reference: res/images/reference.png";
    private static $allowed_children = 'none';
    private static $description = 'Adds references to your website.';

    public function canCreate($member = null, $context = []) {
        if (!$member || !(is_a($member, Member::class)) || is_numeric($member)) {
            $member = Security::getCurrentUser()?->ID;
        }

        return (DataObject::get($this->ClassName)->count() > 0) ? false : true;
    }

}
