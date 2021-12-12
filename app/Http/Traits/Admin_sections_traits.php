<?php
namespace App\Http\Traits;
use App\Models\Admin_sections;

trait Admin_sections_traits{

    public function getAdminSections(){
        $sections=Admin_sections::where([
            'parent_section_id'=>null,
            ])->orWhere([
            'parent_section_id'=>'',
        ])->get();
        foreach ($sections as $section){
            if($section['is_drop_menu']==1){
                $section['sub_sections']=Admin_sections::where('parent_section_id',$section['id'])->get();
            }
        }
        return $sections;
    }

}
