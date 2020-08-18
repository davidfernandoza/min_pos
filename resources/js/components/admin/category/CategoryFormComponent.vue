<template>
	<form @submit.prevent="categoryStore">

		<div class="form-group">
			<input type="text" :class="`form-control ${errors.name? 'is-invalid': ''}`" name="name" placeholder="Name" v-model="category.name" required title="Name">
			<small v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</small>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary btn-block" v-if="form_type == 'created'">Register</button>
			<button type="submit" class="btn btn-primary btn-block" v-else>Edit</button>
		</div>

	</form>
</template>

<script>
	export default {
		props:['category_data'],
		data(){
			return{
				default:{
					id: '',
					name: ''
				},
				category: {},
				server_url: '/admin/categories/store/',
				form_type: 'created',
				errors: {}
			}
		},
		created(){
			this.category = {...this.default}
		},
		mounted(){
			$(document).on('hidden.bs.modal', () => {
				this.category = {...this.default}
			})
		},
		watch: {
			category_data: function(new_value, old_value) {
				this.category = {...new_value}
				this.form_type = 'edit'

				if(!new_value){
					this.form_type = 'created'
					this.category = {...this.default}
				}
			}
		},
		methods:{

			async categoryStore(){
				const url = this.form_type == 'edit'
				? this.server_url + this.category.id
				: this.server_url

				const response = await axios.post(url, this.category).then(response => {
					this.$emit("category", response.data.categories);
					swal(`Product ${this.form_type} successful`, "", "success");
					$('#modal').modal('hide')
				}).catch(error =>{
					this.errors = error.response.data.errors
				})
			},

		}
	}
</script>











