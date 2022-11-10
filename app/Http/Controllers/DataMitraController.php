<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class DataMitraController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
  
            $data = Mitra::latest()->get();
  
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editMitra">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteMitra">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('mitra.mitra_index');
    }

    public function store(Request $request)
    {

        //define validation rules
        $validator = Validator::make($request->all(),[
            'NamaMitra'     => 'required',
            'Alamat'   => 'required',
            'tlp'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       $mitra= Mitra::updateOrCreate([
                    'id' => $request->mitra_id
                ],
                [
                    'NamaMitra' => $request->NamaMitra, 
                    'Alamat' => $request->Alamat,
                    'tlp' => $request->tlp
                ]);        
                
     
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $mitra  
        ]);
    }

    public function edit($id)
    {
        $mitra = Mitra::find($id);
        return response()->json($mitra);
    }

    public function destroy($id)
    {
        //delete post by ID
        Mitra::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Post Berhasil Dihapus!.',
        ]); 
    }
}
