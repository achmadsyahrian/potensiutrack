<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('lecturers.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Akun baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label required">NIP</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                    placeholder="Masukkan nip" value="{{ old('nip') }}" autocomplete="off">
                                <x-invalid-feedback field='nip'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label class="form-label required">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    placeholder="Masukkan nama" value="{{ old('name') }}" autocomplete="off">
                                <x-invalid-feedback field='name'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label class="form-label required">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Masukkan username" value="{{ old('username') }}"  autocomplete="off">
                                <x-invalid-feedback field='username'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email" name="email" value="{{ old('email') }}"  autocomplete="off">
                                <x-invalid-feedback field='email'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">No. Handphone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Masukkan nomor" name="phone" value="{{ old('phone') }}"  autocomplete="off">
                                <x-invalid-feedback field='phone'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Foto Profile</label>
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo">
                                <div class="text-muted"><small>*Max 2MB</small></div>
                                <x-invalid-feedback field='photo'></x-invalid-feedback>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        Simpan
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy ms-1">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
                            <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M14 4l0 4l-6 0l0 -4" />
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if ($errors->any())
            var modal = new bootstrap.Modal(document.getElementById('modal-report'));
            modal.show();
        @endif
    });
</script>
