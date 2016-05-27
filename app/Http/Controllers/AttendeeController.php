<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_attendee_type;
use App\Http\Requests\AttendeeRequest;

/**
 * AttendeeController Created on 22/05/2016
 *
 * @author Kimchhoin Sok
 *        
 */

class AttendeeController extends Controller
{
    private $a;

    /**
     * __construct
     *
     * @param Tbl_user $u          
     */
    function __construct(Tbl_attendee_type $a) {
        $this->a = $a;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
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
     * all
     */
    public function all()
    {
        $attendee = $this->a->where('is_active',true)->get();
        if(!$attendee){
            return response()->json([
                'STATUS'=> FALSE ,
                'MESSAGE' => 'RECORD NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> TRUE,
                    'MESSAGE'=>'RECORD FOUND(s)',
                    'DATA' => $attendee
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendeeRequest $request)
    {
        $attendee = $request->all();
   
        $insert = $this->a->insert($attendee);
        if($insert) {
                return response()->json([
                        'STATUS'=> TRUE,
                        'MESSAGE'=>'ATTENDEE TYPE HAS INSERTED.',
                        'CODE' => 200
                ], 200);
        }else{
            return response()->json([
                'STATUS'=> FALSE,
                'MESSAGE' => 'ATTENDEE TYPE INSERT UNSUCCESFULL', 
                'CODE'=> 400], 200);
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
        $id = preg_replace ( '#[^0-9]#', '', $id );
        $attendee =$this->u->where('attendee_id', $id)->first();
        
        if(!$attendee){
            return response()->json([
                'STATUS'=> FALSE ,
                'MESSAGE' => 'NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> TRUE,
                    'MESSAGE'=>'RECORD FOUND(s)',
                    'DATA' => $attendee
            ], 200);
        }
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
    public function update(AttendeeRequest $request, $id)
    {
        date_default_timezone_set ( 'Asia/Phnom_Penh' );
        $create_date = date ( "Y-m-d H:i:s" );
        $attendee_id = preg_replace ( '#[^0-9]#', '', $attendee_id );
        $update = $this->a->where('attendee_id', $attendee_id)->first();
        if(!$update) {
            return response()->json([
                'STATUS'=> FALSE,
                'MESSAGE' => 'USER ID NOT FOUND', 
                'CODE'=> 400
                ], 200);
        }
        else {
            $this->a->where ('attendee_id', $attendee_id )->update ( [ 
            'attendee_title' => $request->get ('attendee_title'),
            'updated_at'=> $create_date
        ] );
            
        return response()->json([
            'STATUS'=> TRUE,
            'MESSAGE'=>'USER HAS UPDATED',
            'CODE' => 200
            ], 200);
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
        date_default_timezone_set ( 'Asia/Phnom_Penh' );
        $create_date = date ( "Y-m-d H:i:s" );
        $id = preg_replace ( '#[^0-9]#', '', $id );
        $delete = $this->a->where('attendee_id', $id)->first();
        if(!$delete) {
            return response()->json([
                'STATUS'=> FALSE,
                'MESSAGE' => 'ATTENDEE TYPE ID FOUND', 
                'CODE'=> 400
                ], 200);
        }
        else {
            $this->a->where ('attendee_id', $id )->update ( [ 
            'is_active' => false,
            'updated_at'=> $create_date
        ] );
            
        return response()->json([
            'STATUS'=> TRUE,
            'MESSAGE'=>'ATTENDEE TYPE HAS UPDATED',
            'CODE' => 200
            ], 200);
        }
    }

    public function listAttendeeType($page, $limit)
    {
        $page = preg_replace ( '#[^0-9]#', '', $page );
        $item = preg_replace ( '#[^0-9]#', '', $limit );
        $offset = $page * $item - $item;
        
        
        $count = $this->a->count();
        $totalpage = 0;
        if ($count % $item > 0){
            $totalpage = floor($count / $item) +1;
        }
        else {
            $totalpage = $count / $item ;
        }
        
        $pagination = [
                'TOTALPAGE' => $totalpage ,
                'TOTALRECORD' => $count ,
                'CURRENTPAGE'  => $page,
                'SHOWITEM'  => $item
        ];
        
        $attendee_type = $this->a->skip($offset)->take($item)->orderBy('attendee_id', 'desc')->get();
        
        if(!$attendee_type || $page > $totalpage){
            return response()->json([
                'STATUS'=> FALSE ,
                'MESSAGE' => 'NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> TRUE ,
                    'MESSAGE'=>'RECORD FOUND(S)',
                    'DATA' => $attendee_type,
                    'PAGINATION' => $pagination
            ], 200);
        } 
    }
 
    /**
     * search
     *
     * @param unknown $page
     * @param unknown $limit
     * 
     */
    public function search($page, $limit, $keySearch)
    {
        $keySearch = preg_replace ( '#[^0-9A-Za-z\s-_]#', '', $keySearch );
        $page = preg_replace ( '#[^0-9]#', '', $page );
        $item = preg_replace ( '#[^0-9]#', '', $limit );
        $offset = $page * $item - $item;
         
         
        $count = $this->a->where ( 'attendee_title', 'like',  $keySearch . '%' )->count();
        $totalpage = 0;
        if ($count % $item > 0 ){
            $totalpage = floor($count / $item) +1;
        }
        else {
            $totalpage = $count / $item ;
        }
         
        $pagination = [
                'TOTALPAGE' => $totalpage ,
                'TOTALRECORD' => $count ,
                'CURRENTPAGE'  => $page,
                'SHOWITEM'  => $item
        ];
         
        $attendee_type = $this->a->where ( 'attendee_title', 'like',  $keySearch . '%' )->skip($offset)->take($item)->orderBy('attendee_id', 'desc')->get();
         
        if(!$user  || $page > $totalpage){
            return response()->json([
                'STATUS'=>  FALSE ,
                'MESSAGE' => 'RECORD NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> TRUE ,
                    'MESSAGE'=>'RECORD FOUND',
                    'DATA' => $attendee_type,
                    'PAGINATION' => $pagination
            ], 200);
        }
    }
}
