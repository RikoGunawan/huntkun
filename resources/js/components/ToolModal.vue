<template>
    <div class="modal">
        <div class="modal-content">
            <h2>{{ tool ? "Edit Tool" : "Create Tool" }}</h2>
            <form @submit.prevent="saveTool">
                <div class="form-group">
                    <label>Name</label>
                    <input v-model="form.name" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select v-model="form.role_id" class="form-control" required>
                        <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Modifier</label>
                    <input v-model="form.modifier" type="number" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="file" @change="handleFile" class="form-control" />
                </div>
                <br>
                <button type="submit" class="btn btn-success">{{ tool ? "Update" : "Save" }}</button>
                <button type="button" @click="$emit('close')" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from "vue";
import axios from "axios";

export default {
    props: ["tool"],
    emits: ["close", "save"],
    setup(props, { emit }) {
        const form = ref({
            name: "",
            role_id: "",
            modifier: "",
            icon: null,
        });
        const roles = ref([]);

        // Fetch the roles for the dropdown list
        const fetchRoles = () => {
            axios.get("/api/roles").then((response) => {
                roles.value = response.data;
            });
        };

        // Handle file selection for the icon
        const handleFile = (event) => {
            form.value.icon = event.target.files[0];
        };

        // Save the tool data (create or update)
        const saveTool = () => {
            const formData = new FormData();
            for (const key in form.value) {
                // Skip the icon field if not provided
                if (key === "icon" && !form.value[key]) continue;
                formData.append(key, form.value[key]);
            }

            // If it's an edit (PUT request), add _method for Laravel
            if (props.tool) {
                formData.append("_method", "PUT");
            }

            console.log("FormData Debug:", Array.from(formData.entries()));

            const url = props.tool ? `/api/tools/${props.tool.id}` : "/api/tools";
            const method = props.tool ? "post" : "post"; // Use POST for creating tools

            axios[method](url, formData)
                .then(() => {
                    emit("save");
                    emit("close");
                })
                .catch((error) => {
                    console.error(error.response?.data.errors); // Debug error
                    alert('Terjadi kesalahan: ' + error.response?.data.message);
                });
        };

        // Watch for changes in the tool prop and populate the form if it exists
        watch(
            () => props.tool,
            (newTool) => {
                if (newTool) {
                    form.value = {
                        name: newTool.name || "",
                        role_id: newTool.role_id || "",
                        modifier: newTool.modifier || "",
                        icon: null, // Keep this null to allow users to upload a new icon
                    };
                } else {
                    form.value = { name: "", role_id: "", modifier: "", icon: null };
                }
            },
            { immediate: true } // Ensure it runs when the component is mounted
        );

        // Fetch roles when the component is mounted
        onMounted(fetchRoles);

        return { form, roles, handleFile, saveTool };
    },
};
</script>

<style scoped>
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 500px;
}
</style>
