<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Type;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\TypeRequest;
use Yajra\DataTables\Contracts\DataTable;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Type::query();

            return DataTables::of($query)
            ->addColumn('action', function($type){
                return '
                <div class="flex justify-center w-20 gap-4 mx-auto align-middle">
                <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                    href="' . route('admin.type.edit', $type->id) . '">
                    Sunting
                </a>
                
                <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.type.destroy', $type->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                </form>
                </div>';
            })
            ->rawColumns(['action'])
            ->make();
        }

        return view('admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name'] . '-' . Str::lower(Str::random(5)));

        Type::create($data);

        return redirect()->route('admin.type.index')->with('success', 'Type berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', [
            'type' => $type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $type->update($data);

        return redirect()->route('admin.type.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type = Type::findOrFail($type->id);
        $type->delete();

        return redirect()->route('admin.type.index');
    }
}
