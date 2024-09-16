@extends('layouts.admin.app')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card shadow-sm border-0 rounded-4">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Lengkap</label>
                                                <input type="text"
                                                    class="form-control rounded-4 @error('name') is-invalid @enderror"
                                                    name="name" placeholder="Nama"
                                                    value="{{ old('name', $user->name) }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control rounded-4" name="email"
                                                    value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="roles" class="form-label">Pilih Role</label>
                                            <select name="roles[]" class="form-control @error('roles') is-invalid @enderror"
                                                multiple>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role }}"
                                                        {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('roles')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="opd_id" class="form-label">OPD</label>
                                                <select id="opd_id" name="opd_id"
                                                    class="form-select rounded-4 @error('opd_id') is-invalid @enderror">
                                                    <option value="" class="dropdown-header" disabled>Pilih OPD
                                                    </option>
                                                    @foreach ($opds as $opd)
                                                        <option value="{{ $opd->id }}"
                                                            {{ $user->opd_id == $opd->id ? 'selected' : '' }}>
                                                            {{ $opd->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('opd_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="bidang" class="form-label">Bidang</label>
                                                <select id="bidang" name="bidang"
                                                    class="form-select rounded-4 @error('bidang') is-invalid @enderror">
                                                    <option value="" class="dropdown-header" disabled>Pilih Bidang
                                                    </option>
                                                </select>
                                                @error('bidang')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="pekerjaan_id" class="form-label">Pekerjaan</label>
                                                <select id="pekerjaan_id" name="pekerjaan_id"
                                                    class="form-select rounded-4 @error('pekerjaan_id') is-invalid @enderror">
                                                    <option value="" class="dropdown-header" disabled>Pilih Pekerjaan
                                                    </option>
                                                </select>
                                                @error('pekerjaan_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label for="password" class="form-label">Password Baru</label>
                                                <input type="password" id="password"
                                                    class="form-control rounded-4 @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Masukkan password baru minimal 8 karakter">
                                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                    password.</small>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer rounded-bottom-4">
                                <button type="submit" class="btn btn-primary rounded-4 my-1 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                                        <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                        <path d="M14 4l0 4l-6 0l0 -4" />
                                    </svg>
                                    Update
                                </button>
                                <a href="{{ route('user.index') }}" class="btn btn-danger rounded-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                    </svg>
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const opds = @json($opds);
            const isSuperAdmin = @json($isSuperAdmin);
            const pekerjaans = @json($pekerjaans);
            const currentBidang = "{{ $user->formatlaporan->bidang ?? '' }}";
            const currentPekerjaanId = "{{ $user->formatlaporan->pekerjaan_id ?? '' }}";

            function updateBidangDropdowns(opdId) {
                const selectedOpd = opds.find(opd => opd.id == opdId);
                const bidangSelect = $('#bidang');
                const pekerjaanSelect = $('#pekerjaan_id');

                bidangSelect.empty().append(
                    '<option value="" class="dropdown-header" disabled>Pilih Bidang</option>');
                pekerjaanSelect.empty().append(
                    '<option value="" class="dropdown-header" disabled>Pilih Pekerjaan</option>');

                if (selectedOpd && selectedOpd.formatlaporans && selectedOpd.formatlaporans.length > 0) {
                    const uniqueBidang = [...new Set(selectedOpd.formatlaporans.map(fl => fl.bidang))];

                    uniqueBidang.forEach(bidang => {
                        if (bidang) {
                            bidangSelect.append(
                                `<option value="${bidang}" ${bidang === currentBidang ? 'selected' : ''}>${bidang}</option>`
                            );
                        }
                    });

                    // Populate pekerjaan dropdown
                    Object.entries(pekerjaans).forEach(([id, nama_pekerjaan]) => {
                        pekerjaanSelect.append(
                            `<option value="${id}" ${id == currentPekerjaanId ? 'selected' : ''}>${nama_pekerjaan}</option>`
                        );
                    });
                }
            }

            // Handle change event for OPD dropdown
            $('#opd_id').change(function() {
                const opdId = $(this).val();
                updateBidangDropdowns(opdId);
            });

            // Trigger change event on page load to populate dropdowns
            const initialOpdId = $('#opd_id').val();
            if (initialOpdId) {
                updateBidangDropdowns(initialOpdId);
            }
        });
    </script>
@endpush
