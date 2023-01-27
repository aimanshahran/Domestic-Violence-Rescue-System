<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute mestilah diterima.',
    'accepted_if' => ':attribute mestilah diterima bila :other ialah :value.',
    'active_url' => ':attribute bukan URL yang sah.',
    'after' => ':attribute mestilah satu tarikh selepas :date.',
    'after_or_equal' => ':attribute mestilah satu tarikh selepas atau sama dengan :date.',
    'alpha' => ':attribute hendaklah mengandungi huruf.',
    'alpha_dash' => ':attribute hendaklah mengandungi huruf, nombor, sempang dan garis bawah sahaja.',
    'alpha_num' => ':attribute mestilah mengandungi huruf dan nombor sahaja.',
    'alpha_spaces' => ':attribute hanya boleh mengandungi huruf dan ruang.',
    'array' => 'The :attribute mestilah dalam bentuk array.',
    'before' => 'The :attribute mestilah satu tarikh sebelum :date. ',
    'before_or_equal' => ':attribute mestilah satu tarikh sebelum atau sama dengan :date.',
    'between' => [
        'array' => ':attribute mestilah mempunyai antara item :min dan :max.',
        'file' => ':attribute mestilah di antara :min and :max kilobytes.',
        'numeric' => ':attribute mestilah di antara :min and :max.',
        'string' => ':attribute mestilah di antara :min and :max huruf.',
    ],
    'boolean' => 'Medan :attribute mestilah benar atau salah.',
    'confirmed' => 'Pengesahan :attribute tidak sepadan.',
    'current_password' => 'Kata laluan anda tidak betul.',
    'date' => ':attribute bukan tarikh yang sah.',
    'date_equals' => ':attribute mestilah satu tarikh yang sama dengan :date.',
    'date_format' => ':attribute tidak sepadan dengan format :format.',
    'declined' => ':attribute mesti ditolak.',
    'declined_if' => ':attribute mesti ditolak bila :other ialah :value.',
    'different' => ':attribute dan :other mestilah berlainan.',
    'digits' => ':attribute mestilah :digits digit.',
    'digits_between' => 'Jumlah :attribute mestilah diantara :min dan :max digit.',
    'dimensions' => ':attribute mempunyai dimensi imej yang tidak sah.',
    'distinct' => 'Medan :attribute mempunyai nilai pendua.',
    'doesnt_end_with' => ':attribute mungkin tidak berakhir dengan salah satu daripada yang berikut: :values.',
    'doesnt_start_with' => ':attribute mungkin tidak bermula dengan salah satu daripada yang berikut: :values.',
    'email' => ':attribute mesti alamat e-mel yang sah.',
    'ends_with' => ':attribute mestilah berakhir dengan salah satu daripada yang berikut: :values.',
    'enum' => ':attribute yang dipilih tidak sah.',
    'exists' => ':attribute yang dipilih tidak sah.',
    'file' => ':attribute mestilah fail.',
    'filled' => 'Medan :attribute perlu diisi.',
    'gt' => [
        'array' => ':attribute mesti mempunyai lebih daripada item :value.',
        'file' => ':attribute mestilah lebih besar daripada :value kilobait.',
        'numeric' => ':attribute mestilah lebih besar daripada :value.',
        'string' => ':attribute mestilah lebih besar daripada :value huruf.',
    ],
    'gte' => [
        'array' => ':attribute mesti mempunyai :value butiran atau lebih.',
        'file' => 'Nilai :attribute mesti lebih atau sama dengan :value kilobait.',
        'numeric' => 'Nilai :attribute mesti lebih atau sama dengan :value.',
        'string' => ':attribute mesti lebih atau sama dengan :value huruf.',
    ],
    'image' => ':attribute mesti sebuah gambar.',
    'in' => ':attribute yang dipilih adalah tidak sah.',
    'in_array' => 'Medan :attribute tidak wujud dalam :other.',
    'integer' => ':attribute mesti dalam bentuk integer.',
    'ip' => ':attribute mestilah alamat IP yang sah.',
    'ipv4' => ':attribute mestilah alamat IPv4 yang sah.',
    'ipv6' => ':attribute mestilah alamat IPv6 yang sah.',
    'json' => ':attribute mestilah rentetan JSON yang sah.',
    'lt' => [
        'array' => ':attribute mesti kurang dari :value perkara.',
        'file' => ':attribute mesti kurang dari :value kilobait.',
        'numeric' => 'Nilai :attribute mesti kurang dari :value.',
        'string' => ':attribute mesti kurang dari :value huruf.',
    ],
    'lte' => [
        'array' => ':attribute mesti tidak melebihi dari :value perkara.',
        'file' => ':attribute mesti kurang atau sama dengan :value kilobait.',
        'numeric' => ':attribute mesti kurang atau sama dengan :value.',
        'string' => ':attribute mesti kurang atau sama dengan :value huruf.',
    ],
    'mac_address' => ':attribute mestilah satu alamat MAC yang sah.',
    'max' => [
        'array' => ':attribute mesti tidak melebihi dari :max perkara.',
        'file' => ':attribute mesti kurang dari :max kilobait.',
        'numeric' => ':attribute mesti kurang dari :max.',
        'string' => ':attribute mesti kurang dari :max huruf.',
    ],
    'mimes' => ':attribute mestilah fail berjenis: :values.',
    'mimetypes' => ':attribute mestilah fail berjenis: :values.',
    'min' => [
        'array' => ':attribute mesti mempunyai sekurang-kurangnya :min perkara.',
        'file' => ':attribute mesti mempunyai sekurang-kurangnya :min kilobait.',
        'numeric' => ':attribute mesti mempunyai sekurang-kurangnya :min.',
        'string' => ':attribute mesti mempunyai sekurang-kurangnya :min huruf.',
    ],
    'multiple_of' => ':attribute mestilah gandaan :value.',
    'not_in' => ':attribute yang dipilih adalah tidak sah.',
    'not_regex' => 'Format :attribute format adalah tidak sah.',
    'numeric' => ':attribute mestilah bernombor.',
    'password' => [
        'letters' => ':attribute mestilah mempunyai sekurang-kurangnya satu huruf.',
        'mixed' => ':attribute mestilah mempunyai sekurang-kurangnya satu huruf kecil dan satu huruf besar.',
        'numbers' => ':attribute mestilah mempunyai sekurang-kurangnya satu nombor.',
        'symbols' => ':attribute mestilah mempunyai sekurang-kurangnya satu simbol unik.',
        'uncompromised' => ':attribute yang diberi muncul dalam kebocoran data. Sila pilih :attribute yang berlainan.',
    ],
    'phone' => ':attribute mestilah nombor telefon yang sah.',
    'present' => 'Medan :attribute mesti ada.',
    'prohibited' => 'Medan :attribute adalah dilarang.',
    'prohibited_if' => 'Medan :attribute adalah dilarang bila :other adalah :value.',
    'prohibited_unless' => 'Medan :attribute adalah dilarang kecuali :other berada dalam :values.',
    'prohibits' => 'Medan :attribute melarang :other untuk muncul.',
    'regex' => 'Format :attribute adalah tidak sah.',
    'required' => 'Medan :attribute adalah diperlukan.',
    'required_array_keys' => 'Medan :attribute mesti mengandungi entri untuk: :values.',
    'required_if' => 'Medan :attribute diperlukan bila :other adalah :value.',
    'required_unless' => 'Medan :attribute diperlukan bila melainkan :other berada dalam :values.',
    'required_with' => 'Medan :attribute diperlukan bila :values ada.',
    'required_with_all' => 'Medan :attribute diperlukan bila :values ada.',
    'required_without' => 'Medan :attribute diperlukan bila :values tiada.',
    'required_without_all' => 'Medan :attribute diperlukan bila tiada satu pun daripada :values ada.',
    'same' => ':attribute dan :other mestilah sepadan.',
    'size' => [
        'array' => ':attribute mestilah mempunyai :size perkara.',
        'file' => ':attribute mestilah mempunyai :size kilobait.',
        'numeric' => ':attribute mestilah mempunyai :size.',
        'string' => ':attribute mestilah mempunyai :size huruf.',
    ],
    'starts_with' => ':attribute mestilah dimulai dengan salah satu daripada: :values.',
    'string' => ':attribute mestilah rentetan.',
    'timezone' => ':attribute mestilah zon waktu yang sah.',
    'unique' => ':attribute telah pun diambil.',
    'uploaded' => ':attribute gagal memuat naik.',
    'url' => ':attribute mestilah URL yang sah.',
    'uuid' => ':attribute mestilah UUID yang sah.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
