<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\CompanyGuest;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    var $data = [];
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
        $auth = Auth::user();
        $this->data['auth'] = $auth;
        $this->data['guest'] = $this->getActiveGuest();
        $this->data['company'] = $this->getActiveCompanyGuest();

        return view('administrator/page/dashboard', $this->data);
    }

    private function getActiveGuest()
    {
        $guest = Guest::whereNull('checkout')
            ->orderBy('created_at', 'DESC')
            ->get();
        return $guest;
    }

    private function getActiveCompanyGuest()
    {
        $companyGuest = CompanyGuest::whereNull('checkout')
            ->orderBy('created_at', 'DESC')
            ->get();
        return $companyGuest;
    }
}
