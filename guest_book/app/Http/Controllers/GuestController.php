<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Intervention\Image\Facades\Image;

class GuestController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'saveData']]);
    }

    public function index()
    {
        return view('guest/guest_form');
    }

    public function saveData(Request $request)
    {
        $rules = [
            'name' => 'required',
            'visit_date' => 'required',
            'email' => 'required|email',
            'identity' => 'required',
            'identity_id' => 'required',
            'identity_file' => 'required',
            'photo_file' => 'required',
            'swab_file' => 'required',
            'phone_number' => 'required',
            'relation' => 'required',
            'purpose' => 'required'
        ];

        $messages = [
            'required' => 'Kolom ini harus diisi terlebih dahulu',
        ];

        $request->validate($rules, $messages);

        $input = [
            'name' => $request->post('name'),
            'visit_date' => $request->post('visit_date'),
            'email' => $request->post('email'),
            'identity' => $request->post('identity'),
            'identity_id' => $request->post('identity_id'),
            'identity_file' => 'identity-' . time() . '.jpg',
            'photo_file' => 'photo-' . time() . '.jpg',
            'swab_file' => 'swab-' . time() . '.jpg',
            'phone_number' => $request->post('phone_number'),
            'intended_person' => empty($request->post('intended_person')) ? $request->post('intended_person_name') : $request->post('intended_person'),
            'relation' => $request->post('relation'),
            'purpose' => $request->post('purpose'),
            'estimated_time' => $request->post('estimated_time_hour') + $request->post('estimated_time_minute')
        ];

        $this->saveIdentityFile($input['identity_file'], $request->post('identity_file'));
        $this->savePhotoFile($input['photo_file'], $request->post('photo_file'));
        $this->saveSwabFile($input['swab_file'], $request->post('swab_file'));

        Guest::create($input);

        return back()->with('success', 'Anda sudah berhasil mengisi buku tamu');
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

    private function saveSwabFile($imageName, $image)
    {
        $path = public_path() . '/img/swab/' . $imageName;
        Image::make(file_get_contents($image))->save($path);
    }
}
