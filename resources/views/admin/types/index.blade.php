<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm text-xl font-normal font-semibold leading-tight tracking-wider text-gray-800 font-cool">
            {{ __('Types') }}
        </h2>
    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#dataTable').DataTable({
              processing: true,
              serverSide: true,
              stateSave: true,
              ajax: {
                url: '{!! url()->current() !!}',
              },
              language: {
                url: '//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
              },
              columns: [{
                  data: 'id',
                  name: 'id',
                },
                {
                  data: 'name',
                  name: 'name'
                },
                {
                  data: 'slug',
                  name: 'slug'
                },
                {
                  data: 'action',
                  name: 'action',
                  orderable: false,
                  searchable: false,
                  width: '15%'
                },
              ],
            });
          </script>
    </x-slot>

    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl sm lg:px-8">
            <div class="mb-10">
                <a href="{{ route('admin.type.create') }}" class="px-4 py-2 text-sm font-normal tracking-wider text-white bg-green-400 rounded-md hover:bg-green-900 font-cool">
                    + Buat Type
                </a>
            </div>
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 text-sm font-normal tracking-wider bg-white sm:py-6 text-y font-cool">
                    <table id="dataTable">
                        <thead>
                            <tr class="text-sm font-normal tracking-wider font-cool">
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="mx-auto text-center"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
