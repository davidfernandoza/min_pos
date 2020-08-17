<template>
	<form @submit.prevent="userStore">

		<div class="form-row mb-3">
			<div class="form-group col-md-4 ">
				<img :src="`${user.image.url}`" width="150" height="150" v-if="show_image">
				<img src="/images/default.png" width="150" height="150" v-else>
			</div>

			<div class="form-group col-md-8 d-flex align-items-center">
				<input type="file" :class="`form-control-file ${errors.photo? 'is-invalid': ''}`" name="photo" placeholder="photo"  @change="previewFile" ref="photo">
				<small v-if="errors.photo" class="invalid-feedback">{{errors.photo[0]}}</small>
			</div>
		</div>

		<div class="form-group">
			<input type="text" :class="`form-control ${errors.names? 'is-invalid': ''}`" name="names" placeholder="Names" v-model="user.names" required>
			<small v-if="errors.names" class="invalid-feedback">{{errors.names[0]}}</small>
		</div>

		<div class="form-group">
			<input type="text" :class="`form-control ${errors.last_names? 'is-invalid': ''}`" name="last_names" placeholder="Last Names" v-model="user.last_names" required>
			<small v-if="errors.last_names" class="invalid-feedback">{{errors.last_names[0]}}</small>
		</div>

		<div class="form-group">
			<input type="email" :class="`form-control ${errors.email? 'is-invalid': ''}`" name="email" placeholder="Email" v-model="user.email" required>
			<small v-if="errors.email" class="invalid-feedback">{{errors.email[0]}}</small>
		</div>


		<div class="form-group">
			<select :class="`form-control ${errors.rol? 'is-invalid': ''}`" name="rol" v-model="user.rol" required>
				<option disabled>Select Rol</option>
				<option>ADMIN</option>
				<option>USER</option>
			</select>
			<small v-if="errors.rol" class="invalid-feedback">{{errors.rol[0]}}</small>
		</div>

		<div class="card-footer">
			<button type="submit" class="btn btn-primary btn-block" v-if="form_type == 'create'">Register</button>
			<button type="submit" class="btn btn-primary btn-block" v-else>Edit</button>
		</div>

	</form>
</template>

<script>
	export default {
		props:['user_data'],
		data(){
			return{
				default:{
					id: '',
					rol: 'Select Rol',
					password: '123456789',
					image:{
						url: ''
					}
				},
				user: {},
				server_url: '/admin/users/store/',
				form_type: 'created',
				show_image: false,
				errors: {}
			}
		},
		created(){
			this.user = this.default
		},
		mounted(){
			$(document).on('hidden.bs.modal', () => {
				this.$refs.photo.value = null
				this.user = {...this.default}
				this.show_image = false
			})

		},
		watch: {
			user_data: function(new_value, old_value) {
				this.user = {...new_value}
				this.form_type = 'edit'
				this.show_image = true

				if(!new_value){
					this.form_type = 'created'
					this.user = {...this.default}
					this.show_image = false
				}
			}
		},
		methods:{
			previewFile(event){
				this.show_image = true
				this.user.photo = event.target.files[0]
				this.user.image.url = URL.createObjectURL(this.user.photo)
			},
			async userStore(){
				const data_user = new FormData(),
				url = this.form_type == 'edit'
				? this.server_url + this.user.id
				: this.server_url
				data_user.append('id', this.user.id)
				data_user.append('names', this.user.names)
				data_user.append('last_names', this.user.last_names)
				data_user.append('email', this.user.email)
				data_user.append('rol', this.user.rol)
				data_user.append('password', this.user.password)
				data_user.append('password_confirmation', this.user.password)


				if(this.user.photo){
					data_user.append('photo', this.user.photo, this.user.photo.name)
				}

				const response = await axios.post(url, data_user).then(response => {
					this.$emit("users", response.data.users);
					swal(`User ${this.form_type} successful`, "", "success");
					$('#modal').modal('hide')

				}).catch(error =>{
					console.log();
					this.errors = error.response.data.errors
				})


			}
		}
	}
</script>











