<?php

namespace App\Http\Controllers;

use App\Http\Requests\tasks\StoreTaskRequest;
use App\Http\Requests\tasks\UpdateTaskRequest;
use App\Http\Resources\tasks\TasksList;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $tasks = Task::query()->where('created_by', auth()->user()->id);

        $sort = $request['due_date'];
        if($sort){
            $tasks->orderBy("due_date", $sort);
        }

        $statusFilter = $request['status'];
        if($statusFilter){
            $tasks->where("status", $statusFilter);
        }
        return response()->json(TasksList::collection($tasks->get()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreTaskRequest $request
     * @return JsonResponse
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $data = $request->validated();
            $data["created_by"] = auth()->user()->id;
            $created = Task::create($data);
            if(!$created){
                return response()->json([
                    "success" => false,
                    "message" => "Couldn't create task!",
                    "data" => null
                ], 400);
            }

            return response()->json([
                "success" => true,
                "message" => "Task Created Successfully!",
                "data" => $created
            ], 201);

        }catch (\Exception $e){
            return response()->json([
                "success" => false,
                "exception" => $e->getMessage(),
                "message" => "Oops something went wrong!",
                "data" => null
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $item = Task::findOrFail($id);

            return response()->json([
                "success" => true,
                "message" => "",
                "data" => $item
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                "success" => false,
                "message" => "Task not found",
                "data" => null
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateTaskRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $item = Task::findOrFail($id);
            $updated = $item->update($request->validated());

            if(!$updated){
                return response()->json([
                    "success" => false,
                    "message" => "Couldn't update the task!",
                    "data" => null
                ], 400);
            }

            return response()->json([
                "success" => true,
                "message" => "Task Updated Successfully!",
                "data" => $item
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                "success" => false,
                "message" => "Task not found",
                "data" => null
            ], 404);
        }
    }

    public function setTaskCompleted(Request $request, $id){
        try{
            $item = Task::findOrFail($id);
            $item->update([
                "status" => "completed"
            ]);
            return response()->json([
                "success" => true,
                "message" => "Task Updated Successfully!",
                "data" => $item
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "success" => false,
                "message" => "Task not found",
                "data" => null
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $item = Task::findOrFail($id);
            if($item->delete()){
                return response()->json([
                    "success" => true,
                    "message" => "Task Deleted Successfully!",
                    "data" => null
                ], 200);
            }
            return response()->json([
                "success" => false,
                "message" => "Couldn't delete the task!",
                "data" => $item
            ], 400);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "success" => false,
                "message" => "Task not found",
                "data" => null
            ], 404);
        }
    }
}
