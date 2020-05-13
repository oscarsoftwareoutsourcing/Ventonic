<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => ['array', 'min:1']
        ]);
        // Arreglo questions: primer valor el id de la pregunta y el segundo valor el id del elemento seleccionado
        // como respuesta de la columna options
        $profile = (auth()->user()->type==='E') ? auth()->user()->companyProfile : auth()->user()->sellerProfile;
        $answered = [];
        foreach ($request->question as $q) {
            list($question_id, $option_index) = explode("_", $q);
            array_push($answered, [
                'question_id' => $question_id,
                'option_index' => $option_index
            ]);
        }
        $profile->answered = (!empty($answered)) ? json_encode($answered) : null;
        $profile->save();

        $request->session()->flash('status', 'Encuesta registrada con éxito');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
