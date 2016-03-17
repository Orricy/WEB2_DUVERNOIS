<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\User;

use App\Http\Requests;

class ProjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('isAdmin', ['except' => ['index', 'show', 'create', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$projects = Project::all();
        $projectsWaiting = Project::where('status', 'waiting approval')->orderBy('id', 'desc')->get();
        $projectsApproved = Project::where('status', 'approved')->orderBy('id', 'desc')->get();
        $projectsRefused = Project::where('status', 'refused')->orderBy('id', 'desc')->get();
        return view('projects.index')->with(compact('projectsWaiting', 'projectsApproved', 'projectsRefused'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreProjectRequest $request)
    {
        $project = Project::create([
            'user_id' => $request->user()->id,
            'name' => $request->project_name,
            'creator' => $request->project_creator,
            'adress_creator' => $request->project_adress,
            'email_creator' => $request->project_email,
            'phone_creator' => $request->project_phone,
            'contact' => $request->project_mediator,
            'adress_contact' => $request->mediator_adress,
            'email_contact' => $request->mediator_email,
            'phone_contact' => $request->mediator_phone,
            'identity' => $request->identity,
            'type' => $request->project_type,
            'context' => $request->context,
            'demand' => $request->demand,
            'goal' => $request->goal,
            'other' => $request->other,
        ]);
        $user = User::find($request->user()->id);
        //dd($user->email,$user->name);
        //Envoie du mail
        $mail = new \PHPMailer(true);
        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = 'dd.iim.year2@gmail.com';               // SMTP username
        $mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';               // SMTP password
        $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                      // TCP port to connect to

        $mail->setFrom('dd.iim.year2@gmail.com', 'Création de '.$request->project_name.' sur td-laravel');
        $mail->addAddress($user->email, $user->name);    // Add a recipient

        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = 'Création de '.$request->project_name.' sur td-laravel';
        $mail->Body    = '<h2>Lancement du projet : '.$request->project_name.'</h2>
            <p>Bonjour '.$user->name.',</p>
            <p>Vous venez de créer un nouveau projet sur notre site.</p>
            <p>Vous serez dès à présent informé de tous changement concernant celui-ci.</p>
            <p>Parmi les changements possible il y a :</p>
            <ul>
                <li>Validation</li>
                <li>Refus</li>
                <li>Edition</li>
                <li>Suppression</li>
            </ul>
            <p>Vous pouvez si vous êtes intéressé pae le développement suivre le projet sur github à cette adresse
                <a href="https://github.com/Orricy/WEB2_DUVERNOIS_JULIEN">Github WEB2_DUVERNOIS</a>
            </p>
            <p><strong>IIM</strong> - Année 2</p>
            <p>Damien Duvernois</p>'
            ;
        $mail->AltBody = 'Dommage votre client de messagerie ne supporte pas le format html, toutefois vous venez d\'ajouter '.$request->project_name.' comme nouveau projet.';
        $mail->send();
        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        if($project)
            return view('projects.show')->with(compact('project'));
        else
            return view('projects.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        if($project)
            return view('projects.edit')->with(compact('project'));
        else
            return view('projects.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        if($project){
            $project->name = $request->project_name;
            $project->creator = $request->project_creator;
            $project->adress_creator = $request->project_adress;
            $project->email_creator = $request->project_email;
            $project->phone_creator = $request->project_phone;
            $project->contact = $request->project_mediator;
            $project->adress_contact = $request->mediator_adress;
            $project->email_contact = $request->mediator_email;
            $project->phone_contact = $request->mediator_phone;
            $project->identity = $request->identity;
            $project->type = $request->project_type;
            $project->context = $request->context;
            $project->demand = $request->demand;
            $project->goal = $request->goal;
            $project->other = $request->other;
            $project->save();
            $user = User::find($project->user_id);
            //dd($user->email,$user->name);
            //Envoie du mail
            $mail = new \PHPMailer(true);
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'dd.iim.year2@gmail.com';               // SMTP username
            $mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';               // SMTP password
            $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                      // TCP port to connect to

            $mail->setFrom('dd.iim.year2@gmail.com', 'Status du projet '.$project->name.' sur td-laravel');
            $mail->addAddress($user->email, $user->name);    // Add a recipient

            $mail->isHTML(true);                                    // Set email format to HTML

            $mail->Subject = 'Status du projet '.$project->name.' sur td-laravel';
            $mail->Body    = '<h2>Edition de votre projet : '.$request->project_name.'</h2>
                <p>Bonjour '.$user->name.',</p>
                <p>Le projet '.$request->project_name.' que vous avez inité a été modifié</p>
                <p>Vous pouvez directement allez voir les changements sur notre site</p>
                <p>Vous pouvez si vous êtes intéressé pae le développement suivre le projet sur github à cette adresse
                    <a href="https://github.com/Orricy/WEB2_DUVERNOIS_JULIEN">Github WEB2_DUVERNOIS</a>
                </p>
                <p><strong>IIM</strong> - Année 2</p>
                <p>Damien Duvernois</p>'
                ;
            $mail->AltBody = 'Dommage votre client de messagerie ne supporte pas le format html, toutefois votre projet '.$request->project_name.' a été modifié.';
            $mail->send();
            return redirect()->route('projects.show', $id);
        }
        else{
            return redirect()->to('/projects');
        }
    }

    /**
     * Update the project status in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $authorizedStatus = array('waiting approval', 'approved', 'refused');
        $project = Project::find($id);
        //check for authorized value
        if (in_array($request->status, $authorizedStatus)) {
            if($project){
                $project->status = $request->status;
                $project->save();
                $user = User::find($project->user_id);
                //dd($user->email,$user->name);
                //Envoie du mail
                $mail = new \PHPMailer(true);
                $mail->isSMTP();                                        // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = 'dd.iim.year2@gmail.com';               // SMTP username
                $mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';               // SMTP password
                $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                      // TCP port to connect to
                $mail->addAddress($user->email, $user->name);    // Add a recipient

                $mail->isHTML(true);                                    // Set email format to HTML

                if($request->status == 'approved'){
                    $mail->setFrom('dd.iim.year2@gmail.com', 'Status du projet '.$project->name.' sur td-laravel');
                    $mail->Subject = 'Status du projet '.$project->name.' sur td-laravel';
                    $mail->Body    = '<h2>Félicitation '.$project->name.' a été approuvé</h2>
                        <p>Bonjour '.$user->name.',</p>
                        <p>Le projet '.$project->name.' que vous avez inité a été officiellemnt approuvé par un administrateur</p>
                        <p>Vous pouvez directement allez voir le changement sur notre site</p>
                        <p>Vous pouvez si vous êtes intéressé pae le développement suivre le projet sur github à cette adresse
                            <a href="https://github.com/Orricy/WEB2_DUVERNOIS_JULIEN">Github WEB2_DUVERNOIS</a>
                        </p>
                        <p><strong>IIM</strong> - Année 2</p>
                        <p>Damien Duvernois</p>'
                        ;
                    $mail->AltBody = 'Dommage votre client de messagerie ne supporte pas le format html, toutefois votre projet '.$request->project_name.' a été approuvé.';
                }
                elseif($request->status == 'refused'){
                    $mail->setFrom('dd.iim.year2@gmail.com', 'Status du projet '.$project->name.' sur td-laravel');
                    $mail->Subject = 'Status du projet '.$project->name.' sur td-laravel';
                    $mail->Body    = '<h2>Nous sommes au regret de vous dire que '.$project->name.' a été refusé</h2>
                        <p>Bonjour '.$user->name.',</p>
                        <p>Le projet '.$project->name.' que vous avez inité a été malheuresement refusé par un administrateur</p>
                        <p>Vous pouvez directement allez voir le changement sur notre site</p>
                        <p>Vous pouvez si vous êtes intéressé pae le développement suivre le projet sur github à cette adresse
                            <a href="https://github.com/Orricy/WEB2_DUVERNOIS_JULIEN">Github WEB2_DUVERNOIS</a>
                        </p>
                        <p><strong>IIM</strong> - Année 2</p>
                        <p>Damien Duvernois</p>'
                        ;
                    $mail->AltBody = 'Dommage votre client de messagerie ne supporte pas le format html, toutefois votre projet '.$$project->name.' a été refusé.';
                }
                
                $mail->send();
                return redirect()->route('projects.show', $id);
            }
            else{
                return redirect()->route('projects.show', $id);
            }
        }
        
        else{
            return redirect()->to('/projects');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if($project){
            $user = User::find($project->user_id);
            //dd($user->email,$user->name);
            //Envoie du mail
            $mail = new \PHPMailer(true);
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Username = 'dd.iim.year2@gmail.com';               // SMTP username
            $mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';               // SMTP password
            $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                      // TCP port to connect to

            $mail->setFrom('dd.iim.year2@gmail.com', 'Status du projet '.$project->name.' sur td-laravel');
            $mail->addAddress($user->email, $user->name);    // Add a recipient

            $mail->isHTML(true);                                    // Set email format to HTML

            $mail->Subject = 'Status du projet '.$project->name.' sur td-laravel';
            $mail->Body    = '<h2>Suppression de votre projet : '.$project->name.'</h2>
                <p>Bonjour '.$user->name.',</p>
                <p>Le projet '.$project->name.' que vous avez inité a été supprimé</p>
                <p>Vous pouvez directement allez voir les changements sur notre site</p>
                <p>Vous pouvez si vous êtes intéressé pae le développement suivre le projet sur github à cette adresse
                    <a href="https://github.com/Orricy/WEB2_DUVERNOIS_JULIEN">Github WEB2_DUVERNOIS</a>
                </p>
                <p><strong>IIM</strong> - Année 2</p>
                <p>Damien Duvernois</p>'
                ;
            $mail->AltBody = 'Dommage votre client de messagerie ne supporte pas le format html, toutefois votre projet '.$project->name.' a été supprimé.';
            $mail->send();
            $project->delete();
            return redirect()->to('/projects');
        }
        else
            return redirect()->to('/projects');
    }
}
