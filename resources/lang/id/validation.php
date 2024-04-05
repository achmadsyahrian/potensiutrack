<?php

return [
    'required' => 'Kolom :attribute harus diisi.',
    'attributes' => [
        'name' => 'nama',
        'phone' => 'No handphone',
        'old_password' => 'password lama',
        'new_password' => 'password baru',
        'confirm_password' => 'konfirmasi password',
        'role_id' => 'level',
        'lab_id' => 'lab',
        'photo' => 'foto',
        'mandatory_user_id' => 'asisten lab',
        'date' => 'tanggal',
        'requested_by' => 'pemohon',
        'inventory_code' => 'kode intentory',
        'technician_id' => 'teknisi',
        'division' => 'divisi',
        'technician_id' => 'teknisi',
        'item_inventory_id' => 'barang',
    ],
    'regex' => 'Kolom :attribute harus memenuhi format yang benar.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'min' => [
        'string' => 'Kolom :attribute harus memiliki setidaknya :min karakter.',
    ],
    'same' => 'Kolom :attribute harus sama dengan :other.',
    'max' => [
        'file' => 'Ukuran file :attribute tidak boleh melebihi :max kilobyte.', 
        'string' => 'Panjang karakter :attribute tidak boleh melebihi :max karakter.', 
    ],
    'unique' => 'Data :attribute sudah terdaftar dalam sistem.',
    'image' => 'Kolom :attribute harus berupa file gambar.',
];