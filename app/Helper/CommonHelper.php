<?php
namespace App\Helper;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
 
class CommonHelper {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    private static $breadcrumn_data = [];
    public static function add_breadcrumb($pagename, $url = '') {
        
        $temp_array = array();
        $temp_array['name'] = $pagename;
        $temp_array['url'] = $url;
        self::$breadcrumn_data[] = $temp_array;
    }
    
    public static function get_breadcrumb()
    {
        $breadcrumb_str = '';
        $breadcrumb_str .= '<ol class="breadcrumb mb-0 bg-light">
                        <li class="breadcrumb-item"><a href="'.URL::to('/').'">Home</a></li>';
        if(!empty(self::$breadcrumn_data)){
            foreach(self::$breadcrumn_data as $breadcrumb){
                if($breadcrumb['url'] != ''){
                    $breadcrumb_str .= '<li class="breadcrumb-item"><a href="'.$breadcrumb['url'].'">'.$breadcrumb['name'].'</a></li>';
                }else{
                    $breadcrumb_str .= '<li class="breadcrumb-item">'.$breadcrumb['name'].'</li>';
                }
            }
        }
        $breadcrumb_str .= '</ol>';
        return $breadcrumb_str;
    }
    public static function get_setting_details($fild_name,$return_fild){
       // DB::table('site_setting_option')->select()->get();
        $result =  DB::table('site_setting_option')
                    ->select($return_fild)
                    ->where('fild_name',$fild_name)
                    ->first();
        return isset($result->$return_fild) ? $result->$return_fild : '' ;
    }
    public static function get_banner(){
         $slug =  \Request::path();
        
        $result =  DB::table('banner')
                    ->select('*')
                    ->where('page_slug',$slug)
                    ->where('status',1)
                    ->get();
        return $result;
    }
     public static function get_langauge_list(){
         $result =  DB::table('language')
                    ->where('status',1)
                    ->get()->toarray();
        return $result;
     }
     public static function get_selected_language(){
         $language =  session()->get('admin');
         
         if(!empty($language)){
            return $language['language'];
         }else{
             return '1';
         }
     }
     public static function user_selected_language(){
         $language =  session()->get('user');
         
         if(!empty($language)){
            return $language['language'];
         }else{
             return '1';
         }
     }
     
     public static function footer_data(){
         //        FOR FOOTER
        $dataset_footer = DB::table('tbl_dataset as ds')
                        ->leftJoin('brand as b', 'b.id', '=', 'ds.fld_category_id')
                        ->select('b.title as br_name','b.id as br_id')
                        ->groupBy('ds.fld_category_id')
                        ->where('ds.fld_dataset_status',1)
                        ->orderBy('ds.popular_count', 'desc')
                        ->take(5)->get();
        
        $reports_footer = DB::table('reports as r')
                        ->leftJoin('sub_category as sc', 'sc.id', '=', 'r.sub_category_id')
                        ->select('sc.name as sc_name','sc.id as sc_id')
                        ->groupBy('r.sub_category_id')
                        ->where('r.status',1)
                        ->orderBy('r.popular_count', 'desc')
                        ->take(5)->get();
        
        $infographics_footer = DB::table('infographics as i')
                            ->leftJoin('sub_category as sc', 'sc.id', '=', 'i.category_id')
                            ->select('sc.name as sc_name','sc.id as sc_id')
                            ->groupBy('i.category_id')
                            ->where('i.status',1)
                            ->orderBy('i.id', 'desc')
                            ->take(5)->get();
        
        $data = array();
        $data['dataset_footer'] = $dataset_footer;
        $data['reports_footer'] = $reports_footer;
        $data['infographics_footer'] = $infographics_footer;
        
        return $data;
     }
     public static function get_contact_details(){
        $data['contact_image'] = DB::table('site_setting_option')->where('fild_name','contact_image')->first();
        $data['contact_name'] = DB::table('site_setting_option')->where('fild_name','contact_name')->first();
        $data['contact_post'] = DB::table('site_setting_option')->where('fild_name','contact_post')->first();
        $data['contact_email'] = DB::table('site_setting_option')->where('fild_name','contact_email')->first();
        $data['contact_number'] = DB::table('site_setting_option')->where('fild_name','contact_number')->first();
        return $data;
     }
}