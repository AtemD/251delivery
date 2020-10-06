<template>
    <div class="container">
        <div v-if="$can('create countries')">
            <button href="#add-country" class="btn btn-primary" data-toggle="modal" data-target="#add-country">
                <i class="fas fa-plus xs"></i>
                Add Country
            </button>

            <div class="modal fade" id="add-country" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Country</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createCountry">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of country"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Abbreviation</label>
                                    <input v-model="form.abbreviation" type="text" name="abbreviation" placeholder="abbreviation of country"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('abbreviation') }" required>
                                    <has-error :form="form" field="abbreviation"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Currency Name</label>
                                    <input v-model="form.currency_name" type="text" name="currency_name" placeholder="currency name of country"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('currency_name') }" required>
                                    <has-error :form="form" field="currency_name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Currency Abbreviation</label>
                                    <input v-model="form.currency_abbreviation" type="text" name="currency_abbreviation" placeholder="currency abbreviation of country"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('currency_abbreviation') }" required>
                                    <has-error :form="form" field="currency_abbreviation"></has-error>
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
            console.log('Add country component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    abbreviation: '',
                    currency_name: '',
                    currency_abbreviation: '',
                    status: '',
                }),
            }
        },
        methods: {
            createCountry(){
                this.form.post('/dashboard/company/settings/locations/countries')
                .then(()=>{

                    $('#add-country').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
