<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;

use App\Models\employee;
use App\Models\tasks;


class tableController extends Controller
{

  
  public function getEmployeesData()
    {
         $data = DB::table('employees')->get();
         return Datatables::of($data) 
          ->addIndexColumn()
          ->addColumn('action', function($data){
                 $url = url('/'); 
                 $actionBtn = '
                 <a href="javascript:void(0)"  class=" btn btn-success btn-sm" title="edit" onclick=showAjaxModal("'.$url.'/addEmployee/'.$data->id.'") > Edit</a>
                  <a href="javascript:void(0)" data-toggle="modal" data-target="#delete_modals" onclick=delete_row(event,"'.$data->id.'","'.$url.'/deleteEmployee") class=" btn btn-danger btn-sm" title="delete"> Delete</a>';
                 return $actionBtn;
             })
         ->rawColumns(['action'])
         ->make(true);
    }

    public function getTasksData()
    {
         $data = DB::table('tasks')->get();
         return Datatables::of($data) 
          ->addIndexColumn()
          ->editColumn('status',function($data){
              if($data->status != 'Unassigned'){
                   $empData = Employee::find($data->assigne)->toArray();
                   return $data->status.'-'.$empData['name'];
              }else{
                    return $data->status;
              }
             
              })
          ->addColumn('action', function($data){
                 $url = url('/'); 
                 $actionBtn = ' 
                 <a href="javascript:void(0)"  class=" btn btn-primary btn-sm" title="edit" onclick=showAjaxModal("'.$url.'/addTask/'.$data->id.'") > Edit</a>
                 <a href="javascript:void(0)"  class=" btn btn-warning btn-sm" title="Assining tasks" onclick=showAjaxModal("'.$url.'/assignTask/'.$data->id.'") > Assign</a>';
                 if($data->status == 'Assigned'){
                 	$actionBtn .='<a href="'.url('/changeTaskStatus').'/'.$data->id.'"  class=" btn btn-info btn-sm" title="start task"> Start</a>';
                 }
                 if($data->status == 'In Progress'){
                 	$actionBtn .='<a href="'.url('/doneTaskStatus').'/'.$data->id.'"  class=" btn btn-success btn-sm" title="finish task"> Done</a>';
                 }
                 $actionBtn .='<a href="javascript:void(0)" data-toggle="modal" data-target="#delete_modals" onclick=delete_row(event,"'.$data->id.'","'.$url.'/deleteTask") class=" btn btn-danger btn-sm" title="delete"> Delete</a>';
                 return $actionBtn;
             })
         ->rawColumns(['action','status'])
         ->make(true);
    }
}