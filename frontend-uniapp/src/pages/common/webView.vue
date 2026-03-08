<template>
	<view>
		<!-- <text class="iconfont icon-fanhui back" @click="back"></text> -->
		<web-view :src="url"></web-view>
	</view>
</template>
<script>
	export default {
		data() {
			return {
				url: ''
			};
		},
		onLoad(options) {
			
		},
		onShow() {
			
			this.getKefu()
			const _this = this
			uni.setNavigationBarTitle({
				title: _this.$t("common.customerService")
			})
		},
		methods: {
			back() {
				uni.navigateBack({
					delta: 1
				})
			},
			getKefu(){
				this.$u.api.common.getSetting('kefu_link').then(({message}) => {
					this.url = message.value
				})
			}
		}
	}
</script>
<style lang="scss" scoped>
	.back {
		position: fixed;
		left: 20rpx;
		top: 44rpx;
		z-index: 99999;
		color: #fff;
	}
</style>
