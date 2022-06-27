<?php

return [
    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut ini berisi standar pesan kesalahan yang digunakan oleh
    | kelas validasi. Beberapa aturan mempunyai multi versi seperti aturan 'size'.
    | Jangan ragu untuk mengoptimalkan setiap pesan yang ada di sini.
    |
    */
    'accepted' => 'Form :attribute harus diterima.',
    'active_url' => 'Form :attribute bukan URL yang valid.',
    'after' => 'Form :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Form :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha' => 'Form :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Form :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num' => 'Form :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Form :attribute harus berupa sebuah array.',
    'before' => 'Form :attribute harus tanggal sebelum :date.',
    'before_or_equal' => 'Form :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => 'Form :attribute harus antara :min dan :max.',
        'file' => 'Form :attribute harus antara :min dan :max kilobytes.',
        'string' => 'Form :attribute harus antara :min dan :max karakter.',
        'array' => 'Form :attribute harus antara :min dan :max item.',
    ],
    'boolean' => 'Form :attribute harus berupa true atau false',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => 'Form :attribute bukan tanggal yang valid.',
    'date_format' => 'Form :attribute tidak cocok dengan format :format.',
    'different' => 'Form :attribute dan :other harus berbeda.',
    'digits' => 'Form :attribute harus berupa angka :digits.',
    'digits_between' => 'Form :attribute harus antara angka :min dan :max.',
    'dimensions' => 'Form :attribute tidak memiliki dimensi gambar yang valid.',
    'distinct' => 'Form :attribute memiliki nilai yang duplikat.',
    'email' => 'Form :attribute harus berupa alamat surel yang valid.',
    'exists' => 'Form :attribute yang dipilih tidak valid.',
    'file' => 'Form :attribute harus berupa sebuah berkas.',
    'filled' => 'Form :attribute harus memiliki nilai.',
    'image' => 'Form :attribute harus berupa gambar.',
    'in' => 'Form :attribute yang dipilih tidak valid.',
    'in_array' => 'Form :attribute tidak terdapat dalam :other.',
    'integer' => 'Form :attribute harus merupakan bilangan bulat.',
    'ip' => 'Form :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Form :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Form :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Form :attribute harus berupa JSON string yang valid.',
    'max' => [
        'numeric' => 'Form :attribute maksimal :max.',
        'file' => 'Form :attribute maksimal :max kilobytes.',
        'string' => ':attribute maksimal :max karakter.',
        'array' => 'Form :attribute maksimal :max item.',
    ],
    'mimes' => 'Form :attribute harus dokumen berjenis : :values.',
    'mimetypes' => 'Form :attribute harus dokumen berjenis : :values.',
    'min' => [
        'numeric' => 'Form :attribute minimal :min.',
        'file' => 'Form :attribute minimal :min kilobytes.',
        'string' => 'Form :attribute minimal :min karakter.',
        'array' => 'Form :attribute minimal :min item.',
    ],
    'not_in' => 'Form :attribute yang dipilih tidak valid.',
    'numeric' => 'Form :attribute harus berupa angka.',
    'present' => 'Form :attribute wajib ada.',
    'regex' => 'Format Form :attribute tidak valid.',
    'required' => 'Form :attribute wajib diisi.',
    'required_if' => 'Form :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'Form :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with' => 'Form :attribute wajib diisi bila terdapat :values.',
    'required_with_all' => 'Form :attribute wajib diisi bila terdapat :values.',
    'required_without' => 'Form :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Form :attribute wajib diisi bila tidak terdapat ada :values.',
    'same' => 'Form :attribute dan :other harus sama.',
    'size' => [
        'numeric' => 'Form :attribute harus berukuran :size.',
        'file' => 'Form :attribute harus berukuran :size kilobyte.',
        'string' => 'Form :attribute harus berukuran :size karakter.',
        'array' => 'Form :attribute harus mengandung :size item.',
    ],
    'string' => 'Form :attribute harus berupa string.',
    'timezone' => 'Form :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Form :attribute sudah ada sebelumnya.',
    'uploaded' => 'Form :attribute gagal diunggah.',
    'url' => 'Format Form :attribute tidak valid.',
    /*
    |---------------------------------------------------------------------------------------
    | Baris Bahasa untuk Validasi Kustom
    |---------------------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan pesan validasi kustom untuk atribut dengan menggunakan
    | konvensi "attribute.rule" dalam penamaan baris. Hal ini membuat cepat dalam
    | menentukan spesifik baris bahasa kustom untuk aturan atribut yang diberikan.
    |
    */
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],
    /*
    |---------------------------------------------------------------------------------------
    | Kustom Validasi Atribut
    |---------------------------------------------------------------------------------------
    |
    | Baris bahasa berikut digunakan untuk menukar atribut 'place-holders'
    | dengan sesuatu yang lebih bersahabat dengan pembaca seperti Alamat Surel daripada
    | "surel" saja. Ini benar-benar membantu kita membuat pesan sedikit bersih.
    |
    */
    'attributes' => [
    ],
];