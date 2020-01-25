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

</head>

<body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <br/>
    <h1>Neonex</h1>
    <p>Application de gestion d'ordinateur du centre culturel</p>
    <div class="text-center">

        @include('flash::message')

    </div>
    <div class="container">

        <!-- Login Form -->
        <form method="post" action="/connexion">
            @csrf
            <input type="text" id="login" class="form-control fadeIn second" name="login" placeholder="Nom d'utilisateur">
            <br/>
            <input type="password" id="password" class="form-control fadeIn third" name="password" placeholder="Mot de passe">
            <br/>
            <button type="submit" class="btn btn-primary btn-block fadeIn fourth">Connexion</button><br/>
            <br/>
        </form>

    </div>


    <!-- Remind Passowrd -->
    <div id="formFooter">
      <button type="button" class="btn btn-dark btn-small" data-toggle="modal" data-target="#exampleModalScrollable">
        Documentation
      </button>
    </div>

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

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
