<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/example', function() {
    return 'hello there!';
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/books', 'BookController@index');

Route::any('/practice/{n?}', 'PracticeController@index');

Route::any('/practice', 'PracticeController@index');

Route::get('/books/{title}', 'BookController@show');

Route::get('/book/{title?}', function($title = '') {
    if ($title == '') {
        return "Your request did not have a title";
    } else {
        return 'Results for the book: '.$title;
    }
});

Route::get('/debugbar', function() {

    $data = Array('foo' => 'bar');
    Debugbar::info($data);
    Debugbar::info('Current environment: '.App::environment());
    Debugbar::error('Error!');
    Debugbar::warning('Watch out…');
    Debugbar::addMessage('Another message', 'mylabel');

    return 'Just demoing some of the features of Debugbar';

});

Route::get('/debug', function() {
    echo '<pre>';
    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    echo 'DB defaultStringLength: '.Illuminate\Database\Schema\Builder::$defaultStringLength;
        /*
	The following commented out line will print your MySQL credentials.
	Uncomment this line only if you're facing difficulties connecting to the database and you
        need to confirm your credentials.
        When you're done debugging, comment it back out so you don't accidentally leave it
        running on your production server, making your credentials public.
        */
    print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
	$results = DB::select('SHOW DATABASES;');
	echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
	echo "<br><br>Your Databases:<br><br>";
	print_r($results);
    }
    catch (Exception $e) {
	echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});