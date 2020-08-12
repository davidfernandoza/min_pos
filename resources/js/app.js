/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap')

import Vue from 'vue'
import CategoryList from './components/category/CategoryListComponent.vue'
import ProductList from './components/product/ProductListComponent.vue'

new Vue({
	el: '#app',
	components:{
		CategoryList,
		ProductList
	}
});
