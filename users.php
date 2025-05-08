<?php
// Header untuk API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Tampilkan error untuk debugging (pastikan ini hanya digunakan di lingkungan pengembangan)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
require_once "../api/config.php";

// Validasi apakah input adalah JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(array("status" => "error", "message" => "Input JSON tidak valid"));
        exit();
    }
}

// Mendapatkan metode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Memproses request berdasarkan metode HTTP
switch ($method) {
    case 'GET':
        // Mengambil data users
        $sql = "SELECT * FROM users";
        $result = mysqli_query($koneksi, $sql);
        
        if ($result) {
            $users = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = $row;
            }
            echo json_encode(array("status" => "success", "data" => $users));
        } else {
            echo json_encode(array("status" => "error", "message" => "Gagal mengambil data users"));
        }
        break;
        
    case 'POST':
        // Mengambil data dari request
        $action = isset($data['action']) ? $data['action'] : '';
        
        if (empty($action)) {
            echo json_encode(array("status" => "error", "message" => "Action tidak boleh kosong"));
            exit();
        }
        
        if ($action == 'login') {
            // Proses login
            $email = bersihkan_input($data['email']);
            $password = bersihkan_input($data['password']);
            $role = bersihkan_input($data['role']);
            
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND role='$role'";
            $result = mysqli_query($koneksi, $sql);
            
            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                echo json_encode(array("status" => "success", "data" => $user));
            } else {
                echo json_encode(array("status" => "error", "message" => "Email, password, atau role tidak sesuai!"));
            }
        } 
        elseif ($action == 'register') {
            // Proses register
            $id = 'user' . time();
            $name = bersihkan_input($data['name']);
            $email = bersihkan_input($data['email']);
            $password = bersihkan_input($data['password']);
            $role = bersihkan_input($data['role']);
            
            // Cek apakah email sudah ada
            $cek_email = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
            if (mysqli_num_rows($cek_email) > 0) {
                echo json_encode(array("status" => "error", "message" => "Email sudah terdaftar!"));
                exit();
            }
            
            $sql = "INSERT INTO users (id, name, email, password, role) VALUES ('$id', '$name', '$email', '$password', '$role')";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "Registrasi berhasil!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Registrasi gagal: " . mysqli_error($koneksi)));
            }
        }
        elseif ($action == 'update') {
            // Update user
            $id = bersihkan_input($data['id']);
            $name = bersihkan_input($data['name']);
            $password = isset($data['password']) && !empty($data['password']) ? bersihkan_input($data['password']) : null;
            
            if ($password) {
                $sql = "UPDATE users SET name='$name', password='$password' WHERE id='$id'";
            } else {
                $sql = "UPDATE users SET name='$name' WHERE id='$id'";
            }
            
            if (mysqli_query($koneksi, $sql)) {
                // Ambil data user terbaru
                $get_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
                $user = mysqli_fetch_assoc($get_user);
                
                echo json_encode(array("status" => "success", "message" => "Profil berhasil diupdate!", "data" => $user));
            } else {
                echo json_encode(array("status" => "error", "message" => "Update profil gagal: " . mysqli_error($koneksi)));
            }
        }
        elseif ($action == 'delete') {
            // Hapus user
            $id = bersihkan_input($data['id']);
            
            $sql = "DELETE FROM users WHERE id='$id'";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "User berhasil dihapus!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Query gagal: " . mysqli_error($koneksi)));
            }
        }
        else {
            echo json_encode(array("status" => "error", "message" => "Action tidak valid"));
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(array("status" => "error", "message" => "Metode HTTP tidak didukung"));
        break;
}

// Tutup koneksi database
mysqli_close($koneksi);

// Fungsi untuk membersihkan input
function bersihkan_input($data) {
    global $koneksi;
    return mysqli_real_escape_string($koneksi, trim($data));
}
