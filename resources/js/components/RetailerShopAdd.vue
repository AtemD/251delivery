<template>
    <div class="container">
        <div v-if="$can('create shops')">
            <button href="#add-shop" class="btn btn-primary" data-toggle="modal" data-target="#add-shop">
                <i class="fas fa-plus xs"></i>
                Add Shop
            </button>

            <div class="modal fade" id="add-shop" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New shop</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createShop()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="your shop name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about your shop"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required>
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Shop Email</label>
                                    <input v-model="form.email" type="email" name="email" placeholder="your shops business email"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }" required>
                                    <has-error :form="form" field="email"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input v-model="form.phone_number" type="text" name="phone_number" placeholder="your shops phone number"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('phone_number') }" required>
                                    <has-error :form="form" field="phone_number"></has-error>
                                </div>
                                
                                <label>Bannner Image</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="banner_image" class="custom-file-input form-control" id="banner_image"
                                            :class="{ 'is-invalid': form.errors.has('banner_image') }" @change="selectFile">
                                        <label class="custom-file-label" for="banner_image">{{ image_notice }}</label>
                                        <has-error :form="form" field="banner_image"></has-error>
                                    </div>
                                </div>

                                <label>Average Food Preparation Time</label>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="min_food_time">Min <small class="text-muted">(in minutes)</small></label>
                                        <input v-model="form.min_food_time" type="text" name="min_food_time" class="form-control" :class="{ 'is-invalid': form.errors.has('min_food_time') }" id="min_food_time" 
                                            placeholder="e.g 15" required>
                                        <has-error :form="form" field="min_food_time"></has-error>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="max_food_time">Max <small class="text-muted">(in minutes)</small></label>
                                        <input v-model="form.max_food_time" type="text" name="max_food_time" class="form-control" :class="{ 'is-invalid': form.errors.has('max_food_time') }" id="max_food_time" 
                                            placeholder="e.g 35" required>
                                        <has-error :form="form" field="max_food_time"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Shop Type</label>
                                    <select class="form-control" name="shop_type" v-model="form.shop_type" :class="{ 'is-invalid': form.errors.has('shop_type') }" >
                                        <option v-for="type in allShopTypes" :key="type.id" :value="type.id">
                                            {{ type.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="shop_type"></has-error>
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
        props: ['shoptypes'],

        mounted() {
            console.log('Retailer Shop Add Component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    shop_type: '',
                    description: '',
                    email: '',
                    phone_number: '',
                    banner_image: '',
                    min_food_time: '',
                    max_food_time: '',
                    
                }),
                allShopTypes: this.shoptypes,
                image_notice: 'choose shop banner image',
            }
        },
        methods: {
            selectFile(e) {
                const file = e.target.files[0];
                // Assign the image name to notice
                this.image_notice = file.name;
                // Assign the file to the image
                this.form.banner_image = file;
            },
            createShop(){
                this.form.post('/dashboard/retailer/shops', {
                    // Transform form data to FormData
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }]
                })
                .then(()=>{

                    // $('#add-shop').modal('hide');

                    Toast.fire({
                        icon: 'success',
                        title: 'Shop Created Successfully'
                    })

                    // setTimeout(()=>{ 
                    //     window.location.reload();
                    // }, 2000);

                })
                .catch(()=>{

                })
            }
        }
    }
</script>
