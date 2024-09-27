@php
$editUrl = route('kesimpulan.edit', $kesimpulan->id);
$deleteUrl = route('kesimpulan.delete', $kesimpulan->id);
@endphp

@if($isSuperAdmin || $user->hasPermissionTo('edit kesimpulan'))
    <a href="{{ $editUrl }}" class="btn btn-sm rounded-pill mx-1 my-1 px-2">Edit</a>
@endif

@if($isSuperAdmin || $user->hasPermissionTo('delete kesimpulan'))
    <form action="{{ $deleteUrl }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
    </form>
@endif