<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

use Spatie\Permission\Models\Role;
use DB;
use File;
use DataTables;
use Illuminate\Support\Facades\App;

use App\News_categorie;use App\News_newspaper_publisher;use App\News_auther;use App\Countrie;use App\Country_citie;use App\News_types_tag;use App\Companie;use App\Language;

class NewsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        App::setLocale('ar');

        $this->middleware('permission:News-list', ['only' => ['index','show']]);
        $this->middleware('permission:News-create', ['only' => ['create','store']]);
        $this->middleware('permission:News-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:News-delete', ['only' => ['destroy']]);

    }

            /**
             * Display a listing of the resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function index(Request $request)
            {

                if ($request->ajax()) {
                    $data = News::query();








                    return Datatables::eloquent($data)


                     ->editColumn('news_languages', function(News $data) {
                            $news_languages_data ='';
                            $data_news_languages =json_decode($data->news_languages);
                            foreach ($data_news_languages as $info){
                                $Language = Language::find($info);
                                $news_languages_data.= $Language->name_ar .' - ';
                            }
                                return $news_languages_data;
                        })


                     ->editColumn('category_id', function(News $data) {
                            $category_id_data ='';
                            $info =$data->category_id;
                                $News_categorie = News_categorie::find($info);
                                $category_id_data.= $News_categorie->name_ar ;
                                return $category_id_data;
                        })

                     ->editColumn('publisher_newspaper_id', function(News $data) {
                            $publisher_newspaper_id_data ='';
                            $info =$data->publisher_newspaper_id;
                                $News_newspaper_publisher = News_newspaper_publisher::find($info);
                                $publisher_newspaper_id_data.= $News_newspaper_publisher->newspaper_name_ar ;
                                return $publisher_newspaper_id_data;
                        })

                     ->editColumn('auther_id', function(News $data) {
                            $auther_id_data ='';
                            $info =$data->auther_id;
                                $News_auther = News_auther::find($info);
                                $auther_id_data.= $News_auther->name_ar ;
                                return $auther_id_data;
                        })

                     ->editColumn('country_id', function(News $data) {
                            $country_id_data ='';
                            $info =$data->country_id;
                                $Countrie = Countrie::find($info);
                                $country_id_data.= $Countrie->name_ar ;
                                return $country_id_data;
                        })

                     ->editColumn('city_id', function(News $data) {
                            $city_id_data ='';
                            $info =$data->city_id;
                                $Country_citie = Country_citie::find($info);
                                $city_id_data.= $Country_citie->name_ar ;
                                return $city_id_data;
                        })

                     ->editColumn('company_id', function(News $data) {
                            $company_id_data ='';
                            $info =$data->company_id;
                                $Companie = Companie::find($info);
                                $company_id_data.= $Companie->company_name_ar ;
                                return $company_id_data;
                        })


                     ->editColumn('is_video_news', function(News $data) {
                            if($data->is_video_news != null){
                              return "نعم";
                            }
                            else{
                                return "لا";
                            }
                        })

                     ->editColumn('published', function(News $data) {
                            if($data->published != null){
                              return "نعم";
                            }
                            else{
                                return "لا";
                            }
                        })

                     ->editColumn('is_comment_allowed', function(News $data) {
                            if($data->is_comment_allowed != null){
                              return "نعم";
                            }
                            else{
                                return "لا";
                            }
                        })

                     ->editColumn('is_breaking_news', function(News $data) {
                            if($data->is_breaking_news != null){
                              return "نعم";
                            }
                            else{
                                return "لا";
                            }
                        })

                     ->editColumn('is_slider_news', function(News $data) {
                            if($data->is_slider_news != null){
                              return "نعم";
                            }
                            else{
                                return "لا";
                            }
                        })

                     ->editColumn('is_company_news', function(News $data) {
                            if($data->is_company_news != null){
                              return "نعم";
                            }
                            else{
                                return "لا";
                            }
                        })


                        ->order(function ($data) {
                            $data->orderBy('id', 'desc');
                        })
                        ->addColumn('action', function($row){
                            $row_id=$row->id;
                            $form_id="delete_News_form_".$row_id;
                            $btn='<div style="display:inline-block; width: 210px;">
            <a class="btn btn-info" href="news/'.$row_id.'">عرض</a>
            <a class="btn btn-primary" href="news/'.$row_id.'/edit">تعديل</a>
            <form id="'.$form_id.'" method="POST" action="news/'.$row_id.'" style="display:inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="'.csrf_token().'">
                                        <button type="button" onclick="return deleteItem('."'$form_id'".')" class="btn btn-danger">حذف</button>
                                    </form></div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])

                        ->make(true);
                }
                return view('backend.news.index');

            }



            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                $sort_number = News::all()->count()+1;


                $category_ids=DB::table("news_categories")->orderBy('id', 'asc')->get();
                $news_categories=[];
                foreach ($category_ids as $info){
                    $news_categories[$info->id]=$info->name_ar;
                }

                $publisher_newspaper_ids=DB::table("news_newspaper_publishers")->orderBy('id', 'asc')->get();
                $news_newspaper_publishers=[];
                foreach ($publisher_newspaper_ids as $info){
                    $news_newspaper_publishers[$info->id]=$info->newspaper_name_ar;
                }

                $auther_ids=DB::table("news_authers")->orderBy('id', 'asc')->get();
                $news_authers=[];
                foreach ($auther_ids as $info){
                    $news_authers[$info->id]=$info->name_ar;
                }

                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }

                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }

                $company_ids=DB::table("companies")->orderBy('id', 'asc')->get();
                $companies=[];
                foreach ($company_ids as $info){
                    $companies[$info->id]=$info->company_name_ar;
                }

                $languages=DB::table("languages")->orderBy('id', 'asc')->get();

                return view('backend.news.create',compact('sort_number','news_categories','news_newspaper_publishers','news_authers','countries','country_cities','companies','languages'));
            }

            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(Request $request)
            {

            $this->validate($request, [
            'category_id'=>'required',
                    'title_ar'=>'required',
                    'sub_title_ar'=>'required',
                    'content_ar_html'=>'required',
                    'image'=>'required',
                    'publish_date'=>'required',
                    'permalink_tag'=>'required|unique:news',
                    'news_languages'=>'required',
                    'sort'=>'required',

        ]);


                $input = $request->all();


                        if(isset($input['is_video_news'])){
                        $input['is_video_news']= 1;
                    }

                        if(isset($input['published'])){
                        $input['published']= 1;
                    }

                        if(isset($input['is_comment_allowed'])){
                        $input['is_comment_allowed']= 1;
                    }

                        if(isset($input['is_breaking_news'])){
                        $input['is_breaking_news']= 1;
                    }

                        if(isset($input['is_slider_news'])){
                        $input['is_slider_news']= 1;
                    }

                        if(isset($input['is_company_news'])){
                        $input['is_company_news']= 1;
                    }


                $news_types_tags=$input["news_types_tags"];
                $news_types_tags = str_replace(",","\",\"",$news_types_tags);
                $news_types_tags = "[\"".$news_types_tags."\"]";
                $input["news_types_tags"]=$news_types_tags;$input['news_languages']=json_encode($input['news_languages']);



                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                    }
                }



                $News = News::create($input);

                //store images if found
                //store files if found


                if($input['save_type']=="save_and_add_new"){
                    return redirect()->route('news.create')
                        ->with('success','تم اضافة البيانات بنجاح');
                }
                else{
                    return redirect()->route('news.index')
                        ->with('success','تم اضافة البيانات بنجاح');
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
                $News = News::find($id);




                $category_ids=DB::table("news_categories")->orderBy('id', 'asc')->get();
                $news_categories=[];
                foreach ($category_ids as $info){
                    $news_categories[$info->id]=$info->name_ar;
                }

                $publisher_newspaper_ids=DB::table("news_newspaper_publishers")->orderBy('id', 'asc')->get();
                $news_newspaper_publishers=[];
                foreach ($publisher_newspaper_ids as $info){
                    $news_newspaper_publishers[$info->id]=$info->newspaper_name_ar;
                }

                $auther_ids=DB::table("news_authers")->orderBy('id', 'asc')->get();
                $news_authers=[];
                foreach ($auther_ids as $info){
                    $news_authers[$info->id]=$info->name_ar;
                }

                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }

                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }

                $company_ids=DB::table("companies")->orderBy('id', 'asc')->get();
                $companies=[];
                foreach ($company_ids as $info){
                    $companies[$info->id]=$info->company_name_ar;
                }

                $languages=DB::table("languages")->orderBy('id', 'asc')->get();

                 $news_types_tags = $News->news_types_tags;
                $news_types_tags = str_replace("[",'',$news_types_tags);
                $news_types_tags = str_replace("]",'',$news_types_tags);
                $news_types_tags = str_replace("\"",'',$news_types_tags);
                $News->news_types_tags = $news_types_tags;$News->news_languages=json_decode($News->news_languages);


                return view('backend.news.show',compact('News'  ,'news_categories','news_newspaper_publishers','news_authers','countries','country_cities','companies','languages' ));

            }


            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit($id)
            {
                $News = News::find($id);




                $category_ids=DB::table("news_categories")->orderBy('id', 'asc')->get();
                $news_categories=[];
                foreach ($category_ids as $info){
                    $news_categories[$info->id]=$info->name_ar;
                }

                $publisher_newspaper_ids=DB::table("news_newspaper_publishers")->orderBy('id', 'asc')->get();
                $news_newspaper_publishers=[];
                foreach ($publisher_newspaper_ids as $info){
                    $news_newspaper_publishers[$info->id]=$info->newspaper_name_ar;
                }

                $auther_ids=DB::table("news_authers")->orderBy('id', 'asc')->get();
                $news_authers=[];
                foreach ($auther_ids as $info){
                    $news_authers[$info->id]=$info->name_ar;
                }

                $country_ids=DB::table("countries")->orderBy('id', 'asc')->get();
                $countries=[];
                foreach ($country_ids as $info){
                    $countries[$info->id]=$info->name_ar;
                }

                $city_ids=DB::table("country_cities")->orderBy('id', 'asc')->get();
                $country_cities=[];
                foreach ($city_ids as $info){
                    $country_cities[$info->id]=$info->name_ar;
                }

                $company_ids=DB::table("companies")->orderBy('id', 'asc')->get();
                $companies=[];
                foreach ($company_ids as $info){
                    $companies[$info->id]=$info->company_name_ar;
                }

                $languages=DB::table("languages")->orderBy('id', 'asc')->get();

                $news_types_tags = $News->news_types_tags;
                $news_types_tags = str_replace("[",'',$news_types_tags);
                $news_types_tags = str_replace("]",'',$news_types_tags);
                $news_types_tags = str_replace("\"",'',$news_types_tags);
                $News->news_types_tags = $news_types_tags;$News->news_languages=json_decode($News->news_languages);




                return view('backend.news.edit',compact('News' ,'news_categories','news_newspaper_publishers','news_authers','countries','country_cities','companies','languages' ));
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

            $News = News::find($id);

            $this->validate($request, [
            'category_id'=>'required',
                    'title_ar'=>'required',
                    'sub_title_ar'=>'required',
                    'content_ar_html'=>'required',
                    'publish_date'=>'required',
                    'permalink_tag'=>'required|unique:news,permalink_tag,'.$News->id.',id',
                    'news_languages'=>'required',
                    'sort'=>'required',

        ]);


                $input = $request->all();


                        if(isset($input['is_video_news'])){
                        $input['is_video_news']= 1;
                    }

                        if(isset($input['published'])){
                        $input['published']= 1;
                    }

                        if(isset($input['is_comment_allowed'])){
                        $input['is_comment_allowed']= 1;
                    }

                        if(isset($input['is_breaking_news'])){
                        $input['is_breaking_news']= 1;
                    }

                        if(isset($input['is_slider_news'])){
                        $input['is_slider_news']= 1;
                    }

                        if(isset($input['is_company_news'])){
                        $input['is_company_news']= 1;
                    }


                $news_types_tags=$input["news_types_tags"];
                $news_types_tags = str_replace(",","\",\"",$news_types_tags);
                $news_types_tags = "[\"".$news_types_tags."\"]";
                $input["news_types_tags"]=$news_types_tags;$input['news_languages']=json_encode($input['news_languages']);



                $old_image=News::find($id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                    if ($request->file('image') && $request->file('image')->isValid()) {
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/news/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                    }
                }



                $News->update($input);

                //store images if found
                //store files if found

                return redirect()->route('news.index')
                    ->with('success','تم تحديث البيانات بنجاح');
            }

            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
                 // delete files and images

                $old_image=News::find($id)->image;
                 File::delete($old_image);


                 // delete files and images in sub tables if this module has mutiple files or images


                News::find($id)->delete();
                return redirect()->route('news.index')
                    ->with('success','تم حذف البيانات بنجاح');
            }

            //additional Functions




            public function checknews_types_tags_for_news_forFieldnews_types_tags(Request $request){
        $news_types_tags= $request["name_ar"];
        $News_types_tag = News_types_tag::where("name_ar",$news_types_tags)->first();
        if(isset($News_types_tag)){
            return "true";
        }
        else{
            return "false";
        }
    }
    public function searchnews_types_tags_for_news_forFieldnews_types_tags(Request $request){
        $search_text = $request["search_text"];
        $response_array=[];
        $news_types_tags = News_types_tag::where("name_ar",'like','%'.$search_text.'%')->get('name_ar');
        foreach ($news_types_tags as $News_types_tag){
            array_push($response_array,$News_types_tag->name_ar);
        }
        return $response_array;
    }
            
            
            

        }