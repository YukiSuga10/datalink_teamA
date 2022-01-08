<?php

namespace App\Http\Controllers;

use App\Models\Picmot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use function PHPUnit\Framework\returnSelf;

class MotionController extends Controller
{
    public function distance($lat1,$lon1,$lat2,$lon2){
        //２点の緯度の平均
        $lat_average = deg2rad( $lat1 + (($lat2 - $lat1) / 2) );
        //２点の緯度差
        $lat_difference = deg2rad( $lat1 - $lat2 );
        //２点の経度差
        $lon_difference = deg2rad( $lon1 - $lon2 );
        $curvature_radius_tmp = 1 - 0.00669438 * pow(sin($lat_average), 2);
        $meridian_curvature_radius = 6335439.327 / sqrt(pow($curvature_radius_tmp, 3));//子午線曲率半径
        $prime_vertical_circle_curvature_radius = 6378137 / sqrt($curvature_radius_tmp);//卯酉線曲率半径
        
        //２点間の距離
        $distance = pow($meridian_curvature_radius * $lat_difference, 2) + pow($prime_vertical_circle_curvature_radius * cos($lat_average) * $lon_difference, 2);
        $distance = sqrt($distance);

        return $distance;
    }

    public function wait()
    {
        return view('motionwaiting');
    }


    public static function motion(Request $request){
  
        $timestamp = $request->get("timeStamp");
        $motion = $request->get("flg");
        $lat =  $request->get("lat");
        $lon = $request->get("lon");

        $data = array(
            "motion" => $motion,
            "lat" => $lat,
            "lon" => $lon,
            "timestamp" => $timestamp
        );

        
        DB::table('picmot')->insert([
            "user_id" => 1,
            "picture" => "aaa",
            "motion" => $motion,
            "lat" => $lat,
            "lon" => $lon,
            "motioned_at" => $timestamp
        ]);

        $user_id = 0;
        

        sleep(1);
        
        $opponent1 = DB::table('picmot')->where("motion",(int)$data["motion"])->where("user_id" ,"<>", $user_id)->where("motioned_at", ">=", date('Y-m-d H:i:s',strtotime("-10 second")))->get();
        $opponent2 = DB::table('picmot')->where("motion",(int)$data["motion"])->where("user_id" ,"<>", $user_id)->where("motioned_at", "<=", date('Y-m-d H:i:s',strtotime("+10 second")))->get();

        // $opponent->motion
        if (isset($opponent1) || isset($opponent2)){
            if (isset($opponent1)){
                $image_address = Picmot::query()->where("motion",$opponent1['motion'])->where("motioned_at",$opponent1['motioned_at'])->where("lat",$opponent1["lat"])->where("lon",$opponent1["lon"])->first();
                return view("motionOK")->with(["image" => $image_address]);
            }else{
                $image_address = Picmot::query()->where("motion",$opponent2['motion'])->where("motioned_at",$opponent2['motioned_at'])->where("lat",$opponent2["lat"])->where("lon",$opponent2["lon"])->first();
                return view("motionOK")->with(["image" => $image_address]);
            }
            
        }else{
            return view("motionNo");
        }

        return $data;
    }



}
