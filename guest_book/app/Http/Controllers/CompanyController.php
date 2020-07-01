<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyGuest;
use Intervention\Image\Facades\Image;

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

    public function index()
    {
        return view('guest/company_form');
    }

    public function saveData(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'identity' => 'required',
            'identity_id' => 'required',
            'identity_file' => 'required',
            'photo_file' => 'required',
            'phone_number' => 'required',
            'company' => 'required',
            'role' => 'required',
            'relation' => 'required',
            'purpose' => 'required'
        ];

        $messages = [
            'required' => 'Kolom ini harus diisi terlebih dahulu',
        ];

        $request->validate($rules, $messages);

        $input = [
            'name' => $request->post('name'),
            'is_leader' => $request->post('is_leader', 0),
            'email' => $request->post('email'),
            'identity' => $request->post('identity'),
            'identity_id' => $request->post('identity_id'),
            'identity_file' => 'identity-' . time() . '.jpg',
            'photo_file' => 'photo-' . time() . '.jpg',
            'phone_number' => $request->post('phone_number'),
            'company' => $request->post('company'),
            'role' => $request->post('role'),
            'intended_person' => empty($request->post('intended_person')) ? $request->post('intended_person_name') : $request->post('intended_person'),
            'relation' => $request->post('relation'),
            'purpose' => $request->post('purpose'),
            'estimated_time' => $request->post('estimated_time_hour') + $request->post('estimated_time_minute')
        ];

        $this->saveIdentityFile($input['identity_file'], $request->post('identity_file'));
        $this->savePhotoFile($input['photo_file'], $request->post('photo_file'));

        CompanyGuest::create($input);

        return back()->with('success', 'Buku tamu berhasil disimpan');
    }

    private function saveIdentityFile($imageName, $image)
    {
        $path = public_path() . '/img/identity/' . $imageName;
        Image::make(file_get_contents($image))->save($path);
    }

    private function savePhotoFile($imageName, $image)
    {
        $path = public_path() . '/img/photo/' . $imageName;
        Image::make(file_get_contents($image))->save($path);
    }
}
