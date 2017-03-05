<template>
    <div class="panel panel-info">
        <div class="panel-heading">
            Clients <i v-if="loading" class="fa fa-spinner fa-spin fa-fw"></i>
            <a class="btn btn-success btn-xs pull-right" href="/crm/clients/create"><i class="fa fa-plus"></i></a>
        </div>

        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Client Type</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="client in clients" :class="{ 'success': client.accepted == 1, 'danger': client.accepted == 2, 'text-muted': client.read }">
                    <td>#{{ client.id }}</td>
                    <td>{{ client.client_type }}</td>
                    <td v-if="client.company == 0">{{ client.first_name }} {{ client.last_name }}</td>
                    <td v-if="client.company == 1">{{ client.company_name }}</td>
                    <td>{{ client.address }}</td>
                    <td>
                        <a class="btn btn-primary btn-xs" :href="'/crm/clients/' + client.id">View <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        <a class="btn btn-info btn-xs" :href="'/crm/clients/' + client.id + '/edit'">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                clients: [],
                loading: false
            }
        },
        created() {
            this.getClients();
        },
        methods: {
            getClients() {
                let vm = this;
                vm.loading = true;
                axios.get('/api/crm/clients/index')
                    .then(function (response) {
                        vm.$set(vm, 'clients', response.data.clients);
                        console.log('Clients loaded');
                        vm.loading = false;
                    }).catch(function (error) {
                    swal(
                        'Something went wrong!',
                        "Please refer to error log",
                        'error'
                    );
                    console.log(error);
                    vm.loading = false;
                })
            }
        }
    }
</script>