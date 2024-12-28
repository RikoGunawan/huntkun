<template>
    <div class="container-normal">
        <div class="d-flex justify-content-between align-items-center mb-4 text-white">
            <h1>Locations</h1>
            <button @click="openCreateModal" class="btn btn-primary mb-3">Add Location</button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Base Time (minutes)</th>
                    <th>Reward</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(location, index) in locations" :key="location.id">
                    <td>{{ index + 1 }}</td>
                    <td>
                        <img v-if="location.image" :src="'/images/' + location.image" class="img-thumbnail" style="width: 300px;" />
                    </td>
                    <td>{{ location.name }}</td>
                    <td>{{ location.role.name }}</td>
                    <td>{{ location.base_time }}</td>
                    <td>{{ location.reward }}</td>
                    <td>
                        <button @click="editLocation(location)" class="btn btn-warning btn-sm">Edit</button>
                        <button @click="deleteLocation(location.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal for Create/Edit -->
        <LocationModal v-if="showModal" :location="selectedLocation" @close="closeModal" @save="fetchLocations" />
    </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import LocationModal from "./LocationModal.vue";

export default {
    components: { LocationModal },
    setup() {
        const locations = ref([]);
        const showModal = ref(false);
        const selectedLocation = ref(null);

        const fetchLocations = () => {
            axios.get("/api/locations").then((response) => {
                locations.value = response.data;
            });
        };

        const openCreateModal = () => {
            selectedLocation.value = null;
            showModal.value = true;
        };

        const editLocation = (location) => {
            selectedLocation.value = location;
            showModal.value = true;
        };

        const deleteLocation = (id) => {
            if (confirm("Are you sure you want to delete this location?")) {
                axios.delete(`/api/locations/${id}`).then(() => fetchLocations());
            }
        };

        const closeModal = () => {
            showModal.value = false;
        };

        onMounted(fetchLocations);

        return { locations, showModal, selectedLocation, openCreateModal, editLocation, deleteLocation, closeModal, fetchLocations };
    },
};
</script>

<style scoped>
.img-thumbnail {
    border: 1px solid #ddd;
}
</style>

