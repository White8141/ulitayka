<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function legend()
    {
        return view('legend');
    }

    public function finland()
    {
        return view('finland_info');
    }

    public function ins_moment()
    {
        return view('ins_moment');
    }

    public function australia()
    {
        return view('australia_info');
    }

    public function egypt()
    {
        return view('egypt_info');
    }

    public function england()
    {
        return view('england_info');
    }

    public function italy()
    {
        return view('italy_info');
    }

    public function norway()
    {
        return view('norway_info');
    }


    public function thailand()
    {
        return view('thailand_info');
    }

    public function georgia()
    {
        return view('georgia_info');
    }

    public function usa()
    {
        return view('usa_info');
    }

    public function israel()
    {
        return view('israel_info');
    }

    public function montenegro()
    {
        return view('montenegro_info');
    }

    public function germany()
    {
        return view('germany_info');
    }

    public function ins_for_visa()
    {
        return view('ins_for_visa');
    }

    public function ins_need()
    {
        return view('ins_need');
    }

    public function shengen()
    {
        return view('shengen');
    }

    public function ins_info()
    {
        return view('ins_info');
    }

    public function single_ins()
    {
        return view('single_ins');
    }

    public function group_ins()
    {
        return view('group_ins');
    }

    public function med_ins()
    {
        return view('med_ins');
    }

    public function comp_ins()
    {
        return view('comp_ins');
    }

    public function abort()
    {
        return view('abort');
    }

    public function fransh_ins()
    {
        return view('fransh_ins');
    }

    public function how_it_works()
    {
        return view('how_it_works');
    }

    public function what_data()
    {
        return view('what_data');
    }

    public function how_to_avoid()
    {
        return view('how_to_avoid');
    }

    public function how_get_paid()
    {
        return view('how_get_paid');
    }

    public function how_get_policy()
    {
        return view('how_get_policy');
    }

    public function whether_print_policy()
    {
        return view('whether_print_policy');
    }


    public function what_your_insurance()
    {
        return view('what_your_insurance');
    }

    public function included_my_insurance()
    {
        return view('included_my_insurance');
    }

    public function insertion_insurance()
    {
        return view('insertion_insurance');
    }

    public function what_e_policy()
    {
        return view('what_e_policy');
    }

    public function police_details(Request $request)
    {
        //dd($request->details);
        return view('police_details')->with(['defaultData' => $request->details]);
    }
}
