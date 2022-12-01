<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\Debitur;
use App\Models\Image;
use App\Models\TemporaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DebiturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

        $data = Debitur::latest()->get();

        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('cabang_id', function($data) {
            return $data->cabang->NamaCabang;
        })
        ->addColumn('action', function($row){

        $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit"
            class="edit btn btn-primary btn-sm editDebitur">Edit</a>';

        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'"
            data-original-title="Delete" class="btn btn-danger btn-sm deleteDebitur">Delete</a>';

        return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
        }

        return view('debitur.debitur_index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabang = Cabang::all();
        return view('debitur.create',compact('cabang'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //delete post by ID
         Debitur::where('id', $id)->delete();
         //return response
         return response()->json([
         'success' => true,
         'message' => 'Data Post Berhasil Dihapus!.',
         ]);
    }

}
