<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use App\Models\Projects;

class ProjectController extends Controller
{
    public function getProjects(Request $request) {
        $params = $request->all();

        unset( $params['project_name'] );
        if($request->client_id == 'all') {
            unset( $params['client_id'] );
        }
        if($request->project_status == 'all') {
            unset( $params['project_status'] );
        }

        if( $request->project_name != null ) {
            $data = Projects::with('client')->where('project_name', 'like', '%'. $request->project_name .'%')->where($params)->get();
        } else {
            $data = Projects::with('client')->where($params)->get();
        }

        return response()->json( $data );
    }
}
