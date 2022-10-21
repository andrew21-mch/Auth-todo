<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;

class TodoController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        try{
            $todo = new Todo();
            $todo->title = $request->title;
            $todo->description = $request->description;
            $todo->user_id = Auth::user()->id;

            $todo->save();


            return response()->json([
                'message'=>'Todo created successfully',
                'todo'=>$todo
            ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong',
                'error'=>$e->getMessage()
            ], 500);
        }

    }

    public function edit(Request $request, $id){
        $request->validate([
            'title'=>'required',
            'description'=>'required'
        ]);
        try{
            $todo = Todo::find($id);
            $todo->title = $request->title;
            $todo->description = $request->description;
            $todo->save();
            return response()->json([
                'message'=>'Todo updated successfully',
                'todo'=>$todo
            ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong',
                'error'=>$e->getMessage()
            ], 500);
        }

    }

    public function delete($id){
        try{
            $todo = Todo::find($id);
            $todo->delete();
            return response()->json([
                'message'=>'Todo deleted successfully',
                'todo'=>$todo
            ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong',
                'error'=>$e->getMessage()
            ], 500);
        }

    }

    public function getTodos(){
        try{
            $todos = Todo::where('user_id', Auth::user()->id)->get();
            return response()->json([
                'message'=>'Todos fetched successfully',
                'todos'=>$todos
            ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong',
                'error'=>$e->getMessage()
            ], 500);
        }

    }

    public function getTodoById($id){
        try{
            $todo = Todo::find($id);
            return response()->json([
                'message'=>'Todo fetched successfully',
                'todo'=>$todo
            ], 201);
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'Something went wrong',
                'error'=>$e->getMessage()
            ], 500);
        }

    }


}
