<?php

Route::group(['namespace' => 'Szabomikierno\GoogleCalendarL5Wrapper\Controllers', 'prefix' => 'googlecalendarwrapper'], function() {

	Route::get('/', ['as' => 'GoogleCalendarTestPath', 'uses' => 'GoogleCalendarController@index']);

});