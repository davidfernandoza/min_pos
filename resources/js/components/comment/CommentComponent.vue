<template>
	<section class="col-mb-4">
		<h4 class="mb-4">Comments</h4>

		<div>
			<div class="form-group">
				<input type="text" v-model="comment.body" @keyup.enter="store()" class="form-control" required placeholder="Enter to add comment">
			</div>
		</div>

		<div class="card mb-3" v-for="(comment, index) in comments" :key="index">
			<div class="row no-gutters ">
				<div class="col-4 col-md-3 col-lg-2 d-flex pl-2 flex-wrap align-items-center ">
					<img :src="`${comment.user.image.url}`"  width="100">
				</div>
				<div class="col-8 col-md-9 col-lg-10">
					<div class="card-body">
						<h5 class="card-title">{{comment.user.names}}</h5>
						<p class="card-text">{{comment.body}}</p>
						<p class="card-text"><small class="text-muted">{{ comment.created_at }}</small></p>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		props: ['product_id', 'auth_id'],
		data(){
			return{
				comment: {
					'user_id': this.auth_id,
					'product_id': this.product_id
				},
				comments: [],
			}
		},
		created(){
			this.getComments()
		},
		methods:{
			getComments(){
				axios.get(`/comments/product/${this.product_id}`).then(response => {
					this.comments = response.data
				})
			},
			async store(){
				if (Object.keys(this.auth_id).length === 0) {
					await swal("Login first!!", "", "warning");
					window.location.href = "/auth/login";
				}
				else{
					axios.post(`/comments/store/${this.auth_id}`, this.comment).then(response => {
						this.comments.unshift(response.data)
						this.comment.body = ''
					})
				}
			}
		}
	}
</script>
