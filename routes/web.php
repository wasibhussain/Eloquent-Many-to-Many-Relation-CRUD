<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Many to many Relation, Create in database
Route::get('/create', function(){

    $user = User::find(1);

    $user->roles()->save(new Role(['name'=>'Admistrator']));
});

//Many to many Relation, read from database
Route::get('/read', function(){

    $user = User::find(1);

    foreach($user->roles as $role){

        echo $role->name. "<br>";
    }
});


//Many to many Relation, update into database
Route::get('/update', function(){

    $user = User::find(1);

    if($user->has('roles')){

        foreach($user->roles as $role){

            if($role->name == 'Admistrator'){

                $role->name = 'subscriber';

                $role->save();
            }
        }
    }
});


//Many to many Relation, delete from database
Route::get('/delete', function(){

    $user = User::find(1);

    foreach($user->roles as $role){

    $role->whereId(1)->delete();
    }
});