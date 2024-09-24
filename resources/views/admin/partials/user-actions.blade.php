@if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
    <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-sm rounded-pill mx-1 my-1 px-2">Edit</a>
@endif

@if(auth()->user()->hasRole('super-admin'))
    <form action="{{ url('admin/users/' . $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm rounded-pill my-1 px-2" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
    </form>
@endif