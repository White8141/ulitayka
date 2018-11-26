<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Repositories\PolicyRepository;

class HomeController extends Controller
{
    protected $policies;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PolicyRepository $policies)
    {
        $this->middleware('auth');

        $this->policies = $policies;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->user());
        //$policies = $this->policies->forUser($request->user());
        
        return view ('sections/home/index', [
            'user' => $request->user(),
            'toolbar' => ''
        ]);
    }

    /**
     * Показать все полисы клиента
     *
     * @return \Illuminate\Http\Response
     */
    public function policies_list(Request $request)
    {
        //dd($request->user());
        $policies = $this->policies->forUser($request->user());

        return view ('sections/home/policies', [
            'policies' => $policies
        ]);
    }

    public function user_save (Request $request) {
        //dump($request->all());

        $user = $request->user();
        $user->user_first_name_en = $request->input('userFirstNameEn');
        $user->user_last_name_en = $request->input('userLastNameEn');
        $user->user_first_name_ru = $request->input('userFirstNameRu');
        $user->user_last_name_ru = $request->input('userLastNameRu');
        $user->user_birthdate = $request->input('userBirthdate');
        if ($request->input('userPassport') != null) $user->user_passport = $request->input('userPassport');
        $user->user_phone = $request->input('userPhone');
        $user->user_profile_filled = true;

        //dd($user);
        $user->save();

        //dump($user);

        return view ('sections/home/index', [
            'user' => $user,
            'toolbar' => 'Данные сохранены'
        ]);
    }
}
