<?php
session_start();

// Hancurkan semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

header('Location: ../../../login');
exit();
