/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap')

import Vue from 'vue'
import Category from './components/CategoryComponent.vue'
import Product from './components/ProductComponent.vue'

new Vue({
	el: '#app',
	components:{
		Category,
		Product
	}
});
