<template>
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Name</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(category, index) in categoriesList" :key="index">
				<td>{{category.name}}</td>
				<td class="d-flex justify-content-center">
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
		props:['categories'],
		data(){
			return {
				categoriesList: this.categories
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
					axios.post(`categories/delete/${this.categories[index].id}`).then(response => {
						this.categoriesList.splice(index, 1)
						swal("Category deleted", "", "success");
					})
				}
			}
		}
	}
</script>











