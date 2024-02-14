<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use App\Models\Userinfo;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function dashboardpage(){
        return view('layout.sidenav-layout');
    }
    public function DistrictCreate(){
        return view('Dashboard.Division');
    }
    public function CreateDivision(Request $request){
    return Division::create([
        'name'=>$request->input('name'),
      ]);
    }
    public function DivisionList(){
        return Division::all();
    }
    public function Districtpage(){
        return view('Dashboard.District');
    }

    public function DistrictCreatestore(Request $request){
         return  District::create([
                'name'=>$request->input('DistrictName'),
                'division_id'=>$request->input('DivisionName_ID'),
            ]);
    }

    public function userpage(){
        return view('Dashboard.user');
    }
    public function DistrictList($divisionId){
        return District::where('division_id','=',$divisionId)->get();
    }

    public function userstore(Request $request){
      return  Userinfo::create([
            'UserName'=>$request->input('UserName'),
            'UserEmail'=>$request->input('UserEmail'),
            'UserMobile'=>$request->input('UserMobile'),
            'division_id'=>$request->input('DivisionName_ID'),
            'district_id'=>$request->input('DistrictName_ID'),

        ]);
    }

}


