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
        return redirect()->route('projects.create');
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
        //
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
        $projects = Project::find($id);
        if($projects){
            $projects->delete();
            return redirect()->to('/projects');
        }
        else
            return redirect()->to('/projects');
    }
}
