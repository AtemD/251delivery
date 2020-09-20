<template>
        <div v-if="$can('delete taxes')">
            <button type="button" class="btn btn-danger btn-sm" @click="deleteTaxes">
                <i class="fas fa-trash">
                </i>
            </button>
        </div>
</template>

<script>
    export default {
        props: ['shop', 'tax'],

        mounted() {
            console.log('Retailer delete tax Component mounted.')
        }, 
        data() {
            return {
                form: new Form({}),
                taxToDelete: this.tax,
                taxToDeleteShop: this.shop,
            }
        },
        methods: {
            deleteTaxes(){
                
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
                        
                        this.form.delete('/dashboard/retailer/shops/'+this.taxToDeleteShop.slug+'/settings/taxes/'+this.taxToDelete.id).then(()=>{

                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'Your tax has been deleted.',
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
                            'Your tax has not been Deleted :)',
                            'error'
                        )
                    }
                })

                    
            },
        }
    }
</script>
