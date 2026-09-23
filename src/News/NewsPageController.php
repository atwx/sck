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

    public function view()
    {
        $segment = (string) $this->getRequest()->param("ID");
        if ($segment === '') {
            return $this->httpError(404);
        }

        $article = NewsEntry::get()->filter('URLSegment', $segment)->first();

        // Old links used the numeric ID; send them to the current URL.
        if (!$article && ctype_digit($segment)) {
            $article = NewsEntry::get()->byID((int) $segment);
            if ($article && $article->URLSegment) {
                return $this->redirect($article->Link(), 301);
            }
        }

        if (!$article) {
            return $this->httpError(404);
        }

        return [
            "News" => $article,
        ];
    }
}