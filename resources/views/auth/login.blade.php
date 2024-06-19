<x-guest-layout>
    @slot('title', 'Login')
    @push('page')
        <h4 class="font-size-18 mt-4">Login</h4>
        <p class="text-muted">Masukkan username dan password untuk mengakses PPDB </p>
    @endpush
    <div class="p-2 mt-5">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-user-2-line auti-custom-input-icon text-info"></i>
                <label for="username">Username</label>
                <input id="username" type="text"
                    class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" name="username" required
                    autocomplete="username" placeholder="Masukkan username" value="{{ old('username') }}">
                <x-jet-input-error for="username"></x-jet-input-error>
            </div>

            <div class="form-group auth-form-group-custom mb-4">
                <i class="ri-lock-2-line auti-custom-input-icon text-info"></i>
                <label for="password">Password</label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password" required autocomplete="current-password" id="password"
                    placeholder="Masukkan password">
                <x-jet-input-error for="password"></x-jet-input-error>
            </div>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                <label class="custom-control-label" for="remember_me">Ingat saya</label>
            </div>

            <div class="mt-4 text-center">
                <button class="btn btn-info w-md waves-effect waves-light" type="submit">Masuk</button>
            </div>

        </form>
        <div x-data="{open:false}" class="mt-4 text-center">
            <span x-on:click="open=!open" type="button">
                <i class="mdi mdi-lock mr-1"></i>
                Lupa Password?
            </span>

            <div x-cloak x-show="open">
                <div class="fixed-top col-12 h-100 w-100" style="background-color:rgba(0, 0, 0, 0.5);">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Lupa Password?</h5>
                                <button x-on:click="open=false" type="button"
                                    style="font-size: 20px; background: none; border: none">
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <p>Silahkan hubungi pihak Sekolah atau Superadmin.</p>
                            </div>
                            <div class="modal-footer">
                                <button x-on:click="open=false" type="button"
                                    class="btn btn-info waves-effect waves-light">Oke</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
