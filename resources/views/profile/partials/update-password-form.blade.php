<p class="text-sm text-gray-600">
    Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar selalu aman.
</p>

<form method="post" action="{{ route('password.update') }}" class="mt-3">
    @csrf
    @method('put')

    <div class="col-md-12 mb-3">

        <label for="update_password_current_password" class="form-label">Password Sekarang</label>
        <div class="col-md-12 mb-3">
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

        <label for="update_password_password" class="form-label">Password Baru</label>
        <div class="col-md-12 mb-3">
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

        <label for="update_password_password_confirmation" class="form-label">Ulangi Password Baru</label>
        <div class="col-md-12 mb-4">
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

        <button
            class="btn btn-primary rounded-4 hover:bg-primary-700 hover:text-white transition duration-300 ease-in-out">Update</button>

        <div class="mt-4">

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="divider text-center text-sm text-gray-600 transition duration-300 ease-in-out"
                    style="opacity: 0; transform: translateY(-10px);"
                    x-bind:class="{ 'opacity-100 translate-y-0': show }">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-rosette-discount-check">
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

</form>

@push('js')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endpush
