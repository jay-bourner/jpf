<template>
    <div class="dashboard">
        <div class="dashboard-cards">
            <div class="card">
                <h2>Venues</h2>
                <div>{{ venueCount }} Venues</div>
                <!-- <div v-for="venue in venues" :key="venue.id">
                    <p>{{ venue.name }}</p>
                </div> -->

            </div>
            <div class="card">
                <h2>Classes</h2>
                <div>{{ classesCount }} Classes</div>
            </div>
        </div>
        <div class="dashboard-data">
            <h2>Upcoming Classes</h2>
            
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

import FetchAPI from '../APIs/FetchAPI'

export default {
    name: 'Dashboard',
    setup() {
        const venues = ref([]);
        const venueCount = ref(0);
        const classes = ref([]);
        const classesCount = ref(0);
        const schedules = ref([]);

        const venueError = ref(null);
        const classesError = ref(null); 
        const schedulesError = ref(null);

        
        const setVenues = async () => { 
            get('/api/venues', venues, venueCount) 
        };

        const setClasses = async () => { 
            get('/api/classes', classes, classesCount) 
        }; 

        const setSchedules = async () => { 
            get('/api/schedules', schedules) 
        };

        const get = async (url, ref, counter = null) => {
            await FetchAPI.get(url).then(response => {
                ref.value = response;
                if(counter) {
                    counter.value = ref.value.length;
                }
            }).catch(err => {
                ref.error.value = err;
                console.error('Error fetching data:', ref.error.value);
            });
        }

        setVenues()
        setClasses()
        setSchedules()

        return {
            venues,
            venueCount,
            classes,
            classesCount,
            schedules,
        };
    },
}
</script>

<style>

</style>