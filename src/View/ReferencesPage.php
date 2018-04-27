<?php

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Jan 6, 2017 - 11:10:05 AM
 */
class ReferencesPage
        extends DataObjectPage {

    private static $icon = "hudhaifas/data-reference: res/images/reference.png";
    private static $allowed_children = 'none';
    private static $description = 'Adds references to your website.';

    public function canCreate($member = null, $context = []) {
        return true;
    }

}
