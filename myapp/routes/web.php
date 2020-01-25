<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/attributions', function () {

    if(auth()->guest())
    {

        flash('Vous devez être connecté pour voir cette page.')->error();

        return redirect('/');

    }

    $listeAttributions = App\Attribution::all();
    $listeUtilisateurs = App\Visiteur::all();
    $listeOrdinateurs = App\Ordinateur::all();

    return view('attributions')
            ->with('listeAttributions', $listeAttributions)
            ->with('listeUtilisateurs', $listeUtilisateurs)
            ->with('listeOrdinateurs', $listeOrdinateurs);
});

Route::post('/attributions', function() {

    request()->validate([

        'date' => 'required',
        'ordinateurs' => 'required',
        'utilisateurs' => 'required',
        'hdebut' => 'required',
        'hfin' => 'required'

    ]);

    $date = request('date');
    $ordinateurs = request('ordinateurs');
    $infoOrdinateurs = explode('|', $ordinateurs);
    $utilisateurs = request('utilisateurs');
    $infoUtilisateurs = explode('|', $utilisateurs);
    $heureDebut = request('hdebut');
    $heureFin = request('hfin');

    $checkAssociation = App\Attribution::where('idordinateur', $infoOrdinateurs[0])
    ->where('date', $date)
    ->where('idutilisateur', $infoUtilisateurs[0])
    ->where('statut', 1)->exists();

    if($checkAssociation)
    {

        flash('Un utilisateur est déjà associé à cet ordinateur. Veuillez cloturer les associations en cours...')->error();

        return redirect('/attributions');

    }
    else
    {


        $creationAssociation = new App\Attribution;
        $creationAssociation->date = $date;
        $creationAssociation->idordinateur = $infoOrdinateurs[0];
        $creationAssociation->ordinateur = $infoOrdinateurs[1];
        $creationAssociation->idutilisateur = $infoUtilisateurs[0];
        $creationAssociation->nomutilisateur = $infoUtilisateurs[1];
        $creationAssociation->hdebut = $heureDebut;
        $creationAssociation->hfin = $heureFin;
        $creationAssociation->statut = 1;
     
        $creationAssociation->save();
    
        if($creationAssociation)
        {
    
            flash('L\'utilisateur '.$infoUtilisateurs[1].' a bien été associé à l\'ordinateur ['.$infoOrdinateurs[1].'] ('.$date.').')->success();
    
            return redirect('/attributions');
    
    
        }
        else
        {
    
            flash('L\'utilisateur '.$infoUtilisateurs[1].' n\'a pû être associé à l\'ordinateur ['.$infoOrdinateurs[1].'] ('.$date.').')->error();
    
            return redirect('/attributions');
    
        }


    }

});

Route::get('/cloture-attribution/{id}/{secure}', function(){

    $idAttribution = request('id');
    $securisation = request('secure');

    if(md5('secure'.$idAttribution.'endsecure') === $securisation)
    {


        $clotureAttribution = App\Attribution::find($idAttribution);
    
    
        $clotureAttribution->update([
    
            'statut' => 2
    
        ]);
    
        if($clotureAttribution)
        {
    
            flash('L\'association de l\'utilisateur '.$clotureAttribution->nomutilisateur.' à l\'ordinateur '.$clotureAttribution->ordinateur.' a été cloturé.')->success();
    
            return redirect('/attributions');
    
        }
        else
        {
    
            flash('L\'association de l\'utilisateur '.$clotureAttribution->nomutilisateur.' à l\'ordinateur '.$clotureAttribution->ordinateur.' n\'a pas été cloturé.')->error();
    
            return redirect('/attributions');
    
        }

    }
    else
    {

        flash('Désolé, ce lien de cloture n\'est pas sécurisé.')->error();

        return redirect('/attributions');

    }

});

Route::get('/annulation-attribution/{id}/{secure}', function(){

    $idAttribution = request('id');
    $securisation = request('secure');

    if(md5('secure'.$idAttribution.'endsecure') === $securisation)
    {

        $clotureAttribution = App\Attribution::find($idAttribution);
        
        
        $clotureAttribution->update([

            'statut' => 3

        ]);

        if($clotureAttribution)
        {

            flash('L\'association de l\'utilisateur '.$clotureAttribution->nomutilisateur.' à l\'ordinateur '.$clotureAttribution->ordinateur.' a été annulé.')->success();

            return redirect('/attributions');

        }
        else
        {

            flash('L\'association de l\'utilisateur '.$clotureAttribution->nomutilisateur.' à l\'ordinateur '.$clotureAttribution->ordinateur.' n\'a pas été annulé.')->error();

            return redirect('/attributions');

        }

    }
    else
    {

        flash('Désolé, ce lien d\'annulation n\'est pas sécurisé.')->error();

        return redirect('/attributions');
        
    }


});

Route::get('/utilisateurs', function () {

    if(auth()->guest())
    {

        flash('Vous devez être connecté pour voir cette page.')->error();

        return redirect('/');

    }

    $listeUtilisateurs = App\Visiteur::all();

    return view('utilisateurs')->with('listeUtilisateurs', $listeUtilisateurs);

});

Route::post('/utilisateurs', function() {

    request()->validate([

        'nom' => 'required',
        'prenom' => 'required',
        'password' => 'required',
        'email' => 'required', 'email',

    ]);

    $nom = request('nom');
    $prenom = request('prenom');
    $identifiant = strtolower($nom).'.'.strtolower($prenom);
    $password = request('password');
    $email = request('email');

    $checkUser = App\Visiteur::where('email', $email)->exists();

    if($checkUser)
    {

        flash('Désolé, un utilisateur avec cette adresse email existe déjà.')->error();

        return redirect('/utilisateurs');


    }
    else
    {

        $ajoutVisiteur = new App\Visiteur;
        $ajoutVisiteur->nom = strtoUpper($nom);
        $ajoutVisiteur->prenom = $prenom;
        $ajoutVisiteur->username = $identifiant;
        $ajoutVisiteur->password = bcrypt($password);
        $ajoutVisiteur->email = $email;

        $ajoutVisiteur->save();

        if($ajoutVisiteur)
        {

            flash('L\'utilisateur '.$nom.' '.$prenom.' a bien été créer.')->success();

            return redirect('/utilisateurs');

        }
        else
        {

            flash('L\'utilisateur '.$nom.' '.$prenom.' n\'a pas été créer.')->error();

            return redirect('/utilisateurs');

        }

    }


});

Route::get('/suppression/{id}/{secure}', function(){

    $idUtilisateur = request('id');
    $secureUtilisateur = request('secure');

    if(md5('secure'.$idUtilisateur.'endsecure') === $secureUtilisateur)
    {


        $checkAttribution = App\Attribution::where('idutilisateur', $idUtilisateur)->where('statut', '1')->exists();

        if($checkAttribution)
        {
    
            flash('Vous ne pouvez pas supprimer cet utilisateur car il est associé à une machine.')->error();
    
            return redirect('/utilisateurs');
    
        }
        else
        {
    
    
            $deleteUtilisateur = App\Visiteur::where('id', $idUtilisateur)->delete();
    
            if($deleteUtilisateur)
            {
        
                flash('L\'utilisateur a bien été supprimer.')->success();
        
                return redirect('/utilisateurs');
        
            }
            else
            {
        
                flash('L\'utilisateur n\'a pas été supprimer.')->error();
        
                return redirect('/utilisateurs');
        
            }
    
    
        }    


    }
    else
    {


        flash('Désolé, ce lien de suppression n\'est pas sécurisé.')->error();

        return redirect('/utilisateurs');

    }

});

Route::post('/connexion', function() {

    request()->validate([
        'login' => 'required',
        'password' => 'required',
    ]);

    $resultat = auth()->attempt([ // PERMET DE TESTER UNE CONNEXION ET RENVOYER FALSE OU TRUE
        'username' => request('login'),
        'password' => request('password'),
        'grade' => 1,
    ]);

    if($resultat)
    {

        return redirect('/dashboard');

    }
    else
    {

        flash('Vos identifiants sont incorrects ou votre compte n\'est pas autorisé.')->error();

        return redirect('/');

    }

});

Route::get('/deconnexion', function() {

    auth()->logout();

    return redirect('/');

});

Route::get('/dashboard', function () {

    if(auth()->guest())
    {

        flash('Vous devez être connecté pour voir cette page.')->error();

        return redirect('/');

    }

    $ordinateurs = App\Ordinateur::all();

    return view('network')->with('ordinateurs', $ordinateurs);
});

Route::get('/', function () {
    return view('connexion');
});
