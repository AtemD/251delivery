<template>
    <div class="container">
        <div v-if="$can('create discounts')">
            <button href="#add-cuisine" class="btn btn-primary" data-toggle="modal" data-target="#add-cuisine">
                <i class="fas fa-plus xs"></i>
                Add Cuisine
            </button>

            <div class="modal fade" id="add-cuisine" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Cuisine</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createCuisine">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of cuisine e.g Ethiopian Cuisine"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about the cuisine"
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
            console.log('Add cuisine component mounted.')
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
            createCuisine(){
                this.form.post('/dashboard/company/settings/cuisines')
                .then(()=>{

                    $('#add-cuisine').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
