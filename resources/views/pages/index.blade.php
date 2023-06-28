@extends('layouts.app')

@section('title')
    Mattia's Project | Index
@endsection

@section('content')
    <h1>Pagina Iniziale</h1>

    <a class="btn btn-primary my-3 " href="{{ route('pages.create') }}">crea il tuo progetto</a>

    <div class="row">
    @foreach ($project as $elem)

        <div class="card m-4 col-2">
            <img class="card-img-top" src="{{asset('storage/'. $elem->cover_image)}}" alt="Title">
            <div class="card-body">
                <a href="{{route('pages.show', $elem->id)}}">
                    <h4>{{$elem->title}}</h4>
                </a>
                <p class="card-text">progetto numero: {{$elem->id}}</p>
                <p class="card-text">{{$elem->content}}</p>
                <a href="{{route('pages.edit', $elem->id)}}">modifica progetto</a>
            </div>

            <form action="{{ route('pages.destroy', $elem->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('sei sicuro di voler cancellare il progetto?')" type="submit" class="btn btn-danger mb-2">cancella progetto</button>
            </form>
        </div>

        @endforeach
    </div>

@endsection