<button class="btn btn-danger mb-3 rounded-4" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
    Hapus Akun
</button>

<div class="modal modal-blur fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content rounded-4">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionLabel">Apakah Anda Yakin Ingin Menghapus Akun Anda?
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon mb-2 text-danger icon-lg">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 9v4"></path>
                            <path
                                d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z">
                            </path>
                            <path d="M12 16h.01"></path>
                        </svg>
                    </div>
                    <p class="small text-muted">
                        Setelah akun Anda dihapus, semua sumber daya dan data yang terkait akan dihapus secara permanen.
                        Silakan masukkan kata sandi Anda untuk konfirmasi bahwa Anda ingin menghapus akun Anda secara
                        permanen.
                    </p>

                    <div class="mb-3">
                        <label for="password" class="form-label visually-hidden">Password</label>
                        <input type="password" class="form-control rounded-4" id="password" name="password"
                            placeholder="Password" required>
                        @if ($errors->userDeletion->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->userDeletion->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer rounded-bottom-4">
                    <button type="button" class="btn btn-secondary rounded-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger rounded-4">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>
