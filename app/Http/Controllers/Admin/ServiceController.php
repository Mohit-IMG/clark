<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Service;
use Auth;

class ServiceController extends Controller
{
    public function add(Request $request){
        // dd($request);
                if($request->isMethod('post')){			
                    $rules=[				
                        'service'=>'string|required',
                        'description'=>'max:330',				
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
                                
                                $service=Service::find($request->post('id'));
                            }else{
                                
                                $service=new Service();
                            }
                            

                            $service->user_id = Auth::id();
                            $service->service_name=$request->post('service');
                            $service->description=$request->post('description');
                            // dd($request);
                            $service->save();
                            
                            if((int) $request->post('id')>0){
                                
                                return response(array('message'=>'Service updated successfully.','reset'=>false),200);
                            }else{
                                
                                return response(array('message'=>'Service added successfully.','reset'=>true,'script'=>true),200);
                            
                            }
                        }catch (\Exception $e){
                    
                            return response(array("message" => $e->getMessage()),403); 
                        
                        }
                    }
                    
                    return response(array('message'=>'Data not found.'),403);
                
            }
                $result=[];
        
                return view('admin.service.add',compact('result'));
            }
        
            public function serviceList(){
                
                $result=\App\Models\Service::orderBy('service_name','ASC')->get();		
                return view('admin.service.list',compact('result'));
            }
        
            public function destroy(Request $request,$id){
                
                $result=Service::find($id);
                
                if($result){
                    
                    Service::where('id',$id)->delete();;
                    
                    return redirect()->back()->with('5fernsadminsuccess','Service deleted successfully.');
                    
                }else{
                    
                    return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
                }
                
            }
            
            public function changeStatus(Request $request){
                
                Service::where('id',$request->post('id'))->update(['status'=>$request->post('status')]);
                
                return response(array('message'=>'Service status changed successfully.'),200);
            }
            
        
            public function update(Request $request,$id){
                $result=Service::find($id);
                
                if($result){
                    
                    return view('admin.service.add',compact('result'));
                    
                }else{
                    
                    return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
                }
                
            }
}
