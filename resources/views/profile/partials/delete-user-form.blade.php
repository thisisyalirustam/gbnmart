<section class="container py-4">
    <header class="mb-4">
        <h2 class="h5 text-danger">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted small">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <!-- Trigger delete modal -->
    <button
        type="button"
        class="btn btn-danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        {{ __('Delete Account') }}
    </button>

    <!-- Delete confirmation modal -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
            @csrf
            @method('delete')

            <h5 class="modal-title text-danger">
                {{ __('Are you sure you want to delete your account?') }}
            </h5>

            <p class="mt-2 text-muted small">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-3">
                <label for="password" class="form-label visually-hidden">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control @if($errors->userDeletion->has('password')) is-invalid @endif"
                    placeholder="{{ __('Password') }}"
                >
                @if ($errors->userDeletion->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->userDeletion->first('password') }}
                    </div>
                @endif
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <button
                    type="button"
                    class="btn btn-secondary"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn btn-danger ms-2">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

