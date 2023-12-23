<?php
session_start();
// Pastikan session_start() sudah dipanggil di halaman lain yang memulai sesi

// Hancurkan semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Setelah menghancurkan sesi, alihkan ke halaman login atau halaman lain yang sesuai
header('Location: ../../../');
exit();
