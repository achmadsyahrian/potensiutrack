<?php

return [
    'required' => 'Kolom :attribute harus diisi.',
    'attributes' => [
        'name' => 'nama',
        'nip' => 'nip',
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
        'class' => 'kelas',
        'lecturer_id' => 'dosen',
        'course' => 'mata kuliah',
        'course_topic' => 'materi kuliah',
        'course_credits' => 'jumlah sks',
        'scheduled_date' => 'waktu rencana',
        'time' => 'waktu',
        'division_id' => 'divisi',
        'reported_by_id' => 'pelapor',
        'network_expansion_reason' => 'alasan',
        'finish_date' => 'tanggal selesai',
        'fault_reason' => 'alasan',
        'reason' => 'alasan',
        'web_app_id' => 'aplikasi',
        'month' => 'bulan',
        'year' => 'tahun',
        'programmer_id' => 'programmer',
        'application' => 'aplikasi',
        'assignment_type' => 'Tipe Penugasan',
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
    'numeric' => 'Kolom :attribute hanya boleh berisi angka.',
    'uploaded' => 'Ukuran file yang diunggah pada kolom :attribute terlalu besar. Harap unggah file dengan ukuran maksimum 2MB.',
];