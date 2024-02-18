<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Videos;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContentMangement;
use App\Http\Controllers\HomeController;
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
// Route::patch('/contenmangment', [ContentMangement::class, 'update'])->name('contenmangment.update');;
Route::get('contenmangment',[ ContentMangement::class,'index']);
Route::patch('contenmangment/store/{id}',[ ContentMangement::class,'update'])->name('contenmangment.update');
Route::patch('managcontentdelete',[ ContentMangement::class,'destroy'])->name('contenmangment.destroy');

Route::get('/fetch-content', [HomeController::class, 'fetchContent']);
Route::get('/fetch-video', [HomeController::class, 'fetchvideo']);
Route::get('/error', [HomeController::class, 'error'])->name('error.404');

Route::get('/search', [SearchController::class, 'index']);
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/test', function () {
    $posts = DB::table('posts')->orderBy('id', 'DESC')->get();
    $videos = App\Models\videos::orderBy('id', 'DESC')->get();
    $mostposts = DB::table('posts')->orderBy('REED', 'DESC')->get();
    $mostvideos = DB::table('videos')->orderBy('REED', 'DESC')->get();
    $mosttags = DB::table('poststags')->orderBy('REED', 'DESC')->get();
    $tags = DB::table('poststags')->get();
    $groups = DB::table('groups')->get();


    $postswithtime =[];
    $datenow = strtotime('-3:00');
    foreach ($posts as $singlepost) {
        if (strtotime($singlepost->DATE_SCHEDULER) <= $datenow) {
            $postswithtime[] = $singlepost;
        }
    }

    $page = array(
        "name" => "طبكم - tebkum",
        "tital" => "طبكم - tebkum",
        "description" => "طبكم - tebkum",
        "url" => url('/'),
        "imgurl" => asset('main_page/images/logo.png')
    );
    return view('welcomeTest', ['page' => $page,'groups' => $groups, 'posts' => $postswithtime, 'mosttags' => $mosttags, 'mostposts' => $mostposts, 'mostvideos' => $mostvideos, 'videos' => $videos, 'tags' => $tags, $intersted='intersted']);
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




/// dashboards
Route::get('/dashboard', [App\Http\Controllers\webcontrol::class, 'index'])->name('dashboard');
Route::get('/color', [App\Http\Controllers\postcontrol::class, 'color'])->name('color');
Route::get('/posts/create', [App\Http\Controllers\postcontrol::class, 'create'])->name('create');
Route::get('/posts/tags', [App\Http\Controllers\postcontrol::class, 'tags'])->name('tags');
Route::get('/posts', [App\Http\Controllers\postcontrol::class, 'posts'])->name('posts');
Route::get('/posts/addtags', [App\Http\Controllers\postcontrol::class, 'addtags'])->name('addtags');
Route::get('/posts/tags/{id}/edit', [App\Http\Controllers\postcontrol::class, 'tagsedit'])->name('tags.edit');
Route::get('/posts/{id}/edit', [App\Http\Controllers\postcontrol::class, 'postedit'])->name('post.edit');
Route::get('/profile/{user}/edit', [App\Http\Controllers\webcontrol::class, 'edit'])->name('profile.edit');
Route::get('/videos', [App\Http\Controllers\postcontrol::class, 'videos'])->name('videos');
Route::get('/videos/create', [App\Http\Controllers\postcontrol::class, 'createvideos'])->name('createvideos');
Route::get('/videos/{id}/edit', [App\Http\Controllers\postcontrol::class, 'videoedit'])->name('video.edit');
Route::get('/programs', [App\Http\Controllers\postcontrol::class, 'programs'])->name('programs');
Route::get('/programs/create', [App\Http\Controllers\postcontrol::class, 'createprograms'])->name('createprograms');
Route::get('/programs/{id}/edit', [App\Http\Controllers\postcontrol::class, 'programsvideos'])->name('programsvideos.edit');
Route::get('/programsvid/{id}/create', [App\Http\Controllers\postcontrol::class, 'createprogramsvid'])->name('createprogramsvid');
Route::get('/programsvid/{id}/edit', [App\Http\Controllers\postcontrol::class, 'editprogramsvid'])->name('editprogramsvid');
Route::get('/programseditprogram/{id}', [App\Http\Controllers\postcontrol::class, 'editprogramdata'])->name('editprogramdata.edit');

Route::get('/posts/groups', [App\Http\Controllers\postcontrol::class, 'groups'])->name('groups');
Route::get('/posts/addgroups', [App\Http\Controllers\postcontrol::class, 'addgroups'])->name('addgroups');
Route::get('/posts/groups/{id}/edit', [App\Http\Controllers\postcontrol::class, 'groupsedit'])->name('groups.edit');

Route::get('/posts/pictures', [App\Http\Controllers\postcontrol::class, 'pictures'])->name('pictures');
Route::get('/posts/addpictures', [App\Http\Controllers\postcontrol::class, 'addpicture'])->name('addpicture');
Route::get('/posts/pictures/{id}/edit', [App\Http\Controllers\postcontrol::class, 'picturesedit'])->name('pictures.edit');

///forms
Route::post('/storeposts', [App\Http\Controllers\postcontrol::class, 'storeposts'])->name('storeposts');
Route::post('/storetags', [App\Http\Controllers\postcontrol::class, 'storetags'])->name('storetags');
Route::patch('/tags/{tag}', [App\Http\Controllers\postcontrol::class, 'edittags'])->name('tags.update');
Route::patch('/posts/{id}', [App\Http\Controllers\postcontrol::class, 'editposts'])->name('post.update');
Route::patch('/posts/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroy'])->name('post.destroy');
Route::post('/storevideos', [App\Http\Controllers\postcontrol::class, 'storevideos'])->name('storevideos');
Route::patch('/videos/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroyvid'])->name('video.destroy');
Route::patch('/videos/{id}', [App\Http\Controllers\postcontrol::class, 'editvideos'])->name('video.update');
Route::post('/storeprograms', [App\Http\Controllers\postcontrol::class, 'storeprograms'])->name('storeprograms');
Route::patch('/programs/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroyprogram'])->name('program.destroy');
Route::post('/storeprogramsvid', [App\Http\Controllers\postcontrol::class, 'storeprogramsvid'])->name('storeprogramsvid');
Route::patch('/programsvid/{id}', [App\Http\Controllers\postcontrol::class, 'editprogramsvideo'])->name('programsvideo.update');
Route::patch('/programsvid/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroyprogramsvid'])->name('programsvid.destroy');
Route::patch('/program/{id}', [App\Http\Controllers\postcontrol::class, 'editprograms'])->name('program.update');

Route::post('/storegroups', [App\Http\Controllers\postcontrol::class, 'storegroups'])->name('storegroups');
Route::patch('/groups/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroygroups'])->name('destroygroups');
Route::patch('/groups/{group}', [App\Http\Controllers\postcontrol::class, 'editgroups'])->name('groups.update');

Route::post('/store_pictures', [App\Http\Controllers\postcontrol::class, 'store_pictures'])->name('store_pictures');
Route::patch('/pictures/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroypictures'])->name('destroypictures');
Route::patch('/pictures/{id}', [App\Http\Controllers\postcontrol::class, 'editpicture'])->name('picture.update');


/// main website
Route::get('/posts/{id}/show', [App\Http\Controllers\webcontrol::class, 'postbyid'])->name('postbyid');
Route::get('/group/{id}/show', [App\Http\Controllers\webcontrol::class, 'groupbyid'])->name('groupbyid');
Route::get('/grouptags/{id}/show', [App\Http\Controllers\webcontrol::class, 'groupsecbyid'])->name('groupsecbyid');
Route::get('/tags/{id}/show', [App\Http\Controllers\webcontrol::class, 'tagbyid'])->name('tagbyid');
Route::get('/videotags/{id}/show', [App\Http\Controllers\webcontrol::class, 'videotags'])->name('videotags');
Route::get('/tags/{tag}', [App\Http\Controllers\webcontrol::class, 'tagbyid'])->name('showtag');
Route::get('/tags/{id}/show/{nm}', [App\Http\Controllers\webcontrol::class, 'tagbyidnum'])->name('tagbyidnum');
Route::get('/videos/{id}/show', [App\Http\Controllers\webcontrol::class, 'videobyid'])->name('videobyid');
Route::get('/tagsvid/{id}/show', [App\Http\Controllers\webcontrol::class, 'tagbyidvid'])->name('tagbyidvid');
Route::get('/videos/show', [App\Http\Controllers\webcontrol::class, 'videosshow'])->name('videosshow');
// Route::get('/videos/{id}/show', [App\Http\Controllers\webcontrol::class, 'videosshownum'])->name('videosshownum');
Route::get('/login', [App\Http\Controllers\webcontrol::class, 'login'])->name('login');
Route::get('/register', [App\Http\Controllers\webcontrol::class, 'register'])->name('register');
Route::get('/aboutus', [App\Http\Controllers\webcontrol::class, 'aboutgus'])->name('aboutus');
Route::get('/contactus', [App\Http\Controllers\webcontrol::class, 'contactus'])->name('contactus');
Route::get('/policy', [App\Http\Controllers\webcontrol::class, 'policy'])->name('policy');
Route::get('/Intellectual_property_rights', [App\Http\Controllers\webcontrol::class, 'Intellectual_property_rights'])->name('Intellectual_property_rights');
Route::get('/privacy', [App\Http\Controllers\webcontrol::class, 'privacy'])->name('privacy');




// 26/2/2023
// add user control
Route::get('/userscontrol', [App\Http\Controllers\webcontrol::class, 'userscontrol'])->name('userscontrol');
Route::get('/showdayaction', [App\Http\Controllers\webcontrol::class, 'showdayaction'])->name('showdayaction');
Route::post('/showdaysaction', [App\Http\Controllers\webcontrol::class, 'showdaysaction'])->name('showdaysaction');
Route::patch('/tags/delete/{id}', [App\Http\Controllers\postcontrol::class, 'destroytags'])->name('destroytags');


// 27/2/2023
// allow user to change password
Route::post('/updatePassword', [App\Http\Controllers\postcontrol::class, 'updatePassword'])->name('updatePassword');
Route::get('sitemap.xml', [App\Http\Controllers\webcontrol::class,  'sitemap'])->name('sitemap');
Route::get('/search-posts', [App\Http\Controllers\postcontrol::class, 'search'])->name('search-posts');
Route::get('/search-pictures', [App\Http\Controllers\postcontrol::class, 'search-pictures'])->name('search-pictures');