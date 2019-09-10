<?php

namespace App\Http\Controllers\Admin;

use App\Bought;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComptableController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $purchases = Bought::with('user', 'publi')->get();
        $dailyPurchases = Bought::where('created_at', '>', now()->subday())->get();
        $weeklyPurchases = Bought::where('created_at', '>', now()->subWeek())->get();
        $monthlyPurchases = Bought::where('created_at', '>', now()->subMonth())->get();
        $yearPurchases = Bought::where('created_at', '>', now()->subYear())->get();

        return view('admin.comptables.index', [
            'user' => $user,
            'purchases' => $purchases,
            'dailyPurchases' => $dailyPurchases,
            'weeklyPurchases' => $weeklyPurchases,
            'monthlyPurchases' => $monthlyPurchases,
            'yearPurchases' => $yearPurchases]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit( )
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy( )
    {
        //
    }
}

