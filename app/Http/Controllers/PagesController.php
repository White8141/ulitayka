<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function index()
    {
        return view('sections/index');
    }

    //разлел Электронный полис
    public function how_it_works()
    {
        return view('sections/policy/how_it_works');
    }
    public function included_my_insurance()
    {
        return view('sections/policy/included_my_insurance');
    }
    public function what_your_insurance()
    {
        return view('sections/policy/what_your_insurance');
    }
    public function what_e_policy()
    {
        return view('sections/policy/what_e_policy');
    }
    public function what_data()
    {
        return view('sections/policy/what_data');
    }
    public function how_get_policy()
    {
        return view('sections/policy/how_get_policy');
    }
    public function whether_print_policy()
    {
        return view('sections/policy/whether_print_policy');
    }

    //раздел Страховой случай
    public function ins_moment()
    {
        return view('sections/case/ins_moment');
    }
    public function ins_moment_full()
    {
        return view('sections/case/ins_moment_full');
    }
    public function how_get_paid()
    {
        return view('sections/case/how_get_paid');
    }
    public function how_to_avoid()
    {
        return view('sections/case/how_to_avoid');
    }
    
    //раздел Путешественникам
    public function ins_need()
    {
        return view('sections/travel/ins_need');
    }
    public function ins_for_visa()
    {
        return view('sections/travel/ins_for_visa');
    }
    public function shengen()
    {
        return view('sections/travel/shengen');
    }
    public function ins_info()
    {
        return view('sections/travel/ins_info');
    }
    //виды страховок
    public function single_ins()
    {
        return view('sections/travel/type/single_ins');
    }
    public function group_ins()
    {
        return view('sections/travel/type/group_ins');
    }
    public function med_ins()
    {
        return view('sections/travel/type/med_ins');
    }
    public function comp_ins()
    {
        return view('sections/travel/type/comp_ins');
    }
    public function abort()
    {
        return view('sections/travel/type/abort');
    }
    public function fransh_ins()
    {
        return view('sections/travel/type/fransh_ins');
    }

    //раздел Контакты
    public function contacts()
    {
        return view('sections/contacts/contacts');
    }
    public function legend()
    {
        return view('sections/legend');
    }
    
    //страны
    public function finland()
    {
        return view('countries/finland_info');
    }
    public function australia()
    {
        return view('countries/australia_info');
    }
    public function egypt()
    {
        return view('countries/egypt_info');
    }
    public function england()
    {
        return view('countries/england_info');
    }
    public function italy()
    {
        return view('countries/italy_info');
    }
    public function norway()
    {
        return view('countries/norway_info');
    }
    public function thailand()
    {
        return view('countries/thailand_info');
    }
    public function georgia()
    {
        return view('countries/georgia_info');
    }
    public function usa()
    {
        return view('countries/usa_info');
    }
    public function israel()
    {
        return view('countries/israel_info');
    }
    public function montenegro()
    {
        return view('countries/montenegro_info');
    }
    public function germany()
    {
        return view('countries/germany_info');
    }
}
