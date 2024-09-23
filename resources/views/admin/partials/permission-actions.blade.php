<a href="{{ url('admin/permissions/' . $row->id . '/edit') }}" class="btn btn-sm rounded-pill my-1 px-2">Edit</a>
<form action="{{ url('admin/permissions/' . $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm rounded-pill my-1 px-2"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
</form>
