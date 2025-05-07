<?php
// Header untuk API
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Koneksi ke database
require_once "../koneksi.php";

// Mendapatkan metode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Memproses request berdasarkan metode HTTP
switch ($method) {
    case 'GET':
        // Mengambil data bookings
        $user_id = isset($_GET['user_id']) ? bersihkan_input($_GET['user_id']) : null;
        $tenant_id = isset($_GET['tenant_id']) ? bersihkan_input($_GET['tenant_id']) : null;
        
        if ($user_id) {
            // Ambil bookings berdasarkan user_id
            $sql = "SELECT * FROM bookings WHERE user_id='$user_id'";
        } elseif ($tenant_id) {
            // Ambil bookings berdasarkan tenant_id
            $sql = "SELECT * FROM bookings WHERE tenant_id='$tenant_id'";
        } else {
            // Ambil semua bookings
            $sql = "SELECT * FROM bookings";
        }
        
        $result = mysqli_query($koneksi, $sql);
        
        if ($result) {
            $bookings = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $bookings[] = $row;
            }
            echo json_encode(array("status" => "success", "data" => $bookings));
        } else {
            echo json_encode(array("status" => "error", "message" => "Gagal mengambil data bookings"));
        }
        break;
        
    case 'POST':
        // Mengambil data dari request
        $data = json_decode(file_get_contents("php://input"), true);
        $action = isset($data['action']) ? $data['action'] : '';
        
        if ($action == 'create') {
            // Buat booking baru
            $id = 'booking' . time();
            $user_id = bersihkan_input($data['user_id']);
            $user_name = bersihkan_input($data['user_name']);
            $tenant_id = bersihkan_input($data['tenant_id']);
            $service_id = bersihkan_input($data['service_id']);
            $service_name = bersihkan_input($data['service_name']);
            $booking_date = bersihkan_input($data['date']);
            $notes = bersihkan_input($data['notes']);
            
            $sql = "INSERT INTO bookings (id, user_id, user_name, tenant_id, service_id, service_name, booking_date, notes, status) 
                    VALUES ('$id', '$user_id', '$user_name', '$tenant_id', '$service_id', '$service_name', '$booking_date', '$notes', 'pending')";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "Pesanan berhasil dibuat!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Pembuatan pesanan gagal: " . mysqli_error($koneksi)));
            }
        }
        elseif ($action == 'updateStatus') {
            // Update status booking
            $id = bersihkan_input($data['id']);
            $status = bersihkan_input($data['status']);
            
            $sql = "UPDATE bookings SET status='$status' WHERE id='$id'";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "Status pesanan berhasil diupdate!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Update status pesanan gagal: " . mysqli_error($koneksi)));
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