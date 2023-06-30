@extends('layouts.app')

@section('title')
    Mattia's Project| Singolo progetto
@endsection

@section('content')
    <h1>Progetto: {{$project->title}}</h1>
    <h3>{{$project->slug}}</h3>

    @if($project->category)
        <div>{{$project->category->name}}</div>
    @endif

    @foreach ($project->technologies as $item)
        <div>{{$elem->name}}</div>
    @endforeach
@endsection