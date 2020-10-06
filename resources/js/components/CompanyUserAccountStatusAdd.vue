<template>
    <div class="container">
        <div v-if="$can('create user account statuses')">
            <button href="#add-user-account-status" class="btn btn-primary" data-toggle="modal" data-target="#add-user-account-status">
                <i class="fas fa-plus xs"></i>
                Add User Account Status
            </button>

            <div class="modal fade" id="add-user-account-status" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New User Account Status</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createUserAccountStatus">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of user account status e.g Verified, Unverified, etc"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about the user account status"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required>
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Color</label>
                                    <input v-model="form.color" type="text" name="color" placeholder="color of user account status e.g primary, secondary etc"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('color') }" required>
                                    <has-error :form="form" field="color"></has-error>
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
            console.log('Add user account status component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    description: '',
                    color: '',
                }),
            }
        },
        methods: {
            createUserAccountStatus(){
                this.form.post('/dashboard/company/settings/statuses/user-account-statuses')
                .then(()=>{

                    $('#add-user-account-status').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
