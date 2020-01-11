<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Http\Requests\AskQuestionRequest;

class QuestionController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $questions=Question::with('user')->latest()->paginate(5);
         return view('questions.index',compact('questions'));
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question=new Question();
        return view('questions.create',compact('question'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {  
        $request->user()->questions()->create($request->all());
        return redirect('/questions')->with('success','Your question has been submitted');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // $question=Question::find($id);
         $question->increment('views');
        // dd($question->title);
        // $question->views=$question->views+1;
        // $question->save();
        return view('questions.show',compact('question'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question=Question::find($id);
        // if(\Gate::denies('update-question',$question))
        // {
        //     abort(403,"Access denied");   

        // }
        $this->authorize("update", $question);
        return view('questions.edit',compact('question'));
        
       
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, $id)
    {
        //
        $question=Question::find($id);
        // if(\Gate::denies('update-question',$question))
        // {
        //     abort(403,"Access denied");   

        // }
        $this->authorize("update", $question);
        $question->update($request->only('title','body'));
        return redirect('/questions')->with('success','your question has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question=Question::find($id);
        // if(\Gate::denies('delete-question',$question))
        // {
        //     abort(403,"Access denied");   

        // }
        $this->authorize("delete", $question);
        $question->delete();
        return redirect('/questions')->with('success','your question has been deleted');
    }
}
