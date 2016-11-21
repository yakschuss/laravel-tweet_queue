<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
 */

ClassLoader::addDirectories(array(

  app_path().'/commands',
  app_path().'/controllers',
  app_path().'/models',
  app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
 */

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
 */

App::error(function(Exception $exception, $code)
{
  Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
 */

App::down(function()
{
  return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
 */

require app_path().'/filters.php';

Form::macro('datetime', function($name) {
  $years = value(function() {
    $startYear = (int) date('Y');
    $endYear = $startYear + 2;
    $years = ['' => 'year'];
    for($year = $startYear; $year < $endYear; $year++) {
      $years[ $year ] = $year;
    };
    return $years;
  });

  $months = value(function() {
    $months = ['' => 'month'];
    for($month = 1; $month < 13; $month++) {
      $timestamp = strtotime(date('Y'). '-'.$month.'-13');
      $months[ $month ] = strftime('%B', $timestamp);
    }
    return $months;
  });

  $days = value(function() {
    $days = ['' => 'day'];
    for($day = 1; $day < 32; $day++) {
      $days[ $day ] = $day;
    }
    return $days;
  });

  $hours = value(function() {
    $hours = ['' => 'hour'];
    for($hour = 0; $hour < 24; $hour++) {
      $hours[ $hour ] = $hour;
    }
    return $hours;
  });

  $minutes = value(function() {
    $minutes = ['' => 'minute'];
    for($minute = 0; $minute < 60; $minute++) {
      $minutes[ $minute ] = $minute;
    }
    return $minutes;
  });

  return Form::select($name.'[year]', $years) .
    Form::select($name.'[month]', $months) .
    Form::select($name.'[day]', $days) .
    Form::select($name.'[hour]', $hours) .
    Form::select($name.'[minute]', $minutes);
});
