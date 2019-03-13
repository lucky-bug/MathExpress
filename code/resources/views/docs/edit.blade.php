@extends('layouts.app')

@section('content')
    <div class="container">
        @component('layouts.components.title')
            Ислохи Китоб
        @endcomponent
        <div class="row">
            <div class="col-12">
                <form action="{{ route('docs.update', $doc->getId()) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="bookTitleInput">Номи китоб</label>
                        <input type="text" class="form-control" id="bookTitleInput" name="title" placeholder="Номи китоб" value="{{$doc->getTitle()}}">
                    </div>
                    <div class="form-group">
                        <label for="bookAuthorInput">Нависанда</label>
                        <input type="text" class="form-control" id="bookAuthorInput" name="author" placeholder="Нависанда" value="{{$doc->getAuthor()}}">
                    </div>
                    <div class="form-group">
                        <label for="bookDescriptionInput">Дар бораи китоб</label>
                        <textarea class="form-control" id="bookDescriptionInput" name="description" rows="5">{{$doc->getDescription()}}</textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" id="bookThumb" name="thumbnail">
                    </div>
                    <div class="custom-file mt-3">
                        <input type="file" id="bookFile" name="file">
                    </div>
                    <button class="btn btn-primary align-self-end my-3" type="submit">Ислохкуни</button>
                </form>
            </div>
        </div>
    </div>
@endsection
