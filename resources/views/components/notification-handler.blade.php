@if (session()->has('error'))
   <x-notify head='Gagal!' type="danger" body="{{ session('error') }}"></x-notify>
@elseif (session()->has('success'))
   <x-notify head='Berhasil!' type="success" body="{{ session('success') }}"></x-notify>
@endif