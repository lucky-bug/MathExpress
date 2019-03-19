@extends('layouts.app')

@section('content')
    <div class="container">
        @component('layouts.components.titleWithSearch', ['search_text' => 'Номи савол', 'search_url' => route('questions.index')])
            Саволхои охирин
        @endcomponent
        <div class="row justify-content-left">
            @foreach($questions as $question)
                <div class="col-12">
                    <div class="p-0 card shadow mb-3 text-justify">
                        <div class="card-body d-flex align-items-center p-4">
                            <h3 class="flex-grow-1 pr-2 text-dark font-weight-bold"
                                style="white-space: normal"
                            >
                                <a class="btn" href="{{ route('questions.show', $question->getId()) }}">
                                    <h3>
                                        {{ $question->getTitle() }}
                                    </h3>
                                </a>
                                <div class="small mt-2">
                                    @foreach($question->tags as $tag)
                                        <a class="badge badge-secondary mr-1 p-1" href="{{ route('questions.index', ['tag' => $tag->getName()]) }}">
                                            {{ $tag->getName() }}
                                        </a>
                                    @endforeach
                                </div>
                            </h3>
                            <div>
                                <button
                                        class="btn btn-sm mr-2 {{ $question->answers->count() > 0 ? ($question->getAnswerId() === null ? 'border border-success btn-light' : 'border border-success btn-success') : 'btn-light' }} align-self-center h-100"
                                >
                                    <h2 class="mb-0">{{ $question->answers->count() }}</h2>
                                    <small>чавобхо</small>
                                </button>

                                <button type="button"
                                        class="btn btn-sm btn-light align-self-center h-100"
                                >
                                    <h2 class="mb-0">{{ $question->getViewCount() }}</h2>
                                    <small>дидан</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center w-100 mt-3">
                {{$questions->appends($_GET)->links()}}
            </div>
        </div>
    </div>
@endsection
