<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TurnController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TeamCaptainController;
use App\Http\Controllers\DataRecorderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TeamController::class, 'getTeams'])->name('homepage');

//Regisztráció és belépés route szabályai
Route::get('/registration', [AuthController::class, 'registrationCreate'])->name('registration.create');
Route::post('/registration', [AuthController::class, 'registrationStore'])->name('registration.store');
Route::get('/login', [AuthController::class, 'loginCreate'])->name('login.create');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgotpassword-change', [AuthController::class, 'forgotPasswordChange'])->name('forgotPassword.change');
Route::post('/forgotpassword-update', [AuthController::class, 'forgotPasswordUpdate'])->name('forgotPassword.update');
Route::get('/password-change', [AuthController::class, 'passwordChange'])->name('password.change');
Route::post('/password-update', [AuthController::class, 'passwordUpdate'])->name('password.update');


//Admin és csapatkapitány szerepkörű felhasználó beléptetésének engedélyezése a menüponthoz
Route::prefix('teams')->group(function () {
    Route::get('/players', [PlayerController::class, 'index'])->name('players.index');
    Route::post('/players/store', [PlayerController::class, 'store'])->name('players.store');
    Route::get('/players/{user}/edit', [PlayerController::class, 'edit'])->name('players.edit');
    Route::put('/players/{user}', [PlayerController::class, 'update'])->name('players.update');
    Route::delete('/players/{user}', [PlayerController::class, 'destroy'])->name('players.destroy');
    Route::post('/addPlayer/{teamCaptain}', [TeamCaptainController::class, 'addPlayer'])->name('teamCaptains.addPlayer');
    route::resource('/teamCaptains', TeamCaptainController::class);
    route::resource('/dataRecorders', DataRecorderController::class);
    Route::resource('/teams', TeamController::class);
});

//Eredményrögzítés menüpont
Route::prefix('games')->group(function () {
    Route::get('/', [GameController::class, 'index'])->name('games.index');
    Route::get('/{game}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::post('/{game}', [GameController::class, 'update'])->name('games.update');
    Route::get('/lots/', [GameController::class, 'gamesLots'])->name('gamesLots.index');
    Route::post('/getHomeTeam', [GameController::class, 'getHomeTeam']);
    Route::post('/getHomeTeamPlayer', [GameController::class, 'getHomeTeamPlayer']);
    Route::post('/getAwayTeam', [GameController::class, 'getAwayTeam']);
    Route::post('/getAwayTeamPlayer', [GameController::class, 'getAwayTeamPlayer']);
});

//Bajnokság menüpont
Route::prefix('championship')->group(function () {
    route::get('teams', [TeamController::class, 'getGroupByChampionship'])->name('getGroupByChampionship');
    route::post('teams/getTeamsByGroupId', [TeamController::class, 'getTeamsByGroupId']);
});


//Admin szerepkörű felhasználó beléptetésének engedélyezése a menüponthoz
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::post('/turns/truncate', [TurnController::class, 'truncateTurn'])->name('turns.truncate');
    Route::resource('/admins', AdminController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/days', DayController::class);
    Route::resource('/tracks', TrackController::class);
    Route::resource('/groups', GroupController::class);
    Route::resource('/turns', TurnController::class);
});


//Admin szerepkörű felhasználó beléptetésének engedélyezése a menüponthoz
Route::group(['prefix' => 'list', 'middleware' => ['auth', 'admin']], function () {
    Route::post('/teams/store', [TeamController::class, 'store'])->name('fakeTeam.store');
    Route::get('/teams/{team}/edit', [TeamController::class, 'teamToGroupEdit'])->name('teamToGroup.edit');
    Route::post('/teams/{team}', [TeamController::class, 'teamToGroupUpdate'])->name('teamToGroup.update');
    Route::get('/teams/{team}', [TeamController::class, 'teamListShow'])->name('teamList.show');
    Route::get('/teams/', [TeamController::class, 'teamList'])->name('teamList.index');
    Route::get('/players/', [UserController::class, 'playerList'])->name('playerList.index');
    Route::get('/players/{user}', [PlayerController::class, 'playerStatusUpdate'])->name('playerStatus.update');
    Route::get('/lots/', [TeamController::class, 'teamLot'])->name('teamLot.index');
    Route::get('/teamLotAction/{id}', [TeamController::class, 'teamLotAction'])->name('teamLot.action');
    Route::get('/action/{id}', [GameController::class, 'action'])->name('games.action');
});
