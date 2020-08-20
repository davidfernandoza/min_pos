<template>
	<div>
		<div class="row my-3">
			<div class="col-12 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" v-on:click="newCategory">
					<i class="fas fa-plus"></i> New Category
				</button>
			</div>
		</div>

		<table id="categories_table" class="display table table-sm" style="width:100%" @click="getEventTable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Actions</th>
				</tr>
			</thead>
		</table>

		<!-- Modal -->
		<modal-category :title="title">
			<category-form :category_data="category_data" @refreshTable="refreshTable()"/>
		</modal-category>
	</div>
</template>

<script>
	import CategoryForm from './CategoryFormComponent.vue'
	import ModalCategory from '../ModalComponent.vue'
	export default {
		components:{
			CategoryForm,
			ModalCategory
		},
		data(){
			return {
				category_data: {name: ''},
				title: ''
			}
		},
		mounted(){
			this.getCategories()
		},
		methods:{

			getCategories(){
				$('#categories_table').DataTable( {
					'processing': true,
					'serverSide': true,
					'ajax': "/admin/categories/data-table",
					columns:[
						{data: 'name', name: 'name'},
						{data: 'actions', name: 'actions', orderable: false, searchable: false},
					]
    		})
			},

			getEventTable(event){
				const button = event.target
				if (button.getAttribute('role') === 'delete') {
					this.deleteProduct(button.getAttribute('data-id'))
				}
				else {
					this.categoryEdit(button.getAttribute('data-id'))
				}
			},

			// Actions buttons
			newCategory(){
				this.title = 'New Category'
				this.category_data = null
				$('#modal').modal('show')
			},

			async categoryEdit(id){
				this.category_data = await this.getCategory(id)
				this.title = 'Category Edit'
				$('#modal').modal('show');
			},


			refreshTable(){
				$('#categories_table').DataTable().ajax.reload(null, false)
			},

			async getCategory(id){
				const response = await axios.get(`/admin/categories/get/${id}`)
				return response.data
			},

			async deleteProduct(id){
				const deleted = await swal({
					title: "Are you sure to delete this record??",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})

				if (deleted) {
					axios.post(`/admin/categories/delete/${id}`).then(response => {
						this.refreshTable()
						swal("Category deleted", "", "success");
					})
				}
			}
		}
	}
</script>











