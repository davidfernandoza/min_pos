<template>
	<div>
		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" v-on:click="openModal">
					New register <i class="fas fa-plus"></i>
				</button>
			</div>
		</div>
		<div class="row m-3">
			<product-list :products="data" v-if="view_type == 'products'"/>
			<user-list :users="data" v-else-if="view_type == 'users'"/>
			<categories-list :categories="data" v-else/>
			<modal/>
		</div>
	</div>
</template>

<script>
import ProductList from './product/ProductListComponent.vue'
import UserList from './user/UserListComponent.vue'
import CategoriesList from './category/CategoryListComponent.vue'
import Modal from './ModalComponent.vue'
	export default {
		props:['data', 'view_type'],
		components:{
			ProductList,
			UserList,
			CategoriesList,
			Modal
		},
		methods:{
			openModal(){
				$('#modal').modal('show');
			}
		}
	}
</script>











