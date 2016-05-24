<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tbl_user;
use App\Tbl_job;
use App\Tbl_attendee_type;
use App\Http\Requests\UserRequest;

/**
 * UserController Created on 22/05/2016
 *
 * @author Kimchhoin Sok
 *        
 */
class UserController extends Controller
{
    private $u;
    private $j;
    private $a;

    /**
     * __construct
     *
     * @param Tbl_user $u          
     */
    function __construct(Tbl_user $u, Tbl_job $j, Tbl_attendee_type $a) {
        $this->u = $u;
        $this->j = $j;
        $this->a = $a;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.user');
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
        $user = $this->u->all();
        if(!$user){
            return response()->json(['STATUS'=> FALSE ,'MESSAGE' => 'RECORD NOT FOUND', 'CODE'=> 400], 200);
        }else{
            return response()->json([
                    'STATUS'=> TRUE,
                    'MESSAGE'=>'RECORD FOUND(S)',
                    'DATA' => $user
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $request->all();
   
        $insert = $this->u->insert($user);
        if($insert) {
                return response()->json([
                        'STATUS'=> TRUE,
                        'MESSAGE'=>'USER HAS INSERTED.',
                        'CODE' => 200
                ], 200);
        }else{
            return response()->json([
                'STATUS'=> false,
                'MESSAGE' => 'USER INSERT UNSUCCESFULL', 
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
        $user =$this->u->where('user_id', $id)->first();
        
        if(!$user){
            return response()->json([
                'STATUS'=> FALSE ,
                'MESSAGE' => 'NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> TRUE,
                    'MESSAGE'=>'RECORD FOUND(S)',
                    'DATA' => $user
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
    public function update(UserRequest $request, $id)
    {
        date_default_timezone_set ( 'Asia/Phnom_Penh' );
        $create_date = date ( "Y-m-d H:i:s" );
        $id = preg_replace ( '#[^0-9]#', '', $id );
        $update = $this->u->where('user_id', $id)->first();
        if(!$update) {
            return response()->json([
                'STATUS'=> FALSE,
                'MESSAGE' => 'USER ID NOT FOUND', 
                'CODE'=> 400
                ], 200);
        }else {
            
        $this->u->where ('user_id', $id )->update ( [ 
            'name' => $request->get ( 'name' ),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'job_id_for' => $request->get('job_id_for'),
            'attendee_id_for' => $request->get('attendee_id_for'),
            'extra_guest' => $request->get('extra_guest'),
            'dinner' => $request->get('dinner'),
            'paper' => $request->get('paper'),
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
        $id = preg_replace ( '#[^0-9]#', '', $id );
        $delete = $this->u->where('user_id', $id)->first();
        if($delete->delete()){
            return response()->json([
                    'STATUS' => TRUE,
                    'MESSAGE' => 'USER HAS DELETED',
                    'CODE' => 422
            ], 200);
        }
        else {
            return response()->json([
                'STATUS'=> FALSE,
                'MESSAGE' => 'USER ID NOT FOUND', 
                'CODE'=> 400], 200);
        }
    }

    /**
    * List User
    */

    public function listUser($page, $limit)
    {
        $page = preg_replace ( '#[^0-9]#', '', $page );
        $item = preg_replace ( '#[^0-9]#', '', $limit );
        $offset = $page * $item - $item;
        
        
        $count = $this->p->count();
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
        
        $user = $this->u->skip($offset)->take($item)->orderBy('user_id', 'desc')->get();
        
        if(!$user || $page > $totalpage){
            return response()->json([
                'STATUS'=> FALSE ,
                'MESSAGE' => 'NOT FOUND', 
                'CODE'=> 400], 200);
        }
        else{
            return response()->json([
                    'STATUS'=> TRUE ,
                    'MESSAGE'=>'RECORD FOUND(S)',
                    'DATA' => $user,
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
         
         
        $count = $this->u->where ( 'pro_name', 'like',  $keySearch . '%' )->count();
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
         
        $user = $this->u->where ( 'pro_name', 'like',  $keySearch . '%' )->skip($offset)->take($item)->orderBy('user_id', 'desc')->get();
         
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
                    'DATA' => $user,
                    'PAGINATION' => $pagination
            ], 200);
        }
    }
}
