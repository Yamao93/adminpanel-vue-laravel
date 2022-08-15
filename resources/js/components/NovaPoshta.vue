<template>

    <div class="container">
        <div class="card-header">
            <h1 class="text-center">Отделения НП</h1>

        </div>
        <div class="card-body">
            <label for="regions">Выберите Город</label>
            <select name="regions" id="regions" v-model="selectedRegion" @change="selectRegion">
                <option v-for="region in regions.regions" :key="region.index" :value="region.Ref">
                    {{ region.DescriptionRu }}
                </option>

            </select>

            <select v-if="visibleSelect" name="addresses" id="addresses">
                <option v-for="address in addresses.addresses" :key="address.index" :value="address.Ref">
                    {{ address.DescriptionRu }}
                </option>

            </select>
        </div>
    </div>

</template>

<script>
export default {
    data() {

        return {
            selectedRegion: "",
            regions: {},
            addresses: {},
            visibleSelect: false,
        }

    },

    methods: {
        async getRegions() {
            this.$Progress.start();
            this.regions = await axios.get('api/novaposhta').then(({data}) => ({regions: data.data}));
            this.$Progress.finish();

        },
        async selectRegion() {
            if (this.selectedRegion !== "") {
                this.$Progress.start();
                this.addresses = await axios.get('api/novaposhta/' + this.selectedRegion).then(({data}) => ({addresses: data.data}));
                this.$Progress.finish();
                this.visibleSelect = true;
            }

        }

    },
    mounted() {


    },
    created() {
        this.getRegions()

    }
}
</script>






























