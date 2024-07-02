<?php

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Models\Task;

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


Route::get('/', function () {
    return redirect()->route('tasks');
});

Route::get('/tasks', function (){
    $tasks = Task::latest()->where('completed', true)->orderBy('id','desc')->get();
    return view('tasks-list',['tasks' => $tasks]);
})->name('tasks');

Route::view('/tasks/create', 'create-task')->name('create-task');

Route::get('/single-task/{id}', function($id){

    $task = Task::findOrFail($id);

    //dd($task);
    
    if(!$task) {
        abort(404, 'Task not found');
    }

    return view('single-task', ['task' => $task]);
})->name('single-task');

Route::get('edit/task/{task:id}', function(Task $task){

    //dd($task);
    
    return view('edit-task', ['task' => $task]);
})->name('edit-task');



Route::post('/tasks', function (Request $request) {
    //dd($request->all());

    /*  
        ONE OPTION

        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'required',
        ]);

        $task = new Task();
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->long_description = $data['long_description'];
        $task->save();

        return redirect()->route('tasks',['id'=> $task->id])->with('message', 'Task created successfully');
    */

    /*  ANOTHER OPTION */

    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'long_description' => 'required',
        'completed' => 'required',
    ]);

    Task::create($request->all());
    
    return redirect()->route('tasks',['id'=> $request->id])->with('message', 'Task created successfully');

})->name('tasks.store');


Route::put('/update/task/{id}', function (Request $request, $id) {

        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'long_description' => 'required',
        ]);

        $task = Task::findOrFail($id);
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->long_description = $data['long_description'];
        $task->save();

        return redirect()->route('tasks',['id'=> $task->id])->with('message', 'Task updated successfully');
    

})->name('task.update');

