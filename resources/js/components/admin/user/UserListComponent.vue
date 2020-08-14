<template>
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Photo</th>
				<th>Names</th>
				<th>Last Names</th>
				<th>Email</th>
				<th>Rol</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="(user, index) in usersList" :key="index">
				<td><img :src="`/${user.image.url}`" width="50" height="50"></td>
				<td>{{user.names}}</td>
				<td>{{user.last_names}}</td>
				<td>{{user.email}}</td>
				<td>{{user.rol}}</td>
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
		props:['users'],
		data(){
			return {
				usersList: this.users
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
					axios.post(`users/delete/${this.users[index].id}`).then(response => {
						this.usersList.splice(index, 1)
						swal("User deleted", "", "success");
					}).catch(err => {
						swal(`Forbidden`, "", "error");
					})
				}
			}
		}
	}
</script>











