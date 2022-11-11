User::create([
'username' => 'kanwil_kemenag',
'password' => bcrypt('11111111'),
'level' => 'kanwil'
])

Kanwil::create([
'id_user' => '1',
'nama_pimpinan' => 'Ari',
'alamat' => 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114',
'logo' => 'logo_kemenag.png'
])

Kab_kota::create([
'nama' => 'Kabupaten Agam',
])

User::create([
'username' => 'kemenag_agam',
'password' => bcrypt('11111111'),
'level' => 'kab/kota'
])

Kemenag_kab_kota::create([
'nama' => 'Kementerian Agama Kabupaten Agam',
'id_user' => '2',
'id_kab_kota' => '1',
'alamat' => 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114',
'logo' => 'logo_kemenag.png'
])

User::create([
'username' => 'mftt_agm',
'password' => bcrypt('11111111'),
'level' => 'ppiu'
])

Ppiu::create([
'nama' => 'PT. Mahabbah Family Tour dan Travel',
'id_user' => '3',
'id_kab_kota' => '1',
'status' => 'Pusat',
'nomor_sk' => 'No. 9120005970756 Tahun 2022',
'tanggal_sk' => '2022-01-27',
'alamat' => 'Jalan Lintas Lubuk Basung Bukittinggi Jorong Lubuk Anyir RT/RW 00/00 Kel. Bayua Kec. Tanjung Raya Kab. Agam',
'logo' => 'default.png'
])