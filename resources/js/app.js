// Import Vue dan createApp dari Vue 3
import { createApp } from 'vue';

// Import file bootstrap.js jika diperlukan (misalnya, untuk mengimpor jQuery atau Bootstrap)
import './bootstrap';

// Import komponen Vue yang sudah Anda buat
import CreateEditRoleModal from './components/CreateEditRoleModal.vue';

// Membuat instance aplikasi Vue
const app = createApp({});

// Mendaftarkan komponen Vue agar bisa digunakan di Blade atau template Vue lainnya
app.component('create-edit-role-modal', CreateEditRoleModal);

// Mount aplikasi Vue ke elemen dengan ID 'app'
app.mount('#app');
