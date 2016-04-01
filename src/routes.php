<?php

Route::group(['namespace' => 'Szabomikierno\GoogleCalendarLaravelWrapper\Controllers', 'prefix' => 'googlecalendarwrapper'], function() {

	Route::get('/', ['as' => 'GoogleCalendarTestPath', 'uses' => 'GoogleCalendarController@index']);

});