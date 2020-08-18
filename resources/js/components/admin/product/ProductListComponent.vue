<template>
	<div>
		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" v-on:click="newProduct">
					<i class="fas fa-plus"></i> New Product
				</button>
			</div>
		</div>
		<div class="row m-3">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Category</th>
						<th>Price</th>
						<th>Stock</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(product, index) in products_list" :key="index">
						<td><img :src="product.image.url" width="80"></td>
						<td>{{product.name}}</td>
						<td>{{product.category.name}}</td>
						<td>{{product.price}}</td>
						<td>{{product.amount}}</td>
						<td>
							<button v-on:click="productEdit(index)" data-toggle="modal" class="btn btn-sm btn-warning">
								<i class="fas fa-edit"></i>
							</button>
							<button v-on:click="deleteProduct(index)" class="btn btn-sm btn-danger">
								<i class="fas fa-trash-alt"></i>
							</button>
							<a :href="`/products/${product.id}`" class="btn btn-info btn-sm" target="_blank"><i class="far fa-eye"></i></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<!-- Modal -->
		<modal-product :title="title">
			<product-form :product_data="product_data" @product="products_list = $event"/>
		</modal-product>
	</div>
</template>

<script>
	import ModalProduct from '../ModalComponent.vue'
	import ProductForm from './ProductFormComponent.vue'
	export default {
		props:['products'],
		components:{
			ModalProduct,
			ProductForm
		},
		data(){
			return {
				product_data: null,
				products_list: null,
				title: ''
			}
		},
		created(){
			this.products_list = this.products
		},

		methods:{

			// Actions buttons
			newProduct(){
				this.title = 'New Product'
				this.product_data = null
				$('#modal').modal('show')
			},
			productEdit(index){
				this.title = 'Product Edit'
				this.product_data  = this.products_list[index]
				$('#modal').modal('show');
			},
			async deleteProduct(index){
				const deleted = await swal({
					title: "Are you sure to delete this record??",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})

				if (deleted) {
					axios.post(`products/delete/${this.products[index].id}`).then(response => {
						this.products_list.splice(index, 1)
						swal("Product deleted", "", "success");
					})
				}
			}
		}
	}
</script>











