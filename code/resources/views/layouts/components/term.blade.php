<div class="card bg-white shadow-sm my-2">
    <div class="btn card-header d-flex" id="heading{{$term->getId()}}" data-toggle="collapse" data-target="#collapse{{$term->getId()}}" aria-expanded="false" aria-controls="collapse{{$term->getId()}}">
        <h3 class="mb-0">
            {{$term->getTitle()}}
        </h3>

        <div class="ml-auto">
            <a href="{{route('terms.edit', $term->getId())}}" class="btn btn-secondary btn-sm mx-1">
                <i class="fa fa-pencil-alt"></i>
            </a>

            <a href="{{route('terms.destroy', $term->getId())}}" class="btn btn-danger btn-sm mx-1">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>

    <div class="collapse"  id="collapse{{$term->getId()}}" aria-labelledby="heading{{$term->getId()}}" data-parent="#list">
        <div class="card-body">
            {{$term->getBody()}}
        </div>
    </div>
</div>