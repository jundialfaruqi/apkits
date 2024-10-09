<div class="table-responsive">
    <table id="{{ $tableId }}" class="table table-striped table-hover table-vcenter border-top rounded-4">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Nama</th>
                @role('super-admin')
                    <th>OPD</th>
                @endrole
                <th class="text-center">{{ $lastMonthName }}</th>
                <th class="text-center">{{ $currentMonthName }}</th>
                <th class="text-center">{{ $lastYear }}</th>
                <th class="text-center">{{ $currentYear }}</th>
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
                        name: 'name',
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var avatar = '';
                            if (row.profile_photo) {
                                avatar =
                                    '<span class="avatar rounded-circle me-2" style="background-image: url(' +
                                    row.profile_photo + ')"></span>';
                            } else {
                                avatar =
                                    '<span class="avatar rounded-circle me-2">' +
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user">' +
                                    '<path stroke="none" d="M0 0h24v24H0z" fill="none" />' +
                                    '<path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />' +
                                    '<path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />' +
                                    '</svg></span>';
                            }
                            return '<div class="d-flex align-items-center justify-content-start" style="min-width: 200px">' +
                                avatar + '<span>' + data + '</span></div>';
                        }
                    },
                    @role('super-admin')
                        {
                            data: 'opd',
                            name: 'opd'
                        },
                    @endrole 
                    {
                        data: 'lastMonthRancangan',
                        name: 'lastMonthRancangan',
                        className: 'text-center'
                    },
                    {
                        data: 'currentMonthRancangan',
                        name: 'currentMonthRancangan',
                        className: 'text-center'
                    },
                    {
                        data: 'lastYearRancangan',
                        name: 'lastYearRancangan',
                        className: 'text-center'
                    },
                    {
                        data: 'currentYearRancangan',
                        name: 'currentYearRancangan',
                        className: 'text-center'
                    },
                    {
                        data: 'totalRancangan',
                        name: 'totalRancangan',
                        className: 'text-center'
                    }
                ]
            });
        });
    </script>
@endpush
