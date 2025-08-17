<template>
    <div class="dashboard">
        <div class="dashboard-cards">
            <div class="card">
                <h2>Venues</h2>
                <div v-for="venue in venues" :key="venue.id">
                    <p>{{ venue.name }}</p>
                </div>

            </div>
            <div class="card">
                <h2>Classes</h2>
                <div>2 Classes</div>
            </div>
        </div>
    </div>
</template>

<script>
// import FetchAPI from '../APIs/FetchAPI.js';

export default {
    name: 'Dashboard',
    // components: {
    //     FetchAPI
    // },
    data() {
        return {
            venues: [],
            classes: []
        };
    },
    mounted() {
        fetch('/api/venues')
        .then(response => response.json())
        .then(data => {
            this.venues = data;
        })
        .catch(error => {
            console.error('Error fetching venues:', error);
        });
    },
}
</script>

<style>

</style>