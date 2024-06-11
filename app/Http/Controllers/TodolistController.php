<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;

class TodolistController extends Controller
{
    private TodolistService $todolistService;
    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist(Request $request) {
        $todolist = $this->todolistService->getTodo();
        return response()->view("todolist.todolist", [
            "title" => "todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request) {
        $todo = $request->input("todo");
        
        if(empty($todo)) {
            $todolist = $this->todolistService->getTodo();
            return response()->view("todolist.todolist", [
                "title" => "todolist",
                "todolist" => $todolist,
                "error" => "Todo is required"
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);
        // Alert::success('Hore!', 'Todo Created Successfully');
        toast('Your Post as been submited!','success');
        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function removeTodo(Request $request, string $todoId): RedirectResponse {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodolistController::class, 'todolist'])->with('success', 'Deleted Succesfully');
    }
}
