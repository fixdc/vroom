<x-app-layout>
    <x-slot name="header">
        <h2 class="text-sm text-xl font-normal font-semibold leading-tight tracking-wider text-gray-800 font-cool">
            {{ __('Bookings') }}
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
                  name: 'name',
                },
                {
                  data: 'item.brand.name',
                  name: 'item.brand.name',
                },
                {
                  data: 'item.name',
                  name: 'item.name',
                },
                {
                  data: 'start_date',
                  name: 'start_date',
                },
                {
                  data: 'end_date',
                  name: 'end_date',
                },
                {
                  data: 'status',
                  name: 'status',
                },
                {
                  data: 'payment_status',
                  name: 'payment_status',
                },
                {
                  data: 'total_price',
                  name: 'total_price',
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
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class="px-4 py-5 text-sm font-normal tracking-wider bg-white sm:py-6 text-y font-cool">
                    <table id="dataTable">
                        <thead>
                            <tr class="text-sm font-normal tracking-wider font-cool">
                                <th>ID</th>
                                <th>User</th>
                                <th>Brand</th>
                                <th>Cars</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Status Booking</th>
                                <th>Status Pembayaran</th>
                                <th>Total Bayar</th>
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
