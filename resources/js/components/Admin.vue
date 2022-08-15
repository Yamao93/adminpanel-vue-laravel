<template>
<div v-if="$gate.isAdmin()">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Api Key</th>

        </tr>
        </thead>
        <tbody>
            <td class="text-capitalize">{{api.api.name}}</td>
        </tbody>
    </table>
        <div class="card-header">
            <h1 class="text-center">Регистрация нового ключа</h1>
        </div>
            <label for="apiKey">Введите ключ</label>
            <input type="text" id="apiKey" v-model="apiKey">
           <p>Ключ для работы с API:   60ab97653fb997ef5426a649a31810f8</p>
            <button @click="sendData">Send data</button>
    </div>
    <div v-else="!$gate.isAdmin()">
        <not-found></not-found>
    </div>
</template>

<script>
export default {
    data() {

        return {
            api: {
                api:{
                    id:'',
                    name:''
                }
            },
            apiKey: "",
            form: new Form ({
                id: '',
                name: '',
            })
        }

    },

    methods: {
        async getApiKey() {
            this.$Progress.start();
            this.api = await axios.get('api/admin').then(({data}) => ({api: data.data}));
            this.$Progress.finish();
        },

        async sendData() {
            if (this.apiKey !== '') {
                this.form.name = this.apiKey;
                this.$Progress.start();
                this.api = await axios.post('api/admin', this.form).then((response) =>  ({api: response.data.data}));
                this.$Progress.finish();
                console.log(this.api)
            } else {
                alert('Поле apiKey не заполнено!')
            }
        }
    },

        mounted() {
            this.getApiKey()

        },
        created() {


        }

}
</script>


<!--<templete>-->
<!--<form class="review-form" @submit.prevent="onSubmit">-->
<!--<p>-->
<!--    <label for="name">Name:</label>-->
<!--    <input id="name" v-model="name" placeholder="name">-->
<!--</p>-->
<!--<p>-->
<!--    <input type="submit" value="Submit">-->
<!--</p>-->

<!--</form>-->


<!--</templete>-->























