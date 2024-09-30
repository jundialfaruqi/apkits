<div class="table-responsive">
    <table id="statistik-table" class="table table-striped table-hover table-vcenter border-top rounded-4">
        <thead>
            <tr>
                <th>Nama</th>
                @role('super-admin')
                    <th>OPD</th>
                @endrole
                <th>Kegiatan Bulan ini</th>
                <th>Kegiatan Bulan lalu</th>
                <th>Kegiatan Tahun ini</th>
                <th>Kegiatan Tahun lalu</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffData as $data)
            <tr>
                <td>{{ $data['name'] }}</td>
                @role('super-admin')
                    <td>{{ $data['opd'] }}</td>
                @endrole
                <td class="text-center">{{ $data['currentMonthRancangan'] }}</td>
                <td class="text-center">{{ $data['lastMonthRancangan'] }}</td>
                <td class="text-center">{{ $data['currentYearRancangan'] }}</td>
                <td class="text-center">{{ $data['lastYearRancangan'] }}</td>
                <td class="text-center">{{ $data['totalRancangan'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>