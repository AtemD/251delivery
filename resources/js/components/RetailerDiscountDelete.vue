<template>
        <div v-if="$can('delete discounts')">
            <button type="button" class="btn btn-danger btn-sm" @click="deleteDiscount">
                <i class="fas fa-trash">
                </i>
            </button>
        </div>
</template>

<script>
    export default {
        props: ['shop', 'discount'],

        mounted() {
            console.log('Retailer delete discount Component mounted.')
        }, 
        data() {
            return {
                form: new Form({}),
                discountToDelete: this.discount,
                discountToDeleteShop: this.shop,
            }
        },
        methods: {
            deleteDiscount(){
                
                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        
                        this.form.delete('/dashboard/retailer/shops/'+this.discountToDeleteShop.slug+'/settings/discounts/'+this.discountToDelete.id).then(()=>{

                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your discount has been deleted.',
                                'success'
                            ).then((result) => {
                                if(result.value || !result.value) {window.location.reload();}
                            })
                            

                        }).catch(()=> {
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: 'Try again, or check your input values'
                            })

                        });

                        
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your discount has not been Deleted :)',
                            'error'
                        )
                    }
                })

                    
            },
        }
    }
</script>
