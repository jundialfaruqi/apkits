<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-striped table-hover table-vcenter border-top rounded-4">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                @role('super-admin')
                    <th>OPD</th>
                @endrole
                <th class="text-center">Bulan ini</th>
                <th class="text-center">Bulan lalu</th>
                <th class="text-center">Tahun ini</th>
                <th class="text-center">Tahun lalu</th>
                <th class="text-center">Total</th>
            </tr>
        </thead>
    </table>
</div>
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#{{ $tableId }}').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ $dataUrl }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    @role('super-admin')
                        {
                            data: 'opd',
                            name: 'opd'
                        },
                    @endrole {
                        data: 'currentMonthRancangan',
                        name: 'currentMonthRancangan',
                        class: 'text-center'
                    },
                    {
                        data: 'lastMonthRancangan',
                        name: 'lastMonthRancangan',
                        class: 'text-center'
                    },
                    {
                        data: 'currentYearRancangan',
                        name: 'currentYearRancangan',
                        class: 'text-center'
                    },
                    {
                        data: 'lastYearRancangan',
                        name: 'lastYearRancangan',
                        class: 'text-center'
                    },
                    {
                        data: 'totalRancangan',
                        name: 'totalRancangan',
                        class: 'text-center'
                    }
                ]
            });
        });
    </script>
@endpush
