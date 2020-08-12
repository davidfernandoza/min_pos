<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<category :category="category"/>
				<div  class="d-flex flex-wrap justify-content-md-between">
					<product :product="product" v-for="(product, index) in category.products" :key="index"/>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
	import Product from './ProductComponent.vue'
	import Category from '../category/CategoryComponent.vue'
	export default {
		props: ['category'],
		components:{
			Product,
			Category
		}
	}
</script>
