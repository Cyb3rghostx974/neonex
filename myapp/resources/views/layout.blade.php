<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Neonex - Application Gestion d'ordinateur au centre culturel</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Neonex</div>
      <div class="list-group list-group-flush">
        <a href="/dashboard" class="list-group-item list-group-item-action bg-light">Postes informatiques</a>
        <a href="/utilisateurs" class="list-group-item list-group-item-action bg-light">Utilisateurs</a>
        <a href="/attributions" class="list-group-item list-group-item-action bg-light">Attributions</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"  data-toggle="modal" data-target="#exampleModalScrollable">Documentation</a>
        @if(auth()->check())
            <a href="/deconnexion" class="list-group-item list-group-item-action bg-light">Déconnexion</a>
        @endif
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            @if(auth()->check())
                <li class="nav-item active">
                    <a class="nav-link" href="#">Bonjour, {{ auth()->user()->username }} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/deconnexion">Déconnexion</a>
                </li>
            @endif
          </ul>
        </div>
      </nav>

      <div class="text-center">

        @include('flash::message')

      </div>


      @yield('contenu')

    </div>
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Documentation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

              <h2 class="text-dark">1 - Connexion & affichage des postes informatiques</h2>
              <small>Identifiant : Secretariat / Mot de passe : demo</small>
              <hr/>
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ asset('videos/Tuto1.mp4') }}"></iframe>
              </div>
              <h2 class="text-dark">2 - Gestion des utilisateurs</h2>
              <hr/>
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ asset('videos/Tuto2.mp4') }}"></iframe>
              </div>
              <h2 class="text-dark">3 - Gestion des attributions</h2>
              <hr/>
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ asset('videos/Tuto3.mp4') }}"></iframe>
              </div>

          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>

    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/rowreorder/2.2.3/js/dataTables.rowReorder.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


  <!-- Menu Toggle Script -->
  <script>

    $(document).ready(function() {
        var table = $('#example').DataTable( {
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    "language": {
                        "lengthMenu": "Afficher les enregistrements _MENU_ par page",
                        "zeroRecords": "Rien trouvé - désolé",
                        "info": "Afficher la page _PAGE_ de _PAGES_",
                        "infoEmpty": "Aucun enregistrement disponible",
                        "infoFiltered": "(filtré à partir du nombre total d'enregistrements)",
                        "search": "Recherche"
                    },
                    responsive: true
            } );

        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

    } );

  </script>

</body>

</html>
