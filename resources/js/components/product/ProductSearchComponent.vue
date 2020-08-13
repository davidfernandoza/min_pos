<template>
	<div class="container">
		<div  class="d-flex flex-wrap justify-content-md-between">
			<product :product="product" v-for="(product, index) in products" :key="index"/>
		</div>
	</div>
</template>

<script>
	import Product from './ProductComponent.vue'
	export default {
		props: ['products'],
		components:{
			Product
		}
	}
</script>
