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
    ],
    'regex' => 'Kolom :attribute harus memenuhi format yang benar.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'min' => [
        'string' => 'Kolom :attribute harus memiliki setidaknya :min karakter.',
    ],
    'same' => 'Kolom :attribute harus sama dengan :other.',
    'max' => [
        'file' => 'Ukuran file :attribute tidak boleh melebihi :max kilobyte.', 
    ],
    'unique' => 'Data :attribute sudah terdaftar dalam sistem.',
];