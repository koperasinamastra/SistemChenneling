<?php

namespace App\Http\Controllers;

use App\Models\Debitur;
use App\Models\Image;
use App\Models\TemporaryImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('debitur.debitur_index');
    }


    public function store(Request $request)
    {

        $validasi= $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'noktp' => 'required',
        'alamat' => 'required',
        'tlp' => 'required',
        'plafond' => 'required',
        'cabang_id' => 'required',
        'nama_debitur'=>'required'


        ]);
            $array = $request->only([
            'name', 'email', 'password'
        ]);
        $array['password'] = bcrypt($array['password']);
        User::create($array);

        $debitur = $request->only([
            'nama_debitur','noktp','alamat','tlp','plafond','cabang_id'
        ]);
        Debitur::create($debitur);



        $temporaryFolder = Session::get('folder');
        $namefile = Session::get('filename');

        $temporary = TemporaryImage::where('folder', $temporaryFolder)->where('image', $namefile)->first();

        if ($temporary) { //if exist

                Image::create([
                    'folder' => $temporaryFolder,
                    'image' => $namefile,
                ]);

                //hapus file and folder temporary
                $path = storage_path() . '/app/files/tmp/' . $temporary->folder . '/' . $temporary->image;
                if (File::exists($path)) {

                    Storage::move('files/tmp/'.$temporary->folder.'/'.$temporary->image, 'files/'.$temporary->folder.'/'.$temporary->image);

                    File::delete($path);
                    rmdir(storage_path('app/files/tmp/' . $temporary->folder));

                    //delete record in temporary table
                    $temporary->delete();

                    return response()->json(['status' => true, 
                    'message' => 'Data Berhasil Disimpan'
                ]);
                }

                return response()->json(['status' => true, 
                'message' => 'Data Gagal Disimpan'
            ]);

        }

        return response()->json([
            'status' => false, 
            'message' => 'Data Gagal Disimpan'
        ]);
    }


}
