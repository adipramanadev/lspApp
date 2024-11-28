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
            ->addIndexColumn()  
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
         $validated = $request->validate([
             'nik' => 'required|string|max:50|unique:asesors,nik',
             'nama' => 'required|string|max:75',
             'alamat' => 'required|string|max:100',
             'sex' => 'required',
             'email' => 'required|email|max:50|unique:asesors,email',
             'status' => 'required',
             'no_hp' => 'nullable|string|max:20',
             'skema' => 'nullable|string|max:50',
         ]);
     
         try {
             $asesor = new Asesor($validated);
     
             if ($asesor->save()) {
                 return redirect()->route('asesor.index')->with('success', 'Data berhasil disimpan!');
             } else {
                 return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
             }
         } catch (\Exception $e) {
             // Log error for debugging
             \Log::error('Error saat menyimpan data Asesor: ' . $e->getMessage());
     
             return redirect()->back()->with('error', 'Gagal menyimpan data! Kesalahan: ' . $e->getMessage());
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
    public function update(Request $request, $id)
    {
        // Cari data berdasarkan ID
        $asesor = Asesor::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|string|max:50|unique:asesors,nik,' . $asesor->id,
            'nama' => 'required|string|max:75',
            'alamat' => 'required|string|max:100',
            'sex' => 'required',
            'email' => 'required|email|max:50|unique:asesors,email,' . $asesor->id,
            'status' => 'required',
            'no_hp' => 'nullable|string|max:20',
            'skema' => 'nullable|string|max:50',
        ]);

        try {
            // Update data
            $asesor->update($validated);

            // Redirect dengan pesan sukses
            return redirect()->route('asesor.index')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Error saat memperbarui data Asesor: ' . $e->getMessage());

            // Redirect dengan pesan error
            return redirect()->back()->with('error', 'Gagal memperbarui data! Kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asesor = Asesor::find($id);

        if (!$asesor) {
            return redirect()->route('asesor.index')->with('error', 'Data tidak ditemukan!');
        }

        try {
            $asesor->delete();
            return redirect()->route('asesor.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('asesor.index')->with('error', 'Gagal menghapus data! Pastikan tidak ada relasi terkait.');
        }
    }

}
