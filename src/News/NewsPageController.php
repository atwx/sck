<?php

namespace Atwx\Sck\News;

use PageController;
use SilverStripe\Model\List\PaginatedList;

class NewsPageController extends PageController
{
    private static $allowed_actions =  [
        "view"
    ];
    
    public function getNews()
    {
        $paginatedList = PaginatedList::create(
            NewsEntry::get()->sort('Date DESC'),
            $this->getRequest()
        )->setPageLength(10);

        return $paginatedList;
    }

    public function view() {
        $id = $this->getRequest()->param("ID");
        $article = NewsEntry::get()->byId($id);
        return [
            "News" => $article,
        ];
    }
}