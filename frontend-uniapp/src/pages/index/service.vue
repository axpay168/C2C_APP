<template>
	<view class="Body">
		<div class="Site PageBox">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left" @click="back"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
					<div class="van-nav-bar__title van-ellipsis">{{common.home.menu[1]}}</div>
				</div>
			</div>
			<div class="ScrollBox" v-if="list.length > 0">
				<div style="width: 95%; margin-left: 10px;" @click="dumprun('/pages/common/article?id='+list[1].id)">
					<div role="button" tabindex="0"
						class="van-cell van-cell--clickable van-cell--center van-cell--large"><i
							class="van-icon van-cell__left-icon"><img src="../../static/image/news/fund.png"
								class="van-icon__image"><!----></i>
						<div class="van-cell__title"><span>{{list[1].title}}</span></div><i data-v-413fb6f5=""
							class="van-icon van-icon-arrow van-cell__right-icon"><!----></i>
					</div>
				</div>
				<div style="width: 95%; margin-left: 10px;" @click="dumprun('/pages/common/article?id='+list[2].id)">
					<div role="button" tabindex="0"
						class="van-cell van-cell--clickable van-cell--center van-cell--large"><i
							class="van-icon van-cell__left-icon"><img src="../../static/image/news/fund.png"
								class="van-icon__image"><!----></i>
						<div class="van-cell__title"><span>{{list[2].title}}</span></div><i data-v-413fb6f5=""
							class="van-icon van-icon-arrow van-cell__right-icon"><!----></i>
					</div>
				</div>
				<div style="width: 95%; margin-left: 10px;" @click="dumprun('/pages/common/article?id='+list[3].id)">
					<div role="button" tabindex="0"
						class="van-cell van-cell--clickable van-cell--center van-cell--large"><i
							class="van-icon van-cell__left-icon"><img src="../../static/image/news/fund.png"
								class="van-icon__image"><!----></i>
						<div class="van-cell__title"><span>{{list[3].title}}</span></div><i data-v-413fb6f5=""
							class="van-icon van-icon-arrow van-cell__right-icon"><!----></i>
					</div>
				</div>
				<div style="line-height: 45px; color: rgb(204, 204, 204); margin: 10px auto; text-align: center;">
					<div>{{common.common7[0]}}</div><button class="van-button van-button--default van-button--large"
						style="margin: 10px auto; width: 25%; text-align: center; color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;" @click="dumprun('/pages/index/serviceCenter')">
						<div class="van-button__content"><span class="van-button__text"><span
									style="color: rgb(255, 255, 255);">{{common.common7[1]}}</span></span></div>
					</button>
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
				list:[]
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getlist()
		},
		onShow() {
			
		},
		methods: {
			getlist(){
				this.$u.api.index.get_Information().then(res => {
					// console.log(res)
					this.list = res.data 
				})
			},
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
		background-color: #13171a
	}

	.van-cell {
		padding: 17px 0;
		background-color: #191c23
	}

	.van-cell__title {
		color: #e7e7e7
	}
</style>