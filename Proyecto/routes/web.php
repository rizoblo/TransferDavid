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

/*Route::get('/', function () {
    return view('index');
});*/

    //INDEX
        Route::get('/', 'noticeController@index');




//Route::get('/editUser', 'editUserController@index');

    //INFORMACION
    Route::get('/legalTerms', 'webInfoController@legalTerms');
    Route::get('/privacity', 'webInfoController@privacity');

    //CRUD DE USUARIOS

        Route::get('/adminUsers', 'editAllUsersController@index')->middleware('auth');
        Route::get('/editUser/{id}/{var1}', 'editUserController@index')->middleware('auth');
        Route::post('/editUser/{id}/{var1}', 'editUserController@validarForm')->middleware('auth');
        Route::put('/editUser/{id}/{var1}', 'editUserController@eliminarCuenta')->middleware('auth');
        Route::get('/deleteUser/{id}/{var1}', 'editUserController@eliminarCuenta')->middleware('auth');
    //PANEL DE ADMINISTRACION

        Route::get('/administration', 'administrationController@index')->middleware('auth');


    //CLUBES

        Route::get('/addTeam', 'addTeamController@index')->middleware('auth');
        Route::post('/addTeam', 'addTeamController@recibirFormulario')->middleware('auth');
        Route::get('/infoClub/{id}', 'showTeamController@index');
        Route::get('/editClub/{id}', 'editClubController@index')->middleware('auth');
        Route::put('/editClub/{id}', 'editClubController@recibirFormulario')->middleware('auth');
        Route::get('/clubes', 'showAllTeamsController@index');
        Route::get('/clubes/{id}', 'deleteTeamController@eliminarClub')->middleware('auth');

    //JUGADORES

        Route::get('/jugadores', 'playerController@index');
        Route::post('/jugadores', 'playerController@findPlayer');

        Route::get('/editarJugadores/{id}', 'playerController@editarJugadorVista')->middleware('auth');
        Route::post('/editarJugadores/{id}', 'playerController@editarJugador')->middleware('auth');
        Route::get('/jugadoresEliminar/{id}', 'playerController@eliminarJugador')->middleware('auth');

        Route::get('/addPlayer', 'playerController@addPlayerView')->middleware('auth');
        Route::post('/addPlayer', 'playerController@addPlayer')->middleware('auth');

    //PARTIDOS

        Route::get('/matches', 'matchesController@devolverCabecera');
        Route::post('/matches', 'matchesController@devolverPartidos');
        Route::put('/matches', 'matchesController@devolverCabecera');
        Route::get('/addMatch/{fallo}', 'matchesController@devolverAddMatch')->middleware('auth')->middleware('mWUsersList');
        Route::post('/addMatch/{fallo}', 'matchesController@recibirAddMatch')->middleware('auth')->middleware('mWUsersList');

        /*Route::get('/matches/{team}', 'matchesController@devolverPartidosInicial');
        Route::post('/matches/{team}', 'matchesController@devolverPartidos');
        Route::put('/matches/{team}', 'matchesController@editarPartidoVista')->middleware('auth')->middleware('mWUsersList');*/
        /*Route::get('/addMatch/{fallo}/{equipo}', 'matchesController@devolverAddMatch')->middleware('auth')->middleware('mWUsersList');
        Route::post('/addMatch/{fallo}/{equipo}', 'matchesController@recibirAddMatch')->middleware('auth')->middleware('mWUsersList');*/
        Route::put('/editMatch', 'matchesController@editarPartidoVista')->middleware('auth')->middleware('mWUsersList');
        Route::post('/editMatch', 'matchesController@editarPartido')->middleware('auth')->middleware('mWUsersList');
        Route::get('/deleteMatch/{id}', 'matchesController@eliminarPartido')->middleware('auth')->middleware('mWUsersList');

    //LIGAS
        Route::get('/league/{id}', 'leagueController@devolverLeague');
        Route::post('/league/{id}', 'leagueController@devolverLeagueForm');

    //NOTICIAS

    Route::get('/noticeView/{id}', 'noticeController@noticeInfo');
    Route::get('/noticeViewOther/{id}', 'noticeController@noticeInfoOther');

    Route::get('/addNotice', 'noticeController@devolverFormAddNotice')->middleware('auth');
    Route::post('/addNotice', 'noticeController@recibirFormAddNotice')->middleware('auth');

Route::get('/serieA', function () {
    return view('serieA');
});
Route::get('/bundesliga', function () {
    return view('bundesliga');
});
Route::get('/ligueOne', function () {
    return view('ligueOne');
});
Route::get('/premierLeague', function () {
    return view('premierLeague');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
