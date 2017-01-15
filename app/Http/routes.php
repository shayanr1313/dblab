<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {
    /**
     * Show Task Dashboard
     */
    Route::get('/', function () {
        // $tasks = Task::where('list', 'List 2')->orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => Task::orderBy('created_at', 'asc')->get(),
            'tlist' => Task::select('list')->distinct()->get()
        ]);
    });

    /**
     * Select List
     */
    Route::get('/task/{list}', function ($list) {
        // $tasks = Task::where('list', 'List 2')->orderBy('created_at', 'asc')->get();
        return view('tasks', [
            'tasks' => Task::where('list', $list)->orderBy('created_at', 'asc')->get(),
            'tlist' => Task::select('list')->distinct()->get()
            // 'tasks' => $tasks
        ]);
        return redirect('/');
    });

    /**
     * Add New Task
     */
    Route::post('/task', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'text' => 'required|max:255',
            'list' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $task = new Task;
        $task->name = $request->name;
        $task->text = $request->text;
        $task->list = $request->list;
        $task->save();

        return redirect('/');
    });

    /**
     * Delete Task
     */
    Route::delete('/task/{id}', function ($id) {
        Task::findOrFail($id)->delete();

        return redirect('/');
    });

    /**
     *  Update list
     */
    Route::post('/task/updateList/{id}', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'list' => 'required|max:255',
            // 'name' => 'required|max:255',
            // 'text' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // $task = new Task;
        $task = Task::findOrFail($request->id);
        // $task->name = $request->name;
        $task->list = $request->list;
        $task->save();

        return redirect('/');
    });

    /**
     *  Update text
     */
    Route::post('/task/updateText/{id}', function (Request $request) {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|max:255',
            'text' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        // $task = new Task;
        $task = Task::findOrFail($request->id);
        // $task->name = $request->name;
        $task->text = $request->text;
        $task->save();

        return redirect('/');
    });
});
