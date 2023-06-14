<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    //add slider function

public function add(Request $request){
    //check method is post or not
    if($request->isMethod('post')){
        $rules = [
            'id' => 'numeric|required',
        ];

        // check id is equal to 0 and apply rules
        if((int) $request->post('id')==0){
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif';
        }
        
        //applay validator function 
        $validator = \Validator::make($request->all(),$rules);

        // if validator fails then check 
        if($validator->fails()){
            $message = '';
            $message_l = json_decode(json_encode($validator->messages()),true);
            foreach($message_l as $msg){
                $message = $msg[0];
                break;
            }
            return response(array('message'=>$message),403);
        }else{

            // if validated success then try and catch starts
            try{
                if((int) $request->post('id')>0){
                    $slider = Slider::find($request->post('id'));
                }else{
                    $slider = new Slider();
                }

                // now code for image check if any old image is exist or not
                $image = $request->post('old_image');
                //if requset has image
                if($request->hasFile('image')){
                    $imageData = $request->file('image');
                    $image = strtotime(date('Y-m-d H:i:s')).'.'.$imageData->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/sliders');
                    $imageData->move($destinationPath,$image);
                }

                $slider->image = $image;
                $slider->save();

                if((int) $request->post('id')>0){
                    return response(array('message'=>'Slider Updated Successfully.','reset'=>false),200);
                }else{
                    return response(array('message'=>'Slider Added Successfully.','reset'=>true ,'script'=>false),200);
                }
            }catch(\Exception $e){

                return respone(array("message"=>$e->getMessage()),403);
            }
        }

        return response(array('message'=>'Data not found.'),403);
    }

    $result = [];
    return view('admin.slider.add',compact('result'));
}



//change status function
public function changestatus(Request $request){

    Slider::where('id',$request->post('id'))->update(['status'=>$request->post('status')]);
    return response(array('message'=>'Slider status changed successfully.'));
}

//change order
public function changeOrder(Request $request){
    $allData = $request->allData;
    $i = 1;

    foreach ($allData as $key => $value){
        Slider::where('id',$value)->update(array('sort_order'=>$i));
        $i++;
    }
}

//slider list
public function sliderList(){
    $result = Slider::latest()->paginate(5);
    return view('admin.slider.list',compact('result'));
}

// update function 
public function update($id){
    $result = Slider::find($id);
    if($result){
        return view('admin.slider.add',compact('result'));
    }else{
        return redirect()->back()->with('5fernsadminerror','Something went wrong. Please try again.');
    }
}

// delete function
public function destroy($id){
    Slider::where('id',$id)->delete();
    return redirect('admin/slider/list');
}
}
