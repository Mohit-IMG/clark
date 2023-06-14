<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Service;
use App\Models\Project;
use App\Models\Contact;
use Auth;

class ProjectController extends Controller
{
    public function add(Request $request){
        // dd($request);
                if($request->isMethod('post')){			
                    $rules=[				
                        'service_name'=>'string|required'
                    ];
                     
                    if ((int) $request->post('id') == 0 || $request->hasFile('image')) {
                        $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048'; // Adjust the max file size (in kilobytes) as per your requirements
                    }
                    
                            
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
                                
                                $project=Project::find($request->post('id'));
                            }else{  
                                
                                $project=new Project();
                            }
                            
                            $imageFilename = $request->input('old_image');
        
                            if ($request->hasFile('image')) {
                                $imageFilename = \App\Helpers\commonHelper::uploadImage($request->file('image'), 'images');
                            }                            
                                                
                            $project->image=$imageFilename;
                            // dd($imageFilename);
                            $project->user_id = Auth::id();
                            $project->service_type=$request->post('service_type');
                            $project->service=$request->post('service_name');
                            $project->quote=$request->post('quote');
                        
                            // dd($request);
                            $project->save();
                            
                            if((int) $request->post('id')>0){
                                
                                return response(array('message'=>'Project updated successfully.','reset'=>false),200);
                            }else{
                                
                                return response(array('message'=>'Project added successfully.','reset'=>true,'script'=>true),200);
                            
                            }
                        }catch (\Exception $e){
                    
                            return response(array("message" => $e->getMessage()),403); 
                        
                        }
                    }
                    
                    return response(array('message'=>'Data not found.'),403);
                
            }
                $result=[];
                $services=\App\Models\Service::all();
        
                return view('admin.project.add',compact('result','services'));
            }
        
            public function projectList(){
                
                $result=\App\Models\Project::orderBy('service_type','ASC')->get();		
                return view('admin.project.list',compact('result'));
            }
        
            public function destroy(Request $request,$id){
                
                $result=Project::find($id);
                
                if($result){
                    
                    Project::where('id',$id)->delete();;
                    
                    return redirect()->back()->with('5fernsadminsuccess','Project deleted successfully.');
                    
                }else{
                    
                    return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
                }
                
            }
            
            public function changeStatus(Request $request){
                
                Project::where('id',$request->post('id'))->update(['status'=>$request->post('status')]);
                
                return response(array('message'=>'Project status changed successfully.'),200);
            }
            

        
            public function update(Request $request,$id){
                $services=\App\Models\Service::get();
                $result=Project::find($id);
                
                if($result){
                    
                    return view('admin.project.add',compact('result','services'));
                    
                }else{
                    
                    return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
                }
                
            }


            public function contactList()
            {
                $result = \App\Models\Contact::all();
                return view('admin.contact', compact('result'));
            }
            
}
