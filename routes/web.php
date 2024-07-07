<?php

use App\Http\Requests\TaskCompletedRequest;
use App\Http\Requests\TaskRequest;
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
    $tasks = Task::latest()->paginate();
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

Route::get('edit/task/{task}', function(Task $task){

    //dd($task);
    
    return view('edit-task', ['task' => $task]);
})->name('edit-task');



Route::post('/tasks', function (TaskRequest $request) {
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

    $task = Task::create($request->validated());
    
    return redirect()->route('tasks',['id'=> $task->id])->with('message', 'Task created successfully');

})->name('tasks.store');


Route::put('/update/task/{task}', function (TaskRequest $request, Task $task) {

        //$data = $request->validated();

        // $task = Task::findOrFail($id);
        // $task->title = $data['title'];
        // $task->description = $data['description'];
        // $task->long_description = $data['long_description'];
        // $task->save();
        $task->update($request->validated());

        return redirect()->route('tasks')->with('updated_task', $task->id)->with('message', 'Task updated successfully');
    

})->name('task.update');

Route::put('/completed/task/{task}', function (Task $task) {

    if($task->completed != 1) {
        $task->completed = 1;
        $task->save();
    }

    return redirect()->route('tasks')->with('message', 'Task completed successfully');
    
})->name('task.completed');

Route::delete('/delete/task/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks')->with('deleted_task', $task->id)->with('message', 'Task deleted successfully');
})->name('task.delete');
