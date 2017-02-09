<template>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="/crm/enquiries" class="list-group-item list-group-item-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Enquiries</a>
                <button class="list-group-item list-group-item-danger" @click="reject()" v-if="enquiry.accepted > 0">Reject</button>
                <button class="list-group-item list-group-item-success" @click="accept()" v-if="enquiry.accepted > 0">Accept</button>
                <button class="list-group-item list-group-item-warning" @click="convert()" v-if="!enquiry.converted">Convert to Client</button>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-info">
                <div class="panel-heading">Enquiry #{{ enquiry.id }} <i v-if="loading" class="fa fa-spinner fa-spin fa-fw"></i></div>
                <ul class="list-group">
                    <li class="list-group-item" v-if="enquiry.company == 1">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Company Name:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.company_name }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right" v-if="enquiry.company == 0">
                                Name:
                            </div>
                            <div class="col-md-4 text-right" v-if="enquiry.company == 1">
                                Contact Name:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.first_name }} <span v-if="enquiry.last_name">{{ enquiry.last_name }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Prospect Type:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.prospect_type }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Email:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.email }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Contact No.:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.tel_number }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Product Interest:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.product.title }} - £{{ enquiry.product.unit_price }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Message:
                            </div>
                            <div class="col-md-8">
                                {{ enquiry.message }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['data'],
        data() {
            return {
                enquiry: this.data,
                loading: false
            }
        },
        methods: {
            accept() {
                let vm = this;
                swal({
                    title: '<i class="fa fa-spinner fa-spin fa-fw"></i>',
                    text: 'Accepting...',
                    showCancelButton: false
                });
                axios.patch('/api/crm/enquiries/accept', {
                    id: vm.enquiry.id
                }).then(function (response) {
                    window.location.href = "/crm/jobs/create?client_id" + response.data.client_id;
                }).catch(function (error) {
                    swal({
                        title: 'Oops!',
                        text: 'Something went wrong...',
                        type: 'error'
                    })
                })
            },
            reject() {
                let vm = this;
                swal({
                    title: '<i class="fa fa-spinner fa-spin fa-fw"></i>',
                    text: 'Rejecting...',
                    showCancelButton: false
                });
                axios.patch('/api/crm/enquiries/reject', {
                    id: vm.enquiry.id
                }).then(function (response) {
                    window.location.href = '/crm/enquiries';
                }).catch(function (error) {
                    swal({
                        title: 'Oops!',
                        text: 'Something went wrong...',
                        type: 'error'
                    })
                })
            },
            convert() {
                let vm = this;
                swal({
                    title: '<i class="fa fa-spinner fa-spin fa-fw"></i>',
                    text: 'Converting...',
                    showCancelButton: false
                });
                axios.patch('/api/crm/enquiries/convert/client', {
                    id: vm.enquiry.id
                }).then(function (response) {
                    window.location.href = '/crm/clients/' + response.data.client_id;
                }).catch(function (error) {
                    swal({
                        title: 'Oops!',
                        text: 'Something went wrong...',
                        type: 'error'
                    })
                })
            }
        }
    }
</script>