@extends('layouts.app')

@section('content')
    <div class="container">
        @component('layouts.components.title')
            Маҳфуми нав
        @endcomponent
        <div class="row">
            <div class="col-12">
                <form action="{{ route('terms.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="termTitleInput">Номи маҳфум</label>
                        <input type="text" class="form-control" id="termTitleInput" name="title" placeholder="Номи маҳфум">
                    </div>
                    <div class="form-group">
                        <label for="termDescriptionInput">Маълумоти зиёдтар</label>
                        <textarea class="form-control" id="termDescriptionInput" name="body" rows="5" placeholder="Маълумоти зиёдтар оиди маҳфум"></textarea>
                    </div>
                    <button class="btn btn-success align-self-end my-3" type="submit">Боргузоред</button>
                </form>
            </div>
        </div>
    </div>
@endsection