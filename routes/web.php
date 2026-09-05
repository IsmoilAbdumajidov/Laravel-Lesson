<?php

use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\IdeaController;
use App\Models\Idea;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// Route::get('/ideas', [IdeaController::class, 'index'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/welcome', function () {
        return view('welcome');
    });

    Route::get('/', function () {
        // $job = Job::all();

        // dd($job[0]->salary);
        // dd($job);

        return view('home');
    });

    Route::get('/jobs', function () {
        return view('jobs', [
            'jobs' => Job::all(),
        ]);
    });

    Route::get('/jobs/{id}', function ($id) {
        // $job = Arr::first(Job::all(), fn ($job) => $job['id'] == $id);

        $job = Job::find($id);

        return view('job', ['job' => $job]);
    });

    Route::get('/about', function () {
        return view('about');
    });

    Route::view('/contact', 'contact', [
        'tasks' => [
            'Task 1',
            'Task 2',
            'Task 3',
        ],
    ]);

    Route::get('/ideas', [IdeaController::class, 'index']);
    Route::get('/ideas/create', [IdeaController::class, 'create']);
    Route::post('/ideas', [IdeaController::class, 'store']);
    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);

    Route::delete('/logout', [SessionsController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);

});

Route::get('/admin', function () {
    return "Private Admin Page";
});


// Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');

// + if I use class, I don't use (use) keyword for give virable to function
// Migration database'ni quradi, Model database table'ni ifodalaydi, Eloquent database bilan ishlaydi, Controller nima qilishni hal qiladi, Route requestni kerakli joyga yuboradi, View esa natijani userga ko‘rsatadi.

// $jobs = [
// [
//     'id' => 1,
//     'title' => 'Director',
//     'salary' => '$50.000',
// ],
// [
//     'id' => 2,
//     'title' => 'Programmer',
//     'salary' => '$10.000',
// ],
// [
//     'id' => 3,
//     'title' => 'Project Manager',
//     'salary' => '$15.000',
// ],
// ];

// Route::get('/ideas/{id}', function ($id) {
//     $idea = Idea::findOrFail($id);
//     // findOrFail. we use this key word 404 page automatically show when we don't find the data in database.
//     // $idea = Idea::find($id);

//     // if (!$idea) {
//     //     abort(404);
//     // }

//     // return $idea;
//     return view('ideas.show', ['idea' => $idea]);

// });

// +destroy
// Route::delete('/ideas/{idea}', function (Idea $idea) {

//     $idea->delete();

//    return redirect("/ideas");

// });

// + update
// Route::patch('/ideas/{idea}', function (Idea $idea) {
//     //+ this is an api
//     $idea->update([
//         'description'=>request('description'),
//     ]);
//         return redirect("/ideas/{$idea->id}");

// });

// + edit
// Route::get('/ideas/{idea}/edit', function (Idea $idea) {
//     // we naming the virable same as the route parameter, so we can use route model binding
//     // dd($idea);
//     //+ this is a page route
//     return view('ideas.edit', ['idea' => $idea]);

// });

// + show
// Route::get('/ideas/{idea}', function (Idea $idea) {
//     // we naming the virable same as the route parameter, so we can use route model binding
//     // dd($idea);
//     return view('ideas.show', ['idea' => $idea]);

// });
// // +store
// Route::post('/ideas', function () {

//     Idea::create([
//         'description'=>request('description'),
//         'state'=>'pending',
//     ]);
//     // $idea = request('description');
//     // Idea::create([
//     //     'description'=>$idea,
//     //     'state'=>'pending',
//     // ]);
//     // session()->push('ideas', $idea);

//     //  dd($idea);
//     return redirect('/ideas');

// });
// + index
// Route::get('/ideas', function () {
//     // $ideas = Idea::query()->when(request('state'),function($query,$state){
//     //     $query->where('state',$state);
//     //     // dd($state, $query);
//     //     // we get query key data in search bar
//     // })->get();

//     // $ideas = Idea::where('state','pending')->get();
//     $ideas = Idea::all();
//     // $idea = Idea::find(1);
//     // $ideas = DB::table('ideas')->get();
//     // $ideas = session()->get('ideas',[]);
//     // dd($idea);
//     // return $idea;

//     // return $ideas[0]->description;
//     return view('ideas.index', ['ideas' => $ideas]);
//     // return view('ideas', ['ideas' => $ideas]);
// });

// Route::post('/ideas', function (Request $request) {
//      $value = $request->ideas;
//     //  $value = $request->input('ideas');
//      dd($value);
//     //  dd(request()->all());
// //    dd("Hello, World!");
// });

// Route::view('/contact', 'contact', [
//     'greeting' => 'Welcome to our contact page!',
// ]);

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/jobs', function () use ($jobs) {
//     return view('jobs', [
//         'jobs' => $jobs,
//     ]);
// });

// Route::get('/jobs/{id}', function ($id) use ($jobs) {

//     $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);

//     return view('job', ['job' => $job]);

//     // $job = Arr::first($jobs, function ($jobs) use ($id) {
//     //     return $jobs['id'] == $id;
//     // });

//     // dd($id, $job);
//     // dd($job);

// });

// Route::get('/', function () {
//     return view('home', [
//         'greeting' => 'Welcome to our page!',
//         'name' => 'John Doe',
//     ]);
// });

// Route::get('/', function () {
//     return view('home');
// });

// // Route::get('/test-route',[Controller::class,'action']);
// Route::get('/test-route',function(){
//   return view('test');
// });

// Route::get('/succes-route',function(){
//   return ['success'=> "Muvaffaqiyatli"];
// });
// Route::get('/users-route',function(){
//   return "Users";
// });

// Route:post("contact",function(){
//   return "post data";
// });
