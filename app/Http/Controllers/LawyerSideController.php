<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\casetobehandled;
use App\Adverse;
use App\clientadverse;
use App\Employee;
use App\employeeclients;
use Auth;
use App\Schedule;
use App\Notary;
use DB;

class LawyerSideController extends Controller
{
    public function home()
    {
    	return view('lawyer ui.lawyerui');

    	
    }
     public function shownotarytable()
    {
      
     $clientnotary = DB::table('employeeclients')
                      ->where([['employees.id',Auth::user()->id],['clients.nature_of_request','Administration of oath']])
                      ->join('employees','employees.id','=','employeeclients.employee_id')
                      ->join('clients','clients.id','=','employeeclients.client_id')
                      // ->join('notaries','notaries.client_id','=','employeeclients.client_id')
                      ->get();
         $clientnotaryview = DB::table('employeeclients')
                      ->select('notaries.id as notaryid')
                      ->where([['employees.id',Auth::user()->id],['clients.nature_of_request','Administration of oath']])
                      ->join('employees','employees.id','=','employeeclients.employee_id')
                      ->join('clients','clients.id','=','employeeclients.client_id')
                      ->join('notaries','notaries.client_id','=','employeeclients.client_id')
                      ->get();
               
         

        foreach($clientnotary as $client)
        {

          $notaries = Notary::where('client_id',$client->id)
         ->orderBy('created_at','asc')
         ->get();
          
        }
        
       
      
      return view('lawyer ui.notary')->withclientnotary($clientnotary)
                                     ->withclientnotaryview($clientnotaryview);
         
    }
     public function showwalkintable()
    {
     $clients = DB::table('employeeclients')
                      ->where([['employees.id',Auth::user()->id],['clients.nature_of_request','Legal Documentation']])
                      ->join('employees','employees.id','=','employeeclients.employee_id')
                      ->join('clients','clients.id','=','employeeclients.client_id')
                      ->get();  
      return view('lawyer ui.walkin')->withClients($clients);
    }
     public function showreqtable()
    {
       $lawyerclients = Auth::user()->id;
      
      $clients = Client::where('cl_status','Pending')->orderBy('cllname','asc')
        ->with('casetobehandled')
        ->get();
       foreach($clients as $client)
       {
        $clientadverse = clientadverse::where('client_id',$client->id)->get();

       
       
       }  
          return view('lawyer ui.client_table')->withClients($clients);
       
    }
    public function showmanagecase()
    {
      $allcases = Client::where('cl_status','Approved')
      ->with('casetobehandled')
      ->with('adverse')
      ->get();
      return view('lawyer ui.managecase')->withAllcases($allcases);
    }
    public function editcase($id)
    {
      $editcase = Client::find($id);
     
   
      $clientid = $editcase->id;
      $clients = Client::where('id',$clientid)
                ->with('casetobehandled')
                ->with('adverse')
                ->get();
      
      
      $status = Status::all();
      

      return view('lawyer ui.editcase')->withClients($clients)
                             ->withStatus($status);
    }
     public function showschedule()
    {
        $schedules = Employee::select('*')
        ->where('id',Auth::user()->id)->with('schedules')->get();
        
        return view('lawyer ui.schedules')->withSchedules($schedules);
    }
}
