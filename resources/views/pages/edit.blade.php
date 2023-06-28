@extends('layouts.app')

@section('title')
    Mattia's Project | Modifica
@endsection

@section('content')
    <h1>Modifica il tuo probetto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $elem)
                <li>{{$elem}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="container">

    <form action="{{route ('pages.update', $project->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="project-title" value="{{old('title') ?? $project->title}}">
            </div>

            <div class="mb-3">
                <label for="project-content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="project-content" rows="3">{{old('content') ?? $project->content}}</textarea>
            </div>

            <button class="btn btn-primary">Modifica il post</button>
        </form>

    </div>
@endsection