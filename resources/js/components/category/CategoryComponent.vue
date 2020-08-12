<template>
	<div class="card category-card w-100" >
		<a :href="`/products/category/${category.id}`">
			<div class="card-body">
				<h2 class="text-center">
					{{category.name}}
				</h2>
			</div>
		</a>
	</div>
</template>

<script>
	export default {
		props: ['category']
	}
</script>











