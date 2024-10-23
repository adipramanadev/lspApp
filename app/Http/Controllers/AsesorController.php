<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use Illuminate\Http\Request;
use DataTables;

class AsesorController extends Controller
{

    //server siide datatable 
    public function getAsesorData()
    {
        $asesores = Asesor::select(['id', 'nama', 'alamat', 'telepon']);

        return DataTables::of($asesores)
            ->addIndexColumn()  // Adds index to the first column
            ->addColumn('action', function($row){
                $btn = '<a href="edit/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>';
                $btn .= ' <form action="delete/'.$row->id.'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';
                return $btn;
            })
            ->rawColumns(['action'])  // Allow raw HTML for the action column
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index asesor 
        $asesores = Asesor::all();
        return view('pages.admin.asesor.index', compact('asesores'),['type_menu' => 'asesor']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.admin.asesor.create',['type_menu'=>'asesor']);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nik' => 'required|string|max:50|unique:asesor,nik',
            'nama' => 'required|string|max:75',
            'alamat' => 'required|string|max:100',
            'sex'=> 'required',
            'email' => 'required|email|max:50|unique:asesor,email',
            'status' =>'required',
            'no_hp' => 'required',
            'skema' => 'required',
            
            // Other validation rules
        ]);
    
        try {
            Asesor::create($validated);
            return redirect()->route('asesor.index')->with('success', 'Data Asesor berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan atau data sudah ada.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Asesor $asesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //form update 
        $asesor  = Asesor::find($id);

        return view('pages.admin.asesor.edit',compact('asesor'), ['type_menu'=>'asesor']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asesor $asesor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //destroy asesor 
        $asesor = Asesor::find($id);
        $asesor->delete();
        //show sweet
        return redirect()->route('asesor.index')->with('success', 'Data Asesor berhasil di delete');

    }
}
