@extends('layouts.app')

@section('title')
    Mattia's Project| Singolo progetto
@endsection

@section('content')

    <div class="container mt-3">

        <h1>Progetto: {{$project->title}}</h1>
        <h3>{{$project->slug}}</h3>
        
        @if($project->category)
        <div>{{$project->category->name}}</div>
        @endif
        
        <div class="text-primary d-flex">

            @if($project->technologies)
                
                @foreach ($project->technologies as $elem)
                <div class="me-2">{{$elem->name}}</div>
                @endforeach

            @endif
            
        </div>

    </div>

@endsection