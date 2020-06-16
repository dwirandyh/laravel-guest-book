<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Intervention\Image\Facades\Image;

class GuestController extends Controller
{
    //
    public function index()
    {
        return view('guest/guest_form');
    }

    public function saveData(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'identity' => 'required',
            'identity_id' => 'required',
            'phone_number' => 'required',
            'company' => 'required',
            'purpose' => 'required',
            'identity_file' => 'required'
        ];

        $messages = [
            'required' => 'Kolom ini harus diisi terlebih dahulu',
        ];

        $request->validate($rules, $messages);

        $input = [
            'name' => $request->post('name'),
            'email' => $request->post('email'),
            'identity' => $request->post('identity'),
            'identity_id' => $request->post('identity_id'),
            'phone_number' => $request->post('phone_number'),
            'company' => $request->post('company'),
            'purpose' => $request->post('purpose'),
            'identity_file' => 'identity-' . time() . '.jpg'
        ];

        $this->saveIdentityFile($input['identity_file'], $request->post('identity_file'));

        Guest::create($input);

        return back()->with('success', 'Buku tamu berhasil disimpan');
    }

    private function saveIdentityFile($imageName, $image)
    {
        $path = public_path() . '/img/identity/' . $imageName;
        Image::make(file_get_contents($image))->save($path);
    }
}
