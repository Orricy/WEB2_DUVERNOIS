<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;
use App\Models\User;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('profile.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('profile.edit')->with(compact('user'));
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
        $this->validate($request,
            [
                'name' => 'required|max:255',
                'email' => 'required|max:255',
            ],
            [
                'name.required' => 'Veuillez indiquez votre nom',
                'name.max' => 'Votre nom dépasse la limite de 255 caractères',
                'email.required' => 'Veuillez indiquez votre mail',
                'email.max' => 'Votre adresse mail dépasse la limite de 255 caractères',
            ]
        );
        $user = User::find($id);
        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password && $request->password_confirmation) {
                if($request->password == $request->password_confirmation){
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
            else{
                $user->save();
            }
            return redirect()->route('profile.show', $id);
        }
        else{
            return redirect()->to('/articles');
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
        //
    }
}
