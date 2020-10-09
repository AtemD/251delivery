<template>
    <div class="container">
        <div v-if="$can('create users')">
            <button href="#add-user" class="btn btn-primary" data-toggle="modal" data-target="#add-user">
                <i class="fas fa-plus xs"></i>
                Add User
            </button>

            <div class="modal fade" id="add-user" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createUser">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input v-model="form.first_name" type="text" name="first_name" placeholder="Users First Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('first_name') }" required>
                                    <has-error :form="form" field="first_name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input v-model="form.last_name" type="text" name="last_name" placeholder="Users Last Name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('last_name') }" required>
                                    <has-error :form="form" field="last_name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input v-model="form.phone_number" type="text" name="phone_number" placeholder="Users phone number"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }" required>
                                    <has-error :form="form" field="phone_number"></has-error>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="form.email" type="text" name="email" placeholder="Users Email Address"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" required>
                                    <has-error :form="form" field="email"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input v-model="form.password" type="password" name="password" placeholder="Users password"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }" required>
                                    <has-error :form="form" field="password"></has-error>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input v-model="form.password_confirmation" type="password" name="password_confirmation" placeholder="Users confirmed password"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" required>
                                    <has-error :form="form" field="password_confirmation"></has-error>
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
            console.log('Add company user component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    first_name : '',
                    last_name : '',
                    phone_number : '',
                    email : '',
                    password: '',
                    password_confirmation: ''
                }),
            }
        },
        methods: {
            createUser(){
                this.form.post('/dashboard/company/users')
                .then(()=>{

                    $('#add-user').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
