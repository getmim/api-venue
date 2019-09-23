<?php
/**
 * VenueController
 * @package api-venue
 * @version 0.0.1
 */

namespace ApiVenue\Controller;

use LibFormatter\Library\Formatter;

use Venue\Model\Venue;

class VenueController extends \Api\Controller
{

    public function indexAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        list($page, $rpp) = $this->req->getPager();

        $cond = [];
        if($q = $this->req->getQuery('q'))
            $cond['q'] = $q;

        $venues = Venue::get($cond, $rpp, $page, ['id' => 'DESC']);
        $venues = !$venues ? [] : Formatter::formatMany('venue', $venues, ['user']);

        foreach($venues as &$pg)
            unset($pg->content, $pg->meta);
        unset($pg);

        $this->resp(0, $venues, null, [
            'meta' => [
                'page'  => $page,
                'rpp'   => $rpp,
                'total' => Venue::count($cond)
            ]
        ]);
    }

    public function singleAction() {
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;

        $venue = Venue::getOne(['id'=>$identity]);
        if(!$venue)
            $venue = Venue::getOne(['slug'=>$identity]);

        if(!$venue)
            return $this->resp(404);

        $venue = Formatter::format('venue', $venue, ['user']);
        unset($venue->meta);

        $this->resp(0, $venue);
    }
}