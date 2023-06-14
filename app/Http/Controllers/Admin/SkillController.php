<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Skill;
use Auth;

class SkillController extends Controller
{


    public function add(Request $request){
// dd($request);
		if($request->isMethod('post')){			
			$rules=[				
				'quote'=>'string|required',
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
						
						$skill=Skill::find($request->post('id'));
					}else{
						
						$skill=new Skill();
					}
					

										
					$skill->user_id = Auth::id();
					$skill->quote=$request->post('quote');
					$skill->skill_name=$request->post('skill_name');
                    $skill->skp=$request->post('skp');
				
					// dd($request);
					$skill->save();
					
					if((int) $request->post('id')>0){
						
						return response(array('message'=>'Skill updated successfully.','reset'=>false),200);
					}else{
						
						return response(array('message'=>'Skill added successfully.','reset'=>true,'script'=>true),200);
					
					}
				}catch (\Exception $e){
			
					return response(array("message" => $e->getMessage()),403); 
				
				}
			}
			
			return response(array('message'=>'Data not found.'),403);
		
    }
		$result=[];

        return view('admin.skills.add',compact('result'));
    }

    public function skillList(){
		
		$result=\App\Models\Skill::orderBy('skp','ASC')->get();		
		return view('admin.skills.list',compact('result'));
	}

    public function destroy(Request $request,$id){
		
		$result=Skill::find($id);
		
		if($result){
			
			Skill::where('id',$id)->delete();;
			
			return redirect()->back()->with('5fernsadminsuccess','Skill deleted successfully.');
			
		}else{
			
			return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
		}
		
	}
    
    public function changeStatus(Request $request){
		
		Skill::where('id',$request->post('id'))->update(['status'=>$request->post('status')]);
		
		return response(array('message'=>'Skill status changed successfully.'),200);
	}
    


    public function update(Request $request,$id){


		$result=Skill::find($id);
		
		if($result){
			
			return view('admin.skills.add',compact('result','states'));
			
		}else{
			
			return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
		}
		
	}
}
