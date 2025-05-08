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
        // Mengambil data layanan
        $tenant_id = isset($_GET['tenant_id']) ? bersihkan_input($_GET['tenant_id']) : null;
        
        if ($tenant_id) {
            // Ambil layanan berdasarkan tenant_id
            $sql = "SELECT * FROM services WHERE tenant_id='$tenant_id'";
        } else {
            // Ambil semua layanan
            $sql = "SELECT * FROM services";
        }
        
        $result = mysqli_query($koneksi, $sql);
        
        if ($result) {
            $services = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $services[] = $row;
            }
            echo json_encode(array("status" => "success", "data" => $services));
        } else {
            echo json_encode(array("status" => "error", "message" => "Gagal mengambil data layanan"));
        }
        break;
        
    case 'POST':
        // Mengambil data dari request
        $data = json_decode(file_get_contents("php://input"), true);
        $action = isset($data['action']) ? $data['action'] : '';
        
        if ($action == 'create') {
            // Tambah layanan baru
            $id = 'service' . time();
            $tenant_id = bersihkan_input($data['tenant_id']);
            $name = bersihkan_input($data['name']);
            $description = bersihkan_input($data['description']);
            $price = bersihkan_input($data['price']);
            
            $sql = "INSERT INTO services (id, tenant_id, name, description, price) VALUES ('$id', '$tenant_id', '$name', '$description', '$price')";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "Layanan berhasil ditambahkan!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Tambah layanan gagal: " . mysqli_error($koneksi)));
            }
        }
        elseif ($action == 'update') {
            // Update layanan
            $id = bersihkan_input($data['id']);
            $name = bersihkan_input($data['name']);
            $description = bersihkan_input($data['description']);
            $price = bersihkan_input($data['price']);
            
            $sql = "UPDATE services SET name='$name', description='$description', price='$price' WHERE id='$id'";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "Layanan berhasil diupdate!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Update layanan gagal: " . mysqli_error($koneksi)));
            }
        }
        elseif ($action == 'delete') {
            // Hapus layanan
            $id = bersihkan_input($data['id']);
            
            // Cek apakah layanan sedang dalam pesanan aktif
            $cek_booking = mysqli_query($koneksi, "SELECT * FROM bookings WHERE service_id='$id' AND (status='pending' OR status='confirmed')");
            if (mysqli_num_rows($cek_booking) > 0) {
                echo json_encode(array("status" => "error", "message" => "Tidak dapat menghapus layanan karena sedang ada pesanan aktif!"));
                exit();
            }
            
            $sql = "DELETE FROM services WHERE id='$id'";
            
            if (mysqli_query($koneksi, $sql)) {
                echo json_encode(array("status" => "success", "message" => "Layanan berhasil dihapus!"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Hapus layanan gagal: " . mysqli_error($koneksi)));
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
