<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
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
        $data = Guest::all();
        $auth = Auth::user();

        $stat = [
            'today' => Guest::whereDate('created_at', date('Y-m-d'))->count(),
            'total' => Guest::count()
        ];

        return view('administrator/page/guest', ['data' => $data, 'auth' => $auth, 'stat' => $stat]);
    }

    public function delete($id, Request $request)
    {
        Guest::destroy($id);
        return back()->with('success', 'Data buku tamu berhasil dihapus');
    }
}
