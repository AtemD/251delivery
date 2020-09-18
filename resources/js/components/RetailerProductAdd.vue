<template>
    <div class="container">
        <div v-if="$can('create products')">
            <button href="#add-product" class="btn btn-primary" data-toggle="modal" data-target="#add-product">
                <i class="fas fa-plus xs"></i>
                Add Product
            </button>

            <div class="modal fade" id="add-product" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Product</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <form role="form" @submit.prevent="createProduct">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" placeholder="your product name"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" required>
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Shop</label>
                                    <select class="form-control" name="shop" v-model="form.shop" :class="{ 'is-invalid': form.errors.has('shop') }" required>
                                        <option :value="currentShop.id">
                                            {{ currentShop.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="shop"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Sections</label>
                                    <select class="form-control" name="section" v-model="form.section" :class="{ 'is-invalid': form.errors.has('section') }" required>
                                        <option v-for="section in currentShopSections" :key="section.id" :value="section.id">
                                            {{ section.name }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="section"></has-error>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input form-control" id="image"
                                            :class="{ 'is-invalid': form.errors.has('image') }" @change="selectFile">
                                        <label class="custom-file-label" for="image">{{ image_notice }}</label>
                                    </div>
                                    <has-error :form="form" field="image"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" rows="3" name="description" placeholder="a short description about your product"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" required>
                                    </textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Base price</label>
                                    <input v-model="form.base_price" type="text" name="base_price" placeholder="your products base price"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('base_price') }" required>
                                    <has-error :form="form" field="base_price"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Availability</label>
                                    <select class="form-control" name="availability" v-model="form.availability" :class="{ 'is-invalid': form.errors.has('availability') }" required>
                                        <option :value="0">
                                            Unavailable
                                        </option>
                                        <option :value="1">
                                            available
                                        </option>
                                    </select>
                                    <has-error :form="form" field="availability"></has-error>
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
        props: ['shop', 'sections'],

        mounted() {
            console.log('Retailer add shop Component mounted.')
        }, 
        data() {
            return {
                form: new Form({
                    name : '',
                    shop: '',
                    section: '',
                    image:  '',
                    description: '',
                    base_price: '',
                    availability: ''
                    
                }),
                currentShop: this.shop,
                currentShopSections: this.sections,
                image_notice: 'choose image (optional)',
            }
        },
        methods: {
            selectFile(e) {
                const file = e.target.files[0];
                // Assign the image name to notice
                this.image_notice = file.name;
                // Assign the file to the image
                this.form.image = file;
            },
            createProduct(){
                this.form.post('/dashboard/retailer/shops/'+this.currentShop.slug+'/products', {
                    // Transform form data to FormData
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }]
                })
                .then(()=>{

                    $('#add-product').modal('hide');

                    Toast.fire({
                        icon: 'success',
                        title: 'Product Created Successfully'
                    })

                    setTimeout(()=>{ 
                        window.location.reload();
                    },1000);

                })
                .catch(()=>{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    })
                })
            }
        }
    }
</script>
