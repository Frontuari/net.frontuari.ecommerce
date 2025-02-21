/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.EventBus = new Vue();

/**
 * Detectar URL automaticamente del servidor
 */
const host = window.location.host;
const path = window.location.pathname.split("/")[1];
const protocolo = window.location.protocol;
window.URLSERVER = protocolo+"//"+host+"/";
window.URLHOME = protocolo+"//"+host+"/";

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('nuestros-productos', require('./components/ProductFilterComponent.vue').default);
Vue.component('slider', require('./components/Slider.vue').default);
Vue.component('footer-ad', require('./components/Footer.vue').default);
Vue.component('ads', require('./components/Ads.vue').default);
Vue.component('offers', require('./components/Offers.vue').default);
Vue.component('combos', require('./components/Combos.vue').default);
Vue.component('header-menu', require('./components/Header.vue').default);
Vue.component('catalog', require('./components/Catalog.vue').default);
Vue.component('profile', require('./components/profile.vue').default);
Vue.component('cart', require('./components/Cart.vue').default);
Vue.component('resume', require('./components/Resume.vue').default);
Vue.component('register', require('./components/Register.vue').default);
Vue.component('recover', require('./components/Recover.vue').default);
Vue.component('contact', require('./components/Contact.vue').default);

Vue.filter('FormatNumber',function(num) {
    num = parseFloat(num).toFixed(2);
    const arrNum = num.split(".");
    const decimal = arrNum[1];
    return arrNum[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")+","+decimal;
});

Vue.filter('FormatDolar',function(num) {
    return parseFloat(num).toFixed(2);
});

Vue.filter('MediumImage',function(imageText) {
    imageText = imageText.split('.');
    let newImageText = imageText[0]+'-cropped.'+imageText[1];
    return newImageText;
});

Vue.filter('BigImage',function(imageText) {
    imageText = imageText.split('.');
    let newImageText = imageText[0]+'-medium.'+imageText[1];
    return newImageText;
});

Vue.directive('select2', {
    inserted(el) {
        $(el).on('select2:select', () => {
            const event = new Event('change', { bubbles: true, cancelable: true });
            el.dispatchEvent(event);
        });

        $(el).on('select2:unselect', () => {
            const event = new Event('change', {bubbles: true, cancelable: true})
            el.dispatchEvent(event)
        })
    },
});

Vue.directive('lazyload',{
    inserted: el => {
    function loadImage() {
      const imageElement = Array.from(el.children).find(
      el => el.nodeName === "IMG"
      );
      if (imageElement) {
        imageElement.addEventListener("load", () => {
          setTimeout(() => el.classList.add("loaded"), 100);
        });
        imageElement.addEventListener("error", () => console.log("error"));
        imageElement.src = imageElement.dataset.url;
      }
    }

    function handleIntersect(entries, observer) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadImage();
          observer.unobserve(el);
        }
      });
    }

    function createObserver() {
      const options = {
        root: null,
        threshold: "0"
      };
      const observer = new IntersectionObserver(handleIntersect, options);
      observer.observe(el);
    }
    if (window["IntersectionObserver"]) {
      createObserver();
    } else {
      loadImage();
    }
  }
});


var globalFunc = {
    addToFavorite: function(product,user_id) {

        console.log(product, user_id);
        const audio = new Audio('filling-your-inbox.ogg');
        audio.play().catch(error => {
            console.error("Error al reproducir el audio:", error);
        });
        
        let products_id = product.id;
        
        if(!!user_id) {
            axios.post(URLHOME+'api/favorites', {
                products_id: products_id,
                user_id: user_id
            })
            .then(function (response) {
                if(response.data == 'exist') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ya este producto está añadido en Favoritos',
                    });
                }else {
                    EventBus.$emit("update_cantFavorite",response.data);
                }
                
            })
            .catch(function (error) {
                console.log(error);
            });
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debes estar logueado para agregar a favoritos',
            });
        }
    },

    addToCart: function(product,cantidad) {
        let cart = [];
        console.log("esto es el product nuevo", product);
        if(window.localStorage.getItem('cartNew')) {
            cart = JSON.parse(window.localStorage.getItem('cartNew'));
            cart = globalFunc.validateCart(product,cart,cantidad);
            window.localStorage.setItem('cartNew', JSON.stringify(cart));
            const cantUpdate = globalFunc.getCartCant(cart);
            EventBus.$emit("update_cantCart",cantUpdate);
            const audio = new Audio('filling-your-inbox.ogg');
            audio.play().catch(error => {
                console.error("Error al reproducir el audio:", error);
            });
            
            
        }else {
            cart = globalFunc.validateCart(product,cart,cantidad);
            window.localStorage.setItem('cartNew', JSON.stringify(cart));
            EventBus.$emit("update_cantCart",cantidad);

        }
        
    },
    addComboToCart: function(products) {
        products.forEach( a => {
            globalFunc.addToCart(a,a.cant_combo);
        });
    },
    validateCart: function(product,tmp,cantidad) {
        let exist = false;
        tmp.forEach( (a,b) => {
            if (a.product.id == product.id) {
                if(product.qty_avaliable >= parseInt(parseInt(tmp[b].cant) + parseInt(cantidad)) ){
                    tmp[b].cant = parseInt(parseInt(tmp[b].cant) + parseInt(cantidad));
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El inventario del producto no es suficiente para agregar al carrito',
                    });
                }
                exist = true;
            }
        });
        if(!exist) {
            if(product.qty_avaliable >= 1 && (product.qty_avaliable >= cantidad) ) {
                tmp.push({product: product,cant: parseInt(cantidad)});
            }else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El inventario del producto no es suficiente para agregar al carrito',
                });
            }
        }
        return tmp;
    },
    checkStock: function(product,tmp,cantidad) {

    },
    dropCart: function() {
        window.localStorage.removeItem('cartNew');
        EventBus.$emit("update_cantCart",0);
    },
    droppingCart: function() {
        Swal.fire({
            title: 'Carrito',
            text: "¿Desea eliminar su carrito de compras?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                this.dropCart();
                location.href = "/";
            }
        })
    },
    getCartCant: function(cart) {
        let cant = 0;
        cart.forEach( (a) => {
            cant += a.cant
        });
        return cant;
    },
    removeCart(index) {
        Swal.fire({
            title: 'Carrito',
            text: "¿Desea eliminar el producto del carrito?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                this.products_cart.splice(index,1);
                localStorage.setItem('cartNew', JSON.stringify(this.products_cart));
                this.cant_cart = this.products_cart.length;
                this.total_cart = 0;
                this.updateCartTotal();
                let cart = JSON.parse(window.localStorage.getItem('cartNew'));
                const cantUpdate = globalFunc.getCartCant(cart);
                EventBus.$emit("update_cantCart",cantUpdate);
            }
        })
            

    },
    updateCartTotal(){

        if( window.localStorage.getItem("cartNew") ){
            this.cant_cart = JSON.parse(window.localStorage.getItem("cartNew")).length;
            this.products_cart = JSON.parse(window.localStorage.getItem("cartNew"));
        }else{
            this.cant_cart = 0;
        }
        for(let i = 0; i<this.cant_cart; i++)
        {
            if(this.products_cart[i].product.discount>0)
            {
                this.total_cart+=parseFloat(this.products_cart[i].product.discount) * parseInt(this.products_cart[i].cant);
            }else{
                this.total_cart += parseFloat(this.products_cart[i].product.price) * parseInt(this.products_cart[i].cant);
            }
        }
    }
}

Vue.prototype.addToFavorite = globalFunc.addToFavorite; 
Vue.prototype.addToCart = globalFunc.addToCart;
Vue.prototype.addComboToCart = globalFunc.addComboToCart;
Vue.prototype.removeCart = globalFunc.removeCart;
Vue.prototype.dropCart = globalFunc.dropCart;
Vue.prototype.droppingCart = globalFunc.droppingCart;



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});