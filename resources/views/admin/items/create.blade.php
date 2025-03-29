<x-app-layout>
    <x-slot name="title">Admin</x-slot>
    <x-slot name="header">
      <h2 class="text-xl font-normal leading-tight tracking-wider text-gray-800 font-cool">
        <a href="#!" onclick="window.history.go(-1); return false;">
          ←
        </a class="text-sm font-normal tracking-wider font-cool">
        {!! __('Item &raquo; Buat') !!}
      </h2>
    </x-slot>
  
    <div class="py-12 text-sm font-normal tracking-wider font-cool">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div>
          @if ($errors->any())
            <div class="mb-5" role="alert">
              <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
                Ada kesalahan!
              </div>
              <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
                <p>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                </p>
              </div>
            </div>
          @endif
          <form class="w-full" action="{{ route('admin.item.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">




              <div class="w-full">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                  Nama*
                </label>
                <input value="{{ old('name') }}" name="name"
                       class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                       id="grid-last-name" type="text" placeholder="Nama" required>
                <div class="mt-2 mb-5 text-sm text-gray-500">
                  Nama Item. Contoh: Item 1, Item 2, Item 3, dsb. Wajib diisi. Maksimal 255 karakter.
                </div>
              </div>
              



              <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
                Brand*
              </label>
              <select name="type_id" id="" required class="z-50 block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Type</option>
              @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : ''}}>
                  {{ $brand->name }}
                </option>
              @endforeach
              </select>
              <div class="mt-2 text-sm text-gray-500">
                Brand Item. Contoh: Porsche dsb. Wajib diisi.
              </div>
            </div>
          </div>




          <div class="w-full">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
              Type*
            </label>
            <select name="brand_id" id="" required class="z-50 block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="">Pilih Brand</option>
            @foreach ($types as $type)
              <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : ''}}>
                {{ $type->name }}
              </option>
            @endforeach
            
            </select>
            <div class="mt-2 mb-5 text-sm text-gray-500">
              Type Item. Contoh: City Car dsb. Wajib diisi.
            </div>
          </div>
          
          
          
          <div class="w-full">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
              Fitur*
            </label>
            <input value="{{ old('features') }}" name="features"
                   class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                   id="grid-last-name" type="text" placeholder="Fitur" required>
            <div class="mt-2 text-sm text-gray-500">
              Fitur Item. Contoh: Fitur 1, Fitur 2, dsb. Wajib diisi. Dipisahkan dengan koma (,).
            </div>
          </div>
          
          
          
          <div class="w-full">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
              Foto*
            </label>
            <input name="photos[]"
                   class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                   id="grid-last-name" type="file" multiple accept="png,jpeg,jpg,webp" placeholder="Nama" required>
            <div class="mt-2 text-sm text-gray-500">
               Foto Item (Bisa lebih dari 1) Opsional.
            </div>
          </div>

          <div class="grid grid-cols-3 gap-3 px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
                Harga*
              </label>
              <input value="{{ old('price') }}" name="price"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="number" placeholder="Harga" required>
              <div class="mt-2 text-sm text-gray-500">
                Harga Item contoh 10000000.
              </div>
            </div>
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
                Rating*
              </label>
              <input value="{{ old('rating') }}" name="rating"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="number" placeholder="Rating" required min="1" max="5" step="0.1">
              <div class="mt-2 text-sm text-gray-500">
                Rating Items Max = 5.
              </div>
            </div>
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name z-0">
                Review*
              </label>
              <input value="{{ old('review') }}" name="review"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="number" placeholder="Review" required>
              <div class="mt-2 text-sm text-gray-500">
                Review, Angka Opsional.
              </div>
            </div>
          </div>



        </div>
          <div class="flex flex-wrap mb-6 -mx-3">
            <div class="w-full px-3 text-right">
              <button item="submit"
              class="px-4 py-2 font-normal text-white bg-green-500 rounded shadow-lg hover:bg-green-700">
                  Simpan Item
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </x-app-layout>