<template>
	<view>
		<u-navbar :title="article.title"></u-navbar>
		<view class="m-30">
			<!-- <text class="d-block font-size-32 text-center">{{article.title}}</text> -->
			<view v-html="article.content" class="mt-20"></view>		
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				article:{},
				id:''
			};
		},
		onLoad(options) {
			this.id = options.id
		},
		onShow() {
			this.getNewsDetail()
		},
		onHide(){
			
		},
		beforeDestroy(){
			
		},
		methods:{
			getNewsDetail(){
				if(this.id == 1){
					this.$u.api.index.jieshao_detail().then(res=>{
						this.article = res.data
						this.article.title = res.data.title
					})
				}else{
					this.$u.api.index.Information_detail(this.id).then(res=>{
						this.article = res.data
						this.article.title = res.data.title
					})
				}
			},
		}
	}
</script>

<style lang="scss">
	page{
		background-color: white;
	}
</style>
