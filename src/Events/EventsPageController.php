<?php

namespace Atwx\Sck\Events;

use PageController;
use Atwx\Sck\Events\Event;
use SilverStripe\Model\List\PaginatedList;

class EventsPageController extends PageController
{
    private static $allowed_actions =  [
        "view",
        "past"
    ];

    public function index()
    {
        $paginatedList = PaginatedList::create(
            Event::get()->filter("Start:GreaterThanOrEqual", date('Y-m-d H:i:s'))->sort('Start ASC'),
            $this->getRequest()
        )->setPageLength(10);

        return [
            "Events" => $paginatedList,
        ];
    }

    public function view()
    {
        $id = $this->getRequest()->param("ID");
        $article = Event::get()->byId($id);
        return [
            "Event" => $article,
        ];
    }

    public function past()
    {
        //If $ShowPastEvents is false, redirect to main events page
        if (!$this->data()->ShowPastEvents) {
            return $this->redirect($this->data()->Link());
        }
        $paginatedList = PaginatedList::create(
            Event::get()->filter("Start:LessThan", date('Y-m-d H:i:s'))->sort('Start DESC'),
            $this->getRequest()
        )->setPageLength(10);

        return [
            "Events" => $paginatedList,
        ];
    }
}
