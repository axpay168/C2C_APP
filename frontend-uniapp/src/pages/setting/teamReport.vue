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
			<div class="Site PageBox">
				<div class="van-nav-bar van-nav-bar--fixed">
					<div class="van-nav-bar__content">
						<div class="van-nav-bar__left" @click="back"><i
								class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
						<div class="van-nav-bar__title van-ellipsis">{{common.teamReport.default[0]}}</div>
						<div class="van-nav-bar__right">
							<div><button
									class="van-button van-button--default van-button--min"
									  @click="dumprun('/pages/setting/share')" 
									style="width: 100px; height: 26px; color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
									<div class="van-button__content"><span
											class="van-button__text"><span>{{common.common7[5]}}</span></span></div>
								</button></div>
						</div>
					</div>
				</div>
				<div style="display: flex;">
					<div class="Menu2item1">
						<div style="color: rgb(204, 204, 204);">{{common.common7[6]}} </div>
						<div style="color: rgb(231, 231, 231);"> {{list.subordinate_num}} </div>
					</div>
					<!-- <div class="Menu2item1">
						<div style="color: rgb(204, 204, 204);">{{common.common7[7]}} </div>
						<div style="color: rgb(231, 231, 231);"> {{list.subordinate_num}} </div>
					</div> -->
				</div>
				<div class="ScrollBox" style="color: rgb(204, 204, 204);">
					<div style="color: rgb(255, 255, 255); margin: 20px auto 20px 20px;" v-for="item in list.list">
						{{item.id}} - {{item.username}}
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
				const token = uni.getStorageSync('token')
				this.$u.api.index.team_list(token).then(res => {
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

	.Menu2item1 {
		margin-top: 10px;
		background-color: #191c23;
		line-height: 25px;
		margin-left: 10px;
		width: 48%;
		text-align: center;
		padding: 10px
	}

	.ScrollBox {
		background-color: #13171a
	}
</style>