<?php

namespace Atwx\Sck\News;

use PageController;
use Atwx\Sck\Events\Event;
use SilverStripe\Model\List\PaginatedList;

class EventsPageController extends PageController
{
    private static $allowed_actions =  [
        "view"
    ];

    public function getEvents()
    {
        $paginatedList = PaginatedList::create(
            Event::get()->sort('Date DESC'),
            $this->getRequest()
        )->setPageLength(10);

        return $paginatedList;
    }

    public function view()
    {
        $id = $this->getRequest()->param("ID");
        $article = Event::get()->byId($id);
        return [
            "Event" => $article,
        ];
    }
}
