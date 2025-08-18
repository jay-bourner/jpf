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
            <table>
                <tr>
                    <th v-for="venue in venues" :key="venue.id">
                        {{ venue.name }}
                    </th>
                </tr>
                <tr v-for="classItem in classes" :key="classItem.id" :options="classItem.options">
                    <!-- <td v-for="classOptions in classItem" :key="classOptions.id">
                        {{ classOptions.name }}<br>
                    </td> -->
                </tr>
            </table>
            <div v-for="m in map" :key="m.id">
                {{ m.name }}
            </div>
            <!-- <div class="data-section">
                <h2>Venues</h2>
                <ul>
                    <li v-for="venue in venues" :key="venue.id">
                        {{ venue.name }} - {{ venue.address }}, {{ venue.town }} - {{ venue.postcode }}
                    </li>
                </ul>
            </div> -->
            <!-- <div class="data-section">
                <h2>Classes</h2>
                <ul>
                    <li v-for="classItem in classes" :key="classItem.id">
                        {{ classItem.name }} - {{ classItem.description }}
                    </li>
                </ul>
            </div> -->
        </div>
    </div>
</template>

<script>
export default {
    name: 'Dashboard',
    data() {
        return {
            venues: [],
            venueCount: 0,
            classes: [],
            classesCount: 0,
            map: [],
            classesOptions: [],
        };
    },
    mounted() {
        this.venues = this.getVenues
        this.classes = this.getClasses
        this.map
    },
    computed: {
        // You can add computed properties here if needed
        getVenues: function() {
            fetch('/api/venues')
            .then(response => response.json())
            .then(data => {
                this.venues = data;
                this.venueCount = this.venues.length;
                // console.log('Venues fetched:', this.venues);
            })
            .catch(error => {
                console.error('Error fetching venues:', error);
            });
        },
        getClasses: function() {
            fetch('/api/classes')
            .then(response => response.json())
            .then(data => {
                this.classes = data;
                this.classesCount = this.classes.length;
                for(let classItem of this.classes) {
                    this.classesOptions.push(classItem.name, [...classItem.options]);
                }
                // this.classesOptions.push(this.classes.name,  {...this.classes.map(classItem => classItem.options)});
                // this.map = this.classes.map(classItem => ({
                //     ...classItem,
                //     options: classItem.options.map(option => ({
                //         ...option,
                //         venueName: this.venues.find(v => v.id === option.venue_id)?.name || 'Unknown Venue',
                //         // venueAddress: this.venues.find(v => v.id === option.venue_id)?.address || 'Unknown Address',
                //     })),
                // }));
                // console.log('Classes fetched:', this.classes);
                console.log('Class options:', this.classesOptions);
                // console.log('Map item:', this.map);
            })
            .catch(error => {
                console.error('Error fetching classes:', error);
            });
        },
        // getVenuesToClasses: function() {
        //     this.map = 
        //     });
        //     // this.map = this.classes.map(function(classItem, index) {
        //     //     return {
        //     //         ...classItem,
        //     //         options: classItem.options.map(option => {
        //     //             const venue = this.venues.find(v => v.id === option.venue_id);
        //     //             return {
        //     //                 ...option,
        //     //                 venueName: venue ? venue.name : 'Unknown Venue',
        //     //                 venueAddress: venue ? venue.address : 'Unknown Address',
        //     //             };
        //     //         }),
        //     //     };
        //     // });
        // },
    },
}
</script>

<style>

</style>