<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_job;

/**
 * JobController Created on 22/05/2016
 *
 * @author Kimchhoin Sok
 *        
 */
class JobController extends Controller
{
     private $j;

    /**
     * __construct
     *
     * @param Tbl_user $u          
     */
    function __construct(Tbl_job $j) {
        $this->j = $j;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "job Controller";
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
    public function store(JobRequest $request)
    {
        date_default_timezone_set ( 'Asia/Phnom_Penh' );
        $create_date = date ( "Y-m-d H:i:s" );
        $data = array (
                [ 
                    'name' => $request->get ( 'name' ),
                    'created_at' => $create_date 
                ] 
        );
        $insert = $this->j->insert($data);
        if($insert) {
                return response()->json([
                        'STATUS'=> true,
                        'MESSAGE'=>'JOB TYPE HAS INSERTED.',
                        'CODE' => 200
                ], 200);
        }else{
            return response()->json([
                'STATUS'=> false,
                'MESSAGE' => 'JOB TYPE INSERT UNSUCCESFULL', 
                'CODE'=> 400], 200);
        }
    }

    public function all()
    {
        $job = $this->j->all();
        if(!$job){
            return response()->json([
                'STATUS'=> false ,
                'MESSAGE' => 'RECORD NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> true,
                    'MESSAGE'=>'RECORD FOUND(S)',
                    'DATA' => $job
            ], 200);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
