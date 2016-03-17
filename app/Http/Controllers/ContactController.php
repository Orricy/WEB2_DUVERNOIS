<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the form for sending an email.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'email.required' => 'Veuillez renseigner votre email',
                'subject.required' => 'Merci de donner un sujet à votre message',
                'message.required' => 'Veuillez écrire votre message',
            ]
        );
        //Envoie du mail
        $mail = new \PHPMailer(true);
        //dd($mail);

        $mail->isSMTP();                                        // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                 // Enable SMTP authentication
        $mail->Username = 'dd.iim.year2@gmail.com';               // SMTP username
        $mail->Password = 'TRk41Q[poXdF-725_aQ*)/6';               // SMTP password
        $mail->SMTPSecure = 'ssl';                              // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                      // TCP port to connect to

        $mail->setFrom($request->email, $request->subject);
        $mail->addAddress('d.wastable@gmail.com', 'Damien Duvernois');    // Add a recipient

        $mail->isHTML(true);                                    // Set email format to HTML

        $mail->Subject = $request->subject;
        $mail->Body    = '<h2>'.$request->subject.'</h2>
            <p>'.$request->message.'</p>';
        $mail->AltBody = $request->message;
        if(!$mail->send()) {
            $result = 0;
            $errorLog = $mail->ErrorInfo;
            //retour avec erreur à l'envoie
            return view('contact.create')->with(compact('result', 'errorLog'));
        } else {
            $result = 1;
            //retour avec succès
            return view('contact.create')->with(compact('result'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}
