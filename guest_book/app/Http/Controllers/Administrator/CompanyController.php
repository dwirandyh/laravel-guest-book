<?php

namespace App\Http\Controllers\Administrator;

use App\Exports\CompanyGuestExport;
use App\Http\Controllers\Controller;
use App\Imports\CompanyGuestImport;
use App\Models\CompanyGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CompanyController extends Controller
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
        $data = CompanyGuest::all();
        $auth = Auth::user();

        $stat = [
            'today' => CompanyGuest::whereDate('created_at', date('Y-m-d'))->count(),
            'total' => CompanyGuest::count()
        ];

        return view('administrator/page/company', ['data' => $data, 'auth' => $auth, 'stat' => $stat]);
    }

    public function delete($id, Request $request)
    {
        CompanyGuest::destroy($id);
        return back()->with('success', 'Data buku tamu berhasil dihapus');
    }

    public function checkout($id)
    {
        $guest = CompanyGuest::find($id);
        $guest->checkout = date('Y-m-d G:i:s');
        $guest->save();
        return back()->with('success', 'Checkout berhasil dilakukan');
    }

    public function report(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        $data = CompanyGuest::whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->get();

        $data = [
            'from' => date_format(date_create($from), 'd/m/yy'),
            'to' => date_format(date_create($to), 'd/m/yy'),
            'data' => $data,
        ];

        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('a4', 'landscape');
        $pdf->loadView('report/company', $data);
        return $pdf->stream();
    }

    public function export()
    {
        return Excel::download(new CompanyGuestExport, 'guest-company.xlsx');
    }

    public function import(Request $request)
    {
        if ($request->file('excel_file')) {
            Excel::import(new CompanyGuestImport, $request->file('excel_file'));
            return back()->with('success', 'Data berhasil di import');
        }
        return back();
    }
}
