<?php
Auth::routes();

//Route::post('/policies', 'PolicyController@select')->name('policy_select');   policies_list
Route::match(['get', 'post'], '/policy', 'PolicyController@create')->name('policy_create');
Route::match(['get', 'post'], '/policy/{policy}', 'PolicyController@edit')->name('policy_edit');
Route::post('/policy/calc', 'PolicyController@calc')->name('policy_calc');
Route::put('/policy', 'PolicyController@save')->name('policy_save');
Route::delete('/policy/{policy}', 'PolicyController@delete')->name('policy_delete');

Route::post('/calculator', 'CalcController@calculate')->name('calculate');
Route::post('/calcajax', 'CalcController@ajax')->name('calcajax');
Route::post('/getData', 'CalcController@getData')->name('getData');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/policies', 'HomeController@policies_list')->name('policies_list');
Route::post('/home/user', 'HomeController@user_save')->name('user_save');

// Статические страницы
Route::get('/', 'PagesController@index')->name('main_page');

//Раздел Электронный полис
Route::get('/kak_eto_rabotaet', 'PagesController@how_it_works')->name('how_it_works');
Route::get('/chto_vhodit_v_strahovku', 'PagesController@included_my_insurance')->name('included_my_insurance');
Route::get('/kompanii', 'PagesController@what_your_insurance')->name('what_your_insurance');
Route::get('/electronniy_polis', 'PagesController@what_e_policy')->name('what_e_policy');
Route::get('/dannie_dlya_polisa', 'PagesController@what_data')->name('what_data');
Route::get('/kak_poluchit_polis', 'PagesController@how_get_policy')->name('how_get_policy');
Route::get('/raspechativat_polis', 'PagesController@whether_print_policy')->name('whether_print_policy');

//раздел Страховой случай
Route::get('/strahovoy_sluchay', 'PagesController@ins_moment')->name('ins_moment');
Route::get('/ins_moment_full', 'PagesController@ins_moment_full')->name('ins_moment_full');
Route::get('/kak_poluchit_viplatu', 'PagesController@how_get_paid')->name('how_get_paid');
Route::get('/kak_izezhat_otkaza_v_viplate', 'PagesController@how_to_avoid')->name('how_to_avoid');

//раздел Путешественникам
Route::get('/nuzhna_li_strahovka', 'PagesController@ins_need')->name('ins_need');
Route::get('/strahovka_dlya_visi', 'PagesController@ins_for_visa')->name('ins_for_visa');
Route::get('/shengen', 'PagesController@shengen')->name('shengen');
Route::get('/informaciya_o_kompaniyah', 'PagesController@ins_info')->name('ins_info');
//Виды страховок
Route::get('/individualnaya_strahovka', 'PagesController@single_ins')->name('single_ins');
Route::get('/gruppovaya_strahovka', 'PagesController@group_ins')->name('group_ins');
Route::get('/medicinskaya_strahovka', 'PagesController@med_ins')->name('med_ins');
Route::get('/compinsacionnaya_strahovka', 'PagesController@comp_ins')->name('comp_ins');
Route::get('/strahovka_ot_neviezda', 'PagesController@abort')->name('abort');
Route::get('/strahovka_s_franshizoy', 'PagesController@fransh_ins')->name('fransh_ins');

//Контакты
Route::get('/kontakti', 'PagesController@contacts')->name('contacts');
Route::get('/legenda', 'PagesController@legend')->name('legend');

//Страны
Route::get('/finlyandia', 'PagesController@finland')->name('finland');
Route::get('/australia', 'PagesController@australia')->name('australia');
Route::get('/egipet', 'PagesController@egypt')->name('egypt');
Route::get('/angliya', 'PagesController@england')->name('england');
Route::get('/italiya', 'PagesController@italy')->name('italy');
Route::get('/norvegiya', 'PagesController@norway')->name('norway');
Route::get('/tailand', 'PagesController@thailand')->name('thailand');
Route::get('/israil', 'PagesController@israel')->name('israel');
Route::get('/chernogoria', 'PagesController@montenegro')->name('montenegro');
Route::get('/gruziya', 'PagesController@georgia')->name('georgia');
Route::get('/germaniya', 'PagesController@germany')->name('germany');
Route::get('/usa', 'PagesController@usa')->name('usa');
