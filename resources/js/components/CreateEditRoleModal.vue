<template>
    <div>
        <!-- Modal -->
        <div v-if="isModalVisible" class="modal-overlay" @click.self="closeModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>{{ modalTitle }}</h5>
                    <button type="button" @click="closeModal" class="btn-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submitForm" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" id="name" class="form-control" v-model="roleName" required />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Role Description</label>
                            <textarea id="description" class="form-control" v-model="roleDescription"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Role Image</label>
                            <input type="file" id="image" class="form-control"
                                @input="selectedImage = $event.target.files[0]" />

                        </div>
                        <button type="submit" class="btn btn-primary">{{ submitButtonText }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tombol Create -->
        <button type="button" class="btn btn-primary" @click="openModal('create')">
            Create Role
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isModalVisible: false,
            roleName: '',
            roleDescription: '',
            selectedImage: null,
            modalMode: 'create', // Default mode is 'create'
            roleId: null,
        };
    },
    computed: {
        modalTitle() {
            return this.modalMode === 'create' ? 'Create Role' : 'Edit Role';
        },
        submitButtonText() {
            return this.modalMode === 'create' ? 'Create' : 'Update';
        }
    },
    methods: {
        onFileChange(event) {
            this.selectedImage = event.target.files[0];
            console.log('Selected File:', this.selectedImage);
        },
        openModal(mode, role = null) {
            this.modalMode = mode;
            if (mode === 'edit' && role) {
                this.roleId = role.id;
                this.roleName = role.name;
                this.roleDescription = role.description;
            }
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
            this.roleName = '';
            this.roleDescription = '';
            this.selectedImage = null;
        },

        createRole() {
            const formData = new FormData();
            formData.append('name', this.roleName || 'Untitled Role');
            formData.append('description', this.roleDescription || 'No description');
            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }

            // Debug isi FormData
            console.log('FormData Debug:', Array.from(formData.entries()));

            // URL dan method untuk create
            const url = '/api/roles';
            const method = 'POST'; // Gunakan POST untuk create

            // Kirimkan request ke backend
            axios({
                method: method,
                url: url,
                data: formData,
                headers: { 'Content-Type': 'multipart/form-data' }
            })
                .then(response => {
                    console.log('Response:', response.data);
                    this.$emit('roleSaved'); // Emit event jika role disimpan
                    this.closeModal(); // Tutup modal setelah berhasil
                    window.location.reload(); // Refresh halaman
                })
                .catch(error => {
                    console.error('Error:', error.response?.data || error.message);
                });
        },
        editRole() {
            const formData = new FormData();
            formData.append('name', this.roleName || 'Untitled Role');
            formData.append('description', this.roleDescription || 'No description');
            if (this.selectedImage) {
                formData.append('image', this.selectedImage);
            }

            // Debug isi FormData
            console.log('FormData Debug:', Array.from(formData.entries()));

            // Gunakan POST untuk mensimulasikan PUT
            formData.append('_method', 'PUT');
            axios.post(`/api/roles/${this.roleId}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' },
            })
                .then(response => {
                    console.log('Response:', response.data);
                    this.$emit('roleSaved');
                    this.closeModal();
                    window.location.reload(); // Refresh halaman
                })
                .catch(error => {
                    console.error('Error:', error.response?.data || error.message);
                });
        },
        submitForm() {
            if (this.modalMode === 'create') {
                this.createRole(); // Panggil createRole jika mode create
            } else if (this.modalMode === 'edit') {
                this.editRole(); // Panggil editRole jika mode edit
            }
        }
    }
};
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    color: black;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
</style>
