<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ItemRequest;
use Yajra\DataTables\Contracts\DataTable;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Item::with(['type', 'brand',]);

            return DataTables::of($query)

            ->editColumn('photos', function($item){
                return '<img src="' . $item->thumbnail . '" class="w-20 mx-auto rounded-md" alt="thumbnail">';
            })
            
            ->addColumn('action', function($item){
                return '
                <div class="flex justify-center w-20 gap-4 mx-auto align-middle">
                <a class="block w-full px-2 py-1 mb-1 text-xs text-center text-white transition duration-500 bg-gray-700 border border-gray-700 rounded-md select-none ease hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                    href="' . route('admin.item.edit', $item->id) . '">
                    Sunting
                </a>
                
                <form class="block w-full" onsubmit="return confirm(\'Apakah anda yakin?\');" -block" action="' . route('admin.item.destroy', $item->id) . '" method="POST">
                    <button class="w-full px-2 py-1 text-xs text-white transition duration-500 bg-red-500 border border-red-500 rounded-md select-none ease hover:bg-red-600 focus:outline-none focus:shadow-outline" >
                        Hapus
                    </button>
                        ' . method_field('delete') . csrf_field() . '
                </form>
                </div>';
            })
            ->rawColumns(['action', 'photos'])
            ->make();
        }

        return view('admin.items.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $types = Type::all();
        return view('admin.items.create',[
            'brands' => $brands,
            'types' => $types,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->all();
        
        // upload photos
        if ($request->hasFile('photos')) {
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Push to array
                array_push($photos, $photoPath);
            }

            // Convert to JSON :(
            $data['photos'] = json_encode($photos);
        }

        // Create slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        Item::create($data);

        return redirect()->route('admin.item.index');
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
    public function edit(Item $item)
    {
        $item->load('brand', 'type');
        $brands = Brand::all();
        $types = Type::all();

        return view('admin.items.edit', [
            'item' => $item,
            'brands' => $brands,
            'types' => $types,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $data = $request->all();
        
        // upload photos
        if ($request->hasFile('photos')) {
            $photos = [];

            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('assets/item', 'public');

                // Push to array
                array_push($photos, $photoPath);
            }

            // Convert to JSON :(
            $data['photos'] = json_encode($photos);
        } else {
            $data['photos'] = $item->photos;
        }

        // Create slug
        $data['slug'] = Str::slug($data['name']) . '-' . Str::lower(Str::random(5));

        $item->update($data);

        return redirect()->route('admin.item.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('admin.item.index');
    }
}
