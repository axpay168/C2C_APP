<template>
	<view class="Body">
		<div class="Main Site" style="overflow: visible;">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
					<div class="van-nav-bar__title van-ellipsis"></div>
				</div>
			</div>
			<div class="PageBox">
				<div class="van-nav-bar van-nav-bar--fixed">
					<div class="van-nav-bar__content">
						<div class="van-nav-bar__left" @click="back"><i
								class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
						<div class="van-nav-bar__title van-ellipsis">我的訂單</div>
						<div class="van-nav-bar__right" @click="dumprun('/pages/setting/withdrawalCenter')"><i class="van-icon"><img
									src="../../static/image/news/task00.png" class="van-icon__image"><!----></i></div>
					</div>
				</div>
				<div class="bg">
					<div class="panel">
						<div class="van-grid" style="padding-left: 5px;">
							<div class="van-grid-item" style="flex-basis: 50%; padding-right: 5px;">
								<div class="van-grid-item__content van-grid-item__content--center"><button
										data-v-28db3d76="" class="van-button van-button--default van-button--normal"
										style="color: rgb(255, 255, 255); background: rgb(245, 199, 58); border-color: rgb(245, 199, 58);">
										<div class="van-button__content"><span
												class="van-button__text"><span
													style="color: rgb(0, 0, 0);">賣出訂單</span></span></div>
									</button></div>
							</div>
							<div class="van-grid-item" style="flex-basis: 50%; padding-right: 5px;">
								<div class="van-grid-item__content van-grid-item__content--center"><button
										data-v-28db3d76=""
										class="van-button van-button--default van-button--normal van-button--plain"
										style="color: rgb(245, 199, 58); border-color: rgb(245, 199, 58);">
										<div class="van-button__content"><span
												class="van-button__text"><span
													style="color: rgb(0, 0, 0);">買入訂單</span></span></div>
									</button></div>
							</div>
						</div>
						<div role="feed" class="van-list">
							<div class="van-list__placeholder"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
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
				uni.navigateTo({
					url
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
	.Site .van-nav-bar .van-icon {
	    font-size: 1.5rem !important;
	    color: #bbb !important;
	}
	
	.PageBox {
		overflow: auto;
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

	.PageBox .bgc {
		width: 100%;
		height: 46px;
		position: fixed;
		top: 0;
		z-index: 200
	}

	.PageBox .panel {
		width: 95%;
		margin-left: 10px;
		margin-top: 10px;
		background-color: #13171a
	}

	.PageBox .van-grid-item__content {
		padding: 10px !important;
		display: flex;
		color: #ccc;
		background-color: #191c23
	}

	.topTitle {
		position: absolute;
		max-width: 70%;
		font-size: 18px;
		color: #fff;
		background-color: transparent;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 9999;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		display: block
	}

	.PageBox .mytable {
		background-color: #191c23;
		width: 98%;
		margin: 5px auto;
		margin-top: 6px;
		font-size: 18px;
		margin-bottom: 10px
	}

	.PageBox table {
		width: 100%
	}

	.PageBox th:first-child {
		background-color: #b3b5fc;
		font-weight: 600;
		font-size: 13px;
		border: none;
		height: 33px;
		width: 26%
	}

	.PageBox th {
		border-right: 1px solid #fff !important
	}

	.PageBox table tr td {
		font-size: 11px;
		color: #626262;
		padding: 8px 0;
		text-align: center;
		border: none
	}

	table tbody tr:nth-child(odd) {
		background: #eff0f2
	}

	table tbody tr:nth-child(2n) {
		background: #e1e1f9
	}
</style>