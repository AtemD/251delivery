/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.bus = new Vue();

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
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
    data: {
        cart: []
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
                return total + product.quantity * product.price;
            }, 0);
        },
        totalItems(){
            return this.cart.reduce((total, product) => {
                return total + product.quantity;
            }, 0);
        }
    },
    methods: {
        getCart () {
            this.cart=[];
            // if (localStorage && localStorage.getItem('cart')) {
            //     this.cart = JSON.parse(localStorage.getItem('cart'));

            // } else {
            //     this.cart = [];
            // }
        },
        addToCart(product){
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
                return item.id == product.id;
            });

            if (this.cart[matchingProductIndex].qty <= 1) {
                this.cart.splice(matchingProductIndex, 1);
            } else {
                this.cart[matchingProductIndex].qty--;
            }

            localStorage.setItem('cart', JSON.stringify(this.cart));
        }
        

    }
});
