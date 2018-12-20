<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home')->with(['user'=>auth()->user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveData(Request $request){
        $this->validate($request,['avatar'=>'required|image','signature'=>'required|image']);
        $user=auth()->user();

        $avatar = $request->file('avatar');
        $signature= $request->file('signature');



        $user->avatar= $avatar->openFile()->fread($avatar->getSize());
        $user->signature= $signature->openFile()->fread($signature->getSize());
        $user->save();
        return response()->json('PROCESO OK');
    }
}
