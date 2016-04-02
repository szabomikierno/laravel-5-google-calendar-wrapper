<?php namespace Szabomikierno\GoogleCalendarLaravelWrapper\Facade;
 
use Illuminate\Support\Facades\Facade;
 
class GCalendar extends Facade {
 
    protected static function getFacadeAccessor() { return 'Szabomikierno\GoogleCalendarLaravelWrapper\GoogleCalendar'; }
 
}