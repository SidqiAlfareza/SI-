// URL API
const BASE_URL = "http://localhost/si/api"; 

// Fungsi untuk mengambil data dari API
async function fetchAPI(url, method = 'GET', data = null) {
    try {
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            }
        };

        if (data) {
            options.body = JSON.stringify(data);
        }

        const response = await fetch(url, options);

        // Tambahkan validasi status HTTP sebelum memproses JSON
        if (!response.ok) {
            console.error(`HTTP Error: ${response.status} - ${response.statusText}`);
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json(); // Gagal jika respon bukan JSON
        return result;
    } catch (error) {
        console.error('Error:', error);
        return { status: 'error', message: 'Terjadi kesalahan pada server' };
    }
}


// ----- USER FUNCTIONS -----

// Fungsi untuk login
document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const role = document.getElementById('loginRole').value;
    
    const response = await fetchAPI(`${BASE_URL}/users.php`, 'POST', {
        action: 'login',
        email: email,
        password: password,
        role: role
    });
    
    if (response.status === 'success') {
        // Simpan user ke session
        sessionStorage.setItem('currentUser', JSON.stringify(response.data));
        
        // Update UI
        document.getElementById('nav-login').classList.add('hidden');
        document.getElementById('nav-register').classList.add('hidden');
        document.getElementById('nav-logout').classList.remove('hidden');
        
        // Tampilkan dashboard sesuai role
        if (response.data.role === 'user') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('user-dashboard').classList.remove('hidden');
            loadUserDashboard();
        } else if (response.data.role === 'tenant') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('tenant-dashboard').classList.remove('hidden');
            loadTenantDashboard();
        } else if (response.data.role === 'admin') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('admin-dashboard').classList.remove('hidden');
            loadAdminDashboard();
        }
    } else {
        alert(response.message);
    }
});

// Fungsi untuk register
document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const name = document.getElementById('registerName').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const role = document.getElementById('registerRole').value;
    
    const response = await fetchAPI(`${BASE_URL}/users.php`, 'POST', {
        action: 'register',
        name: name,
        email: email,
        password: password,
        role: role
    });
    
    if (response.status === 'success') {
        alert('Registrasi berhasil! Silakan login.');
        showLoginForm();
    } else {
        alert(response.message);
    }
});

// Fungsi untuk logout
function logout() {
    sessionStorage.removeItem('currentUser');
    
    // Update UI
    document.getElementById('nav-login').classList.remove('hidden');
    document.getElementById('nav-register').classList.remove('hidden');
    document.getElementById('nav-logout').classList.add('hidden');
    
    // Sembunyikan semua dashboard
    document.getElementById('user-dashboard').classList.add('hidden');
    document.getElementById('tenant-dashboard').classList.add('hidden');
    document.getElementById('admin-dashboard').classList.add('hidden');
    
    // Tampilkan form login
    document.getElementById('login-form').classList.remove('hidden');
    document.getElementById('register-form').classList.add('hidden');
}

// ----- USER DASHBOARD FUNCTIONS -----

// Fungsi untuk load dashboard user
function loadUserDashboard() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    
    // Load profil user
    document.getElementById('user-name').value = currentUser.name;
    document.getElementById('user-email').value = currentUser.email;
    
    // Load layanan yang tersedia
    loadAvailableServices();
    
    // Load pesanan user
    loadUserBookings();
}

// Fungsi untuk menampilkan layanan yang tersedia
async function loadAvailableServices() {
    const servicesList = document.getElementById('services-list');
    servicesList.innerHTML = '';
    
    const response = await fetchAPI(`${BASE_URL}/services.php`);
    
    if (response.status === 'success') {
        const services = response.data;
        
        if (services.length === 0) {
            servicesList.innerHTML = '<div class="col-12"><p class="text-center">Belum ada layanan tersedia.</p></div>';
            return;
        }
        
        services.forEach(service => {
            const serviceCard = document.createElement('div');
            serviceCard.className = 'col-md-6 col-lg-4';
            serviceCard.innerHTML = `
                <div class="card booking-card">
                    <div class="card-body">
                        <h5 class="card-title">${service.name}</h5>
                        <p class="card-text">${service.description}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">Rp${service.price}</span>
                            <button class="btn btn-primary btn-sm" onclick="showBookingModal('${service.id}')">Pesan</button>
                        </div>
                    </div>
                </div>
            `;
            servicesList.appendChild(serviceCard);
        });
    } else {
        servicesList.innerHTML = '<div class="col-12"><p class="text-center text-danger">Gagal memuat layanan: ' + response.message + '</p></div>';
    }
}

// Fungsi untuk load pesanan user
async function loadUserBookings() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const userBookingsTable = document.getElementById('user-bookings-table');
    userBookingsTable.innerHTML = '';
    
    const response = await fetchAPI(`${BASE_URL}/bookings.php?user_id=${currentUser.id}`);
    
    if (response.status === 'success') {
        const userBookings = response.data;
        
        if (userBookings.length === 0) {
            userBookingsTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada pesanan.</td></tr>';
            return;
        }
        
        userBookings.forEach(booking => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${booking.id}</td>
                <td>${booking.service_name}</td>
                <td>${booking.booking_date}</td>
                <td><span class="badge ${getStatusBadgeClass(booking.status)}">${booking.status}</span></td>
                <td>
                    ${booking.status === 'pending' ? `<button class="btn btn-danger btn-sm" onclick="cancelBooking('${booking.id}')">Batalkan</button>` : ''}
                </td>
            `;
            userBookingsTable.appendChild(row);
        });
    } else {
        userBookingsTable.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat pesanan: ' + response.message + '</td></tr>';
    }
}

// Fungsi untuk mendapatkan class badge sesuai status
function getStatusBadgeClass(status) {
    switch (status) {
        case 'pending':
            return 'bg-warning';
        case 'confirmed':
            return 'bg-success';
        case 'cancelled':
            return 'bg-danger';
        case 'completed':
            return 'bg-info';
        default:
            return 'bg-secondary';
    }
}

// Fungsi untuk menampilkan modal booking
async function showBookingModal(serviceId) {
    const response = await fetchAPI(`${BASE_URL}/services.php`);
    
    if (response.status === 'success') {
        const services = response.data;
        const service = services.find(s => s.id === serviceId);
        
        if (service) {
            document.getElementById('booking-service-id').value = service.id;
            document.getElementById('booking-service-name').value = service.name;
            
            // Set minimal date ke hari ini
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('booking-date').setAttribute('min', today);
            
            const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
            bookingModal.show();
        }
    } else {
        alert('Gagal memuat data layanan: ' + response.message);
    }
}

// Fungsi untuk membuat pesanan
async function createBooking() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const serviceId = document.getElementById('booking-service-id').value;
    const serviceName = document.getElementById('booking-service-name').value;
    const date = document.getElementById('booking-date').value;
    const notes = document.getElementById('booking-notes').value;
    
    if (!date) {
        alert('Silakan pilih tanggal pesanan!');
        return;
    }
    
    // Ambil data layanan untuk mendapatkan tenant_id
    const serviceResponse = await fetchAPI(`${BASE_URL}/services.php`);
    if (serviceResponse.status !== 'success') {
        alert('Gagal memuat data layanan: ' + serviceResponse.message);
        return;
    }
    
    const services = serviceResponse.data;
    const service = services.find(s => s.id === serviceId);
    
    if (!service) {
        alert('Layanan tidak ditemukan!');
        return;
    }
    
    const response = await fetchAPI(`${BASE_URL}/bookings.php`, 'POST', {
        action: 'create',
        user_id: currentUser.id,
        user_name: currentUser.name,
        tenant_id: service.tenant_id,
        service_id: serviceId,
        service_name: serviceName,
        date: date,
        notes: notes
    });
    
    if (response.status === 'success') {
        const bookingModal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
        bookingModal.hide();
        
        alert('Pesanan berhasil dibuat!');
        loadUserBookings();
    } else {
        alert('Gagal membuat pesanan: ' + response.message);
    }
}

// Fungsi untuk load layanan tenant TENANT DASHBOARD FUNCTION
async function loadTenantServices() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const tenantServicesTable = document.getElementById('tenant-services-table');
    tenantServicesTable.innerHTML = '';
    
    // Fetch services dari API
    const response = await fetchAPI(`${BASE_URL}/services.php?tenant_id=${currentUser.id}`);
    
    if (response.status === 'success') {
        const tenantServices = response.data;
        
        if (tenantServices.length === 0) {
            tenantServicesTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada layanan.</td></tr>';
            return;
        }
        
        tenantServices.forEach(service => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${service.id}</td>
                <td>${service.name}</td>
                <td>${service.description.substring(0, 50)}${service.description.length > 50 ? '...' : ''}</td>
                <td>Rp${service.price}</td>
                <td>
                    <button class="btn btn-sm btn-primary me-1" onclick="editService('${service.id}')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteService('${service.id}')">Hapus</button>
                </td>
            `;
            tenantServicesTable.appendChild(row);
        });
    } else {
        tenantServicesTable.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat layanan: ' + response.message + '</td></tr>';
    }
}

// Fungsi untuk menampilkan form tambah layanan
function showAddServiceForm() {
    document.getElementById('add-service-form').classList.remove('hidden');
    document.getElementById('service-id').value = '';
    document.getElementById('service-form').reset();
}

// Fungsi untuk membatalkan tambah layanan
function cancelAddService() {
    document.getElementById('add-service-form').classList.add('hidden');
    document.getElementById('service-form').reset();
}

// Fungsi untuk tambah/edit layanan
document.getElementById('service-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const serviceId = document.getElementById('service-id').value;
    const name = document.getElementById('service-name').value;
    const description = document.getElementById('service-description').value;
    const price = document.getElementById('service-price').value;
    
    if (!name || !description || !price) {
        alert('Semua field harus diisi!');
        return;
    }
    
    let action = serviceId ? 'update' : 'create';
    
    const response = await fetchAPI(`${BASE_URL}/services.php`, 'POST', {
        action: action,
        id: serviceId || null,
        tenant_id: currentUser.id,
        name: name,
        description: description,
        price: price
    });
    
    if (response.status === 'success') {
        alert(serviceId ? 'Layanan berhasil diupdate!' : 'Layanan berhasil ditambahkan!');
        cancelAddService();
        loadTenantServices();
    } else {
        alert('Gagal ' + (serviceId ? 'mengupdate' : 'menambahkan') + ' layanan: ' + response.message);
    }
});

// Fungsi untuk edit layanan
async function editService(serviceId) {
    const response = await fetchAPI(`${BASE_URL}/services.php?id=${serviceId}`);
    
    if (response.status === 'success' && response.data) {
        const service = response.data;
        
        document.getElementById('service-id').value = service.id;
        document.getElementById('service-name').value = service.name;
        document.getElementById('service-description').value = service.description;
        document.getElementById('service-price').value = service.price;
        
        document.getElementById('add-service-form').classList.remove('hidden');
    } else {
        alert('Gagal memuat data layanan: ' + (response.message || 'Layanan tidak ditemukan'));
    }
}

// Fungsi untuk hapus layanan
async function deleteService(serviceId) {
    if (confirm('Apakah Anda yakin ingin menghapus layanan ini?')) {
        // Cek apakah layanan sedang dalam pesanan aktif
        const bookingResponse = await fetchAPI(`${BASE_URL}/bookings.php?service_id=${serviceId}&status=active`);
        
        if (bookingResponse.status === 'success' && bookingResponse.data.length > 0) {
            alert('Tidak dapat menghapus layanan karena sedang ada pesanan aktif!');
            return;
        }
        
        const response = await fetchAPI(`${BASE_URL}/services.php`, 'POST', {
            action: 'delete',
            id: serviceId
        });
        
        if (response.status === 'success') {
            alert('Layanan berhasil dihapus!');
            loadTenantServices();
        } else {
            alert('Gagal menghapus layanan: ' + response.message);
        }
    }
}

// Fungsi untuk load pesanan masuk tenant
async function loadTenantBookings() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const tenantBookingsTable = document.getElementById('tenant-bookings-table');
    tenantBookingsTable.innerHTML = '';
    
    const response = await fetchAPI(`${BASE_URL}/bookings.php?tenant_id=${currentUser.id}`);
    
    if (response.status === 'success') {
        const tenantBookings = response.data;
        
        if (tenantBookings.length === 0) {
            tenantBookingsTable.innerHTML = '<tr><td colspan="6" class="text-center">Belum ada pesanan masuk.</td></tr>';
            return;
        }
        
        tenantBookings.forEach(booking => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${booking.id}</td>
                <td>${booking.user_name}</td>
                <td>${booking.service_name}</td>
                <td>${booking.booking_date}</td>
                <td><span class="badge ${getStatusBadgeClass(booking.status)}">${booking.status}</span></td>
                <td>
                    ${booking.status === 'pending' ? `
                        <button class="btn btn-success btn-sm me-1" onclick="confirmBooking('${booking.id}')">Konfirmasi</button>
                        <button class="btn btn-danger btn-sm" onclick="rejectBooking('${booking.id}')">Tolak</button>
                    ` : ''}
                </td>
            `;
            tenantBookingsTable.appendChild(row);
        });
    } else {
        tenantBookingsTable.innerHTML = '<tr><td colspan="6" class="text-center text-danger">Gagal memuat pesanan: ' + response.message + '</td></tr>';
    }
}

// Fungsi untuk konfirmasi pesanan
async function confirmBooking(bookingId) {
    if (confirm('Konfirmasi pesanan ini?')) {
        const response = await fetchAPI(`${BASE_URL}/bookings.php`, 'POST', {
            action: 'update_status',
            id: bookingId,
            status: 'confirmed'
        });
        
        if (response.status === 'success') {
            alert('Pesanan berhasil dikonfirmasi!');
            loadTenantBookings();
        } else {
            alert('Gagal mengkonfirmasi pesanan: ' + response.message);
        }
    }
}

// Fungsi untuk menolak pesanan
async function rejectBooking(bookingId) {
    if (confirm('Tolak pesanan ini?')) {
        const response = await fetchAPI(`${BASE_URL}/bookings.php`, 'POST', {
            action: 'update_status',
            id: bookingId,
            status: 'cancelled'
        });
        
        if (response.status === 'success') {
            alert('Pesanan berhasil ditolak!');
            loadTenantBookings();
        } else {
            alert('Gagal menolak pesanan: ' + response.message);
        }
    }
}

// Fungsi untuk navigasi pada dashboard tenant
function showTenantSection(sectionId) {
    // Sembunyikan semua section
    const sections = document.querySelectorAll('.tenant-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    
    // Tampilkan section yang dipilih
    document.getElementById(sectionId).classList.remove('hidden');
    
    // Update active menu
    const menuItems = document.querySelectorAll('#tenant-dashboard .sidebar-menu li');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    const activeMenuItem = Array.from(menuItems).find(item => 
        item.getAttribute('onclick').includes(sectionId)
    );
    
    if (activeMenuItem) {
        activeMenuItem.classList.add('active');
    }
}

// Fungsi untuk update profil tenant
document.getElementById('tenant-profile-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const name = document.getElementById('tenant-name').value;
    const password = document.getElementById('tenant-password').value;
    
    if (!name) {
        alert('Nama tidak boleh kosong!');
        return;
    }
    
    const response = await fetchAPI(`${BASE_URL}/users.php`, 'POST', {
        action: 'update',
        id: currentUser.id,
        name: name,
        password: password || null
    });
    
    if (response.status === 'success') {
        // Update data di session storage
        const updatedUser = {...currentUser, name: name};
        sessionStorage.setItem('currentUser', JSON.stringify(updatedUser));
        
        alert('Profil berhasil diupdate!');
        document.getElementById('tenant-password').value = '';
    } else {
        alert('Gagal update profil: ' + response.message);
    }
});

// ===== ADMIN DASHBOARD FUNCTIONS =====

// Fungsi untuk load dashboard admin
async function loadAdminDashboard() {
    await loadAdminUsers();
    await loadAdminTenants();
    await loadAdminBookings();
}

// Fungsi untuk load users untuk admin
async function loadAdminUsers() {
    const adminUsersTable = document.getElementById('admin-users-table');
    adminUsersTable.innerHTML = '';
    
    const response = await fetchAPI(`${BASE_URL}/users.php?role=all`);
    
    if (response.status === 'success') {
        const users = response.data;
        
        if (users.length === 0) {
            adminUsersTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada user.</td></tr>';
            return;
        }
        
        users.forEach(user => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.role}</td>
                <td>
                    <button class="btn btn-sm btn-primary me-1" onclick="showEditUserModal('${user.id}')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser('${user.id}')" ${user.role === 'admin' ? 'disabled' : ''}>Hapus</button>
                </td>
            `;
            adminUsersTable.appendChild(row);
        });
    } else {
        adminUsersTable.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data user: ' + response.message + '</td></tr>';
    }
}

// Fungsi untuk menampilkan modal edit user
async function showEditUserModal(userId) {
    const response = await fetchAPI(`${BASE_URL}/users.php?id=${userId}`);
    
    if (response.status === 'success' && response.data) {
        const user = response.data;
        
        document.getElementById('edit-user-id').value = user.id;
        document.getElementById('edit-user-name').value = user.name;
        document.getElementById('edit-user-email').value = user.email;
        document.getElementById('edit-user-role').value = user.role;
        
        const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
        editUserModal.show();
    } else {
        alert('Gagal memuat data user: ' + (response.message || 'User tidak ditemukan'));
    }
}

// Fungsi untuk update user oleh admin
async function updateUser() {
    const userId = document.getElementById('edit-user-id').value;
    const name = document.getElementById('edit-user-name').value;
    const role = document.getElementById('edit-user-role').value;
    
    if (!name) {
        alert('Nama tidak boleh kosong!');
        return;
    }
    
    const response = await fetchAPI(`${BASE_URL}/users.php`, 'POST', {
        action: 'update_role',
        id: userId,
        name: name,
        role: role
    });
    
    if (response.status === 'success') {
        const editUserModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
        editUserModal.hide();
        
        alert('User berhasil diupdate!');
        loadAdminDashboard();
    } else {
        alert('Gagal update user: ' + response.message);
    }
}

// Fungsi untuk hapus user oleh admin
async function deleteUser(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
        
        if (userId === currentUser.id) {
            alert('Anda tidak dapat menghapus akun Anda sendiri!');
            return;
        }
        
        // Cek status user
        const userResponse = await fetchAPI(`${BASE_URL}/users.php?id=${userId}`);
        
        if (userResponse.status !== 'success' || !userResponse.data) {
            alert('User tidak ditemukan!');
            return;
        }
        
        const userToDelete = userResponse.data;
        
        if (userToDelete.role === 'admin') {
            alert('Admin tidak dapat dihapus!');
            return;
        }
        
        // Cek apakah ada pesanan aktif
        const bookingResponse = await fetchAPI(`${BASE_URL}/bookings.php?${userToDelete.role === 'tenant' ? 'tenant_id' : 'user_id'}=${userId}&status=active`);
        
        if (bookingResponse.status === 'success' && bookingResponse.data.length > 0) {
            alert(`Tidak dapat menghapus ${userToDelete.role} karena memiliki pesanan aktif!`);
            return;
        }
        
        // Hapus user
        const response = await fetchAPI(`${BASE_URL}/users.php`, 'POST', {
            action: 'delete',
            id: userId
        });
        
        if (response.status === 'success') {
            alert('User berhasil dihapus!');
            loadAdminDashboard();
        } else {
            alert('Gagal menghapus user: ' + response.message);
        }
    }
}

// Fungsi untuk load tenants untuk admin
async function loadAdminTenants() {
    const adminTenantsTable = document.getElementById('admin-tenants-table');
    adminTenantsTable.innerHTML = '';
    
    const response = await fetchAPI(`${BASE_URL}/users.php?role=tenant`);
    
    if (response.status === 'success') {
        const tenants = response.data;
        
        if (tenants.length === 0) {
            adminTenantsTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada tenant.</td></tr>';
            return;
        }
        
        // Dapatkan jumlah layanan untuk setiap tenant
        const serviceResponse = await fetchAPI(`${BASE_URL}/services.php`);
        const services = serviceResponse.status === 'success' ? serviceResponse.data : [];
        
        tenants.forEach(tenant => {
            const tenantServices = services.filter(service => service.tenant_id === tenant.id);
            
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${tenant.id}</td>
                <td>${tenant.name}</td>
                <td>${tenant.email}</td>
                <td>${tenantServices.length}</td>
                <td>
                    <button class="btn btn-sm btn-primary me-1" onclick="showEditUserModal('${tenant.id}')">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser('${tenant.id}')">Hapus</button>
                </td>
            `;
            adminTenantsTable.appendChild(row);
        });
    } else {
        adminTenantsTable.innerHTML = '<tr><td colspan="5" class="text-center text-danger">Gagal memuat data tenant: ' + response.message + '</td></tr>';
    }
}

// Fungsi untuk load bookings untuk admin
async function loadAdminBookings() {
    const adminBookingsTable = document.getElementById('admin-bookings-table');
    adminBookingsTable.innerHTML = '';
    
    const response = await fetchAPI(`${BASE_URL}/bookings.php?role=admin`);
    
    if (response.status === 'success') {
        const bookings = response.data;
        
        if (bookings.length === 0) {
            adminBookingsTable.innerHTML = '<tr><td colspan="7" class="text-center">Belum ada booking.</td></tr>';
            return;
        }
        
        bookings.forEach(booking => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${booking.id}</td>
                <td>${booking.user_name || 'User tidak ditemukan'}</td>
                <td>${booking.tenant_name || 'Tenant tidak ditemukan'}</td>
                <td>${booking.service_name}</td>
                <td>${booking.booking_date}</td>
                <td><span class="badge ${getStatusBadgeClass(booking.status)}">${booking.status}</span></td>
                <td>
                    ${booking.status === 'pending' ? `
                        <button class="btn btn-success btn-sm me-1" onclick="adminConfirmBooking('${booking.id}')">Konfirmasi</button>
                        <button class="btn btn-danger btn-sm" onclick="adminCancelBooking('${booking.id}')">Batalkan</button>
                    ` : booking.status === 'confirmed' ? `
                        <button class="btn btn-info btn-sm me-1" onclick="adminCompleteBooking('${booking.id}')">Selesai</button>
                        <button class="btn btn-danger btn-sm" onclick="adminCancelBooking('${booking.id}')">Batalkan</button>
                    ` : ''}
                </td>
            `;
            adminBookingsTable.appendChild(row);
        });
    } else {
        adminBookingsTable.innerHTML = '<tr><td colspan="7" class="text-center text-danger">Gagal memuat data booking: ' + response.message + '</td></tr>';
    }
}

// Fungsi untuk admin mengonfirmasi booking
async function adminConfirmBooking(bookingId) {
    if (confirm('Konfirmasi pesanan ini?')) {
        const response = await fetchAPI(`${BASE_URL}/bookings.php`, 'POST', {
            action: 'update_status',
            id: bookingId,
            status: 'confirmed'
        });
        
        if (response.status === 'success') {
            alert('Pesanan berhasil dikonfirmasi!');
            loadAdminBookings();
        } else {
            alert('Gagal mengkonfirmasi pesanan: ' + response.message);
        }
    }
}

// Fungsi untuk admin menyelesaikan booking
async function adminCompleteBooking(bookingId) {
    if (confirm('Tandai pesanan ini sebagai selesai?')) {
        const response = await fetchAPI(`${BASE_URL}/bookings.php`, 'POST', {
            action: 'update_status',
            id: bookingId,
            status: 'completed'
        });
        
        if (response.status === 'success') {
            alert('Pesanan berhasil diselesaikan!');
            loadAdminBookings();
        } else {
            alert('Gagal menyelesaikan pesanan: ' + response.message);
        }
    }
}

// Fungsi untuk admin membatalkan booking
async function adminCancelBooking(bookingId) {
    if (confirm('Batalkan pesanan ini?')) {
        const response = await fetchAPI(`${BASE_URL}/bookings.php`, 'POST', {
            action: 'update_status',
            id: bookingId,
            status: 'cancelled'
        });
        
        if (response.status === 'success') {
            alert('Pesanan berhasil dibatalkan!');
            loadAdminBookings();
        } else {
            alert('Gagal membatalkan pesanan: ' + response.message);
        }
    }
}

// Fungsi untuk navigasi pada dashboard admin
function showAdminSection(sectionId) {
    // Sembunyikan semua section
    const sections = document.querySelectorAll('.admin-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    
    // Tampilkan section yang dipilih
    document.getElementById(sectionId).classList.remove('hidden');
    
    // Update active menu
    const menuItems = document.querySelectorAll('#admin-dashboard .sidebar-menu li');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    const activeMenuItem = Array.from(menuItems).find(item => 
        item.getAttribute('onclick').includes(sectionId)
    );
    
    if (activeMenuItem) {
        activeMenuItem.classList.add('active');
    }
}


// Inisialisasi data jika belum ada
function initializeData() {
    if (!localStorage.getItem('users')) {
        const adminUser = {
            id: 'admin1',
            name: 'Admin',
            email: 'admin@gmail.com',
            password: 'admin123',
            role: 'admin'
        };
        
        localStorage.setItem('users', JSON.stringify([adminUser]));
    }
    
    if (!localStorage.getItem('services')) {
        localStorage.setItem('services', JSON.stringify([]));
    }
    
    if (!localStorage.getItem('bookings')) {
        localStorage.setItem('bookings', JSON.stringify([]));
    }
}

// Load data dari localStorage
function getUsers() {
    return JSON.parse(localStorage.getItem('users') || '[]');
}

function getServices() {
    return JSON.parse(localStorage.getItem('services') || '[]');
}

function getBookings() {
    return JSON.parse(localStorage.getItem('bookings') || '[]');
}

// Menyimpan data ke localStorage
function saveUsers(users) {
    localStorage.setItem('users', JSON.stringify(users));
}

function saveServices(services) {
    localStorage.setItem('services', JSON.stringify(services));
}

function saveBookings(bookings) {
    localStorage.setItem('bookings', JSON.stringify(bookings));
}

// Fungsi untuk login
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    const role = document.getElementById('loginRole').value;
    
    const users = getUsers();
    const user = users.find(u => u.email === email && u.password === password && u.role === role);
    
    if (user) {
        // Simpan user ke session
        sessionStorage.setItem('currentUser', JSON.stringify(user));
        
        // Update UI
        document.getElementById('nav-login').classList.add('hidden');
        document.getElementById('nav-register').classList.add('hidden');
        document.getElementById('nav-logout').classList.remove('hidden');
        
        // Tampilkan dashboard sesuai role
        if (user.role === 'user') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('user-dashboard').classList.remove('hidden');
            loadUserDashboard();
        } else if (user.role === 'tenant') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('tenant-dashboard').classList.remove('hidden');
            loadTenantDashboard();
        } else if (user.role === 'admin') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('admin-dashboard').classList.remove('hidden');
            loadAdminDashboard();
        }
    } else {
        alert('Email, password, atau role tidak sesuai!');
    }
});

// Fungsi untuk register
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = document.getElementById('registerName').value;
    const email = document.getElementById('registerEmail').value;
    const password = document.getElementById('registerPassword').value;
    const role = document.getElementById('registerRole').value;
    
    const users = getUsers();
    
    // Cek apakah email sudah digunakan
    if (users.some(u => u.email === email)) {
        alert('Email sudah terdaftar!');
        return;
    }
    
    // Buat user baru
    const newUser = {
        id: 'user' + Date.now(),
        name: name,
        email: email,
        password: password,
        role: role
    };
    
    // Simpan user baru
    users.push(newUser);
    saveUsers(users);
    
    alert('Registrasi berhasil! Silakan login.');
    showLoginForm();
});

// Fungsi untuk logout
function logout() {
    sessionStorage.removeItem('currentUser');
    
    // Update UI
    document.getElementById('nav-login').classList.remove('hidden');
    document.getElementById('nav-register').classList.remove('hidden');
    document.getElementById('nav-logout').classList.add('hidden');
    
    // Sembunyikan semua dashboard
    document.getElementById('user-dashboard').classList.add('hidden');
    document.getElementById('tenant-dashboard').classList.add('hidden');
    document.getElementById('admin-dashboard').classList.add('hidden');
    
    // Tampilkan form login
    document.getElementById('login-form').classList.remove('hidden');
    document.getElementById('register-form').classList.add('hidden');
}

// Fungsi untuk toggle antara form login dan register
function showLoginForm() {
    document.getElementById('login-form').classList.remove('hidden');
    document.getElementById('register-form').classList.add('hidden');
}

function showRegisterForm() {
    document.getElementById('login-form').classList.add('hidden');
    document.getElementById('register-form').classList.remove('hidden');
}

// Fungsi untuk load dashboard user
function loadUserDashboard() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    
    // Load profil user
    document.getElementById('user-name').value = currentUser.name;
    document.getElementById('user-email').value = currentUser.email;
    
    // Load layanan yang tersedia
    loadAvailableServices();
    
    // Load pesanan user
    loadUserBookings();
}

// Fungsi untuk menampilkan layanan yang tersedia
function loadAvailableServices() {
    const servicesList = document.getElementById('services-list');
    servicesList.innerHTML = '';
    
    const services = getServices();
    
    if (services.length === 0) {
        servicesList.innerHTML = '<div class="col-12"><p class="text-center">Belum ada layanan tersedia.</p></div>';
        return;
    }
    
    services.forEach(service => {
        const serviceCard = document.createElement('div');
        serviceCard.className = 'col-md-6 col-lg-4';
        serviceCard.innerHTML = `
            <div class="card booking-card">
                <div class="card-body">
                    <h5 class="card-title">${service.name}</h5>
                    <p class="card-text">${service.description}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-primary fw-bold">Rp${service.price}</span>
                        <button class="btn btn-primary btn-sm" onclick="showBookingModal('${service.id}')">Pesan</button>
                    </div>
                </div>
            </div>
        `;
        servicesList.appendChild(serviceCard);
    });
}

// Fungsi untuk load pesanan user
function loadUserBookings() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const userBookingsTable = document.getElementById('user-bookings-table');
    userBookingsTable.innerHTML = '';
    
    const bookings = getBookings();
    const userBookings = bookings.filter(booking => booking.userId === currentUser.id);
    
    if (userBookings.length === 0) {
        userBookingsTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada pesanan.</td></tr>';
        return;
    }
    
    const services = getServices();
    
    userBookings.forEach(booking => {
        const service = services.find(s => s.id === booking.serviceId);
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${booking.id}</td>
            <td>${service ? service.name : 'Layanan tidak ditemukan'}</td>
            <td>${booking.date}</td>
            <td><span class="badge ${getStatusBadgeClass(booking.status)}">${booking.status}</span></td>
            <td>
                ${booking.status === 'pending' ? `<button class="btn btn-danger btn-sm" onclick="cancelBooking('${booking.id}')">Batalkan</button>` : ''}
            </td>
        `;
        userBookingsTable.appendChild(row);
    });
}

// Fungsi untuk mendapatkan class badge sesuai status
function getStatusBadgeClass(status) {
    switch (status) {
        case 'pending':
            return 'bg-warning';
        case 'confirmed':
            return 'bg-success';
        case 'cancelled':
            return 'bg-danger';
        case 'completed':
            return 'bg-info';
        default:
            return 'bg-secondary';
    }
}

// Fungsi untuk menampilkan modal booking
function showBookingModal(serviceId) {
    const services = getServices();
    const service = services.find(s => s.id === serviceId);
    
    if (service) {
        document.getElementById('booking-service-id').value = service.id;
        document.getElementById('booking-service-name').value = service.name;
        
        // Set minimal date ke hari ini
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('booking-date').setAttribute('min', today);
        
        const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
        bookingModal.show();
    }
}

// Fungsi untuk membuat pesanan
function createBooking() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const serviceId = document.getElementById('booking-service-id').value;
    const date = document.getElementById('booking-date').value;
    const notes = document.getElementById('booking-notes').value;
    
    if (!date) {
        alert('Silakan pilih tanggal pesanan!');
        return;
    }
    
    const services = getServices();
    const service = services.find(s => s.id === serviceId);
    
    if (!service) {
        alert('Layanan tidak ditemukan!');
        return;
    }
    
    const newBooking = {
        id: 'booking' + Date.now(),
        userId: currentUser.id,
        userName: currentUser.name,
        tenantId: service.tenantId,
        serviceId: service.id,
        serviceName: service.name,
        date: date,
        notes: notes,
        status: 'pending',
        createdAt: new Date().toISOString()
    };
    
    const bookings = getBookings();
    bookings.push(newBooking);
    saveBookings(bookings);
    
    const bookingModal = bootstrap.Modal.getInstance(document.getElementById('bookingModal'));
    bookingModal.hide();
    
    alert('Pesanan berhasil dibuat!');
    loadUserBookings();
}

// Fungsi untuk membatalkan pesanan
function cancelBooking(bookingId) {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        const bookings = getBookings();
        const bookingIndex = bookings.findIndex(b => b.id === bookingId);
        
        if (bookingIndex !== -1) {
            bookings[bookingIndex].status = 'cancelled';
            saveBookings(bookings);
            
            alert('Pesanan berhasil dibatalkan!');
            loadUserBookings();
        }
    }
}

// Fungsi untuk navigasi pada dashboard user
function showUserSection(sectionId) {
    // Sembunyikan semua section
    const sections = document.querySelectorAll('.user-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    
    // Tampilkan section yang dipilih
    document.getElementById(sectionId).classList.remove('hidden');
    
    // Update active menu
    const menuItems = document.querySelectorAll('#user-dashboard .sidebar-menu li');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    const activeMenuItem = Array.from(menuItems).find(item => 
        item.getAttribute('onclick').includes(sectionId)
    );
    
    if (activeMenuItem) {
        activeMenuItem.classList.add('active');
    }
}

// Fungsi untuk update profil user
document.getElementById('user-profile-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const name = document.getElementById('user-name').value;
    const password = document.getElementById('user-password').value;
    
    if (!name) {
        alert('Nama tidak boleh kosong!');
        return;
    }
    
    const users = getUsers();
    const userIndex = users.findIndex(u => u.id === currentUser.id);
    
    if (userIndex !== -1) {
        users[userIndex].name = name;
        
        if (password) {
            users[userIndex].password = password;
        }
        
        saveUsers(users);
        sessionStorage.setItem('currentUser', JSON.stringify(users[userIndex]));
        
        alert('Profil berhasil diupdate!');
        document.getElementById('user-password').value = '';
    }
});

// ===== TENANT DASHBOARD FUNCTIONS =====

// Fungsi untuk load dashboard tenant
function loadTenantDashboard() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    
    // Load profil tenant
    document.getElementById('tenant-name').value = currentUser.name;
    document.getElementById('tenant-email').value = currentUser.email;
    
    // Load layanan tenant
    loadTenantServices();
    
    // Load pesanan masuk
    loadTenantBookings();
}

// Fungsi untuk load layanan tenant
function loadTenantServices() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const tenantServicesTable = document.getElementById('tenant-services-table');
    tenantServicesTable.innerHTML = '';
    
    const services = getServices();
    const tenantServices = services.filter(service => service.tenantId === currentUser.id);
    
    if (tenantServices.length === 0) {
        tenantServicesTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada layanan.</td></tr>';
        return;
    }
    
    tenantServices.forEach(service => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${service.id}</td>
            <td>${service.name}</td>
            <td>${service.description.substring(0, 50)}${service.description.length > 50 ? '...' : ''}</td>
            <td>Rp${service.price}</td>
            <td>
                <button class="btn btn-sm btn-primary me-1" onclick="editService('${service.id}')">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteService('${service.id}')">Hapus</button>
            </td>
        `;
        tenantServicesTable.appendChild(row);
    });
}

// Fungsi untuk menampilkan form tambah layanan
function showAddServiceForm() {
    document.getElementById('add-service-form').classList.remove('hidden');
    document.getElementById('service-id').value = '';
    document.getElementById('service-form').reset();
}

// Fungsi untuk membatalkan tambah layanan
function cancelAddService() {
    document.getElementById('add-service-form').classList.add('hidden');
    document.getElementById('service-form').reset();
}

// Fungsi untuk tambah/edit layanan
document.getElementById('service-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const serviceId = document.getElementById('service-id').value;
    const name = document.getElementById('service-name').value;
    const description = document.getElementById('service-description').value;
    const price = document.getElementById('service-price').value;
    
    if (!name || !description || !price) {
        alert('Semua field harus diisi!');
        return;
    }
    
    const services = getServices();
    
    if (serviceId) {
        // Update existing service
        const serviceIndex = services.findIndex(s => s.id === serviceId);
        
        if (serviceIndex !== -1) {
            services[serviceIndex].name = name;
            services[serviceIndex].description = description;
            services[serviceIndex].price = price;
            
            saveServices(services);
            alert('Layanan berhasil diupdate!');
        }
    } else {
        // Create new service
        const newService = {
            id: 'service' + Date.now(),
            tenantId: currentUser.id,
            name: name,
            description: description,
            price: price,
            createdAt: new Date().toISOString()
        };
        
        services.push(newService);
        saveServices(services);
        alert('Layanan berhasil ditambahkan!');
    }
    
    cancelAddService();
    loadTenantServices();
});

// Fungsi untuk edit layanan
function editService(serviceId) {
    const services = getServices();
    const service = services.find(s => s.id === serviceId);
    
    if (service) {
        document.getElementById('service-id').value = service.id;
        document.getElementById('service-name').value = service.name;
        document.getElementById('service-description').value = service.description;
        document.getElementById('service-price').value = service.price;
        
        document.getElementById('add-service-form').classList.remove('hidden');
    }
}

// Fungsi untuk hapus layanan
function deleteService(serviceId) {
    if (confirm('Apakah Anda yakin ingin menghapus layanan ini?')) {
        const services = getServices();
        const serviceIndex = services.findIndex(s => s.id === serviceId);
        
        if (serviceIndex !== -1) {
            // Cek apakah layanan sedang dalam pesanan aktif
            const bookings = getBookings();
            const activeBookings = bookings.filter(b => 
                b.serviceId === serviceId && 
                (b.status === 'pending' || b.status === 'confirmed')
            );
            
            if (activeBookings.length > 0) {
                alert('Tidak dapat menghapus layanan karena sedang ada pesanan aktif!');
                return;
            }
            
            services.splice(serviceIndex, 1);
            saveServices(services);
            
            alert('Layanan berhasil dihapus!');
            loadTenantServices();
        }
    }
}

// Fungsi untuk load pesanan masuk tenant
function loadTenantBookings() {
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const tenantBookingsTable = document.getElementById('tenant-bookings-table');
    tenantBookingsTable.innerHTML = '';
    
    const bookings = getBookings();
    const tenantBookings = bookings.filter(booking => booking.tenantId === currentUser.id);
    
    if (tenantBookings.length === 0) {
        tenantBookingsTable.innerHTML = '<tr><td colspan="6" class="text-center">Belum ada pesanan masuk.</td></tr>';
        return;
    }
    
    tenantBookings.forEach(booking => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${booking.id}</td>
            <td>${booking.userName}</td>
            <td>${booking.serviceName}</td>
            <td>${booking.date}</td>
            <td><span class="badge ${getStatusBadgeClass(booking.status)}">${booking.status}</span></td>
            <td>
                ${booking.status === 'pending' ? `
                    <button class="btn btn-success btn-sm me-1" onclick="confirmBooking('${booking.id}')">Konfirmasi</button>
                    <button class="btn btn-danger btn-sm" onclick="rejectBooking('${booking.id}')">Tolak</button>
                ` : ''}
            </td>
        `;
        tenantBookingsTable.appendChild(row);
    });
}

// Fungsi untuk konfirmasi pesanan
function confirmBooking(bookingId) {
    if (confirm('Konfirmasi pesanan ini?')) {
        const bookings = getBookings();
        const bookingIndex = bookings.findIndex(b => b.id === bookingId);
        
        if (bookingIndex !== -1) {
            bookings[bookingIndex].status = 'confirmed';
            saveBookings(bookings);
            
            alert('Pesanan berhasil dikonfirmasi!');
            loadTenantBookings();
        }
    }
}

// Fungsi untuk menolak pesanan
function rejectBooking(bookingId) {
    if (confirm('Tolak pesanan ini?')) {
        const bookings = getBookings();
        const bookingIndex = bookings.findIndex(b => b.id === bookingId);
        
        if (bookingIndex !== -1) {
            bookings[bookingIndex].status = 'cancelled';
            saveBookings(bookings);
            
            alert('Pesanan berhasil ditolak!');
            loadTenantBookings();
        }
    }
}

// Fungsi untuk navigasi pada dashboard tenant
function showTenantSection(sectionId) {
    // Sembunyikan semua section
    const sections = document.querySelectorAll('.tenant-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    
    // Tampilkan section yang dipilih
    document.getElementById(sectionId).classList.remove('hidden');
    
    // Update active menu
    const menuItems = document.querySelectorAll('#tenant-dashboard .sidebar-menu li');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    const activeMenuItem = Array.from(menuItems).find(item => 
        item.getAttribute('onclick').includes(sectionId)
    );
    
    if (activeMenuItem) {
        activeMenuItem.classList.add('active');
    }
}

// Fungsi untuk update profil tenant
document.getElementById('tenant-profile-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    const name = document.getElementById('tenant-name').value;
    const password = document.getElementById('tenant-password').value;
    
    if (!name) {
        alert('Nama tidak boleh kosong!');
        return;
    }
    
    const users = getUsers();
    const userIndex = users.findIndex(u => u.id === currentUser.id);
    
    if (userIndex !== -1) {
        users[userIndex].name = name;
        
        if (password) {
            users[userIndex].password = password;
        }
        
        saveUsers(users);
        sessionStorage.setItem('currentUser', JSON.stringify(users[userIndex]));
        
        alert('Profil berhasil diupdate!');
        document.getElementById('tenant-password').value = '';
    }
});

// ===== ADMIN DASHBOARD FUNCTIONS =====

// Fungsi untuk load dashboard admin
function loadAdminDashboard() {
    loadAdminUsers();
    loadAdminTenants();
    loadAdminBookings();
}

// Fungsi untuk load users untuk admin
function loadAdminUsers() {
    const adminUsersTable = document.getElementById('admin-users-table');
    adminUsersTable.innerHTML = '';
    
    const users = getUsers();
    
    users.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${user.role}</td>
            <td>
                <button class="btn btn-sm btn-primary me-1" onclick="showEditUserModal('${user.id}')">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser('${user.id}')" ${user.role === 'admin' ? 'disabled' : ''}>Hapus</button>
            </td>
        `;
        adminUsersTable.appendChild(row);
    });
}

// Fungsi untuk menampilkan modal edit user
function showEditUserModal(userId) {
    const users = getUsers();
    const user = users.find(u => u.id === userId);
    
    if (user) {
        document.getElementById('edit-user-id').value = user.id;
        document.getElementById('edit-user-name').value = user.name;
        document.getElementById('edit-user-email').value = user.email;
        document.getElementById('edit-user-role').value = user.role;
        
        const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
        editUserModal.show();
    }
}

// Fungsi untuk update user oleh admin
function updateUser() {
    const userId = document.getElementById('edit-user-id').value;
    const name = document.getElementById('edit-user-name').value;
    const role = document.getElementById('edit-user-role').value;
    
    if (!name) {
        alert('Nama tidak boleh kosong!');
        return;
    }
    
    const users = getUsers();
    const userIndex = users.findIndex(u => u.id === userId);
    
    if (userIndex !== -1) {
        const oldRole = users[userIndex].role;
        
        users[userIndex].name = name;
        users[userIndex].role = role;
        
        // Jika user diubah dari tenant menjadi role lain
        if (oldRole === 'tenant' && role !== 'tenant') {
            // Hapus semua layanan tenant
            const services = getServices();
            const updatedServices = services.filter(s => s.tenantId !== userId);
            saveServices(updatedServices);
        }
        
        saveUsers(users);
        
        const editUserModal = bootstrap.Modal.getInstance(document.getElementById('editUserModal'));
        editUserModal.hide();
        
        alert('User berhasil diupdate!');
        loadAdminDashboard();
    }
}

// Fungsi untuk hapus user oleh admin
function deleteUser(userId) {
    if (confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
        
        if (userId === currentUser.id) {
            alert('Anda tidak dapat menghapus akun Anda sendiri!');
            return;
        }
        
        const users = getUsers();
        const userToDelete = users.find(u => u.id === userId);
        
        if (!userToDelete) {
            alert('User tidak ditemukan!');
            return;
        }
        
        if (userToDelete.role === 'admin') {
            alert('Admin tidak dapat dihapus!');
            return;
        }
        
        // Cek apakah ada pesanan aktif jika user adalah tenant
        if (userToDelete.role === 'tenant') {
            const bookings = getBookings();
            const activeBookings = bookings.filter(b => 
                b.tenantId === userId && 
                (b.status === 'pending' || b.status === 'confirmed')
            );
            
            if (activeBookings.length > 0) {
                alert('Tidak dapat menghapus tenant karena memiliki pesanan aktif!');
                return;
            }
            
            // Hapus semua layanan tenant
            const services = getServices();
            const updatedServices = services.filter(s => s.tenantId !== userId);
            saveServices(updatedServices);
        }
        
        // Cek apakah ada pesanan aktif jika user adalah user biasa
        if (userToDelete.role === 'user') {
            const bookings = getBookings();
            const activeBookings = bookings.filter(b => 
                b.userId === userId && 
                (b.status === 'pending' || b.status === 'confirmed')
            );
            
            if (activeBookings.length > 0) {
                alert('Tidak dapat menghapus user karena memiliki pesanan aktif!');
                return;
            }
        }
        
        // Hapus user
        const updatedUsers = users.filter(u => u.id !== userId);
        saveUsers(updatedUsers);
        
        alert('User berhasil dihapus!');
        loadAdminDashboard();
    }
}

// Fungsi untuk load tenants untuk admin
function loadAdminTenants() {
    const adminTenantsTable = document.getElementById('admin-tenants-table');
    adminTenantsTable.innerHTML = '';
    
    const users = getUsers();
    const tenants = users.filter(user => user.role === 'tenant');
    
    if (tenants.length === 0) {
        adminTenantsTable.innerHTML = '<tr><td colspan="5" class="text-center">Belum ada tenant.</td></tr>';
        return;
    }
    
    const services = getServices();
    
    tenants.forEach(tenant => {
        const tenantServices = services.filter(service => service.tenantId === tenant.id);
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${tenant.id}</td>
            <td>${tenant.name}</td>
            <td>${tenant.email}</td>
            <td>${tenantServices.length}</td>
            <td>
                <button class="btn btn-sm btn-primary me-1" onclick="showEditUserModal('${tenant.id}')">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser('${tenant.id}')">Hapus</button>
            </td>
        `;
        adminTenantsTable.appendChild(row);
    });
}

// Fungsi untuk load bookings untuk admin
function loadAdminBookings() {
    const adminBookingsTable = document.getElementById('admin-bookings-table');
    adminBookingsTable.innerHTML = '';
    
    const bookings = getBookings();
    
    if (bookings.length === 0) {
        adminBookingsTable.innerHTML = '<tr><td colspan="7" class="text-center">Belum ada booking.</td></tr>';
        return;
    }
    
    const users = getUsers();
    
    bookings.forEach(booking => {
        const user = users.find(u => u.id === booking.userId);
        const tenant = users.find(u => u.id === booking.tenantId);
        
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${booking.id}</td>
            <td>${user ? user.name : 'User tidak ditemukan'}</td>
            <td>${tenant ? tenant.name : 'Tenant tidak ditemukan'}</td>
            <td>${booking.serviceName}</td>
            <td>${booking.date}</td>
            <td><span class="badge ${getStatusBadgeClass(booking.status)}">${booking.status}</span></td>
            <td>
                ${booking.status === 'pending' ? `
                    <button class="btn btn-success btn-sm me-1" onclick="adminConfirmBooking('${booking.id}')">Konfirmasi</button>
                    <button class="btn btn-danger btn-sm" onclick="adminCancelBooking('${booking.id}')">Batalkan</button>
                ` : booking.status === 'confirmed' ? `
                    <button class="btn btn-info btn-sm me-1" onclick="adminCompleteBooking('${booking.id}')">Selesai</button>
                    <button class="btn btn-danger btn-sm" onclick="adminCancelBooking('${booking.id}')">Batalkan</button>
                ` : ''}
            </td>
        `;
        adminBookingsTable.appendChild(row);
    });
}

// Fungsi untuk admin mengonfirmasi booking
function adminConfirmBooking(bookingId) {
    if (confirm('Konfirmasi pesanan ini?')) {
        const bookings = getBookings();
        const bookingIndex = bookings.findIndex(b => b.id === bookingId);
        
        if (bookingIndex !== -1) {
            bookings[bookingIndex].status = 'confirmed';
            saveBookings(bookings);
            
            alert('Pesanan berhasil dikonfirmasi!');
            loadAdminBookings();
        }
    }
}

// Fungsi untuk admin menyelesaikan booking
function adminCompleteBooking(bookingId) {
    if (confirm('Tandai pesanan ini sebagai selesai?')) {
        const bookings = getBookings();
        const bookingIndex = bookings.findIndex(b => b.id === bookingId);
        
        if (bookingIndex !== -1) {
            bookings[bookingIndex].status = 'completed';
            saveBookings(bookings);
            
            alert('Pesanan berhasil diselesaikan!');
            loadAdminBookings();
        }
    }
}

// Fungsi untuk admin membatalkan booking
function adminCancelBooking(bookingId) {
    if (confirm('Batalkan pesanan ini?')) {
        const bookings = getBookings();
        const bookingIndex = bookings.findIndex(b => b.id === bookingId);
        
        if (bookingIndex !== -1) {
            bookings[bookingIndex].status = 'cancelled';
            saveBookings(bookings);
            
            alert('Pesanan berhasil dibatalkan!');
            loadAdminBookings();
        }
    }
}

// Fungsi untuk navigasi pada dashboard admin
function showAdminSection(sectionId) {
    // Sembunyikan semua section
    const sections = document.querySelectorAll('.admin-section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    
    // Tampilkan section yang dipilih
    document.getElementById(sectionId).classList.remove('hidden');
    
    // Update active menu
    const menuItems = document.querySelectorAll('#admin-dashboard .sidebar-menu li');
    menuItems.forEach(item => {
        item.classList.remove('active');
    });
    
    const activeMenuItem = Array.from(menuItems).find(item => 
        item.getAttribute('onclick').includes(sectionId)
    );
    
    if (activeMenuItem) {
        activeMenuItem.classList.add('active');
    }
}

// Inisialisasi aplikasi
document.addEventListener('DOMContentLoaded', function() {
    initializeData();
    
    // Cek apakah user sudah login
    const currentUser = JSON.parse(sessionStorage.getItem('currentUser'));
    
    if (currentUser) {
        // Update UI
        document.getElementById('nav-login').classList.add('hidden');
        document.getElementById('nav-register').classList.add('hidden');
        document.getElementById('nav-logout').classList.remove('hidden');
        
        // Tampilkan dashboard sesuai role
        if (currentUser.role === 'user') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('user-dashboard').classList.remove('hidden');
            loadUserDashboard();
        } else if (currentUser.role === 'tenant') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('tenant-dashboard').classList.remove('hidden');
            loadTenantDashboard();
        } else if (currentUser.role === 'admin') {
            document.getElementById('login-form').classList.add('hidden');
            document.getElementById('admin-dashboard').classList.remove('hidden');
            loadAdminDashboard();
        }
    }
});
