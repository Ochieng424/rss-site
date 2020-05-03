<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class FeedsController extends Controller
{
    public function feed(){
        $feed = App::make('feed');
        $feed->setCache(60, 'laravelFeedKey');
        if (!$feed->isCached()) {
           $vacancies = Vacancy::latest()->take(4)->get();

            $feed->title = 'Open Vacancies';
            $feed->description = 'Latest open vacancies';
            $feed->logo = 'https://image.flaticon.com/icons/svg/1243/1243560.svg';
            $feed->link = url('/api/v1/feed');
            $feed->setDateFormat('datetime');
            $feed->pubdate = $vacancies[0]->created_at;
            $feed->lang = 'en';
            $feed->setShortening(true); // true or false
            $feed->setTextLimit(100);

            foreach ($vacancies as $vacancy)
            {
                $feed->add($vacancy->title, $vacancy->company, URL::to('/vacancies/' . $vacancy->id)
                    , $vacancy->created_at, $vacancy->title . "-" . $vacancy->location, $vacancy->description);
            }
        }

        return $feed->render('atom');
    }
}
