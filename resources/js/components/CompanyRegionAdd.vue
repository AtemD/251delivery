<template>
    <div class="container">
        <div v-if="$can('create regions')">
            <button href="#add-region" class="btn btn-primary" data-toggle="modal" data-target="#add-region">
                <i class="fas fa-plus xs"></i>
                Add Region
            </button>

            <div class="modal fade" id="add-region" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Region</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createRegion">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of region"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Abbreviation</label>
                                    <input v-model="form.abbreviation" type="text" name="abbreviation" placeholder="abbreviation of region"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('abbreviation') }" required>
                                    <has-error :form="form" field="abbreviation"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Countries</label>
                                    <select class="form-control" name="country" v-model="form.country" :class="{ 'is-invalid': form.errors.has('country') }" required>
                                        <option v-for="country in allCountries" :key="country.id" :value="country.id">
                                            {{ country.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="country"></has-error>
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
        props:['countries'],

        mounted() {
            console.log('Add region component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    abbreviation: '',
                    status: '',
                }),
                allCountries: this.countries,
            }
        },
        methods: {
            createRegion(){
                this.form.post('/dashboard/company/settings/locations/regions')
                .then(()=>{

                    $('#add-region').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
