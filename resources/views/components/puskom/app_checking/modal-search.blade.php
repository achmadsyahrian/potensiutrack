<div class="modal modal-blur fade " id="modal-search" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('puskom.appchecking.index') }}" method="get">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pencarian Lanjutan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @php
                            use Carbon\Carbon;
                        @endphp
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Bulan</label>
                                <select class="form-select " name="search_month">
                                    <option value="">Pilih Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('search_month') == $i ? 'selected' : '' }}>{{ Carbon::create()->month($i)->translatedFormat('F') }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tahun</label>
                                <select class="form-select" name="search_year">
                                    <option value="">Pilih Tahun</option>
                                    @php
                                        $tahun_sekarang = date('Y');
                                        $tahun_awal = $tahun_sekarang - 5;
                                        $tahun_akhir = $tahun_sekarang + 5;
                                    @endphp
                                    @for ($tahun = $tahun_awal; $tahun <= $tahun_akhir; $tahun++)
                                        <option value="{{ $tahun }}" {{ request('search_year') == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                                    @endfor
                                </select>
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
