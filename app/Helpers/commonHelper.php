<?php
namespace App\Helpers;
use Ixudra\Curl\Facades\Curl;
use Session;
use DB;

class commonHelper{
	
	public static function callAPI($method, $url, $data=array(),$files=array()){

        
		$url=env('APP_URL').'/api'.$url;

        if($method == 'GET'){

            return $response = Curl::to($url)
			->returnResponseObject()
            ->get();

        }elseif($method == 'PUT'){

            return $response = Curl::to($url)

            ->withData(['title'=>'Test', 'body'=>'body goes here', 'userId'=>1])
			->returnResponseObject()
            ->put();

        }elseif($method == 'DELETE'){

            return $response = Curl::to($url)

                ->delete();
        }elseif($method == 'patch'){

            return $response = Curl::to($url)

                ->withData(['title'=>'Test', 'body'=>'body goes here', 'userId'=>1])
				->returnResponseObject()
                ->patch();
        }elseif($method == 'POST'){

            return $response = Curl::to($url)
                ->withData($data)
				->returnResponseObject()
                ->post();
                
        }elseif($method == 'POSTFILE'){
			
            return $response = Curl::to($url)
                ->withData($data)
				->withFile($files['file_input'],$files['image_file'], $files['getMimeType'], $files['getClientOriginalName']) 
                ->post();
                
        }elseif($method == 'userTokenpost'){

            return $response = Curl::to($url)
                ->withData($data)
                ->withBearer(Session::get('5ferns_user'))
				->returnResponseObject()
                ->post();
                
        }elseif($method == 'userTokenget'){
            return $response = Curl::to($url)
            ->withBearer(Session::get('5ferns_user'))
			->returnResponseObject()
            ->get();
        }
        
    }

	public static function buildMenu($parent, $menu, $sub = NULL) {

        $html = "";

        if (isset($menu['parents'][$parent])){
            if (!empty($sub)) {
                $html .= "<ul id=" . $sub . " class='ml-menu'><li class=\"ml-menu\">" . $sub . "</li>\n";
            } else {
                $html .= "<ul class='list'>\n";
            }

            foreach ($menu['parents'][$parent] as $itemId) {
                
				$active=(request()->is($menu['items'][$itemId]['active_link'])) ? 'active' :'';

				$terget = null;
                if (!isset($menu['parents'][$itemId])) { //if condition is false only view menu
                    $html.= "<li class='".$active."' >\n  <a $terget title='" . $menu['items'][$itemId]['label'] . "' href='" . url($menu['items'][$itemId]['link']) . "'>\n <em class='" . $menu['items'][$itemId]['icon'] . " fa-fw'></em><span>" . $menu['items'][$itemId]['label'] . "</span></a>\n</li> \n";
				}
				
                if (isset($menu['parents'][$itemId])) { //if condition is true show with submenu
                    $html .= "<li class='" . $active . "'>\n  <a onclick='return false;' class='menu-toggle' href='#" . $menu['items'][$itemId]['label'] . "'> <em class='" . $menu['items'][$itemId]['icon'] . " fa-fw'></em><span>" . $menu['items'][$itemId]['label'] . "</span></a>\n";
                    $html .= self::buildMenu($itemId, $menu, $menu['items'][$itemId]['label']);
                    $html .= "</li> \n";
                }
				
            }
            $html .= "</ul> \n";
			
        }

        return $html;

    }

	public static function getSidebarMenu(){
		
		if(Session::has('fivefernsadminmenu')){

			$result=Session::get('fivefernsadminmenu');

			$menu = array(
				'items' => array(),
				'parents' => array()
			);
	
			foreach ($result as $v_menu) {
				$menu['items'][$v_menu['menu_id']] = $v_menu;
				$menu['parents'][$v_menu['parent']][] = $v_menu['menu_id'];
			}
	
			return  \App\Helpers\commonHelper::buildMenu(0, $menu);
		}

	}
  
	public static function getOtp(){
		
        $otp = mt_rand(1000,9999);

        return $otp;
	}
	
	public static function sendMsg($url){
        
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
		curl_close($ch);
	}

    public static function emailSendToUser($to, $subject, $msg, $template = false, $result = false){
		
		if (!$template) {
			$template = 'mail';
		}
		if (!$result) {
			$result = array();
		}

		\Mail::send('email_templates.'.$template, compact('to', 'subject', 'msg', 'result'), function($message) use ($to, $subject) {
			$message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
			$message->subject($subject);
			$message->to($to);
			
		});
	}
	    
	public static function getCityNameById($id){
		
		$result=\App\Models\City::where('id',$id)->first();
		
		if($result){

			return ucfirst($result->name);

		}else{

			return 'N/A';

		}
		
	}
	

    // public static function getStateNameById($id){
		
	// 	$result=\App\Models\State::where('id',$id)->first();
		
	// 	if($result){

	// 		return ucfirst($result->name);

	// 	}else{

	// 		return 'N/A';

	// 	}
	// }

    public static function uploadFile($file, $folder)
{
    $filename = strtotime(date('Y-m-d H:i:s')) . rand(11, 99) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('/uploads/' . $folder), $filename);

    return $filename;
}

public static function uploadImage($file, $folder)
{
    $extension = $file->getClientOriginalExtension();
    $filename = strtotime(date('Y-m-d H:i:s')) . rand(11, 99) . '.' . $extension;
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Add any additional allowed extensions if needed
    
    // Check if the file has a valid image extension
    if (in_array($extension, $allowedExtensions)) {
        $file->move(public_path('/uploads/projects' . $folder), $filename);
        // echo $filename;die;
        return $filename;
    }

    return false; // Return false if the file extension is not allowed
}

// public static function uploadImage($imageFile, $oldImage)
// {
//     if ($imageFile) {
//         $image = strtotime(date('Y-m-d H:i:s')) . '.' . $imageFile->getClientOriginalExtension();
//         $destinationPath = public_path('/uploads/category');
//         $imageFile->move($destinationPath, $image);
//         return $image;
//     }

//     return $oldImage;
// }


public static function getStateNameById($id){
		
    $result=\App\Models\State::where('id',$id)->first();
    
    if($result){

        return ucfirst($result->name);

    }else{

        return 'N/A';

    }
}

public static function getCv($id){
    
    $result=\App\Models\About::where('user_id',$id)->first();
    
    if($result){

        return ucfirst($result->cv);

    }else{

        return 'N/A';

    }
    
}

public static function getUsername($id){
    
    $result=\App\Models\User::where('id',$id)->first();
    
    if($result){

        return ucfirst($result->name);

    }else{

        return 'N/A';

    }
    
}

public function extractFirstAndMiddleName($name)
{
    if (!empty($name)) {
        $nameParts = explode(" ", $name);
        if (count($nameParts) >= 2) {
            return $nameParts[0] . " " . $nameParts[1];
        } else {
            return $name . " Kumar";
        }
    }

    return "";
}
	


}


?>