@extends('layouts.app')

@section('content')
    <div class="container-normal text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Roles</h1>
            <create-edit-role-modal ref="createEditModal"></create-edit-role-modal>
        </div>

        <!-- Div untuk menampilkan Roles lewat Vue -->
        <div id="roles-app"></div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning"
                                @click="$refs.createEditModal.openModal('edit', {{ json_encode($role) }})">
                                Edit
                            </button>

                            <form action="{{ route('minecraft.admin.roles.destroy', $role->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue@3.5.13/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const {
            createApp
        } = Vue;

        createApp({
            data() {
                return {
                    roles: [],
                    isModalVisible: false,
                    roleName: '',
                    roleDescription: '',
                    modalMode: 'create', // Default mode is 'create'
                    roleId: null,
                };
            },
            mounted() {
                // Ambil data roles dari API
                axios.get('/api/roles')
                    .then(response => {
                        this.roles = response.data;
                    })
                    .catch(error => {
                        console.error('Error fetching roles:', error);
                    });
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
                },
                submitForm() {
                    const formData = new FormData();
                    formData.append('name', this.roleName || ''); // Defaultkan jika kosong
                    formData.append('description', this.roleDescription || '');
                    if (this.selectedImage) {
                        formData.append('image', this.selectedImage);
                    }

                    console.log('Form Data Debug:', Object.fromEntries(formData.entries())); // Debug data form

                    let url = this.modalMode === 'create' ? '/api/roles' : `/api/roles/${this.roleId}`;
                    let method = this.modalMode === 'create' ? 'post' : 'put';

                    axios({
                            method: method,
                            url: url,
                            data: formData,
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            },
                        })
                        .then(response => {
                            console.log('Response:', response.data); // Log sukses
                            this.$emit('roleSaved'); // Emit event untuk refresh data
                            this.closeModal(); // Menutup modal setelah berhasil update
                        })
                        .catch(error => {
                            if (error.response) {
                                console.error('Backend Error:', error.response.data); // Detail error backend
                            } else {
                                console.error('Request Error:', error.message);
                            }
                        });
                }
                fetchRoles() {
                    // Ambil ulang data roles dari API
                    axios.get('/api/roles')
                        .then(response => {
                            this.roles = response.data;
                        })
                        .catch(error => {
                            console.error('Error fetching roles:', error);
                        });
                }
            }
        }).mount('#roles-app');
    </script>
@endsection
