<?php

namespace App\Http\Controllers;

use App\Desciplinary;
use App\Employee;
use App\Team;
use App\Traits\MetaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DesciplinaryController extends Controller
{
    use MetaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->meta['title'] = 'Desciplinary';
        $descipline = Desciplinary::with('employee', 'team')->get();

        return view('admin.desciplinary.index', $this->metaResponse())->with('desciplinaries', $descipline);
    }

    public function create()
    {
        $this->meta['title'] = 'Create Desciplinary Action';

        return view('admin.desciplinary.create', $this->metaResponse())->with('employee', Employee::select(['id', 'firstname', 'lastname'])->get())->with('team', Team::select(['id', 'name'])->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'          => 'required',
            'action' => 'required',
            'description'      => 'required',
            'employee_id'  => 'required_without:team_id',
            //'description'    => 'required',
            //            'skills' => 'required',
        ]);
        Desciplinary::create([
            'title'          => $request->title,
            'action'      => $request->action,
            'description'  => $request->description,
            'employee_id' => $request->employee_id ?? null,
            'team_id' => $request->team_id ?? null
        ]);

        Session::flash('success', 'Desciplinary is created successfully');

        return redirect()->route('desciplinaries.index');
    }

    public function edit($id)
    {
        $this->meta['title'] = 'Update Desciplinary';
        $desciplinary = Desciplinary::find($id);

        return view('admin.desciplinary.edit', $this->metaResponse())->with('desciplinary', $desciplinary)->with('employee', Employee::select(['id', 'firstname', 'lastname'])->get())->with('team', Team::select(['id', 'name'])->get());
    }

    public function update(Request $request, $id)
    {
        $desciplinary = Desciplinary::find($id);
        $desciplinary->title = $request->title;
        $desciplinary->employee_id = $request->employee_id;
        $desciplinary->team_id = $request->team_id;
        $desciplinary->action = $request->action;
        $desciplinary->description = $request->description;
        $desciplinary->save();
        Session::flash('success', 'Desciplinary is updated successfully');

        return redirect()->route('desciplinaries.index');
    }
    /**
     * @var Integer $id
     * @return void
     */
    public function destroy($id)
    {
        $job = Desciplinary::where('id', $id)->first();
        $job->delete();
        Session::flash('success', 'Desciplinary is deleted successsfuly');

        return redirect()->back();
    }
}
