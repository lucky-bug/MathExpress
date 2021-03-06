<?php

namespace App\Http\Controllers;

use App\Question;
use App\Role;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('tag')) {
            $tags = array_map('trim', explode(',', $request->get('tag')));
            $questions = Question::whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('name', $tags);
            })->paginate(10);
        } elseif ($request->has('q') && $request->get('q') !== null) {
            if($request->has('searchType')) {
                $questions = Question::search(
                    $request->get('q'),
                    $request->get('searchType')
                )->paginate(10);
            }
            else {
                $questions = Question::search($request->get('q'))->paginate(10);
            }
        } else {
            $questions = Question::paginate(10);
        }

        return view('questions.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question = new Question([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ]);

        $tags = array_map('trim', explode(',', $request->get('tags')));
        $tagList = [];

        foreach ($tags as $tag)
        {
            $tagList[] = (Tag::where('name',$tag)->first()
                ? Tag::where('name',$tag)->first()
                : Tag::create(['name' => $tag]))->getId()
            ;
        }

        $question->user()->associate(Auth::user());
        $question->save();
        $question->tags()->attach($tagList);

        return redirect(route('questions.show', $question->getId()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->addView()->save();
        return view('questions.show', ['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if(Auth::id() !== $question->user->getId() && !Auth::user()->hasAnyRole([Role::ROLE_ADMIN])) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('questions.edit', ['question' => $question]);
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
        if(Auth::id() !== $question->user->getId() && !Auth::user()->hasAnyRole([Role::ROLE_ADMIN])) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $tags = array_map('trim', explode(',', $request->get('tags')));
        $tagList = [];

        foreach ($tags as $tag)
        {
            $tagList[] = (Tag::where('name',$tag)->first()
                ? Tag::where('name',$tag)->first()
                : Tag::create(['name' => $tag]))->getId()
            ;
        }

        $question
            ->setTitle($request->get('title'))
            ->setDescription($request->get('description'))
            ->setAnswerId($request->get('answer_id'))
        ;

        $question->tags()->detach($question->tags->pluck('id'));
        $question->tags()->attach($tagList);
        $question->save();

        return redirect(route('questions.show', $question->getId()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if(Auth::id() !== $question->user->getId() && !Auth::user()->hasAnyRole([Role::ROLE_ADMIN])) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $question->forceDelete();

        return redirect(route('questions.index'));
    }
}
