<?php

/**
 *
 * @author Hudhaifa Shatnawi <hudhaifa.shatnawi@gmail.com>
 * @version 1.0, Jan 6, 2017 - 11:10:05 AM
 */
class ReferencesPageController
        extends DataObjectPageController {

    protected function searchObjects($list, $keywords) {
        return Reference::get()->filterAny([
                    'Name:PartialMatch' => $keywords,
                    'Description:PartialMatch' => $keywords,
                    'Details:PartialMatch' => $keywords,
                    'Link:PartialMatch' => $keywords
        ]);
    }

    protected function getObjectsList() {
        return Reference::get();
    }

}
