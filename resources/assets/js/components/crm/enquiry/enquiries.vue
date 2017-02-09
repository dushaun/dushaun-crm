<template>
    <div class="panel panel-info">
        <div class="panel-heading">Enquiries <i v-if="loading" class="fa fa-spinner fa-spin fa-fw"></i></div>

        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Enquiry No.</th>
                    <th>Prospect Type</th>
                    <th>Name</th>
                    <th>Product Interest</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="enquiry in enquiries" :class="{ 'success': enquiry.accepted == 1, 'danger': enquiry.accepted == 2, 'text-muted': enquiry.read }">
                    <td>#{{ enquiry.id }}</td>
                    <td>{{ enquiry.prospect_type }}</td>
                    <td v-if="enquiry.company == 0">{{ enquiry.first_name }} {{ enquiry.last_name }}</td>
                    <td v-if="enquiry.company == 1">{{ enquiry.company_name }}</td>
                    <td>{{ enquiry.product.title }}</td>
                    <td><a class="btn btn-primary btn-xs" :href="'/crm/enquiries/' + enquiry.id" @click="markRead(enquiry.id, enquiry.read)">View <i class="fa fa-arrow-right" aria-hidden="true"></i></a></td>
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
                enquiries: [],
                loading: false
            }
        },
        created() {
            this.getEnquiries();
        },
        methods: {
            getEnquiries() {
                let vm = this;
                vm.loading = true;
                axios.get('/api/crm/enquiries/index')
                    .then(function (response) {
                        vm.$set(vm, 'enquiries', response.data.enquiries);
                        console.log('Enquiries loaded');
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
            },
            markRead(id, read) {
                if (!read) {
                    axios.patch('/api/crm/enquiries/read', {
                        id: id
                    }).then(function (response) {
                        console.log('Enquiry marked as read')
                    }).catch(function (error) {
                        console.log('Something went wrong')
                    })
                }
            }
        }
    }
</script>