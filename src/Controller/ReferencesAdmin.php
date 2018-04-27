<?php

use SilverStripe\Admin\ModelAdmin;

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Apr 27, 2018 - 12:31:22 AM
 */
class ReferencesAdmin
        extends ModelAdmin {

    private static $managed_models = [
        'Reference',
    ];
    private static $url_segment = 'references';
    private static $menu_title = "References";
    private static $menu_icon = "hudhaifas/data-reference: res/images/reference.png";

}
