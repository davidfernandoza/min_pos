<template>
	<div class="card my-4 product" style="width: 15rem;">
		<a :href="`/products/${product.id}`">
			<img :src="product.image.url" class="card-img-top" alt="...">
			<div class="card-body">
				<h3 class="card-title">{{product.name}}</h3>
				<p class="card-text text-truncate">{{product.description}}</p>
			</div>
			<div class="card-footer">
				<h3 class="card-title h5">${{product.price}}</h3>
			</div>
		</a>
	</div>
</template>

<script>
	export default {
		props:['product']
	}
</script>
