<template>
	<view class="Body">
		<div class="Site PageBox">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left" @click="back"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
					<div class="van-nav-bar__title van-ellipsis">{{common.hall.default[3]}}</div>
				</div>
			</div>
			<div class="hallswipe van-swipe">
				<div class="van-swipe__track van-swipe__track--vertical">
					<div class="van-swipe-item" style="height: 50px;"><img
							:src="'https://ilvcoin.top/uploads/head/'+rolist.header" class="robotheader">
						<div style="margin-top: -35px; margin-left: 40px;"> {{rolist.username}} {{common.hall.default[9]}}
							{{rolist.amount}}USDT {{rolist.time}}{{common.common5[1]}}{{common.common5[2]}} </div>
					</div>
				</div>
			</div>
			<div class="infoBox" style="line-height: 22px;" v-if="userinfo.bank.length > 0">
				<div style="font-size: 20px; width: 50%;">{{userinfo.username}}</div>
				<div style="display: flex;">
					<div style="width: 40%;">{{common.buy.label[1]}} </div>
					<div>: {{userinfo.bank[0].name}}</div>
				</div>
				<div style="display: flex;">
					<div style="width: 40%;"> {{common.buy.label[0]}}</div>
					<div>: {{userinfo.money}}</div>
				</div>
				<div style="display: flex;">
					<div style="width: 40%;"> {{common.buy.label[2]}} </div>
					<div>: {{userinfo.bank[0].card_no}}</div>
				</div>
			</div>
			<div class="infoBox" v-else>
				<div style="display: flex;" @click="dumprun('/pages/setting/bindAccount')">
					<div style="font-size: 15px; width: 100%;text-align: center;">{{common.bindAccount2[1]}}</div>
				</div>
			</div>
			<div class="ScrollBox">
				<div class="infoBox2">
					<div class="van-cell-group van-hairline--top-bottom">
						<div class="van-cell van-field">
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
							<div class="van-cell van-field">
								<div class="van-cell__title van-field__label"><span>{{common.sell.label[5]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.sell.placeholder[0]"
											class="van-field__control" :value="maijia" v-model="maijia"></div>
								</div>
							</div><button class="van-button van-button--default van-button--min"
								@click="yosji"
								style="width: 120px; height: 25px; padding: 5px; color: rgb(255, 255, 255); background: rgb(240, 184, 13); border-color: rgb(240, 184, 13);">
								<div class="van-button__content"><span
										class="van-button__text"><span
											style="color: rgb(0, 0, 0); font-size: 13px;">{{common.buy.label[7]}}</span></span></div>
							</button>
						</div>
						<div style="display: flex; background-color: rgb(25, 28, 35);">
							<div class="van-cell van-field">
								<div class="van-cell__title van-field__label"><span>{{common.sell.label[6]}}</span></div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body"><input type="text" :placeholder="common.sell.placeholder[1]"
											class="van-field__control" v-model="mainum"></div>
								</div>
							</div><button class="van-button van-button--default van-button--min"
								@click="allin"
								style="width: 90px; height: 25px; color: rgb(255, 255, 255); background: rgb(240, 184, 13); border-color: rgb(240, 184, 13);">
								<div class="van-button__content"><span
										class="van-button__text"><span
											style="color: rgb(0, 0, 0); font-size: 13px;">{{common.sell.label[8]}}</span></span></div>
							</button>
						</div>
					</div>
				</div>
				<div style="text-align: center; margin-top: 10px;" @click="tijiao">
					<p class="btn">{{common.sell.label[9]}}</p>
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
				shijia:'',
				youjia:'',
				maijia:'',
				mainum:'',
				rolist:[],
				userinfo:[],
				secondsInterval:null,
				seconds:15,
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getrobot()
			this.getuserinfo()
		},
		onShow() {
			let that = this
			// uni.request({
			// 	url:'https://www.mycurrency.net/US.json',
			// 	success({data}) {
			// 		const fiat = ["THB","GBP"]
			// 		const rates = data.rates
			// 		let list = []
			// 		fiat.forEach(item => {
			// 			const has = rates.find(el => el.currency_code == item)
			// 			if(has) list.push(has)
			// 		})
			// 		// console.log(list)
			// 		that.shijia = list[0].rate
			// 		that.youjia = list[0].rate + 1.05
			// 		// console.log(this.shijia)
			// 	}
			
			// })
			this.$u.api.index.shoujia().then(res => {
				this.shijia = res.data.shoujia
				this.youjia = res.data.zuiyou
			})
		},
		methods: {
			tijiao(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.tosell(token,this.maijia,this.mainum).then(res => {
					this.$utils.showToast(res.msg)
					setTimeout(() => {
						uni.switchTab({
							url: '/pages/index/hall',
						})
					}, 1000)
				})
			},
			allin(){
				this.mainum = this.userinfo.money
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
	
	.hallswipe {
	    width: 96%;
	    margin-left: 6px;
	    padding: 3px;
	    padding-left: 20px;
	    height: 50px;
	    z-index: 50;
	    margin-top: 3px;
	    margin-bottom: 3px;
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
	    padding: 5px;
	    padding-left: 10px
	}
	
	.infoBox2,.infoBox {
	    width: 95%;
	    margin-left: 10px;
	    background-color: #191c23;
	    color: #e7e7e7;
	    margin-bottom: 5px
	}
	
	.infoBox2 {
	    padding: 5px;
	    padding-left: 0
	}
	
	.panelHeader {
	    border: 1px solid #ccc;
	    border-radius: 5px;
	    color: #ccc;
	    width: 40%;
	    text-align: center;
	    margin-bottom: 10px
	}
	
	.van-cell {
	    background: #191c23;
	    height: 45px
	}
	
	.van-cell .van-cell__title {
	    font-size: 13px;
	    color: #ccc
	}
	
	.van-cell .van-field__control {
	    font-size: 13px
	}
	
	.van-uploader .van-uploader__preview,.van-uploader .van-uploader__preview-image,.van-uploader .van-uploader__upload {
	    margin: 0;
	    background-color: #f7f8fa;
	    border-radius: 8px
	}
	
	.btn {
	    width: 85%;
	    padding: 10px 50px;
	    border-radius: 20px;
	    background-color: #0076fa;
	    color: #000;
	    font-size: 16px;
	    text-align: center;
	    margin: 5px 30px 10px
	}

</style>