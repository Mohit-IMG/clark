<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\About;
use Auth;

class AboutController extends Controller
{

    public function getState(){
        $states=\App\Models\State::where('country_id','101')->orderBy('name','Asc')->get();
        return view('admin.about.add',compact($states));

    }

    public function add(Request $request){
// dd($request);
		if($request->isMethod('post')){			
			$rules=[				
				'name'=>'string|required',
				'short_description'=>'max:330',				
			];
			 
			if((int) $request->post('id')==0 || $request->hasFile('cv')){
						
                $rules['cv'] = 'required|mimes:pdf,doc,docx';
			
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
						
						$about=About::find($request->post('id'));
					}else{
						
						$about=new About();
					}
					
                    $cvFilename = $request->input('old_cv');

                    if ($request->hasFile('cv')) {
                        $cvFilename = \App\Helpers\commonHelper::uploadFile($request->file('cv'), 'cv');
                    }
										
					$about->cv=$cvFilename;
					$about->user_id = Auth::id();
					$about->name=$request->post('name');
					$about->short_description=$request->post('short_description');
                    $about->address=$request->post('address');
                    $about->state=\App\Helpers\commonHelper::getStateNameById($request->post('state_id'));
                    $about->city=\App\Helpers\commonHelper::getCityNameById($request->post('city_id'));
                    $about->dob=$request->post('dob');
                    $about->zip_code=$request->post('zip_code');
                    $about->email=$request->post('email');
                    $about->alt_mobile=$request->post('alt_mobile');
                    $about->greeting=$request->post('greeting');
                    $about->profile=$request->post('profile');
                    $about->quote=$request->post('quote');
				
					// dd($request);
					$about->save();
					
					if((int) $request->post('id')>0){
						
						return response(array('message'=>'About updated successfully.','reset'=>false),200);
					}else{
						
						return response(array('message'=>'About added successfully.','reset'=>true,'script'=>true),200);
					
					}
				}catch (\Exception $e){
			
					return response(array("message" => $e->getMessage()),403); 
				
				}
			}
			
			return response(array('message'=>'Data not found.'),403);
		
    }
		$result=[];
        $states=\App\Models\State::where('country_id','101')->orderBy('name','Asc')->get();

        return view('admin.about.add',compact('result','states'));
    }

    public function aboutList(){
		
		$result=\App\Models\About::orderBy('sort_order','ASC')->get();		
		return view('admin.about.list',compact('result'));
	}

    public function destroy(Request $request,$id){
		
		$result=About::find($id);
		
		if($result){
			
			About::where('id',$id)->delete();;
			
			return redirect()->back()->with('5fernsadminsuccess','About deleted successfully.');
			
		}else{
			
			return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
		}
		
	}
    
    public function changeStatus(Request $request){
		
		About::where('id',$request->post('id'))->update(['status'=>$request->post('status')]);
		
		return response(array('message'=>'About status changed successfully.'),200);
	}
    
    public function changeOrder(Request $request){
		
		$allData = $request->allData;
		$i = 1;
		foreach ($allData as $key => $value) {
			About::where('id',$value)->update(array('sort_order'=>$i));
			$i++;
		}
		
	}

    public function update(Request $request,$id){
        $states=\App\Models\State::where('country_id','101')->orderBy('name','Asc')->get();
		$result=About::find($id);
		
		if($result){
			
			return view('admin.about.add',compact('result','states'));
			
		}else{
			
			return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
		}
		
	}
}
