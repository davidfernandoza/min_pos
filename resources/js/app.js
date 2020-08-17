/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/
require('./bootstrap')

import swal from 'sweetalert'
import Vue from 'vue'
import CategoryList from './components/category/CategoryListComponent.vue'
import CategoryInfo from './components/category/CategoryInfoComponent.vue'
import ProductInfo from './components/product/ProductInfoComponent.vue'
import ProductSearch from './components/product/ProductSearchComponent.vue'
import ProductListAdmin from './components/admin/product/ProductListComponent'
import CategoryListAdmin from './components/admin/category/CategoryListComponent.vue'
import UserListAdmin from './components/admin/user/UserListComponent.vue'
import Dashboard from './components/admin/DashboardComponent.vue'

new Vue({
	el: '#app',
	components:{
		ProductListAdmin,
		CategoryListAdmin,
		UserListAdmin,
		CategoryList,
		CategoryInfo,
		Dashboard,
		ProductInfo,
		ProductSearch
	}
});
