<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="post" action="/client/create" @submit.prevent="createClient">
                <div class="form-group">
                    <label for="companyOption" class="control-label">Individual or Company?</label>
                    <label class="radio-inline">
                        <input type="radio" name="companyOption" id="company1" value="0" v-model="client.company"> Individual
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="companyOption" id="company2" value="1" v-model="client.company"> Company
                    </label>
                </div>
                <div class="form-group" v-if="client.company == 1">
                    <label for="company_name">Company Name:</label>
                    <input type="text" class="form-control" id="company_name" placeholder="Company name" v-model="client.company_name">
                </div>
                <div class="form-group">
                    <p v-if="client.company == 1">Please give the details of the main contact from the company below:</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" placeholder="Your first name" v-model="client.first_name" @keydown="errors.clear('client.first_name')">
                            <small class="text-danger" v-if="errors.has('client.first_name')" v-text="errors.get('client.first_name')"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Your last name" v-model="client.last_name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="example@dushaun.co.uk" v-model="client.email" @keydown="errors.clear('client.email')">
                    <small class="text-danger" v-if="errors.has('client.email')" v-text="errors.get('client.email')"></small>
                </div>
                <div class="form-group">
                    <label for="tel_number">Telephone:</label>
                    <input type="tel" class="form-control" id="tel_number" placeholder="08009998088" v-model="client.tel_number" @keydown="errors.clear('client.tel_number')">
                    <small class="text-danger" v-if="errors.has('client.tel_number')" v-text="errors.get('client.tel_number')"></small>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_line_1">Address Line 1:</label>
                            <input type="text" class="form-control" id="address_line_1" placeholder="First address line" v-model="client.address_line_1" @keydown="errors.clear('client.address_line_1')">
                            <small class="text-danger" v-if="errors.has('client.address_line_1')" v-text="errors.get('client.address_line_1')"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_line_2">Address Line 2:</label>
                            <input type="text" class="form-control" id="address_line_2" placeholder="Second address line (optional)" v-model="client.address_line_1">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_town">Town/City:</label>
                            <input type="text" class="form-control" id="address_town" placeholder="Town or City" v-model="client.address_town" @keydown="errors.clear('client.address_town')">
                            <small class="text-danger" v-if="errors.has('client.address_town')" v-text="errors.get('client.address_town')"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_county">County:</label>
                            <input type="text" class="form-control" id="address_county" v-model="client.address_county">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address_postcode">Postcode:</label>
                    <input type="tel" class="form-control" id="address_postcode" v-model="client.address_postcode" @keydown="errors.clear('client.address_postcode')">
                    <small class="text-danger" v-if="errors.has('client.address_postcode')" v-text="errors.get('client.address_postcode')"></small>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" rows="3" v-model="client.message" @keydown="errors.clear('client.message')"></textarea>
                    <small class="text-danger" v-if="errors.has('client.message')" v-text="errors.get('client.message')"></small>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%" :disabled="errors.any()">Submit</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Errors from '../../../classes/Errors';
    export default {
        data() {
            return {
                client: {
                    company: 0,
                    company_name: null,
                    title: null,
                    first_name: '',
                    last_name: null,
                    email: '',
                    tel_number: null,
                    address_line_1: null,
                    address_line_2: null,
                    address_town: null,
                    address_county: null,
                    address_postcode: null,
                    contact: {
                        title: null,
                        first_name: '',
                        last_name: null,
                        email: '',
                        tel_number: null,
                        mob_title: null,
                        job_title: null
                    }
                },
                errors: new Errors()
            }
        },
        methods: {
            createClient() {
                let vm = this;
                axios.post('/api/client/create', {
                    client: vm.client
                }).then(function () {
                    swal(
                        'Client Created!',
                        "Now let's make some business.",
                        'success'
                    );
                }).catch(function (error) {
                    swal(
                        'Something went wrong!',
                        "Please double check your entry in the form.",
                        'error'
                    );
                    vm.errors.record(error.response.data);
                })
            }
        }
    }
</script>