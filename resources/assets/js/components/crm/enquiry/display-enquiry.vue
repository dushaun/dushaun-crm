<template>
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="/crm/enquiries" class="list-group-item list-group-item-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Enquiries</a>
                <a :href="'/crm/enquiries/' + enquiry.id + '/reject'" class="list-group-item list-group-item-danger">Reject</a>
                <a :href="'/crm/enquiries/' + enquiry.id + '/accept'" class="list-group-item list-group-item-success">Accept</a>
                <a :href="'/crm/enquiries/' + enquiry.id + '/make/client'" class="list-group-item list-group-item-warning">Make a Client</a>
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
                axios.patch('/api/crm/enquiries/' + vm.enquiry.id + '/accept')
            },
            reject() {

            },
            makeIntoClient() {

            }
        }
    }
</script>