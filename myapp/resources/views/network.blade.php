@extends('layout')

@section('contenu')


<div class="container-fluid">
    <h1 class="mt-4">Postes informatiques</h1>
    <hr/>
    <div class="row">
        @foreach($ordinateurs as $infComp)

            <div class="col-md-4">
                <img class="mx-auto d-block" src="https://img.icons8.com/officel/100/000000/computer.png">
                <p class="text-center">{{ $infComp->computer }} <br/> <small>{{ $infComp->ip }}</small></p>
            </div>
            <br/>
        @endforeach
    </div>   
    <br/>

    </div>
</div>

@endsection('contenu')