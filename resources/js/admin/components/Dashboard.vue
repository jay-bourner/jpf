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
            <div class="schedule">
                <div v-for="(schedule, key) in schedules" :key="key" class="schedule__column">
                    <div class="schedule__column--header">{{ key }}</div>
                    <div v-for="(classItem, index) in schedule" :key="index"  class="schedule__column--list">
                        <div class="schedule__column--item">
                            <h3>{{ classItem.event }}</h3>
                            <div>{{ classItem.frequency }} on a {{ classItem.day }}</div>
                            <div>{{ classItem.starts }} - {{ classItem.ends }}</div>
                        </div>
                    </div>
                </div>
            </div>
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
            FetchAPI.get('/api/venues', venues, venueCount) 
        };

        const setClasses = async () => { 
            FetchAPI.get('/api/classes', classes, classesCount) 
        }; 

        const setSchedules = async () => { 
            FetchAPI.get('/api/schedules', schedules) 
        };

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