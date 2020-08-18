<template>
	<form @submit.prevent="productStore">

		<div class="row mb-3">
			<div class="col-md-12 d-flex justify-content-center mb-4">
				<img :src="`${product.image.url}`"  height="200" v-if="show_image">
				<img src="/images/products/default.png"  height="200" v-else>
			</div>
			<br>
			<div class="col-md-12 d-flex justify-content-center">
				<input type="file" :class="`form-control-file ${errors.photo? 'is-invalid': ''}`" name="photo" placeholder="photo"  @change="previewFile" ref="photo">
				<small v-if="errors.photo" class="invalid-feedback">{{errors.photo[0]}}</small>
			</div>
		</div>

		<div class="form-group">
			<input type="text" :class="`form-control ${errors.name? 'is-invalid': ''}`" name="name" placeholder="Name" v-model="product.name" required title="Name">
			<small v-if="errors.name" class="invalid-feedback">{{errors.name[0]}}</small>
		</div>

		<div class="form-group">
			<input type="number" :class="`form-control ${errors.amount? 'is-invalid': ''}`" name="amount" placeholder="Stock" v-model="product.amount" required title="Stock">
			<small v-if="errors.amount" class="invalid-feedback">{{errors.amount[0]}}</small>
		</div>

		<div class="form-group">
			<input type="number" :class="`form-control ${errors.price? 'is-invalid': ''}`" name="price" placeholder="Price" v-model="product.price" required title="Price">
			<small v-if="errors.price" class="invalid-feedback">{{errors.price[0]}}</small>
		</div>

		<div class="form-group">
			<div class="form-group">
				<textarea :class="`form-control ${errors.description? 'is-invalid': ''}`" name="description" rows="3" placeholder="Description" v-model="product.description" required title="Description"></textarea>
				<small v-if="errors.description" class="invalid-feedback">{{errors.description[0]}}</small>
			</div>
		</div>

		<div class="form-group">
			<select :class="`form-control ${errors.category_id? 'is-invalid': ''}`" name="category_id" v-model="product.category.id" required title="Category">
				<option value="0" disabled>Select Category</option>
				<option :value="category.id" v-for="(category, index2) in categories" :key="index2">{{category.name}}</option>
			</select>
			<small v-if="errors.category_id" class="invalid-feedback">{{errors.category_id[0]}}</small>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary btn-block" v-if="form_type == 'created'">Register</button>
			<button type="submit" class="btn btn-primary btn-block" v-else>Edit</button>
		</div>

	</form>
</template>

<script>
	export default {
		props:['product_data'],
		data(){
			return{
				default:{
					id: '',
					rol: 'Select Category',
					category:{
						id: '0',
						name: '',
					},
					image:{
						url: ''
					}
				},
				categories: [],
				product: {},
				server_url: '/admin/products/store/',
				form_type: 'created',
				show_image: false,
				errors: {}
			}
		},
		created(){
			this.product = {...this.default}
			this.getCategories()
		},
		mounted(){
			$(document).on('hidden.bs.modal', () => {
				this.$refs.photo.value = null
				this.product = {...this.default}
				this.show_image = false
			})
		},
		watch: {
			product_data: function(new_value, old_value) {
				this.product = {...new_value}
				this.form_type = 'edit'
				this.show_image = true

				if(!new_value){
					this.form_type = 'created'
					this.product = {...this.default}
					this.show_image = false
				}
			}
		},
		methods:{
			previewFile(event){
				this.show_image = true
				this.product.photo = event.target.files[0]
				this.product.image.url = URL.createObjectURL(this.product.photo)
			},

			async productStore(){
				const data_product = new FormData(),
				url = this.form_type == 'edit'
				? this.server_url + this.product.id
				: this.server_url
				data_product.append('id', this.product.id)
				data_product.append('name', this.product.name)
				data_product.append('amount', this.product.amount)
				data_product.append('price', this.product.price)
				data_product.append('description', this.product.description)
				data_product.append('category_id', this.product.category.id)

				if(this.product.photo){
					data_product.append('photo', this.product.photo, this.product.photo.name)
				}

				const response = await axios.post(url, data_product).then(response => {
					this.$emit("product", response.data.products);
					swal(`Product ${this.form_type} successful`, "", "success");
					$('#modal').modal('hide')
				}).catch(error =>{
					this.errors = error.response.data.errors
				})
			},

			getCategories(){
				axios.get('/categories/').then(response => {
					this.categories = response.data
				})
			}
		}
	}
</script>











