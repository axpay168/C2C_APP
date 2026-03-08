<template>
	<view class="Body">
		<view class="Site PageBox">
			<view class="van-nav-bar van-nav-bar--fixed">
				<view class="van-nav-bar__content">
					<view class="van-nav-bar__left" @click="back"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i></view>
					<view class="van-nav-bar__title van-ellipsis">{{common.common7[1]}}</view>
				</view>
			</view>

			<view class="ScrollBox">

				<button @click="dumprun(1)" class="van-button"
					style="display: block;margin: 10px; height: 85px; color: rgb(255, 255, 255); background: rgb(25, 28, 35); border-color: rgb(25, 28, 35);">

					<view
						class="van-grid-item__content van-grid-item__content--horizontal van-grid-item__content--center">
						<view style="display: flex;"><img src="../../static/image/news/customer.png"
								style="height: 3rem;">
							<view style="width: 170px; line-height: 3rem; margin-right: 30px;">
								{{common.common2[3]}}
							</view>

							<view class="" style="height: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;">

								<view class="" style="background: rgb(0, 118, 250);
    border-color: rgb(0, 118, 250);
    border-radius: .2225rem;">
									<view style="color: rgb(255, 255, 255);padding: 1px 3px;">{{common.common7[2]}}
									</view>
								</view>

							</view>

						</view>
					</view>

				</button>

				<!-- <button
						@click="dumprun(2)"
						class="van-button van-button--default van-button--large"
						style="margin: 10px; height: 85px; display: flex; color: rgb(255, 255, 255); background: rgb(25, 28, 35); border-color: rgb(25, 28, 35);">
						<view class="van-button__content"><view class="van-button__text">
								<view class="van-grid" style="padding-left: 5px;">
									<view class="van-grid-item" style="flex-basis: 100%; padding-right: 5px;">
										<view class="van-grid-item__content van-grid-item__content--horizontal van-grid-item__content--center">
											<view style="display: flex;"><img src="../../static/image/news/customer.png"
													style="height: 3rem;">
												<view style="width: 170px; line-height: 45px; margin-right: 30px;">TELEGRAM</view>
												<button class="van-button van-button--default van-button--large"
													style="width: 130px; text-align: right; height: 25px; color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
													<view class="van-button__content"><view class="van-button__text"><view
																style="color: rgb(255, 255, 255);">{{common.common7[2]}}</view></view></view>
												</button>
											</view>
										</view>
									</view>
								</view>
							</view></view>
					</button> -->

				<!-- <button
						@click="dumprun(3)"
						class="van-button van-button--default van-button--large"
						style="margin: 10px; height: 85px; display: flex; color: rgb(255, 255, 255); background: rgb(25, 28, 35); border-color: rgb(25, 28, 35);">
						<view class="van-button__content"><view class="van-button__text">
								<view class="van-grid" style="padding-left: 5px;">
									<view class="van-grid-item" style="flex-basis: 100%; padding-right: 5px;">
										<view class="van-grid-item__content van-grid-item__content--horizontal van-grid-item__content--center">
											<view style="display: flex;"><img src="../../static/image/news/customer.png"
													style="height: 3rem;">
												<view style="width: 170px; line-height: 45px; margin-right: 30px;">ZALO</view>
												<button class="van-button van-button--default van-button--large"
													style="width: 130px; text-align: right; height: 25px; color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
													<view class="van-button__content"><view class="van-button__text"><view
																style="color: rgb(255, 255, 255);">{{common.common7[2]}}</view></view></view>
												</button>
											</view>
										</view>
									</view>
								</view>
							</view></view>
					</button> -->
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				isshow: false,
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id

		},
		onShow() {

		},
		methods: {
			back() {
				const pages = getCurrentPages();
				if (pages.length === 2) {
					uni.navigateBack({
						delta: 1
					});
				} else if (pages.length === 1) {
					uni.switchTab({
						url: '/pages/index/index',
					})
				} else {
					uni.navigateBack({
						delta: 1
					});
				}
			},
			dumprun(url) {
				this.$u.api.index.getkf().then(res => {
					if (url == 1) {
						window.location.href = res.data.kefu
					} else if (url == 2) {
						window.location.href = res.data.telegram
					} else {
						window.location.href = res.data.zalo
					}
				})
			},
		},
		computed: {
			common() {
				return this.$t("common")
			},
		}
	}
</script>

<style>
	.ScrollBox {
		padding: 0 !important;
	}

	.Site .van-nav-bar .van-icon {
		font-size: 1.5rem !important;
		color: #bbb !important;
	}

	.PageBox {
		color: #635327;
		padding-top: 40px;
		background-color: #13171a
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-nav-bar .van-nav-bar__title {
		color: #ccc;
		font-weight: 700
	}

	.ScrollBox {
		width: 100%;
		height: 100%;
		background-color: #13171a
	}

	.ScrollBox .van-grid-item__content {
		/* padding: 10px !important;
		display: flex;
		color: #ccc; */
		background-color: #191c23
	}

	.QRCode {
		margin-left: 10px;
		height: 230px
	}
</style>