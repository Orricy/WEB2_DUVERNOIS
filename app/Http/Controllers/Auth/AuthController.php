<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //Envoie du mail
        $mail = new \PHPMailer(true);
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = 'dd.iim.year2@gmail.com';               // SMTP username
        $mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';               // SMTP password
        $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                      // TCP port to connect to

        $mail->setFrom('dd.iim.year2@gmail.com', 'Inscription sur td-laravel Damien Duvernois');
        $mail->addAddress($data['email'], $data['name']);    // Add a recipient

        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = 'Inscription sur TD-laravel Damien Duvernois';
        $mail->Body    = '<h2>Laravel année 2 projet</h2>
            <p>Bonjour '.$data['name'].',</p>
            <p>Vous venez de créer votre compte sur TD-laravel et nous vous remercions de votre confiance</p>
            <p>Vous pouvez dès à présent accéder à de multiple fonctionnalité sur notre site</p>
            <p>Vous pouvez :</p>
            <ul>
                <li>Ecrire un article</li>
                <li>Ajouter des commentaires</li>
                <li>Lancer votre projet</li>
                <li>Contacter l\'administration</li>
                <li>Modifier votre profile</li>
            </ul>
            <p>Prenez garde car l\'admin est tout puissant, il peut :</p>
            <ul>
                <li>Editer et supprimer un article</li>
                <li>Supprimer des commentaires</li>
                <li>valider, refuser, éditer ou encore supprimer vos projets</li>
            </ul>
            <small>Et dire qu\'un seul paramètre dans la base de donnée peut octroyer tant de pouvoir</small>
            <p>Vous pouvez si vous êtes intéressé pae le développement suivre le projet sur github à cette adresse
                <a href="https://github.com/Orricy/WEB2_DUVERNOIS_JULIEN">Github WEB2_DUVERNOIS</a>
            </p>
            <p><strong>IIM</strong> - Année 2</p>
            <p>Damien Duvernois</p>'
            ;
        $mail->AltBody = 'Dommage votre client de messagerie ne supporte pas le format html, toutefois votre compte sur TD-laravel  a été créer.';
        $mail->send();
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->scopes(['scope1', 'scope2'])->redirect();;
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        // $user->token;
    }

}
