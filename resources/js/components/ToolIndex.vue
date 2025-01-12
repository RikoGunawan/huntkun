<template>
    <div class="container-normal">
        <div class="d-flex justify-content-between align-items-center text-white">
            <div class="flex-grow-1">
                <h1 class="mb-4">Tools</h1>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <label for="role" class="form-label mb-0" style="white-space: nowrap;">Filter by Role</label>
                    <select id="role" class="form-control" v-model="selectedRole" style="width: 150px;">
                        <option value="">All</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                </div>

                <button @click="openCreateModal" class="btn btn-primary">Add Tool</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Modifier</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(tool, index) in filteredTools" :key="tool.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ tool.name }}</td>
                    <td>{{ tool.role.name }}</td>
                    <td>{{ tool.modifier }}</td>
                    <td>
                    <td>
                        <img v-if="tool.icon" :src="`/storage/${tool.icon}`" class="img-thumbnail"
                            style="width: 50px;" />
                    </td>

                    </td>
                    <td>
                        <button @click="editTool(tool)" class="btn btn-warning btn-sm">Edit</button>
                        <button @click="deleteTool(tool.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal for Create/Edit -->
        <ToolModal v-if="showModal" :tool="selectedTool" @close="closeModal" @save="fetchTools" />
    </div>
</template>

<script>
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import ToolModal from "./ToolModal.vue";

export default {
    components: { ToolModal },
    setup() {
        const tools = ref([]);
        const showModal = ref(false);
        const selectedTool = ref(null);
        const selectedRole = ref("");
        const roles = ref([]);

        const fetchTools = () => {
            axios.get("/api/tools").then((response) => {
                tools.value = response.data;
            });
        };

        const fetchRoles = () => {
            axios.get("/api/roles").then((response) => {
                roles.value = response.data;
            });
        };

        const openCreateModal = () => {
            selectedTool.value = null;
            showModal.value = true;
        };

        const editTool = (tool) => {
            selectedTool.value = tool;
            showModal.value = true;
        };

        const deleteTool = (id) => {
            if (confirm("Are you sure you want to delete this tool?")) {
                axios.delete(`/api/tools/${id}`).then(() => fetchTools());
            }
        };

        const closeModal = () => {
            showModal.value = false;
        };

        const filteredTools = computed(() => {
            if (selectedRole.value === "") {
                return tools.value;
            }

            return tools.value.filter((tool) => tool.role.id === parseInt(selectedRole.value));
        });

        onMounted(() => {
            fetchTools();
            fetchRoles();
        });

        return {
            tools,
            fetchTools,
            showModal,
            selectedTool,
            selectedRole,
            roles,
            openCreateModal,
            editTool,
            deleteTool,
            closeModal,
            filteredTools,
        };
    },
};
</script>

<style scoped>
.img-thumbnail {
    border: 1px solid #ddd;
}
</style>
