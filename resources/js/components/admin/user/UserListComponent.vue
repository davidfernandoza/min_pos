<template>
	<div>
		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" v-on:click="newUser">
					<i class="fas fa-plus"></i> New User
				</button>
			</div>
		</div>
		<div class="row m-3">
			<table class="table table-sm">
				<thead>
					<tr>
						<th>Photo</th>
						<th>Names</th>
						<th>Last Names</th>
						<th>Email</th>
						<th>Roles</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(user, index) in users_list" :key="index">
						<td><img :src="`${user.image.url}`" width="50" height="50"></td>
						<td>{{user.names}}</td>
						<td>{{user.last_names}}</td>
						<td>{{user.email}}</td>
						<td><samp v-for="(role, index2) in user.roles" :key="index2">{{role.name}}</samp></td>
						<td>
							<button v-on:click="userEdit(index)" data-toggle="modal" class="btn btn-sm btn-warning">
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
		<modal-user :title="title">
			<user-form :user_data="user_data" @users="users_list = $event"/>
		</modal-user>
	</div>
</template>

<script>
	import ModalUser from '../ModalComponent.vue'
	import UserForm from './UserFormComponent.vue'
	export default {
		props:['users'],
		components:{
			ModalUser,
			UserForm
		},
		data(){
			return {
				users_list: null,
				user_data: null,
				title: ''
			}
		},
		created(){
			this.users_list = this.users
		},
		methods:{

			// Actions buttons
			newUser(){
				this.title = 'New User'
				this.user_data = null
				$('#modal').modal('show')
			},
			userEdit(index){
				this.title = 'User Edit'
				this.user_data  = this.users_list[index]
				$('#modal').modal('show');
			},

			// Delete:
			async deleteProduct(index){
				const deleted = await swal({
					title: "Are you sure to delete this record??",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})

				if (deleted) {
					$(document).on('hidden.bs.modal', () => {
				location.reload();
			});
					axios.post(`users/delete/${this.users[index].id}`).then(response => {
						this.users_list.splice(index, 1)
						swal("User deleted", "", "success");
					}).catch(err => {
						swal(`Forbidden`, "", "error");
					})
				}
			}
		}
	}
</script>











