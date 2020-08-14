<template>
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Category</th>
				<th>Price</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(product, index) in productsList" :key="index">
				<td><img :src="product.image.url" width="80"></td>
				<td>{{product.name}}</td>
				<td>{{product.category.name}}</td>
				<td>{{product.price}}</td>
				<td>
					<button v-on:click="openModal" data-toggle="modal" class="btn btn-sm btn-warning">
						<i class="fas fa-edit"></i>
					</button>
					<button v-on:click="deleteProduct(index)" class="btn btn-sm btn-danger">
						<i class="fas fa-trash-alt"></i>
					</button>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		props:['products'],
		data(){
			return {
				productsList: this.products
			}
		},
		methods:{
			openModal(){
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
						this.productsList.splice(index, 1)
						swal("Product deleted", "", "success");
					})
				}
			}
		}
	}
</script>











