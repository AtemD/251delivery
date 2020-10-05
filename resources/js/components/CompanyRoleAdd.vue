<template>
    <div class="container">
        <div v-if="$can('create roles')">
            <button href="#add-role" class="btn btn-primary" data-toggle="modal" data-target="#add-role">
                <i class="fas fa-plus xs"></i>
                Add Role
            </button>

            <div class="modal fade" id="add-role" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Role</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createRole">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of role e.g Administrator"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Guard Name</label>
                                    <input v-model="form.guard_name" type="text" name="guard_name" placeholder="guard name of role e.g web"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('guard_name') }" required>
                                    <has-error :form="form" field="guard_name"></has-error>
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
            console.log('Add role component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    guard_name: '',
                }),
            }
        },
        methods: {
            createRole(){
                this.form.post('/dashboard/company/settings/access-control-levels/roles')
                .then(()=>{

                    $('#add-role').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
