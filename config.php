<?php
session_start();
date_default_timezone_set('Asia/Jakarta');

error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$aang_url = 'https://' . $_SERVER['HTTP_HOST'] . '/';

$conn = mysqli_connect(
    'localhost',
    'root',
    '',
    'projek_portofolio'
);

if (!$conn) {
    die('<b>Koneksi Gagal</b>: ' .  mysqli_connect_error());
}

$get_web = $conn->query("SELECT * FROM website WHERE kode = 'aang'");
$data_web = $get_web->fetch_assoc();

$get_kontak = $conn->query("SELECT * FROM kontak WHERE kode = 'aang'");
$data_kontak = $get_kontak->fetch_assoc();

$date = date("Y-m-d");
$time = date("H:i:s");
$datetime = date("Y-m-d H:i:s");
$timestamp = round(microtime(true) * 1000);

function hitung_usia($tanggal_lahir) {
    $now = new DateTime();
    $lahir = new DateTime($tanggal_lahir);
    $diff = $now->diff($lahir);

    $usia = array(
        'y' => 'Tahun',
        'm' => 'Bulan',
        'd' => 'Hari',
    );

    foreach ($usia as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v;
        } else {
            unset($usia[$k]);
        }
    }

    return $usia ? implode(', ', $usia) : 'Baru';
}


function hitung_tahun($tanggal_lahir) {
    $now = new DateTime();
    $lahir = new DateTime($tanggal_lahir);
    $diff = $now->diff($lahir);

    if ($diff->y) {
        return $diff->y . ' Thn';
    } else {
        return 'Baru';
    }
}

function tanggal_indo($tanggal) {
    $bulan = array (1 => 'Januari', 'Februari','Maret', 'April', 'Mei',
        'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function tgl_indo($tanggal) {
    $bulan = array (1 => 'Jan', 'Feb','Mar', 'Apr', 'Mei',
        'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'
    );

    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}

function waktu_indo($waktu) {
    $date = new DateTime($waktu);
    return $date->format('H.i') . ' WIB';
}

function datetime_indo($datetime) {
    $bulan = array(1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des');

    $split = explode(' ', $datetime);
    $tanggal = $split[0];
    $waktu = $split[1];
    
    $tgl_split = explode('-', $tanggal);
    $formatted_date = $tgl_split[2] . ' ' . $bulan[(int)$tgl_split[1]] . ' ' . $tgl_split[0];
    
    $date = new DateTime($waktu);
    $formatted_time = $date->format('- H.i') . ' WIB';

    return $formatted_date . ' ' . $formatted_time;
}

function filter($data){
    $filter = stripslashes(strip_tags(htmlspecialchars(htmlentities($data,ENT_QUOTES))));
    return $filter;
}

function filterText($data){
    if (is_null($data)) {
        return ''; // Nilai default
    }
    $filter = stripslashes(strip_tags(htmlspecialchars(htmlentities($data, ENT_QUOTES))));
    return $filter;
}

function acak($length) {
	$str = "";
	$karakter = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max_karakter = count($karakter) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max_karakter);
		$str .= $karakter[$rand];
	}
	return $str;
}

function acak_kapital($length) {
	$str = "";
	$karakter = array_merge(range('A','Z'));
	$max_karakter = count($karakter) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max_karakter);
		$str .= $karakter[$rand];
	}
	return $str;
}

function acak_nomor($length) {
	$str = "";
	$karakter = array_merge(range('0','9'));
	$max_karakter = count($karakter) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max_karakter);
		$str .= $karakter[$rand];
	}
	return $str;
}

function acak_nh($length) {
	$str = "";
	$karakter = array_merge(range('A','Z'), range('0','9'));
	$max_karakter = count($karakter) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max_karakter);
		$str .= $karakter[$rand];
	}
	return $str;
}

function time_date_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $days = $diff->d + ($diff->m * 30) + ($diff->y * 365);

    $string = array(
        'y' => 'Tahun',
        'm' => 'Bulan',
        'd' => 'Hari',
        'h' => 'Jam',
        'i' => 'Menit',
        's' => 'Detik',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            if ($k == 'd') {
                $v = $days . ' ' . $v;
            } else {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            }
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' Yang Lalu' : 'Baru Saja';
}

function generateRandomFilename($ext) {
    return uniqid('file_', true) . '.' . $ext;
}

function saveImagesFromEditor($content, $uploadDir) {
    $matches = [];
    $savedPaths = [];
    preg_match_all('/<img src="data:image\/(.*?);base64,(.*?)"/', $content, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $imageType = $match[1];
        $imageData = base64_decode($match[2]);
        $imageName = bin2hex(random_bytes(8)) . '.' . $imageType;
        $imagePath = $uploadDir . $imageName;

        if (file_put_contents($imagePath, $imageData)) {
            $savedPaths[] = 'upload/postingan/' . $imageName;
            $content = str_replace($match[0], '<img src="' . $savedPaths[count($savedPaths) - 1] . '"', $content);
        }
    }

    return $content;
}