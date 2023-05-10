<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\employee;
use App\Models\tasks;

use Mail;
use App\Mail\SendMail;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['active'] = 'home';
        return view('home')->with($data);
    }
    public function employeesScreen()
    {
        $data['active'] = 'employees';
        return view('employees')->with($data);
    }

    public function manageEmployee(Request $req,$id='')
    {
        if (!Auth::check()) {return Redirect::to('/');}
        $page_data = array();
        if($_POST) {
        if ($req->post('id') == '') {
               $emp = new Employee;
               $emp->name = $req->post('name');
               $emp->email = $req->post('email');
               $emp->phone = $req->post('phone');
               $emp->department = $req->post('department');
               $emp->status = $req->post('status');
               $emp->save();
           } else {
               Employee::where('id', $req->post('id'))
                        ->update([
                            'name' => $req->post('name'), 
                            'email' => $req->post('email'),
                            'phone' => $req->post('phone'),
                            'department' => $req->post('department'),
                            'status' => $req->post('status'),
                             ]);
           }
               return Redirect::to('/employees');
           
        }
        if ($id) {
            $page_data['employeesDatas'] = Employee::find($id)->toArray();
        }

        return view('manageEmployee')->with($page_data);
    }

    public function tasksScreen()
    {
        $data['active'] = 'tasks';
        return view('tasks')->with($data);
    }

    public function manageTask(Request $req,$id='')
        {
            if (!Auth::check()) {return Redirect::to('/');}
            $page_data = array();
            if($_POST) {
            if ($req->post('id') == '') {
             $this->sendMail('admin@otaskit.com','Task Created',$req->post('title'));
             $task = new Tasks;
             $task->title = $req->post('title');
             $task->description = $req->post('description');
             $task->status = 'Unassigned';
             $task->assigne = '';
             $task->save();
          }else{
            Tasks::where('id', $req->post('id'))
                        ->update([
                            'title' => $req->post('title'), 
                            'description' => $req->post('description'),
                             ]);
          }
          return Redirect::to('/tasks');
      }

            if ($id) {
            $page_data['TaskDatas'] = Tasks::find($id)->toArray();
            }
            return view('manageTask')->with($page_data);
    }

    public function deleteTaskData(Request $request)
    {
        if (!Auth::check()) {return Redirect::to('/');}
        $empId = $request->post('id');
        $res = DB::table('tasks')->where('id',$empId)->delete();
        echo  $res;
    } 

    public function assignTasks(Request $request,$id='')
    {
     if($_POST) {
        Tasks::where('id', $request->post('id'))
                        ->update([
                            'assigne' => $request->post('emp_id'),
                            'status' => 'Assigned',
                             ]);
     $pempData = Employee::find($request->post('emp_id'))->toArray();               
     $this->sendMail('admin@otaskit.com','Task Assigned',$pempData['name']);
          return Redirect::to('/tasks');
     }
     $data = Employee::all()->toArray();
     $page_data['TaskDatas'] = Tasks::find($id)->toArray();
     $page_data['employees'] = $data;
     return view('assignTasks')->with($page_data);
    }
 public function changeTaskStatus($id='')
  {
        Tasks::where('id', $id)
                        ->update([
                            'status' => 'In Progress',
                             ]);
          return Redirect::to('/tasks');
     
    }
 public function doneTaskStatus($id='')
  { 
        $TaskData= Tasks::find($id)->toArray();
        $to_time = strtotime("now");
        $from_time = strtotime($TaskData['updated_at']);
        $diff =round(abs($to_time - $from_time) / 60,2);
        if($diff > 5){
         Tasks::where('id', $id)
                            ->update([
                                'status' => 'Done',
                                 ]);
        }else{
            return 'not maching time..Please stay back some time...!';
        }
       
          return Redirect::to('/tasks');
    }


 public function sendMail($emailId,$heading,$body)
  {

    $testMailData = [
                'title' => $heading,
                'body' => $body
            ];
    Mail::to($emailId)->send(new SendMail($testMailData));
            // dd('Success! Email has been sent successfully.');
  }

// public function exportCsvData()
//   {
  
//    $data = Tasks::all();
//    return ($data)->download('tasks.csv', \Maatwebsite\Excel\Excel::CSV);
    
//   }

}
