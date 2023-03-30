<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clients;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function index() {
        $getData = [
            'data' => Projects::all(),
            'client_data' => Clients::all()
        ];

        return view('pages.project.index', $getData);
    }

    public function filter(Request $request) {
        $params = [];

        $params['client_id'] = $request->clientData;
        $params['project_status'] = $request->statusData;

        if($request->clientData == 'all') {
            unset( $params['client_id'] );
        }
        if($request->statusData == 'all') {
            unset( $params['project_status'] );
        }

        // dd($params);

        if( $request->searchData != null ) {
            $getData = [
                'data' => Projects::where('project_name', 'like', '%'. $request->searchData .'%')->where($params)->get(),
                'client_data' => Clients::all()
            ];
        } else {
            $getData = [
                'data' => Projects::where($params)->get(),
                'client_data' => Clients::all()
            ];
        }

        return view('pages.project.index', $getData);
    }

    public function store(Request $request) {
        $request->validate([
            'project_name' => 'required',
            'client_id' => 'required',
        ]);

        $postData = new Projects;
        $postData->project_name = $request->project_name;
        $postData->client_id = $request->client_id;
        $postData->project_start = $request->project_start;
        $postData->project_end = $request->project_end;
        $postData->project_status = $request->project_status;
        $postData->save();

        return redirect()->back();
    }

    public function update(Request $request) {
        $request->validate([
            'project_name' => 'required',
            'client_id' => 'required',
        ]);

        $postData = Projects::where('project_id', $request->project_id)->update([
            'project_name' => $request->project_name,
            'client_id' => $request->client_id,
            'project_start' => $request->project_start,
            'project_end' => $request->project_end,
            'project_status' => $request->project_status,
        ]);

        return redirect()->back();
    }

    public function delete($id) {
        try {
            $ids = explode(',', $id);
            Projects::whereIn('project_id', $ids)->delete();
        } catch(\Exception $e) {
            report($e);
        }

        return redirect()->back();
    }
}
