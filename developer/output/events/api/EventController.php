<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Event;

use Validator;
use File;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $searchText=$request->searchText;
        $events = Event:: 
        where(function($q) use ($searchText){
            $q->orWhere("name_ar","like","%".$searchText."%")->orWhere("name_en","like","%".$searchText."%")->orWhere("description_html_ar","like","%".$searchText."%")->orWhere("description_html_en","like","%".$searchText."%")->orWhere("city","like","%".$searchText."%")->orWhere("image","like","%".$searchText."%")->orWhere("date","like","%".$searchText."%")->orWhere("website","like","%".$searchText."%");})->paginate(20);
        return $this->sendResponse(trans("events.Event_read"),$events->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
       

        $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'description_html_ar'=>'required',
                'description_html_en'=>'required',
                'image'=>'required',
                'date'=>'required',
                'active'=>'required',
                
        ]);
        

        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/events/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                }
                

        $Event = Event::create($input);

        
        

        return $this->sendResponse(trans("events.Event_create"),$Event->toArray());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {

         
        $Event = Event::where('id', $id)->first();
        
        if(isset($Event)){
        
        
        }

        if (is_null($Event)) {
            return $this->sendError('Event not found.');
        }

        return $this->sendResponse(trans("events.Event_read"),$Event->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$Event_id)
    {
        $input = $request->except('images','files','_method');
        

         $validator=
            Validator::make($input, [
            'name_ar'=>'required',
                'name_en'=>'required',
                'description_html_ar'=>'required',
                'description_html_en'=>'required',
                'date'=>'required',
                'active'=>'required',
                
        ]);
        
        if($validator->fails()){
            return $this->sendError($validator->errors()->first());
        }

        
                $old_image=Event::find($Event_id)->image;
                if ($request->hasFile('image')) {
                    $document = $request->file('image');
                    $ext = $document->getClientOriginalExtension();
                        $imageName = date('YmdHis') . ".$ext";
                        $path = 'storage/images/events/image/';
                        $request->file('image')->move($path, $imageName);
                        $input['image'] = $path.$imageName;
                        File::delete($old_image);
                    }
                    else{
                    $input['image'] =$old_image;
                }
                

        $Event=Event::where(['id'=>$Event_id ])->update($input);

        
        

        $Event = Event::where(['id'=>$Event_id , 'user_id' => $user_id ])->get();
        return $this->sendResponse(trans("events.Event_update"),$Event->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$Event_id)
    {
        //delete files
         // delete files and images
        
                $old_image=Event::find($Event_id)->image;
                 File::delete($old_image);
                
        
         // delete files and images in sub tables if this module has mutiple files or images
        
        Event::where(['id'=>$Event_id ])->delete();



        return $this->sendResponse(trans("events.Event_delete"));

    }

     //additional Functions
            
            

}
