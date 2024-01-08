<?php
session_start();

// Hancurkan semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Setelah menghancurkan sesi, alihkan ke halaman login atau halaman lain yang sesuai
header('Location: ../../../');
exit();