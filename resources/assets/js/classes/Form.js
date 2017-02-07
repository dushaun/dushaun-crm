import Errors from './Errors';

class Form {
    constructor(data) {
        this.data = data;

        for (let field in data) {
            this[field] = data[field];
        }

        this.errors = new Errors();
    }

    reset() {
        for (let field in data) {
            this[field] = data[field];
        }
    }

    submit(requestType, url, swalThenTitle, swalThenMessage) {
        axios[requestType](url, this.data())
            .then(function () {
                swal(swalTitle, swalMessage, 'success');
            })
    }
}

export default Form;