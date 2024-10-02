<div class="card-body text-center">
    <span class="avatar avatar-xl rounded-circle mb-3">
        @if(auth()->user()->profilePhoto)
            <span class="avatar avatar-xl rounded-circle" style="background-image: url({{ Storage::url(auth()->user()->profilePhoto->photo_path) }})"></span>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="currentColor"
                class="icon icon-tabler icons-tabler-filled icon-tabler-user">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" />
                <path
                    d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" />
            </svg>
        @endif
    </span>
    <h3 class="card-title mb-3">{{ auth()->user()->name }}</h3>
    <div>
        <form action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data" class="d-inline">
            @csrf
            <input type="file" name="photo" id="photo" class="d-none" onchange="this.form.submit()">
            <label for="photo" class="btn btn-icon rounded-4 me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-photo-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M15 8h.01" />
                    <path
                        d="M11 20h-4a3 3 0 0 1 -3 -3v-10a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v4" />
                    <path d="M4 15l4 -4c.928 -.893 2.072 -.893 3 0l3 3" />
                    <path d="M14 14l1 -1c.31 -.298 .644 -.497 .987 -.596" />
                    <path
                        d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
                </svg>
            </label>
        </form>
        @if(auth()->user()->profilePhoto)
            <form action="{{ route('profile.photo.destroy') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-icon rounded-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg>
                </button>
            </form>
        @endif
    </div>
</div>