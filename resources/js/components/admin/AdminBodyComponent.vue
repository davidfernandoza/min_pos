<template>
	<div>
		<div class="row mt-3">
			<div class="col-12 d-flex justify-content-end">
				<button type="button" class="btn btn-primary" data-toggle="modal" v-on:click="openModal">
					Crear nuevo registro
				</button>
			</div>
		</div>
		<div class="row m-3">
			<product-list/>
			<modal/>
		</div>
	</div>
</template>

<script>
import ProductList from './ProductListComponent.vue'
import Modal from './ModalComponent'
	export default {
		components:{
			ProductList,
			Modal
		},
		methods:{
			openModal(){
				$('#modal').modal('show');
			}
		}
	}
</script>











