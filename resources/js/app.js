/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.bus = new Vue();

// Importing the mixins to be used globally
import Permissions from './mixins/Permissions';
Vue.mixin(Permissions);

// Sweet alert
import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
})
window.swalWithBootstrapButtons = swalWithBootstrapButtons;

// Vform package import
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// JavaScript function that serializes Objects to FormData instances.
// This will make it possible for Vform package to be able to upload image files
import objectToFormData from "./objectToFormData"; 
window.objectToFormData = objectToFormData;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('product-modal-component', require('./components/ProductModalComponent.vue').default);
Vue.component('cart-count-component', require('./components/CartCountComponent.vue').default);
Vue.component('product-component', require('./components/ProductComponent.vue').default);
Vue.component('cart-details-component', require('./components/CartDetailsComponent.vue').default);

// COMPANY COMPONENTS:

// company cuisines
Vue.component('company-cuisine-add', require('./components/CompanyCuisineAdd.vue').default);
// company order types
Vue.component('company-order-type-add', require('./components/CompanyOrderTypeAdd.vue').default);
// company order statuses
Vue.component('company-order-status-add', require('./components/CompanyOrderStatusAdd.vue').default);
// company shop account statuses
Vue.component('company-shop-account-status-add', require('./components/CompanyShopAccountStatusAdd.vue').default);
// company user account statuses
Vue.component('company-user-account-status-add', require('./components/CompanyUserAccountStatusAdd.vue').default);
// company payment methods
Vue.component('company-payment-method-add', require('./components/CompanyPaymentMethodAdd.vue').default);
// company shop types
Vue.component('company-shop-type-add', require('./components/CompanyShopTypeAdd.vue').default);
// company roles
Vue.component('company-role-add', require('./components/CompanyRoleAdd.vue').default);
// company countries
Vue.component('company-country-add', require('./components/CompanyCountryAdd.vue').default);
// company regions
Vue.component('company-region-add', require('./components/CompanyRegionAdd.vue').default);
// company cities
Vue.component('company-city-add', require('./components/CompanyCityAdd.vue').default);
// company users
Vue.component('company-user-add', require('./components/CompanyUserAdd.vue').default);

// RETAILER COMPONENTS:

// retailer shops
Vue.component('retailer-shop-add', require('./components/RetailerShopAdd.vue').default);
// Vue.component('retailer-shop-delete-component', require('./components/RetailerShopDeleteComponent.vue').default);
// Vue.component('retailer-shop-edit-component', require('./components/RetailerShopEditComponent.vue').default);

// Retailer products
Vue.component('retailer-product-add', require('./components/RetailerProductAdd.vue').default);
// Vue.component('retailer-product-edit', require('./components/RetailerProductEdit.vue').default);
// Vue.component('retailer-product-delete', require('./components/RetailerProductDelete.vue').default);

// Retailer Taxes
Vue.component('retailer-tax-add', require('./components/RetailerTaxAdd.vue').default);
// Vue.component('retailer-tax-edit', require('./components/RetailerTaxEdit.vue').default);
// Vue.component('retailer-tax-delete', require('./components/RetailerTaxDelete.vue').default);

Vue.component('retailer-discount-add', require('./components/RetailerDiscountAdd.vue').default);
// Vue.component('retailer-discount-edit', require('./components/RetailerDiscountEdit.vue').default);
// Vue.component('retailer-discount-delete', require('./components/RetailerDiscountDelete.vue').default);


Vue.component('retailer-user-add', require('./components/RetailerUserAdd.vue').default);

Vue.component('retailer-section-add', require('./components/RetailerSectionAdd.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
if(document.querySelector('#app')) {
    const app = new Vue({
        el: '#app',
        data: {
            cart: [],
            proceedWithAddToCart: false,
        },
        created(){
            this.getCart();

            bus.$on('add-to-cart', (product) => {
                this.addToCart(product);
            });

            bus.$on('remove-from-cart', (product) => {
                this.removeFromCart(product);
            });

        },
        computed: {
            cartTotal(){
                return this.cart.reduce((total, product) => {
                    return total + product.qty * product.base_price;
                }, 0);
            },
            totalItems(){
                return this.cart.reduce((total, product) => {
                    return total + product.qty;
                }, 0);
            }
        },
        methods: {
            getCart () {
                this.cart=[];
                if (localStorage && localStorage.getItem('cart')) {
                    this.cart = JSON.parse(localStorage.getItem('cart'));
                    // window.localStorage.clear();
                } else {
                    this.cart = [];
                }
            },
            addToCart(product){

                const hasSwitchedShop = this.userHasSwitchedShop(product);

                if(hasSwitchedShop === true){
                    console.log('hit product not from the same shop');
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    
                    swalWithBootstrapButtons.fire({
                        title: 'You Switched to Another Shop',
                        text: "This action will create a new shopping cart and delete the current one!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'No, cancel!',
                        cancelButtonText: 'Yes, create new cart!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {

                            this.proceedWithAddToCart = false;

                            swalWithBootstrapButtons.fire(
                                'OK, first go to checkout',
                                'Once you checkout, you can come back and order from here :)',
                                'success'
                            );

                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            
                            localStorage.clear();
                            this.cart = [];
                            this.proceedWithAddToCart = true;

                            swalWithBootstrapButtons.fire(
                                'Successfully Switched to Another Shop',
                                'Your new cart has been created. You can now place a new order :)',
                                'success'
                            );
                        }
                    });
                } else {
                    this.proceedWithAddToCart = true;
                }

                if(this.proceedWithAddToCart === false) return;

                const matchingProductIndex = this.cart.findIndex((item) => {
                    return item.id === product.id;
                });

                if (matchingProductIndex > -1) {
                    this.cart[matchingProductIndex].qty++;
                } else {
                    product.qty = 1;
                    this.cart.push(product);
                }

                localStorage.setItem('cart', JSON.stringify(this.cart));
            },

            removeFromCart(product){
                const matchingProductIndex = this.cart.findIndex((item) => {
                    return item.id === product.id;
                });

                if (this.cart[matchingProductIndex].qty <= 1) {
                    this.cart.splice(matchingProductIndex, 1);
                } else {
                    this.cart[matchingProductIndex].qty--;
                }

                localStorage.setItem('cart', JSON.stringify(this.cart));
            },

            userHasSwitchedShop(product){
                if (this.cart.length) {
                    // cart is not empty
                    return product.shop_id != this.cart[0].shop_id;
                } else {
                    // Cart is empty
                    return false;
                }
            }
            

        }
    });
}

if(document.querySelector('#retailerapp')) {
    // A fresh vue application instance of the retailer part of the app
    const retailerapp = new Vue({
        el: '#retailerapp',
        created(){
            console.log('retailer app created');

            bus.$on('show-success-toast', () => {
                this.showSuccessToast();
            });

            bus.$on('show-error-alert', () => {
                this.showErrorAlert();
            });
        },
        methods: {
            showSuccessToast() {
                Toast.fire({
                    icon: 'success',
                    title: 'Item Created Successfully'
                })

                setTimeout(()=>{ 
                    window.location.reload();
                },1000);
            },
            showErrorAlert(){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! check your inputs values or reload the page and try again'
                })
            }
        }
    });
}

if(document.querySelector('#companyapp')) {
    // A fresh vue application instance of the company part of the app
    const companyapp = new Vue({
        el: '#companyapp',
        created(){
            console.log('company app created');

            bus.$on('show-success-toast', () => {
                this.showSuccessToast();
            });

            bus.$on('show-error-alert', () => {
                this.showErrorAlert();
            });
        },
        methods: {
            showSuccessToast() {
                Toast.fire({
                    icon: 'success',
                    title: 'Item Created Successfully'
                })

                setTimeout(()=>{ 
                    window.location.reload();
                },1000);
            },
            showErrorAlert(){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! check your inputs values or reload the page and try again'
                })
            }
        }
    });
}
