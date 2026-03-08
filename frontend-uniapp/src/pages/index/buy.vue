<template>
	<view class="Body">
		<div class="Site PageBox">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left" @click="back"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i></div>
					<div class="van-nav-bar__title van-ellipsis">{{common.hall.default[2]}}</div>
				</div>
			</div>
			<div class="hallswipe van-swipe" style="display: none;">
				<div class="van-swipe__track van-swipe__track--vertical">
					<div class="van-swipe-item" style="height: 50px;"><img
							:src="'https://ilvcoin.top/uploads/head/'+rolist.header" class="robotheader">
						<div style="margin-top: -35px; margin-left: 40px;"> {{rolist.username}} {{common.hall.default[9]}}
							{{rolist.amount}}USDT {{rolist.time}}{{common.common5[1]}}{{common.common5[2]}} </div>
					</div>
				</div>
			</div>
			<div style="margin-top: 20px;display: none;" class="infoBox" v-if="userinfo.bank.length > 0">
				<div style="display: flex;">
					<div style="font-size: 15px; width: 50%;">{{userinfo.username}}</div>
					<div>{{common.buy.label[1]}} :{{userinfo.bank[0].name}}</div>
				</div>
				<div style="display: flex;">
					<div style="font-size: 15px; width: 50%;"> {{common.buy.label[0]}}:{{userinfo.money}}</div>
					<div>{{common.buy.label[2]}} :{{userinfo.bank[0].card_no}}</div>
				</div>
			</div>
			<div style="margin-top: 20px;display: none;" class="infoBox" v-else>
				<div style="display: flex;" @click="dumprun('/pages/setting/bindAccount')">
					<div style="font-size: 15px; width: 100%;text-align: center;">{{common.bindAccount2[1]}}</div>
				</div>
			</div>
			<div class="ScrollBox" style="margin-top: 20px;">
				<div class="infoBox">
					<div class="van-cell-group van-hairline--top-bottom">
						<div class="van-cell van-field">
							<div class="van-cell__title van-field__label"><span>{{common.sell.label[0]}}</span></div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body"><input type="text" readonly="readonly"
										:value="userinfo.money" class="van-field__control"></div>
							</div>
						</div>
						
						<div style="display: flex;background-color: rgb(25, 28, 35);">
							<div
								class="input van-cell van-cell--borderless van-field">
								<div class="van-cell__title van-field__label"><span>{{common.buy.label[1]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" readonly="readonly"
											:value="daojishi" class="van-field__control"></div>
								</div>
							</div>
						</div>
						
						<div style="display: flex;background-color: rgb(25, 28, 35);">
							<div
								class="input van-cell van-cell--borderless van-field">
								<div class="van-cell__title van-field__label"><span>{{common.buy.label[2]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" readonly="readonly"
											:value="xtype" class="van-field__control"></div>
								</div>
							</div>
						</div>
						
						<div class="van-cell van-field" style="height: 60px;">
							<div class="van-cell__title van-field__label"><span>{{common.buy.label[3]}}</span></div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body"><input type="text" readonly="readonly"
										:value="shijia" v-model="shijia" class="van-field__control"></div>
							</div>
						</div>
						<div class="van-cell van-field">
							<div class="van-cell__title van-field__label"><span>{{common.buy.label[4]}}</span></div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body"><input type="text" readonly="readonly"
										:value="youjia" v-model="youjia" class="van-field__control"></div>
							</div>
						</div>
						<div style="display: flex; background-color: rgb(25, 28, 35);">
							<div
								class="input van-cell van-cell--required van-cell--borderless van-field">
								<div class="van-cell__title van-field__label"><span>{{common.buy.label[5]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.buy.placeholder[0]"
											class="van-field__control" :value="maijia" v-model="maijia"></div>
								</div>
							</div><button class="van-button van-button--default van-button--min"
								@click="yosji"
								style="width: 140px; color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
								<div class="van-button__content"><span
										class="van-button__text"><span
											style="color: rgb(255, 255, 255); font-size: 13px;">{{common.buy.label[7]}}</span></span></div>
							</button>
						</div>
						<div style="display: flex;background-color: rgb(25, 28, 35);">
							<div
								class="input van-cell van-cell--required van-cell--borderless van-field">
								<div class="van-cell__title van-field__label"><span>{{common.buy.label[6]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.buy.placeholder[1]"
											class="van-field__control" v-model="buynum"></div>
								</div>
							</div>
						</div>
						<div style="display: none;background-color: rgb(25, 28, 35);">
							<div class="input van-cell van-cell--borderless van-field">
								<div class="van-cell__title van-field__label"><span>{{common.buy3[7]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.buy3[8]"
											class="van-field__control" v-model="zuid"></div>
								</div>
							</div>
						</div>
						<div style="display: flex; background-color: rgb(37, 45, 48);">
							<div class="van-cell van-cell--required van-field">
								<div class="van-cell__title van-field__label"><span>{{common.buy.label[10]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.buy.placeholder[2]"
											class="van-field__control" v-model="mine"></div>
								</div>
							</div>
							<div class="van-cell van-cell--required van-field">
								<div class="van-cell__value van-cell__value--alone van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.buy.placeholder[3]"
											class="van-field__control" v-model="maxe"></div>
								</div>
							</div>
						</div>
					</div>
				</div><button type="button"
					@click="tijiao"
					class="van-button van-button--default van-button--large van-button--round"
					style="margin-left: 40px; width: 75%; height: 30px; color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
					<div class="van-button__content"><span
							class="van-button__text">{{common.buy.label[9]}}</span></div>
				</button>
			</div>
		</div>
		
		<u-popup v-model="isshow" mode="bottom" length="66%" contentBackgroundColor="white" :mask="mask">
			<view class="popup-list mianji">
				<view class="popup-list-item" @click="setdaoji('2'+common.buy3[1])">
					<text>2{{common.buy3[1]}}</text>
				</view>
				<view class="popup-list-item" @click="setdaoji('6'+common.buy3[1])">
					<text>6{{common.buy3[1]}}</text>
				</view>
				<view class="popup-list-item" @click="setdaoji('12'+common.buy3[1])">
					<text>12{{common.buy3[1]}}</text>
				</view>
				<view class="popup-list-item" @click="setdaoji('24'+common.buy3[1])">
					<text>24{{common.buy3[1]}}</text>
				</view>
				<view class="popup-list-item" @click="setdaoji('72'+common.buy3[1])">
					<text>72{{common.buy3[1]}}</text>
				</view>
				<view class="popup-list-item" @click="setdaoji('500'+common.buy3[1])">
					<text>500{{common.buy3[1]}}</text>
				</view>
			</view>
		</u-popup>
		<u-popup v-model="isshows" mode="bottom" length="66%" contentBackgroundColor="white" :mask="mask">
			<view class="popup-list mianji">
				<view class="popup-list-item" @click="setxttype(common.buy3[3])">
					<text>{{common.buy3[3]}}</text>
				</view>
				<view class="popup-list-item" @click="setxttype(common.buy3[4])">
					<text>{{common.buy3[4]}}</text>
				</view>
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
				rolist:[],
				secondsInterval:null,
				seconds:15,
				userinfo:[],
				mask:true,
				shijia:'',
				youjia:'',
				maijia:'',
				buynum:'',
				daojishi:'',
				xtype:'',
				zuid:'',
				mine:'',
				maxe:'',
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getrobot()
			// this.daojishi = '2'+this.common.buy3[1]
			// this.xtype = this.common.buy3[3]
			let that = this
			this.$u.api.index.shoujia().then(res => {
				that.shijia = res.data.shoujia
				that.youjia = res.data.zuiyou
			})
		},
		onShow() {
			this.getuserinfo()
		},
		methods: {
			tijiao(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.tobuy(token,this.maijia,this.buynum,this.daojishi,this.xtype,this.zuid,this.mine,this.maxe).then(res => {
					this.$utils.showToast(res.msg)
					setTimeout(() => {
						uni.switchTab({
							url: '/pages/index/hall',
						})
					}, 1000)
				})
			},
			setdaoji(data){
				this.daojishi = data
				this.isshow = false
			},
			setxttype(data){
				this.xtype = data
				this.isshows = false
			},
			yosji(){
				this.maijia = this.youjia
			},
			getuserinfo(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data
				})
			},
			getrobot(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.robot(token).then(res => {
					// console.log(res)
					this.rolist = res.data[0]
					this.secondsInterval = setInterval(() => {
						this.seconds = this.seconds - 1
						if (this.seconds == 0) {
							this.seconds = 15
							this.rolist = res.data[this.seconds]
						}else{
							this.rolist = res.data[this.seconds]
						}
					}, 3000)
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

<style lang="scss" scoped>
	.popup-list {
		.popup-list-item {
			height: 96rpx;
			line-height: 96rpx;
			padding: 0 30rpx;
			font-size: 32rpx;
			position: relative;
			display: flex;
			align-items: center;
	
			&:before {
				content: "";
				position: absolute;
				left: 30rpx;
				right: 30rpx;
				bottom: 0;
				height: 2rpx;
				background-color: #efefef;
			}
	
			&.active {
				background-color: #f2f6ff;
	
				&:after {
					content: "";
					width: 36rpx;
					height: 20rpx;
					background-image: url('/static/image/icon/setting-icon-20.png');
					background-size: cover;
					position: absolute;
					right: 80rpx;
					top: 50%;
					margin-top: -10rpx;
				}
			}
		}
	}
	.ScrollBox {
	    padding: 0 !important;
	}
	
	.PageBox {
	    overflow: auto;
	    padding-top: 40px;
	    background-color: #121617
	}
	
	.PageBox .van-nav-bar {
	    background: #252d30
	}
	
	.van-nav-bar .van-nav-bar__title {
	    color: #fff
	}
	
	.van-cell {
	    background: #252d30
	}
	
	.van-cell.input .van-field__control {
	    border-bottom: 1px solid
	}
	
	.van-cell .van-cell__title {
	    font-size: 14px
	}
	
	.van-uploader .van-uploader__preview,.van-uploader .van-uploader__preview-image,.van-uploader .van-uploader__upload {
	    margin: 0;
	    background-color: #f7f8fa;
	    border-radius: 8px
	}
	
	.Site .van-nav-bar .van-icon {
	    font-size: 1.5rem !important;
	    color: #bbb !important;
	}
	
	.van-cell--borderless.input {
	    margin-top: 0 !important;
	    margin-left: 0 !important;
	}
	
	.panelHeader {
	    margin-top: 0;
	    border: 1px solid #ccc;
	    border-radius: 5px;
	    color: #ccc;
	    width: 40%;
	    text-align: center;
	    margin-bottom: 10px
	}
	
	.van-cell {
	    background: #191c23;
	    height: 40px
	}
	
	.hallswipe {
	    width: 96%;
	    margin-left: 6px;
	    padding: 15px;
	    height: 50px;
	    z-index: 50;
	    margin-top: 0;
	    margin-bottom: 5px;
	    color: #ccc;
	    background-color: #191c23
	}
	
	.robotheader {
	    font-size: 19px;
	    border-radius: 50%;
	    background: pink;
	    overflow: hidden;
	    width: 32px;
	    height: 32px
	}
	
	.infoBox {
	    width: 95%;
	    margin-left: 10px;
	    background-color: #191c23;
	    padding: 10px;
	    color: #e7e7e7;
	    margin-bottom: 5px
	}
	
	.btn {
	    width: 80%;
	    padding: 10px 30px;
	    border-radius: 6px;
	    background-color: #252d30;
	    color: #fff;
	    text-align: center;
	    margin: 41px 20px 70px 30px
	}

</style>