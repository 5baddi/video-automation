<?php

namespace App\Http\Controllers;

use App\User;
use App\Vehicle;
use App\DealerInfo;
use App\WeeklyBudget;
use App\PaymentPlan;
use App\DealerTemplate;
use App\Form;
use App\Vuser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __invoke()
    {
        return view('application');
    }

    public function welcome()
    {

    	$vehicle = Vehicle::where('id',"6837306")->first();

    	var_dump($vehicle['vin']);
    }

    public function getDealerByID(Request $request){

    	$dealer_id = $request->params['id'];
    	$user = Vuser::find($dealer_id);
    	$dealerInfo = DealerInfo::where('user_id',$dealer_id)->first();
    	$WeeklyBudget = WeeklyBudget::where('user_id', $dealer_id)->first();
    	$paymentPlan = PaymentPlan::where('user_id', $dealer_id)->first();
    	$dealertemplate = DealerTemplate::where('user_id',$dealer_id)->first();
    	$makes = array();
    	$bodies = array();
    	$data = array();
    	if($user != null){
    		$data['email'] = $user->email;
    		$data['dealer_name'] = $dealerInfo->name;
    		$data['zipcode']  = $dealerInfo->zip;
    		$vehicles = Vehicle::where('user_id',$dealer_id)->get();
    		if($vehicles != null){
    			foreach($vehicles as $vehicle){
    				$makes[] = $vehicle->make_name;
    				$bodies[] = $vehicle->body_style;
    			}

    			$u_makes = array_unique($makes);
    			$u_bodies = array_unique($bodies);
    			$u_makes = array_values($u_makes);
    			$u_bodies = array_values($u_bodies);
    			
    			for($i =0; $i < count($u_makes); $i++){
    				$temp = array();
    				if($u_makes[$i] != null && $u_makes[$i] != "-"){
    					$temp['id'] = $i;
	    				$temp['value'] = $u_makes[$i];
	    				$temp['checked'] = true;
	    				$data['makes'][] = $temp;
    				}
    				
    			}
    			for($i =0; $i < count($u_bodies); $i++){
    				$temp = array();
    				if($u_bodies[$i] != null && $u_bodies[$i] != "-"){
    					$temp['id'] = $i;
	    				$temp['value'] = $u_bodies[$i];
	    				$temp['checked'] = true;
	    				$data['bodies'][] = $temp;
    				}
    				
    			}
    			
    		}
    		if($WeeklyBudget != null){
    			$data['weekly_budget'] = $WeeklyBudget->ad360_credit;
    		}
    		if($paymentPlan != null){
    			$data['monthly_budget'] = $paymentPlan->ad360_credit;
    		}
    		if($dealertemplate != null){

    			$logo = $dealertemplate->mobile_template_logo;

    			if($logo != "" || $logo != NULL){

    				$logourl = "https://cdn-w.v12soft.com/photos/".$user->photos_directory."/".$logo;
    				$data['logo'] = $logourl;
    			}

    		}
    		return array('success'=> true, 'data' =>$data);

    	}else{
    		return array('success'=> false);

    	}
    	
    }

    public function saveForm(Request $request){

    	$data = $request->data;

    	$form = new Form();
    	$form->dealer_id = $data['dealer_id'];
    	$form->dealer_name = $data['dealer_name'];
    	$form->makes = json_encode($data['makes']);
    	$form->bodies = json_encode($data['bodies']);
    	$form->price_range = $data['price_range'];
    	$form->financing_service = $data['financing_service'];
    	$form->weekly_budget = $data['weekly_budget'];
    	$form->ad_plateform = $data['ad_plateform'];
    	$form->target_radius = $data['target_radius'];
    	$form->plateform = $data['plateform'];
    	$form->budget_split = json_encode($data['budget_split']);
    	$form->type_campaign = json_encode($data['type_campaign']);
    	$form->ad_placement = json_encode($data['ad_placement']);
    	$form->short_tagline = $data['short_tagline'];
    	$form->long_tagline = $data['long_tagline'];
    	$form->description = $data['description'];
    	$form->headline = $data['headline'];
    	$form->color_sheme = $data['color_sheme'];
    	$form->ad_template = $data['ad_template'];
    	$form->vehicle_ad = $data['vehicle_ad'];
    	$form->call_action = $data['call_action'];
    	$form->landing_page = $data['landing_page'];
    	$form->logo = "none";
    	$form->save();

    	return array('id' => $form->id);
    }

    public function uploadlogo(Request $request){

    	$image = $request->file('image');
    	$id = $request->id;
    	$form = Form::find($id);

    	if($form != null){
    		$extension = time().'.'.$image->getClientOriginalExtension();
			$image->move(public_path('/images'), $extension);

			$form->logo = $extension;
			$form->save();
    	}

    }
}
