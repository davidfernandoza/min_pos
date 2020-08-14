/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap')

import Vue from 'vue'
import CategoryList from './components/category/CategoryListComponent.vue'
import CategoryInfo from './components/category/CategoryInfoComponent.vue'
import ProductInfo from './components/product/ProductInfoComponent.vue'
import ProductSearch from './components/product/ProductSearchComponent.vue'
import AdminBody from './components/admin/AdminBodyComponent.vue'

new Vue({
	el: '#app',
	components:{
		CategoryList,
		CategoryInfo,
		ProductInfo,
		ProductSearch,
		AdminBody
	}
});
