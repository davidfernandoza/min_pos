<template>
	<div class="card m-2 product" style="width: 15rem;">
		<a href="">
			<img :src="data_product.image.url" class="card-img-top" alt="...">
			<div class="card-body">
				<h3 class="card-title">{{data_product.name}}</h3>
				<p class="card-text">{{data_product.description}}</p>
			</div>
			<div class="card-footer">
				<h3 class="card-title h5">${{data_product.price}}</h3>
			</div>
		</a>
	</div>
</template>

<script>
	export default {
		props:['product'],
		data(){
			return {
				data_product: this.product
			}
		}
	}
</script>
