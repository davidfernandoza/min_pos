<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div v-for="(category, index1) in categories" :key="index1">
					<div class="card category-card w-100" >
						<a :href="`/products/${category.id}`">
							<div class="card-body">
								<h2 class="text-center">
									{{category.name}}
								</h2>
							</div>
						</a>
					</div>
					<div  class="d-flex flex-wrap justify-content-md-between justify-content-sm-start">
						<product :product="product" v-for="(product, index2) in category.products" :key="index2"/>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Product from './ProductComponent.vue'
	export default {
		components:{
			Product
		},
		data(){
			return {
				categories: [],
				products: {}
			}
		},
		created(){
			this.getCategories()
		},
		methods:{
			getCategories(){
				axios.get('/api/categories/get').then(response => {
					console.log(response.data);
					this.categories = response.data
				})
			}
		}
	}
</script>
