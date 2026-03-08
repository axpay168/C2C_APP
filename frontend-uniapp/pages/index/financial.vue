<template>
	<view class="arbitrage">
		<u-navbar :title="common.home3[3]"></u-navbar>
		<view class="product_list">
			<view class="pro_title ff_NunitoBold">
				<button style="margin-top: 10px;" @click="zhuanh(1)">USD -> USDT</button>
				<button style="margin-top: 10px;" @click="zhuanh(2)">EUR -> USD</button>
				<button style="margin-top: 10px;" @click="dumprun('/pages/setting/mufind')">tài chính của tôi</button>
			</view>
			<view class="list_content">
				<view class="pro_item" v-for="item in list" @click="gomai(item.id)">
					<view class="item_name ff_NunitoSemiBold">
						<span class="days">{{item.minmon}} - {{item.maxmon}}{{common.hall3[0]}}</span>
						<span class="name">{{item.jiangjin}} USD/{{common.hall3[0]}} + {{item.fenbi}}%</span>
					</view>
					<view class="item_value">
						<view class="value_item">
							<view class="fs-32 fc-353F52 ff_NunitoSemiBold">
								{{common.common6[2]}}
							</view>
							<view class="fc-5B616E mt-24 ff_InterMedium">
								${{item.minday}}-{{item.maxday}}
							</view>
						</view>
					</view>
				</view>
			</view>
		</view>
		<u-popup v-model="isshow" mode="bottom" length="66%" contentBackgroundColor="#999">
			<view class="popup-list">
				<div role="button" tabindex="0"
					class="van-cell van-cell--clickable van-cell--center van-cell--large">
					<div class="van-cell__title"><span>{{common.common6[2]}}</span></div>
					<div class="van-cell van-field" style="width: 150px;">
						<div class="van-cell__value van-cell__value--alone van-field__value">
							<div class="van-field__body"><input type="text" :placeholder="common.common6[2]"
									class="van-field__control" :value="password" v-model="password"></div>
						</div>
					</div>
				</div>
				<div role="button" tabindex="0"
					class="van-cell van-cell--clickable van-cell--center van-cell--large">
					<div class="van-cell__title"><span>{{common.hall3[0]}}</span></div>
					<div class="van-cell van-field" style="width: 150px;">
						<div class="van-cell__value van-cell__value--alone van-field__value">
							<div class="van-field__body"><input type="text" :placeholder="common.hall3[0]"
									class="van-field__control" :value="nickname" v-model="nickname"></div>
						</div>
					</div>
				</div>
				<div style="text-align: center; margin-top: 20px;" @click="gaimi">
					<p class="btn">{{common.userInfo.default[12]}}</p>
				</div>
			</view>
		</u-popup>
		
		<u-popup v-model="isshows" mode="bottom" length="66%" contentBackgroundColor="#999">
			<view class="popup-list">
				<view>
					<text style="height: 50px;line-height: 50px;display: block;text-align: center;">EUR:{{userinfo.balance_revered}}</text>
					<text style="height: 50px;line-height: 50px;display: block;text-align: center;">USDT:{{userinfo.money}}</text>
					<text style="height: 50px;line-height: 50px;display: block;text-align: center;">USD:{{userinfo.moneys}}</text>
				</view>
				<div role="button" tabindex="0"
					class="van-cell van-cell--clickable van-cell--center van-cell--large">
					<div class="van-cell__title"><span>{{common.common6[2]}}</span></div>
					<div class="van-cell van-field" style="width: 150px;">
						<div class="van-cell__value van-cell__value--alone van-field__value">
							<div class="van-field__body"><input type="text" :placeholder="common.common6[2]"
									class="van-field__control" :value="hhunye" v-model="hhunye"></div>
						</div>
					</div>
				</div>
				<div v-if="type == 2" role="button" tabindex="0"class="van-cell van-cell--clickable van-cell--center van-cell--large">
					<div class="van-cell__title"><span>USD:{{(hhunye / bili).toFixed(2)}}</span></div>
				</div>
				<div v-else role="button" tabindex="0"class="van-cell van-cell--clickable van-cell--center van-cell--large">
					<div class="van-cell__title"><span>USDT:{{hhunye}}</span></div>
				</div>
				<div style="text-align: center; margin-top: 20px;" @click="huanaz">
					<p class="btn">{{common.userInfo.default[12]}}</p>
				</div>
			</view>
		</u-popup>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				isshow: false,
				isshows: false,
				type:1,
				userinfo:[],
				list:[],
				bili:'',
				hhunye:'',
				nickname:'',
				maiid:'',
				password:''
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getlist()
			this.getuserinfo()
			this.$u.api.index.shoujia().then(res => {
				this.bili = res.data.licai
			})
		},
		onShow() {
	
		},
		methods: {
			getuserinfo(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data
				})
			},
			huanaz(){
				const token = uni.getStorageSync('token')
				if(this.type == 1){
					let jine = this.hhunye
					this.$u.api.index.utovnd(token,this.hhunye,jine,this.type).then(res => {
						this.$utils.showToast('success')
						this.isshows = false
						this.getuserinfo()
					})
				}else{
					let jine = (this.hhunye / this.bili).toFixed(2)
					this.$u.api.index.utovnd(token,this.hhunye,jine,this.type).then(res => {
						this.$utils.showToast('success')
						this.isshows = false
						this.getuserinfo()
					})
				}
			},
			zhuanh(type){
				this.type = type
				this.isshows = true
			},
			gaimi(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.setfina(token,this.maiid,this.password,this.nickname).then(res => {
					this.$utils.showToast('success')
					this.isshow = false
				})
			},
			gomai(id){
				this.maiid = id
				this.isshow = true
			},
			getlist(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.getfina(token).then(res => {
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
	.arbitrage .product_list {
		margin-top: 0;
		padding: 0 32rpx
	}
	
	.arbitrage .product_list .pro_title {
		font-size: 40rpx;
		color: #000
	}
	
	.arbitrage .product_list .list_content .pro_item {
		margin-top: 40rpx;
		background: #fff;
		box-shadow: 6px 12px 20px 0 rgba(0, 0, 0, .1);
		border-radius: 15rpx
	}
	
	.arbitrage .product_list .list_content .pro_item .item_name {
		padding: 32rpx 40rpx;
		border-bottom: 1px solid hsla(0, 0%, 84.7%, .5)
	}
	
	.arbitrage .product_list .list_content .pro_item .item_name .days {
		display: inline-block;
		padding: 0 24rpx;
		height: 56rpx;
		line-height: 56rpx;
		background: linear-gradient(90deg, #318af9, #1652f0);
		box-shadow: 2px 2px 10px 4px rgba(22, 82, 240, .25);
		border-radius: 10rpx;
		color: #fff
	}
	
	.arbitrage .product_list .list_content .pro_item .item_name .name {
		margin-left: 40rpx;
		font-size: 40rpx;
		color: #5f6775
	}
	
	.arbitrage .product_list .list_content .pro_item .item_value {
		padding: 32rpx 0;
		display: flex;
		text-align: center
	}
	
	.arbitrage .product_list .list_content .pro_item .item_value .value_item {
		width: 100%
	}
	
	.arbitrage .product_list .list_content .pro_item .item_types {
		margin-top: 16rpx;
		padding: 0 40rpx 42rpx 42rpx
	}
	
	.arbitrage .product_list .list_content .pro_item .item_types .types_action {
		margin-top: 10rpx;
		display: flex;
		justify-content: space-between;
		align-content: center;
		align-items: center
	}
	
	.arbitrage .product_list .list_content .pro_item .item_types .types_action .types {
		display: flex;
		align-content: center;
		align-items: center
	}
	
	.arbitrage .product_list .list_content .pro_item .item_types .types_action .types .coin_icon {
		margin-right: 24rpx;
		width: 40rpx;
		height: 40rpx;
	}
	
	.arbitrage .product_list .list_content .pro_item .item_types .types_action .actions .icon_go {
		width: 60rpx;
		height: 60rpx;
	}
</style>