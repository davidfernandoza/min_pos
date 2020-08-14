<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div v-for="(category, index1) in categories" :key="index1">
					<category :category="category"/>
					<div  class="d-flex flex-wrap justify-content-md-between">
						<product :product="product" v-for="(product, index2) in category.products" :key="index2"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Product from '../product/ProductComponent.vue'
	import Category from './CategoryComponent.vue'
	export default {
		components:{
			Product,
			Category
		},
		data(){
			return {
				categories: []
			}
		},
		created(){
			this.getCategories()
		},
		methods:{
			getCategories(){
				axios.get('/categories').then(response => {
					this.categories = response.data
				})
			}
		}
	}
</script>
