<template>
	<div class="container m-auto">
		<div class="row">
			<div class="col-md-8 my-4">
				<img :src="product.image.url"/>
			</div>
			<div class="col-md-4 my-4">
				<h1 class="h2">
					{{product.name}}
					<span class="badge badge-pill badge-secondary">{{product.category.name}}</span>
				</h1>
				<h2 class="h1 my-4">${{product.price}}</h2>
				<form action="">
					<div class="row">
						<div class="form-group col-5">
							<label class="h4">Amount</label>
							<input type="number"
								class="form-control" name="amount" value="1">
						</div>
						<div class="col-6 d-flex justify-content-center align-items-center">
							<span class="my-2 text-muted">( {{product.amount}} available )</span>
						</div>
					</div>
					<button class="btn btn-primary btn-block">
						Add cart <i class="fas fa-cart-plus"></i>
					</button>
				</form>
				<h2 class="h4 my-4">Description</h2>
				<p>{{product.description}}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<comment :product_id="product.id" :auth_id="auth_id"/>
			</div>
		</div>
	</div>
</template>

<script>
import Comment from '../comment/CommentComponent.vue'
	export default {
		props:['product', 'auth_id'],
		components:{
			Comment
		}
	}
</script>
