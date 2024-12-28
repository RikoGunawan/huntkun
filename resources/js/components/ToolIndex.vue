<template>
    <div class="container-normal">
        <div class="d-flex justify-content-between align-items-center mb-4 text-white">
            <h1>Tools</h1>
            <button @click="openCreateModal" class="btn btn-primary mb-3">Add Tool</button>
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
                <tr v-for="(tool, index) in tools" :key="tool.id">
                    <td>{{ index + 1 }}</td>
                    <td>{{ tool.name }}</td>
                    <td>{{ tool.role.name }}</td>
                    <td>{{ tool.modifier }}</td>
                    <td>
                        <img v-if="tool.icon" :src="'/images/' + tool.icon" class="img-thumbnail" style="width: 50px;" />
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
import { ref, onMounted } from "vue";
import axios from "axios";
import ToolModal from "./ToolModal.vue";

export default {
    components: { ToolModal },
    setup() {
        const tools = ref([]);
        const showModal = ref(false);
        const selectedTool = ref(null);

        const fetchTools = () => {
            axios.get("/api/tools").then((response) => {
                tools.value = response.data;
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

        onMounted(fetchTools);

        return { tools, showModal, selectedTool, openCreateModal, editTool, deleteTool, closeModal, fetchTools };
    },
};
</script>

<style scoped>
.img-thumbnail {
    border: 1px solid #ddd;
}
</style>
