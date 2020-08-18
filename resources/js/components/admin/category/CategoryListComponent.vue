<template>
	<div>
		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" v-on:click="newCategory">
					<i class="fas fa-plus"></i> New Category
				</button>
			</div>
		</div>
		<div class="row m-3">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(category, index) in categories_list" :key="index">
						<td>{{category.name}}</td>
						<td class="d-flex justify-content-center">
							<button v-on:click="categoryEdit(index)" data-toggle="modal" class="btn btn-sm btn-warning">
								<i class="fas fa-edit"></i>
							</button>
							<button v-on:click="deleteProduct(index)" class="btn btn-sm btn-danger">
								<i class="fas fa-trash-alt"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<!-- Modal -->
		<modal-category :title="title">
			<category-form :category_data="category_data" @category="categories_list = $event"/>
		</modal-category>
	</div>
</template>

<script>
	import CategoryForm from './CategoryFormComponent.vue'
	import ModalCategory from '../ModalComponent.vue'
	export default {
		props:['categories'],
		components:{
			CategoryForm,
			ModalCategory
		},
		data(){
			return {
				category_data: {name: ''},
				categories_list: '',
				title: ''
			}
		},
		created(){
			this.categories_list = this.categories
		},
		methods:{
			// Actions buttons
			newCategory(){
				this.title = 'New Category'
				this.category_data = null
				$('#modal').modal('show')
			},
			categoryEdit(index){
				this.title = 'Category Edit'
				this.category_data  = this.categories_list[index]
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
						this.categories_list.splice(index, 1)
						swal("Category deleted", "", "success");
					})
				}
			}
		}
	}
</script>











