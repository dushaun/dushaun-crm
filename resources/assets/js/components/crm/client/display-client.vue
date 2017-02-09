<template>
    <div class="row">
        <div class="col-md-3" v-if="options">
            <div class="list-group">
                <a href="/crm/clients" class="list-group-item list-group-item-info"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Clients</a>
                <button class="list-group-item list-group-item-danger">Mark as Bad Payer</button>
                <button class="list-group-item list-group-item-success">Add Service Subscription</button>
                <button class="list-group-item list-group-item-success">Create New Job</button>
            </div>
        </div>
        <div :class="{'col-md-9': options, 'col-md-12': !options}">
            <div class="panel panel-info">
                <div class="panel-heading">Client #{{ client.id }}</div>

                <ul class="list-group">
                    <li class="list-group-item" v-if="client.company == 1">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Company Name:
                            </div>
                            <div class="col-md-8">
                                {{ client.company_name }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right" v-if="client.company == 0">
                                Name:
                            </div>
                            <div class="col-md-4 text-right" v-if="client.company == 1">
                                Contact Name:
                            </div>
                            <div class="col-md-8" v-if="client.company == 0">
                                {{ client.first_name }} <span v-if="client.last_name">{{ client.last_name }}</span>
                            </div>
                            <div class="col-md-8" v-if="client.company == 1">
                                {{ client.main_contact.first_name }} <span v-if="client.main_contact.last_name">{{ client.main_contact.last_name }}</span>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right" v-if="client.company == 0">
                                Email:
                            </div>
                            <div class="col-md-8" v-if="client.company == 0">
                                {{ client.email }}
                            </div>
                            <div class="col-md-4 text-right" v-if="client.company == 1">
                                Contact Email:
                            </div>
                            <div class="col-md-8" v-if="client.company == 1">
                                {{ client.main_contact.email }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-4 text-right" v-if="client.company == 0">
                                Tel #:
                            </div>
                            <div class="col-md-8" v-if="client.company == 0">
                                {{ client.tel_number }}
                            </div>
                            <div class="col-md-4 text-right" v-if="client.company == 1">
                                Contact Tel #:
                            </div>
                            <div class="col-md-8" v-if="client.company == 1">
                                {{ client.main_contact.tel_number }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item" v-if="client.address_postcode">
                        <div class="row">
                            <div class="col-md-4 text-right">
                                Address:
                            </div>
                            <div class="col-md-8">
                                <span>{{ client.address_line_1 }}</span><br>
                                <span v-if="client.address_line_2">{{ client.address_line_2 }}</span><br v-if="client.address_line_2">
                                <span>{{ client.address_town }}</span><br>
                                <span>{{ client.address_county }}</span><br>
                                <span>{{ client.address_postcode }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props: {
            data: null,
            options: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {
                client: this.data,
                display_options: this.options
            }
        }
    }
</script>