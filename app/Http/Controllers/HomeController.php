<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Contact;
use Auth;

class HomeController extends Controller
{
    public function getState(Request $request){

        $country_id=$request->get('country_id');

        $option="<option value='' selected >--Select State--</option>";

        if($country_id>0){

            $stateResult=\App\Models\State::where('country_id',$country_id)->get();

            foreach($stateResult as $state){

                $option.="<option value='".$state['id']."'>".ucfirst($state['name'])."</option>";
            }
        }

        return response(array('message'=>'state fetched successfully.','html'=>$option));
    }
    
	
    public function getCity(Request $request){

        $stateId=$request->get('state_id');

        $option="<option value='' selected >--Select City--</option>";

        if($stateId>0){

            $cityResult=\App\Models\City::where('state_id',$stateId)->get();

            foreach($cityResult as $city){
    
                $option.="<option value='".$city['id']."'>".ucfirst($city['name'])."</option>";
            }

        }

        return response(array('message'=>'City fetched successfully.','html'=>$option));
    }

    
    Public function index(){

        $abouts = \App\Models\About::where('status','Active')->get();
        $project = \App\Models\Project::where('status','Done')->get();
        $resume = \App\Models\Resume::where('status','Active')->get();
        $service = \App\Models\Service::where('status','Active')->get();
        $slider = \App\Models\Slider::where('status','Active')->get();
        $skill = \App\Models\Skill::where('status','Active')->get();
        
        // dd($skill);
        return view('index', compact('abouts', 'project', 'resume', 'service', 'slider','skill'));
    }

    public function add(Request $request){
        // dd($request);
                if($request->isMethod('post')){			
                    $rules=[				
                        'name'=>'string|required'
                    ];
                            
                    $validator = Validator::make($request->all(), $rules);
                    
                    if ($validator->fails()){
                        $message = "";
                        $messages_l = json_decode(json_encode($validator->messages()), true);
                        foreach ($messages_l as $msg) {
                            $message= $msg[0];
                            break;
                        }
                        
                        return response(array('message'=>$message),403);
                        
                    }else{
                        
                        
                        try{
                            if((int) $request->post('id')>0){
                                
                                $contact=Contact::find($request->post('id'));
                            }else{  
                                
                                $contact=new Contact();
                            }                           
                                                
                            $contact->name=$request->post('name');
                            $contact->email=$request->post('email');
                            $contact->mobile=$request->post('mobile');
                            $contact->message=$request->post('message');
                            // dd($request);
                            $contact->save();
                            
                            if((int) $request->post('id')>0){
                                
                                return response(array('message'=>'Contact updated successfully.','reset'=>false),200);
                            }else{
                                
                                return back()->with('message', 'Contact added successfully.');
                            
                            }
                        }catch (\Exception $e){
                    
                            return response(array("message" => $e->getMessage()),403); 
                        
                        }
                    }
                    
                    return response(array('message'=>'Data not found.'),403);
                
            }
                $result=[];
        
                return back()->with('message', 'Contact added successfully.');
            }
        
            // public function projectList(){
                
            //     $result=\App\Models\Contact::orderBy('name','ASC')->get();		
            //     return view('admin.contact',compact('result'));
            // }
}
