<template>
    <div class="container">
        <div v-if="$can('create payment methods')">
            <button href="#add-payment-method" class="btn btn-primary" data-toggle="modal" data-target="#add-payment-method">
                <i class="fas fa-plus xs"></i>
                Add Payment Method
            </button>

            <div class="modal fade" id="add-payment-method" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Payment Method</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createPaymentMethod">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of payment method e.g CBE BIRR"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about the payment method"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required>
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                            
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status" v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }" required>
                                        <option :value="0">
                                            Disabled
                                        </option>
                                        <option :value="1">
                                            Enabled
                                        </option>
                                    </select>
                                    <has-error :form="form" field="status"></has-error>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button :disabled="form.busy" type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Add payment method component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    description: '',
                    status: '',
                }),
            }
        },
        methods: {
            createPaymentMethod(){
                this.form.post('/dashboard/company/settings/payment-methods')
                .then(()=>{

                    $('#add-payment-method').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
