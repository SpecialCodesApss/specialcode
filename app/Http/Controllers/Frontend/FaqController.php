<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;

use Spatie\Permission\Models\Role;
use DB;
use Auth;
use File;
use DataTables;
use Illuminate\Support\Facades\App;
use \App\Http\Traits\file_type_traits;



class FaqController extends Controller
{

    use file_type_traits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $faqs = Faq::paginate(20);
        return view("frontend.faqs.index",compact('faqs'));
    }


    /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {

                $lang = App::getLocale();
                $sort_number = Faq::all()->count()+1;

            
                return view('frontend.faqs.create',compact('sort_number'));
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
            'question_ar'=>'required',
                    'question_en'=>'required',
                    'answer_ar'=>'required',
                    'answer_en'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

                
                $input["question_ar"]=$request->question_ar;
                $input["question_en"]=$request->question_en;
                $input["answer_ar"]=$request->answer_ar;
                $input["answer_en"]=$request->answer_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;


                 

                

                

                


                $Faq = Faq::create($input);

                //store images if found
                //store files if found


                if($request->save_type=="save_and_add_new"){
                    return redirect('faqs/create')
                        ->with('success',trans('admin_messages.info_added'));
                }
                else{
                    return redirect('faqs')
                        ->with('success',trans('admin_messages.info_added'));
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

            

               $Faq = Faq::where('id', $id)->first();

        if(isset($Faq)){
        
        
        }

        if (is_null($Faq)) {
            return back()->with('error',trans('admin_messages.Page not found.'));
        }

                
                 


                return view('frontend.faqs.show',compact('Faq'   ));

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
                $Faq = Faq::find($id);
                
                

                
                

                


                return view('frontend.faqs.edit',compact('Faq'
                 ));
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

            
                $input["question_ar"]=$request->question_ar;
                $input["question_en"]=$request->question_en;
                $input["answer_ar"]=$request->answer_ar;
                $input["answer_en"]=$request->answer_en;
                $input["active"]=$request->active;
                $input["sort"]=$request->sort;
            


              
            $this->validate($request, [
            'question_ar'=>'required',
                    'question_en'=>'required',
                    'answer_ar'=>'required',
                    'answer_en'=>'required',
                    'active'=>'required',
                    'sort'=>'required',
                    
        ]);
        

 

                

                

                

                 $Faq=Faq::where(['id'=>$id ])->update($input);

        //store images if found
        //store files if found

        $Faq = Faq::where(['id'=>$id , 'user_id' => $user_id ])->get();

                return redirect('faqs')
                    ->with('success',trans('admin_messages.info_edited'));
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
        
        
         // delete files and images in sub tables if this module has mutiple files or images
        

        Faq::where(['id'=>$id])->delete();

                return redirect('faqs')
                    ->with('success',trans('admin_messages.info_deleted'));
            }

            //additional Functions
            
            


            
}
