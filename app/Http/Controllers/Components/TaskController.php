<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TaskQueue;
use App\TaskType;
use App\TaskPriority;
use App\Task;

class TaskController extends Controller
{
    /**
     * Obtiene un listado de tipos de tareas
     *
     * @method    getTaskTypes
     *
     *
     * @return    JsonResponse          Objeto JSON con datos de respuesta a la petición
     */
    public function getTaskTypes()
    {
        return response()->json(['result' => true, 'taskTypes' => TaskType::all()], 200);
    }

    /**
     * Obtiene un listado de prioridades de tareas
     *
     * @method    getTaskPriorities
     *
     *
     * @return    JsonResponse          Objeto JSON con datos de respuesta a la petición
     */
    public function getTaskPriorities()
    {
        return response()->json(['result' => true, 'taskPriorities' => TaskPriority::all()], 200);
    }

    /**
     * Obtiene un listado de colas de tareas
     *
     * @method    getTaskQueues
     *
     *
     * @return    JsonResponse          Objeto JSON con datos de respuesta a la petición
     */
    public function getTaskQueues()
    {
        return response()->json(['result' => true, 'taskQueues' => TaskQueue::all()], 200);
    }

    /**
     * Registra los datos de la tarea
     *
     * @method    setTask
     *
     *
     * @param     JsonResponse          Objeto JSON con datos de respuesta a la petición
     */
    public function setTask(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'description' => ['required'],
            'tasked_at' => ['required', 'date'],
            'tasked_time' => ['required'],
            'remember_at' => ['required', 'date'],
            'remember_time' => ['required']
        ], [
            'title.required' => 'Debe indicar el título de la tarea',
            'description.required' => 'Debe indicar la descripción',
            'tasked_at.required' => 'Debe indicar una fecha',
            'tasked_at.date' => 'La fecha es incorrecta',
            'tasked_time.required' => 'Debe indicar la hora',
            'remember_at.required' => 'Debe indicar la fecha de recordatorio',
            'remember_at.date' => 'La fecha del recordatorio es incorrecta',
            'remember_time.required' => 'Debe indicar la hora del recordatorio'
        ]);

        $model = "App\\" . ucfirst($request->modelRelationClass);
        $taskedAt = explode("-", $request->tasked_at);
        $rememberAt = explode("-", $request->remember_at);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'tasked_at' => "$taskedAt[2]-$taskedAt[1]-$taskedAt[0]",
            'tasked_time' => $request->tasked_time,
            'remember_type' => $request->remember_type ?? 'E',
            'remember_at' => ($request->remember_at) ? "$rememberAt[2]-$rememberAt[1]-$rememberAt[0]" : null,
            'remember_time' => $request->remember_time,
            'contact_id' => $request->contact_id ?? null,
            'task_queue_id' => ($request->task_queue_id) ? $request->task_queue_id['id'] : null,
            'task_priority_id' => $request->task_priority_id ?? null,
            'task_type_id' => $request->task_type_id ?? null,
            'taskable_type' => $model,
            'taskable_id' => $request->modelRelationId,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(['result' => true], 200);
    }

    /**
     * Obtiene un listado de tareas registradas
     *
     * @method    getTasks
     *
     *
     * @param     string      $class    Nombre d ela clase con la cual relacionar el registro
     * @param     integer     $id       Identificador del registro a asociar
     *
     * @return    JsonResponse          Objeto JSON con los datos de respuesta a la solicitud
     */
    public function getTasks($class, $id)
    {
        $model = "App\\" . ucfirst($class);
        $record = $model::find($id);

        if (!$record || !method_exists($record, 'tasks')) {
            return response()->json(['result' => true, 'tasks' => []]);
        }

        return response()->json([
            'result' => true,
            'tasks' => $record->tasks()->orderBy('tasked_at', 'desc')->orderBy('tasked_time', 'desc')->get()
        ], 200);
    }
}
