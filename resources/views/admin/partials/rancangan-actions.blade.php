<a href="{{ route('todolist.edit', $rancangan->id) }}" class="btn btn-sm rounded-pill mx-1 my-1 px-2">Edit</a>
<form action="{{ route('todolist.delete', $rancangan->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
</form>