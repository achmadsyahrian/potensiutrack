<div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('puskom.webassignment.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Penugasan baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label required">Tanggal</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"
                                    value="{{ old('date') }}" autocomplete="off">
                                <x-invalid-feedback field='date'></x-invalid-feedback>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label required">Aplikasi</label>
                                <input type="text" class="form-control @error('application') is-invalid @enderror" name="application"
                                    value="{{ old('application') }}" autocomplete="off" placeholder="Masukkan aplikasi">
                                <x-invalid-feedback field='application'></x-invalid-feedback>
                            </div>
                        </div>
                    </div>
                    <label class="form-label required">Programmer</label>
                    <div class="form-selectgroup-boxes row mb-3">
                       @foreach ($programmers as $item)
                       <div class="col-lg-6 mb-3">
                          <label class="form-selectgroup-item">
                             <input type="radio" name="programmer_id" value="{{ $item->id }}" class="form-selectgroup-input @error('programmer_id') is-invalid @enderror" {{ old('programmer_id') == $item->id ? 'checked' : '' }}>
                             <span class="form-selectgroup-label d-flex align-items-center p-3 @error('programmer_id') border-danger @enderror">
                                <span class="me-3">
                                   <span class="form-selectgroup-check"></span>
                                </span>
                                <span class="form-selectgroup-label-content">
                                   <span class="form-selectgroup-title strong mb-1">{{ $item->name }}</span>
                                </span>
                             </span>
                             <x-invalid-feedback field='programmer_id'></x-invalid-feedback>
                          </label>
                       </div>
                       @endforeach
                    </div>
                    <label class="form-label required">Penugasan</label>
                    <div class="form-selectgroup-boxes row mb-3">
                        <div class="col-lg-6 mb-3">
                            <label class="form-selectgroup-item">
                               <input type="radio" name="assignment_type" value="maintenance" class="form-selectgroup-input @error('assignment_type') is-invalid @enderror">
                               <span class="form-selectgroup-label d-flex align-items-center p-3 @error('assignment_type') border-danger @enderror">
                                  <span class="me-3">
                                     <span class="form-selectgroup-check"></span>
                                  </span>
                                  <span class="form-selectgroup-label-content">
                                     <span class="form-selectgroup-title strong mb-1">Maintenance</span>
                                  </span>
                               </span>
                               <x-invalid-feedback field='assignment_type'></x-invalid-feedback>
                            </label>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-selectgroup-item">
                               <input type="radio" name="assignment_type" value="development" class="form-selectgroup-input @error('assignment_type') is-invalid @enderror">
                               <span class="form-selectgroup-label d-flex align-items-center p-3 @error('assignment_type') border-danger @enderror">
                                  <span class="me-3">
                                     <span class="form-selectgroup-check"></span>
                                  </span>
                                  <span class="form-selectgroup-label-content">
                                     <span class="form-selectgroup-title strong mb-1">Pengembangan</span>
                                  </span>
                               </span>
                               <x-invalid-feedback field='assignment_type'></x-invalid-feedback>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal" id="submitBtn">
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
