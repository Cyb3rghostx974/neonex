@extends('layout')

@section('contenu')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-8">

            <h1 class="mt-4">Utilisateurs</h1>

        </div>
        <div class="col-md-4">

            <br/>
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalUser">
                Créer un utilisateur
            </button>
        </div>

    </div>
    <hr/>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nom d'utilisateur</th>
                <th>Mot de passe</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listeUtilisateurs as $infUser)
            <tr>
                <td>{{ $infUser->id }}</td>
                <td>{{ $infUser->nom }}</td>
                <td>{{ $infUser->prenom }}</td>
                <td>{{ $infUser->username }}</td>
                <td>{{ $infUser->password }}</td>
                <td>{{ $infUser->email }}</td>
                <td><a href="/suppression/{{ $infUser->id }}/{{ md5('secure'.$infUser->id.'endsecure') }}"><img src="https://img.icons8.com/officel/30/000000/delete-sign.png"></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Création d'un utilisateur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="/utilisateurs">
        @csrf
        <div class="modal-body">
            
                <div class="form-group">
                    <label for="exampleInputPassword1">Nom</label><br/>
                    <input type="text" name="nom" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Prénom</label><br/>
                    <input type="text" name="prenom" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mot de passe</label><br/>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label><br/>
                    <input type="email" name="email" class="form-control">
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Validation</button>
        </div>
        </form>
        </div>
    </div>
    </div>



    </div>
</div>

@endsection('contenu')