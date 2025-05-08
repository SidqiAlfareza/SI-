<?php
// Header untuk API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Koneksi ke database
require_once "../api/config.php";

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
        $data = json_decode(file_get_contents("php://input"), true);
        $action = isset($data['action']) ? $data['action'] : '';
        
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
        elseif ($action == 'updateByAdmin') {
            // Admin update user
            $id = bersihkan_input($data['id']);
            $name = bersihkan_input($data['name']);
            $role = bersihkan_input($data['role']);
            $oldRole = bersihkan_input($data['oldRole']);
            
            $sql = "UPDATE users SET name='$name', role='$role' WHERE id='$id'";
            
            if (mysqli_query($koneksi, $sql)) {
                // Jika role berubah dari tenant menjadi role lain, hapus layanan
                if ($oldRole == 'tenant' && $role != 'tenant') {
                    mysqli_query($koneksi, "DELETE FROM services WHERE tenant_id='$id'");
                }
                
                echo json_encode(array("status" => "success", "message" => "User berhasil diupdate!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Update user gagal: " . mysqli_error($koneksi)));
            }
        }
        elseif ($action == 'delete') {
            // Hapus user
            $id = bersihkan_input($data['id']);
            
            // Cek apakah user ada
            $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
            if (mysqli_num_rows($cek_user) == 0) {
                echo json_encode(array("status" => "error", "message" => "User tidak ditemukan!"));
                exit();
            }
            
            $user = mysqli_fetch_assoc($cek_user);
            
            // Cek apakah user adalah admin
            if ($user['role'] == 'admin') {
                echo json_encode(array("status" => "error", "message" => "Admin tidak dapat dihapus!"));
                exit();
            }
            
            // Cek apakah user adalah tenant dengan pesanan aktif
            if ($user['role'] == 'tenant') {
                $cek_booking = mysqli_query($koneksi, "SELECT * FROM bookings WHERE tenant_id='$id' AND (status='pending' OR status='confirmed')");
                if (mysqli_num_rows($cek_booking) > 0) {
                    echo json_encode(array("status" => "error", "message" => "Tidak dapat menghapus tenant karena memiliki pesanan aktif!"));
                    exit();
                }
                
                // Hapus layanan tenant
                mysqli_query($koneksi, "DELETE FROM services WHERE tenant_id='$id'");
            }
            
            // Cek apakah user adalah user biasa dengan pesanan aktif
            if ($user['role'] == 'user') {
                $cek_booking = mysqli_query($koneksi, "SELECT * FROM bookings WHERE user_id='$id' AND (status='pending' OR status='confirmed')");
                if (mysqli_num_rows($cek_booking) > 0) {
                    echo json_encode(array("status" => "error", "message" => "Tidak dapat menghapus user karena memiliki pesanan aktif!"));
                    exit();
                }
            }
            
            // Hapus user
            $sql = "DELETE FROM users WHERE id='$id'";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "User berhasil dihapus!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Hapus user gagal: " . mysqli_error($koneksi)));
            }
        }
        else {
            echo json_encode(array("status" => "error", "message" => "Action tidak valid"));
        }
        break;
        
    default:
        echo json_encode(array("status" => "error", "message" => "Metode HTTP tidak didukung"));
        break;
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
