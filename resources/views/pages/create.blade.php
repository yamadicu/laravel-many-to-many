@extends('layouts.app')

@section('title')
    Mattia's Project | Create
@endsection

@section('content')
    <h1>crea il tuo probetto</h1>

    <div class="container">

        <form action="{{route('pages.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="project-title" placeholder="inserisci un titolo al progetto">
            </div>

            <div class="mb-3">
                <label for="project-content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="project-content" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="project-cover-image" class="form-label">Cover image</label>
                <input type="file" class="form-control" name="cover-image" id="project-cover-image" placeholder="" aria-describedby="fileHelpId">
                <div id="fileHelpId" class="form-text">Help text</div>
            </div>

            <div class="mb-3">
                <label for="project-categories" class="form-label">Categories</label>
                <select class="form-select form-select-lg @error ('category_id') is invalid @enderror" name="category_id" id="project_categories">
                    <option value="">Scegli una categoria</option>
                    @foreach ($categories as $elem)
                    <option value="{{$elem->id}}" {{ old('category_id') == $elem->id ? 'selected' : '' }}>{{$elem->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                @error ('category_id')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <div class="form-group">

                @foreach($technologies as $elem)
                    <div class="form-check">

                        <input class="form-check-input" 
                               type="checkbox"
                               name="technologies[]"
                               value="{{$elem->id}}" 
                               id="project-check{{$elem->id}}">

                        <label class="form-check-label" for="project-check{{$elem->id}}">
                            {{$elem->name}}
                        </label>
                    </div>
                @endforeach

            </div>

            <button class="btn btn-primary">crea il progetto</button>
        </form>

    </div>
@endsection