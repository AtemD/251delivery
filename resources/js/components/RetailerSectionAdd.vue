<template>
    <div class="container">
        <div v-if="$can('create sections')">
            <button href="#add-section" class="btn btn-primary" data-toggle="modal" data-target="#add-section">
                <i class="fas fa-plus xs"></i>
                Add Section
            </button>

            <div class="modal fade" id="add-section" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Section</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createSection">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="name of section e.g Lunch "
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about this product section"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required>
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Shop</label>
                                    <select class="form-control" name="shop" v-model="form.shop" :class="{ 'is-invalid': form.errors.has('shop') }" required>
                                        <option :value="currentShop.id" selected>
                                            {{ currentShop.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="shop"></has-error>
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
        props: ['shop'],

        mounted() {
            console.log('Add section component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    description: '',
                    shop: ''
                }),
                currentShop: this.shop,
            }
        },
        methods: {
            createSection(){
                this.form.post('/dashboard/retailer/shops/'+this.currentShop.slug+'/settings/sections')
                .then(()=>{

                    $('#add-section').modal('hide');

                    bus.$emit('show-success-toast');

                })
                .catch(()=>{
                    bus.$emit('show-error-alert');
                })
            }
        }
    }
</script>
