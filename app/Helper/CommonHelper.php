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

    public static function get_breadcrumb() {
        $breadcrumb_str = '';
        $breadcrumb_str .= '<ol class="breadcrumb mb-0 bg-light">
                        <li class="breadcrumb-item"><a href="' . URL::to('/') . '">Home</a></li>';
        if (!empty(self::$breadcrumn_data)) {
            foreach (self::$breadcrumn_data as $breadcrumb) {
                if ($breadcrumb['url'] != '') {
                    $breadcrumb_str .= '<li class="breadcrumb-item"><a href="' . $breadcrumb['url'] . '">' . $breadcrumb['name'] . '</a></li>';
                } else {
                    $breadcrumb_str .= '<li class="breadcrumb-item">' . $breadcrumb['name'] . '</li>';
                }
            }
        }
        $breadcrumb_str .= '</ol>';
        return $breadcrumb_str;
    }

    public static function get_setting_details($fild_name, $return_fild) {
        // DB::table('site_setting_option')->select()->get();
        $result = DB::table('site_setting_option')
                ->select($return_fild)
                ->where('fild_name', $fild_name)
                ->first();
        return isset($result->$return_fild) ? $result->$return_fild : '';
    }

    public static function get_banner() {
        $slug = \Request::path();

        $result = DB::table('banner')
                ->select('*')
                ->where('page_slug', $slug)
                ->where('status', 1)
                ->get();
        return $result;
    }

    public static function get_langauge_list() {
        $result = DB::table('language')
                        ->where('status', 1)
                        ->get()->toarray();
        return $result;
    }

    public static function get_selected_language() {
        $language = session()->get('admin');

        if (!empty($language)) {
            return $language['language'];
        } else {
            return '1';
        }
    }

    public static function user_selected_language() {
        $language = session()->get('user');

        if (!empty($language)) {
            return $language['language'];
        } else {
            return '1';
        }
    }

    public static function footer_data() {
        //        FOR FOOTER
        $dataset_footer = DB::table('tbl_dataset as ds')
                        ->leftJoin('brand as b', 'b.id', '=', 'ds.fld_category_id')
                        ->select('b.title as br_name', 'b.id as br_id')
                        ->groupBy('ds.fld_category_id')
                        ->where('ds.fld_dataset_status', 1)
                        ->orderBy('ds.popular_count', 'desc')
                        ->take(5)->get();

        $reports_footer = DB::table('reports as r')
                        ->leftJoin('sub_category as sc', 'sc.id', '=', 'r.sub_category_id')
                        ->select('sc.name as sc_name', 'sc.id as sc_id')
                        ->groupBy('r.sub_category_id')
                        ->where('r.status', 1)
                        ->orderBy('r.popular_count', 'desc')
                        ->take(5)->get();

        $infographics_footer = DB::table('infographics as i')
                        ->leftJoin('sub_category as sc', 'sc.id', '=', 'i.category_id')
                        ->select('sc.name as sc_name', 'sc.id as sc_id')
                        ->groupBy('i.category_id')
                        ->where('i.status', 1)
                        ->orderBy('i.id', 'desc')
                        ->take(5)->get();

        $data = array();
        $data['dataset_footer'] = $dataset_footer;
        $data['reports_footer'] = $reports_footer;
        $data['infographics_footer'] = $infographics_footer;

        return $data;
    }

    public static function get_contact_details() {
        $data['contact_image'] = DB::table('site_setting_option')->where('fild_name', 'contact_image')->first();
        $data['contact_name'] = DB::table('site_setting_option')->where('fild_name', 'contact_name')->first();
        $data['contact_post'] = DB::table('site_setting_option')->where('fild_name', 'contact_post')->first();
        $data['contact_email'] = DB::table('site_setting_option')->where('fild_name', 'contact_email')->first();
        $data['contact_number'] = DB::table('site_setting_option')->where('fild_name', 'contact_number')->first();
        return $data;
    }

    public static function convert_time($month_quarter, $month_quarter_id) {
        $return_time = '';
        if (!empty($month_quarter)) {
            if (isset($month_quarter->return_option) && $month_quarter->return_option == 'M') {

                if (isset($month_quarter->year) && $month_quarter->year != "") {

                    $year = explode('-', $month_quarter->year);

                    $month = $month_quarter_id;

                    if ($month != "") {

                        if ($month > 3) {
                            $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/01")));
                            $return_time = 'M' . date('my', strtotime($return_date));
                        } else {
                            $date = strtotime(date($year[0] . "/" . $month . "/01"));
                            $new_date = strtotime('+ 1 year', $date);
                            $return_date = date('m/t/Y', $new_date);
                            $return_time = 'M' . date('my', strtotime($return_date));
                        }
                    }
                }
            } else if (isset($month_quarter->return_option) && $month_quarter->return_option == 'Q') {

                if (isset($month_quarter->year) && $month_quarter->year != "") {

                    $year = explode('-', $month_quarter->year);

                    $quarter = $month_quarter_id;

                    $month = '';
                    if ($quarter == 'Q1') {
                        $ret_time = 'Q01';
                        $month = '6';
                    } else if ($quarter == 'Q2') {
                        $ret_time = 'Q02';
                        $month = '9';
                    } else if ($quarter == 'Q3') {
                        $ret_time = 'Q03';
                        $month = '12';
                    } else if ($quarter == 'Q4') {
                        $ret_time = 'Q04';
                        $month = '3';
                    }

                    if ($month != "") {
                        if ($month > 3) {
                            $return_date = date('m/t/Y', strtotime(date($year[0] . "/" . $month . "/t")));
                            $return_time = $ret_time . date('y', strtotime($return_date));
                        } else {
                            $date = strtotime(date($year[0] . "/" . $month . "/t"));
                            $new_date = strtotime('+ 1 year', $date);
                            $return_date = date('m/t/Y', $new_date);
                            $return_time = $ret_time . date('y', strtotime($return_date));
                        }
                    }
                }
            }
        }

        return $return_time;
    }

}
