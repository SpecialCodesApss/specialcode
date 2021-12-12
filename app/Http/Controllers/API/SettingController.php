<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;

class SettingController extends BaseController
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getByGroup($setting_group)
    {
        //Secure Settings by avoid any group_key to passed
        if($setting_group == 'mobile_API' || $setting_group =='verification'|| $setting_group =='payment_paytabs'
            || $setting_group =='SMS_malath'|| $setting_group =='google_map'|| $setting_group =='mobile_theme'
        ){
            //get settings by group key
            $settings = Setting::where('setting_group',$setting_group)->select('setting_key','setting_value')->get();
            return $this->sendResponse('data Retrieved successfully.',$settings);
        }
    }


    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function getByName($setting_key)
        {
            //Secure Settings by avoid any group_key to passed
                //get settings by group key
                $setting = Setting::where('setting_key',$setting_key)->first();
                return $this->sendResponse('data Retrieved successfully.',$setting);
        }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }



}
