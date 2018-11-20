<?php

namespace App\Http\Controllers;

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
        $policies = $this->policies->forUser($request->user());
        
        return view ('home', [
            'policies' => $policies
        ]);
    }
}
