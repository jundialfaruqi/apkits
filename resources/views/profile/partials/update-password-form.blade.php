<form method="post" action="{{ route('password.update') }}" class="mt-3">
    @csrf
    @method('put')

    <div class="col-md-12 mb-3">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="update_password_current_password" class="form-label">Password Sekarang</label>
                <input type="password" name="current_password" id="update_password_current_password"
                    autocomplete="current-password" class="form-control rounded-4">

                <div class="text-danger mt-2">
                    @if ($errors->updatePassword->has('current_password'))
                        @foreach ($errors->updatePassword->get('current_password') as $message)
                            {{ $message }}
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <label for="update_password_password" class="form-label">Password Baru</label>
                <input type="password" name="password" id="update_password_password" autocomplete="new-password"
                    class="form-control rounded-4">

                <div class="text-danger mt-2">
                    @if ($errors->updatePassword->has('password'))
                        @foreach ($errors->updatePassword->get('password') as $message)
                            {{ $message }}
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <label for="update_password_password_confirmation" class="form-label">Ulangi Password Baru</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password" class="form-control rounded-4">

                <div class="text-danger mt-2">
                    @if ($errors->updatePassword->has('password_confirmation'))
                        @foreach ($errors->updatePassword->get('password_confirmation') as $message)
                            {{ $message }}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <button class="btn btn-primary rounded-4 me-3">Buat Password Baru</button>
            <div>
                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="mb-0 text-center text-muted small fade" x-bind:class="{ 'show': show }">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-success">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M5 7.2a2.2 2.2 0 0 1 2.2 -2.2h1a2.2 2.2 0 0 0 1.55 -.64l.7 -.7a2.2 2.2 0 0 1 3.12 0l.7 .7c.412 .41 .97 .64 1.55 .64h1a2.2 2.2 0 0 1 2.2 2.2v1c0 .58 .23 1.138 .64 1.55l.7 .7a2.2 2.2 0 0 1 0 3.12l-.7 .7a2.2 2.2 0 0 0 -.64 1.55v1a2.2 2.2 0 0 1 -2.2 2.2h-1a2.2 2.2 0 0 0 -1.55 .64l-.7 .7a2.2 2.2 0 0 1 -3.12 0l-.7 -.7a2.2 2.2 0 0 0 -1.55 -.64h-1a2.2 2.2 0 0 1 -2.2 -2.2v-1a2.2 2.2 0 0 0 -.64 -1.55l-.7 -.7a2.2 2.2 0 0 1 0 -3.12l.7 -.7a2.2 2.2 0 0 0 .64 -1.55v-1" />
                            <path d="M9 12l2 2l4 -4" />
                        </svg>
                        Tersimpan
                    </p>
                @endif
            </div>
        </div>
    </div>
</form>

@push('js')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush
