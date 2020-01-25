@extends('layout')

@section('contenu')


<div class="container-fluid">
    <div class="row">

    <div class="col-md-8">

        <h1 class="mt-4">Association des machines</h1>

    </div>
    <div class="col-md-4">

        <br/>
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
            Créer une attribution
        </button>
    </div>

    </div>
    <hr/>
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Nom d'ordinateur</th>
                <th>Utilisateur</th>
                <th>Heure début</th>
                <th>Heure de fin</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listeAttributions as $infAttribution)
            <tr>
                <td>{{ $infAttribution->date }}</td>
                <td>{{ $infAttribution->ordinateur }}</td>
                <td>{{ $infAttribution->nomutilisateur }}</td>
                <td>{{ $infAttribution->hdebut }}</td>
                <td>{{ $infAttribution->hfin }}</td>
                @if($infAttribution->statut === 1)
                    <td><span class="badge badge-warning">En cours</span></td>
                @elseif($infAttribution->statut === 2)
                    <td><span class="badge badge-success">Terminé</span></td>
                @elseif($infAttribution->statut === 3)
                    <td><span class="badge badge-danger">Annulé</span></td>
                @endif
                <td>
                @if($infAttribution->statut === 1)    
                <a href="/cloture-attribution/{{ $infAttribution->id }}/{{ md5('secure'.$infAttribution->id.'endsecure') }}"><img src="https://img.icons8.com/officel/30/000000/close-sign.png"></a>&nbsp;
                <a href="/annulation-attribution/{{ $infAttribution->id }}/{{ md5('secure'.$infAttribution->id.'endsecure') }}"><img src="https://img.icons8.com/officel/30/000000/delete-sign.png"></a></td>
                @else
                <span class="badge badge-dark">Aucune action</span>
                @endif
                
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attribution d'un utilisateur à une machine</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="/attributions">
            @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1">Date</label><br/>
                    <small>Sélectionnez la date à laquelle l'utilisateur occupera le poste.</small>
                    <input type="date" name="date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Ordinateurs</label>
                    <select name="ordinateurs" class="form-control" id="exampleFormControlSelect1">
                    @foreach($listeOrdinateurs as $infOrdi)
                        <option value="{{ $infOrdi->id }} | {{ $infOrdi->computer }}" >{{ $infOrdi->computer }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Utilisateurs</label>
                    <select name="utilisateurs" class="form-control" id="exampleFormControlSelect1">
                    @foreach($listeUtilisateurs as $infVisiteur)
                        <option value="{{ $infVisiteur->id }} | {{ $infVisiteur->nom }} {{ $infVisiteur->prenom }}" >{{ $infVisiteur->nom }} {{ $infVisiteur->prenom }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Heure début</label><br/>
                    <small>Vous devez choisir une heure compris entre 08H00 et 17H00 (Les horaires d'ouvertures du centre).</small>
                    <select name="hdebut" class="form-control" id="exampleFormControlSelect1">
                        <option value="08:00" >08:00</option>
                        <option value="09:00" >09:00</option>
                        <option value="10:00" >10:00</option>
                        <option value="11:00" >11:00</option>
                        <option value="12:00" >12:00</option>
                        <option value="13:00" >13:00</option>
                        <option value="14:00" >14:00</option>
                        <option value="15:00" >15:00</option>
                        <option value="16:00" >16:00</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Heure fin</label><br/>
                    <select name="hfin" class="form-control" id="exampleFormControlSelect1">
                        <option value="09:00" >09:00</option>
                        <option value="10:00" >10:00</option>
                        <option value="11:00" >11:00</option>
                        <option value="12:00" >12:00</option>
                        <option value="13:00" >13:00</option>
                        <option value="14:00" >14:00</option>
                        <option value="15:00" >15:00</option>
                        <option value="16:00" >16:00</option>
                        <option value="17:00" >17:00</option>
                    </select>
                </div>            
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Association</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    </div>
</div>

@endsection('contenu')