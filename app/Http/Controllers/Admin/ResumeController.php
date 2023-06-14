<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Resume;


class ResumeController extends Controller
{
    public function add(Request $request){
        // dd($request);
                if($request->isMethod('post')){			
                    $rules=[				
                        'short_description'=>'max:330',				
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
                                
                                $resume=Resume::find($request->post('id'));
                            }else{
                                
                                $resume=new Resume();
                            }
                                                
                            $resume->quote=$request->post('quote');
                            $resume->passing_year=$request->post('passing_year');
                            $resume->degree=$request->post('degree');
                            $resume->university=$request->post('university');
                            $resume->description=$request->post('description');
                            $resume->about_id = Auth::id();

                            // dd($request);
                            $resume->save();
                            
                            if((int) $request->post('id')>0){
                                
                                return response(array('message'=>'Resume updated successfully.','reset'=>false),200);
                            }else{
                                
                                return response(array('message'=>'Resume added successfully.','reset'=>true,'script'=>true),200);
                            
                            }
                        }catch (\Exception $e){
                    
                            return response(array("message" => $e->getMessage()),403); 
                        
                        }
                    }
                    
                    return response(array('message'=>'Data not found.'),403);
                
            }
                $result=[];        
                return view('admin.resume.add',compact('result'));
            }
        
            public function resumeList(){
                
                $result=\App\Models\Resume::orderBy('passing_year','ASC')->get();		
                return view('admin.resume.list',compact('result'));
            }
        
            public function destroy(Request $request,$id){
                
                $result=Resume::find($id);
                
                if($result){
                    
                    Resume::where('id',$id)->delete();;
                    
                    return redirect()->back()->with('5fernsadminsuccess','Resume deleted successfully.');
                    
                }else{
                    
                    return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
                }
                
            }
            
            public function changeStatus(Request $request){
                
                Resume::where('id',$request->post('id'))->update(['status'=>$request->post('status')]);
                
                return response(array('message'=>'About status changed successfully.'),200);
            }
            
        
            public function update(Request $request,$id){

                $result=Resume::find($id);
                if($result){
                    
                    return view('admin.resume.add',compact('result'));
                    
                }else{
                    
                    return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
                }
                
            }
}
