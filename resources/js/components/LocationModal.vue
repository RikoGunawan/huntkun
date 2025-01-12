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
                    <select v-model="form.image" class="form-control">
                        <option v-for="image in images" :key="image" :value="image">
                            {{ image }}
                        </option>
                    </select>
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
            image: "",
        });

        const roles = ref([]);
        const images = ref([]); // List of images from the server

        // Fetch roles from the server
        const fetchRoles = () => {
            axios.get("/api/roles").then((response) => {
                roles.value = response.data;
            });
        };

        // Fetch images from the server
        const fetchImages = () => {
            axios.get("/api/storage/images/locations").then((response) => {
                images.value = response.data;
            });
        };

        const saveLocation = () => {
            const payload = { ...form.value };

            if (props.location) {
                payload._method = "PUT";
            }

            console.log("Payload Debug:", payload); // Debug payload sebelum dikirim

            const url = props.location ? `/api/locations/${props.location.id}` : "/api/locations";
            const method = props.location ? "post" : "post";

            axios[method](url, payload)
                .then(() => {
                    emit("save");
                    emit("close");
                })
                .catch((error) => {
                    console.error(error.response?.data.errors);
                    alert("Terjadi kesalahan: " + error.response?.data.message);
                });
        };

        // Watch for location changes and set form data
        watch(
            () => props.location,
            (newLocation) => {
                if (newLocation) {
                    form.value = {
                        name: newLocation.name || "",
                        role_id: newLocation.role_id || "",
                        base_time: newLocation.base_time || "",
                        reward: newLocation.reward || "",
                        image: newLocation.image || "",
                    };
                } else {
                    form.value = { name: "", role_id: "", base_time: "", reward: "", image: "" };
                }
            },
            { immediate: true }
        );

        // Fetch data on mount
        onMounted(() => {
            fetchRoles();
            fetchImages();
        });

        return { form, roles, images, saveLocation };
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
