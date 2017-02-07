<template>
    <div class="panel panel-default">
        <div class="panel-body">
            <form method="post" action="/enquire/submit" @submit.prevent="submitEnquiry">
                <div class="form-group">
                    <label for="companyOption" class="control-label">Are you an Individual or Company?</label>
                    <label class="radio-inline">
                        <input type="radio" name="companyOption" id="company1" value="0" v-model="enquiry.company"> Individual
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="companyOption" id="company2" value="1" v-model="enquiry.company"> Company
                    </label>
                </div>
                <div class="form-group" v-if="enquiry.company == 1">
                    <label for="company_name">Company Name:</label>
                    <input type="text" class="form-control" id="company_name" placeholder="Company name" v-model="enquiry.company_name">
                </div>
                <div class="form-group">
                    <p v-if="enquiry.company == 1">Please give the details of the main contact from the company below:</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" placeholder="Your first name" v-model="enquiry.first_name" @keydown="errors.clear('enquiry.first_name')">
                            <small class="text-danger" v-if="errors.has('enquiry.first_name')" v-text="errors.get('enquiry.first_name')"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Your last name" v-model="enquiry.last_name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Your email, or company email" v-model="enquiry.email" @keydown="errors.clear('enquiry.email')">
                    <small class="text-danger" v-if="errors.has('enquiry.email')" v-text="errors.get('enquiry.email')"></small>
                </div>
                <div class="form-group">
                    <label for="tel_number">Telephone:</label>
                    <input type="tel" class="form-control" id="tel_number" placeholder="Best number to contact you on" v-model="enquiry.tel_number" @keydown="errors.clear('enquiry.tel_number')">
                    <small class="text-danger" v-if="errors.has('enquiry.tel_number')" v-text="errors.get('enquiry.tel_number')"></small>
                </div>
                <div class="form-group">
                    <label for="product_id">Product:</label>
                    <select name="product_id" id="product_id" v-model="enquiry.product_id" @change="errors.clear('enquiry.product_id')">
                        <option :value="null">Select a product</option>
                        <option :value="product.id" v-for="product in products">{{ product.title }}</option>
                    </select>
                    <small class="text-danger" v-if="errors.has('enquiry.product_id')" v-text="errors.get('enquiry.product_id')"></small>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" rows="3" v-model="enquiry.message" @keydown="errors.clear('enquiry.message')"></textarea>
                    <small class="text-danger" v-if="errors.has('enquiry.message')" v-text="errors.get('enquiry.message')"></small>
                </div>
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%" :disabled="errors.any()">Submit</button>
            </form>
        </div>
    </div>
</template>
<script>
    import Errors from '../classes/Errors';
    export default {
        data() {
            return {
                enquiry: {
                    company: 0,
                    company_name: null,
                    first_name: '',
                    last_name: null,
                    email: '',
                    tel_number: null,
                    product_id: null,
                    message: '',
                },
                reset: {
                    company: 0,
                    company_name: null,
                    first_name: '',
                    last_name: null,
                    email: '',
                    tel_number: null,
                    product_id: null,
                    message: '',
                },
                products: [],
                errors: new Errors()
            }
        },
        created() {
            this.getProducts();
        },
        methods: {
            getProducts() {
                let vm = this;
                axios.get('/api/products')
                    .then(function (response) {
                        vm.$set(vm, 'products', response.data.products);
                        console.log('Products loaded');
                    }).catch(function (error) {
                        console.log(error)
                    });
            },
            submitEnquiry() {
                let vm = this;
                axios.post('/api/enquiry/submit', {
                    enquiry: vm.enquiry
                }).then(function () {
                    swal(
                        'Enquiry Submitted!',
                        'Your enquiry has been submitted! DuShaun will get back to you soon.',
                        'success'
                    );
                    vm.enquiry = vm.reset;
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