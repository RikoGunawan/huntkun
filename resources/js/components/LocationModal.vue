<template>
    <div class="modal">
        <div class="modal-content">
            <h2>{{ location ? "Edit Location" : "Create Location" }}</h2>
            <form @submit.prevent="saveLocation">
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
                    <label>Base Time (minutes)</label>
                    <input v-model="form.base_time" type="number" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Reward</label>
                    <input v-model="form.reward" type="text" class="form-control" required />
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" @change="handleFile" class="form-control" />
                </div>
                <br>
                <button type="submit" class="btn btn-success">{{ location ? "Update" : "Save" }}</button>
                <button type="button" @click="$emit('close')" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
</template>

<script>
import { ref, onMounted, watch } from "vue";
import axios from "axios";

export default {
    props: ["location"],
    emits: ["close", "save"],
    setup(props, { emit }) {
        const form = ref({
            name: "",
            role_id: "",
            base_time: "",
            reward: "",
            image: null,
        });
        const roles = ref([]);

        const fetchRoles = () => {
            axios.get("/api/roles").then((response) => {
                roles.value = response.data;
            });
        };

        const handleFile = (event) => {
            form.value.image = event.target.files[0];
        };

        const saveLocation = () => {
            const formData = new FormData();
            for (const key in form.value) {
                if (key === "image" && !form.value[key]) continue;
                formData.append(key, form.value[key]);
            }

            if (props.location) {
                formData.append("_method", "PUT");
            }

            const url = props.location ? `/api/locations/${props.location.id}` : "/api/locations";
            const method = props.location ? "post" : "post";

            axios[method](url, formData)
                .then(() => {
                    emit("save");
                    emit("close");
                })
                .catch((error) => {
                    console.error(error.response?.data.errors);
                    alert('Error: ' + error.response?.data.message);
                });
        };

        watch(
            () => props.location,
            (newLocation) => {
                if (newLocation) {
                    form.value = {
                        name: newLocation.name || "",
                        role_id: newLocation.role_id || "",
                        base_time: newLocation.base_time || "",
                        reward: newLocation.reward || "",
                        image: null,
                    };
                } else {
                    form.value = { name: "", role_id: "", base_time: "", reward: "", image: null };
                }
            },
            { immediate: true }
        );

        onMounted(fetchRoles);

        return { form, roles, handleFile, saveLocation };
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

