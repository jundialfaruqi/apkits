@foreach($user->getRoleNames() as $role)
    <label class="badge bg-primary text-white my-1 mx-1">{{ $role }}</label>
@endforeach