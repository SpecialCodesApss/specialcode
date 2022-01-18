<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Abtest;

use Spatie\Permission\Models\Role;
use DB;
use Auth;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;

use App\User;

class AbtestController extends Controller
{

    use file_type_traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id=Auth::user()->id;
        $searchText=$request->searchText;
        $abtests = Abtest::where(['user_id' => $user_id ])->paginate(20);
        return view("frontend.abtests.index",compact('abtests'));
    }


    /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Abtest::all()->count()+1;


                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }

                return view('frontend.abtests.create',compact('sort_number','users'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

                $lang = App::getLocale();

            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'number'=>'required',
                    'image'=>'required',
                    'active'=>'required',
                    'sort'=>'required',

        ]);



                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["number"]=$request->number;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;
                $input["save_type"]=$request->save_type;


                 $user_id=Auth::user()->id;
             $input['user_id']=$user_id;







                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/abtests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }



                $Abtest = Abtest::create($input);

                //store images if found
                //store files if found


                if($input['save_type']=="save_and_add_new"){
                    return redirect('abtests/create')
                        ->with('success',trans('admin.info_added'));
                }
                else{
                    return redirect('abtests')
                        ->with('success',trans('admin.info_added'));
                }

            }


            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
            $lang = App::getLocale();

            $user_id=Auth::user()->id;


               $Abtest = Abtest::where('id', $id)->where(['user_id' => $user_id ])->first();

        if(isset($Abtest)){


        }

        if (is_null($Abtest)) {
            return $this->sendError('Abtest not found.');
        }


                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }




                return view('frontend.abtests.show',compact('Abtest'  ,'users' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {

            $lang = App::getLocale();
                $Abtest = Abtest::find($id);




                $user_ids=DB::table("users")->orderBy('id', 'asc')->get();
                $users=[];
                foreach ($user_ids as $info){
                    $users[$info->id]=$info->email;
                }






                return view('frontend.abtests.edit',compact('Abtest'
                ,'users' ));
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


                $input["name_ar"]=$request->name_ar;
                $input["name_en"]=$request->name_en;
                $input["number"]=$request->number;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;
            $user_id=Auth::user()->id;
             $input['user_id']=$user_id;




            $this->validate($request, [
            'name_ar'=>'required',
                    'name_en'=>'required',
                    'number'=>'required',
                    'active'=>'required',
                    'sort'=>'required',

        ]);



                $old_image=Abtest::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/abtests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }







                $old_image=Abtest::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/abtests/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }


                 $Abtest=Abtest::where(['id'=>$id ])->where(['user_id' => $user_id ])->update($input);

        //store images if found
        //store files if found

        $Abtest = Abtest::where(['id'=>$id , 'user_id' => $user_id ])->get();

                return redirect('abtests')
                    ->with('success',trans('admin.info_edited'));
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {

        //delete files
         // delete files and images

                $old_image=Abtest::find($id)->image;
                 File::delete($old_image);

        $user_id=Auth::user()->id;

         // delete files and images in sub tables if this module has mutiple files or images


        Abtest::where(['id'=>$id ])->where(['user_id' => $user_id ])->delete();

                return redirect('abtests')
                    ->with('success',trans('admin.info_deleted'));
            }

            //additional Functions





}
