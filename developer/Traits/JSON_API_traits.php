<?php
namespace Developer\Traits;
use DB;
use File;
use App\Api_request;

trait JSON_API_traits{

    public function store_new_api_request($table_name,$controller_name,$input,$table_fields){
        $api_requestinput['name']=$table_name;
        $api_requestinput['controller_name']=$controller_name;
        $api_requestinput['Mobile_List']= isset($input['Mobile_List']) ? 1 : 0 ;
        $api_requestinput['Mobile_Create']= isset($input['Mobile_Create']) ? 1 : 0 ;
        $api_requestinput['Mobile_Update']= isset($input['Mobile_Update']) ? 1 : 0 ;
        $api_requestinput['Mobile_View']= isset($input['Mobile_View']) ? 1 : 0 ;
        $api_requestinput['Mobile_Delete']= isset($input['Mobile_Delete']) ? 1 : 0 ;

        $api_requestinput['list_authorization_status']= isset($input['Mobile_require_auth_user_List']) ? 1 : 0 ;
        $api_requestinput['create_authorization_status']= isset($input['Mobile_require_auth_user_Create']) ? 1 : 0 ;
        $api_requestinput['update_authorization_status']= isset($input['Mobile_require_auth_user_Update']) ? 1 : 0 ;
        $api_requestinput['view_authorization_status']= isset($input['Mobile_require_auth_user_View']) ? 1 : 0 ;
        $api_requestinput['delete_authorization_status']= isset($input['Mobile_require_auth_user_Delete']) ? 1 : 0 ;


        $parameters='';
        $second_item=false;
        foreach ($table_fields as $table_field){
            $comma= ($second_item==true) ? ',' : '';
            if(isset($input[$table_field.'_mobileAPIActive'])){
                $parameters=$parameters.$comma.'"'.$table_field.'"';
                $second_item=true;
            }
        }
        if($input['table_has_multiple_images']=='1'){
            $parameters=$parameters.$comma.'"images"';
        }
        if($input['table_has_multiple_files']=='1'){
            $parameters=$parameters.$comma.'"files"';
        }
        $parameters="[$parameters]";
        $api_requestinput['parameters']=$parameters;

        $is_set_tableName=Api_request::where('name',$table_name)->first();
        if(!isset($is_set_tableName)){
            Api_request::create($api_requestinput);
        }
        else{

            //first clear old json code
            $Generated_JSON_APIs_Requests = $this->get_Gnerated_JSON_API_code($table_name);
            //update this auto generated code from json file
            $JSON_Content = file('developer/Framework_V_1.6.postman_collection.json');
            $JSON_Content = implode($JSON_Content);
            $JSON_Content=str_replace($Generated_JSON_APIs_Requests,'',$JSON_Content);
            $new_file = 'Framework_V_1.6.postman_collection.json';
            $destinationPath="developer/";
            File::put($destinationPath.$new_file,$JSON_Content);

            $is_set_tableName->update($api_requestinput);
        }
    }

    public function Update_JSON_API_File($table_name){

        $Generated_JSON_APIs_Requests = $this->get_Gnerated_JSON_API_code($table_name);

        $Generated_JSON_APIs_Requests.='
        ,{"message": "Comment"}
        ';
        //delete this auto generated code from json file
        $JSON_Content = file('developer/Framework_V_1.6.postman_collection.json');
        $JSON_Content = implode($JSON_Content);
        $JSON_Content=str_replace(',{"message": "Comment"}',$Generated_JSON_APIs_Requests,$JSON_Content);
        $new_file = 'Framework_V_1.6.postman_collection.json';
        $destinationPath="developer/";
        File::put($destinationPath.$new_file,$JSON_Content);

    }

    public function get_Gnerated_JSON_API_code($table_name){
        $api_request=Api_request::where('name',$table_name)->first();
        $Generated_JSON_APIs_Requests='';

        $list_code='';
        $create_code='';
        $update_code='';
        $view_code='';
        $delete_code='';
        $comma='';
        if($api_request['Mobile_List']==1){
            if($api_request['list_authorization_status']==1){
                $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
            }else{  $header='"header": [],';}
            $list_code=$comma.'{
                        "name": "List '.$api_request['name'].'",
                        "request": {
                            "method": "GET",
                            '.$header.'
                            "url": {
                                "raw": "{{url}}/api/'.$api_request['name'].'",
                                "host": [
                                    "{{url}}"
                                ],
                                "path": [
                                    "api",
                                    "'.$api_request['name'].'"
                                ]
                            }
                        },
                        "response": []
                    }';
            $comma=',';
        }

        if($api_request['Mobile_Create']==1){
            if($api_request['create_authorization_status']==1){
                $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
            }else{  $header='"header": [],';}
            $parameters=$api_request['parameters'];
            $parameters=\GuzzleHttp\json_decode($parameters);

            $parameters_code='';
            $first_item=true;

            foreach ($parameters as $parameter){
                $type='text';
                if(strpos($parameter,'image') !== false ){
                    $type='file';
                }
                $comma= ($first_item==true) ? '' : ',';
                $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                $first_item=false;
            }
            $create_code=$comma.'{
					"name": "Create '.$api_request['name'].'",
					"request": {
						"method": "POST",
						'.$header.'
						"body": {
							"mode": "formdata",
							"formdata": [
								'.$parameters_code.'
							]
						},
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'"
							]
							
						}
					},
					"response": []
				}';
            $comma=',';
        }

        if($api_request['Mobile_Update']==1){

            if($api_request['update_authorization_status']==1){
                $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
            }else{  $header='"header": [],';}
            $parameters=$api_request['parameters'];
            $parameters=\GuzzleHttp\json_decode($parameters);

            $parameters_code='';
            $first_item=true;
            foreach ($parameters as $parameter){
                $type='text';
                if(strpos($parameter,'image') !== false ){
                    $type='file';
                }
                $comma= ($first_item==true) ? '' : ',';
                $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                $first_item=false;
            }
            $update_code=$comma.'{
					"name": "Update '.$api_request['name'].'",
					"request": {
						"method": "POST",
						'.$header.'
						"body": {
							"mode": "formdata",
							"formdata": [
								'.$parameters_code.'
							]
						},
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'/1",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'",
								"1"
							],
							"query": [
								{
									"key": "_method",
									"value": "PUT"
								}
							]
						}
					},
					"response": []
				}';
            $comma=',';
        }


        if($api_request['Mobile_View']==1){
            if($api_request['view_authorization_status']==1){
                $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "text"
							}
						],
                    ';
            }else{  $header='"header": [],';}
            $parameters=$api_request['parameters'];
            $parameters=\GuzzleHttp\json_decode($parameters);

            $parameters_code='';
            $first_item=true;
            foreach ($parameters as $parameter){
                $type='text';
                if(strpos($parameter,'image') !== false ){
                    $type='file';
                }
                $comma= ($first_item==true) ? '' : ',';
                $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                $first_item=false;
            }
            $view_code=$comma.'{
					"name": "Show '.$api_request['name'].'",
					"request": {
						"method": "GET",
						'.$header.'
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'/1",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'",
								"1"
							]
						}
					},
					"response": []
				}';
            $comma=',';
        }


        if($api_request['Mobile_Delete']==1){
            if($api_request['delete_authorization_status']==1){
                $header='"header": [
							{
								"key": "Accept",
								"value": "application/json",
								"type": "text"
							},
							{
								"key": "Authorization",
								"value": "{{token}}",
								"type": "text"
							},
							{
								"key": "language",
								"value": "ar",
								"type": "'.$type.'"
							}
						],
                    ';
            }else{  $header='"header": [],';}
            $parameters=$api_request['parameters'];
            $parameters=\GuzzleHttp\json_decode($parameters);

            $parameters_code='';
            $first_item=true;
            foreach ($parameters as $parameter){
                $type='text';
                if(strpos($parameter,'image') !== false ){
                    $type='file';
                }
                $comma= ($first_item==true) ? '' : ',';
                $parameters_code=$parameters_code.'
                                '.$comma.'{
                                    "key": "'.$parameter.'",
                                    "value": "'.$parameter.'",
                                    "type": "'.$type.'"
                                }
                    ';
                $first_item=false;
            }
            $delete_code=$comma.'{
					"name": "Delete '.$api_request['name'].'",
					"request": {
						"method": "DELETE",
						'.$header.'
						"url": {
							"raw": "{{url}}/api/'.$api_request['name'].'/1",
							"host": [
								"{{url}}"
							],
							"path": [
								"api",
								"'.$api_request['name'].'",
								"1"
							]
						}
					},
					"response": []
				}';
            $comma=',';
        }

        $Generated_JSON_APIs_Requests=$Generated_JSON_APIs_Requests.
            ',{
                "name": "'.$api_request['name'].'",
                "item": [
                       '.$list_code.'
                       '.$create_code.'
                       '.$update_code.'
                       '.$view_code.'
                       '.$delete_code.'    
                ],
                "protocolProfileBehavior": {}
            }';

        return $Generated_JSON_APIs_Requests;
    }

}