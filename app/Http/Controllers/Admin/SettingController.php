<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:Setting-show')->only('show');
        $this->middleware('permission:Setting-list')->only('index');
        $this->middleware('permission:Setting-create')->only('create','store');
        $this->middleware('permission:Setting-edit')->only('edit','update');
        $this->middleware('permission:Setting-delete')->only('destroy');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($key)
    {
        $Setting = Setting::where('setting_key',$key)->first();
        return view('admin.settings.edit',compact('Setting'));
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

        $this->validate($request, [
            'setting_value'=>'required',
        ]);

        $input = $request->all();

        $Setting = Setting::find($id);
        $Setting->update($input);

        return redirect()->back()
            ->with('success','تم تحديث البيانات بنجاح');
    }



}
