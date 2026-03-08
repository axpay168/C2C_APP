<template>
	<view class="Body">
		<div class="Main Site" style="overflow: visible;">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i></div>
					<div class="van-nav-bar__title van-ellipsis"></div>
				</div>
			</div>
			<div class="PageBox">
				<div class="van-nav-bar van-nav-bar--fixed">
					<div class="van-nav-bar__content">
						<div class="van-nav-bar__left" @click="back"><i
								class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i></div>
						<div class="van-nav-bar__title van-ellipsis">{{common.wallet.default[2]}}</div>
						<!-- <div class="van-nav-bar__right" @click="dumprun('/pages/setting/withdrawlist')"><i class="van-icon"><img
									src="../../static/image/news/task01.png" class="van-icon__image"></i></div> -->
					</div>
				</div>
			
				<div class="box">
					<div>
				
						<div class="van-cell van-field">
							<div class="van-cell__title van-field__label" style="width:5em"><span>
							<img :src="(typeof window!=='undefined'&&window.location?window.location.origin:'https://mxtrx.top')+'/static/Euro.png'" style="width: 30;"/>
							</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2" style="position: relative;">
									<input type="text"
										placeholder="enter withdrawal amount" class="van-field__control" style="max-width: 80%;" v-model="jine">
									<span style="position: absolute;right: 10px;top: 5px;">	EUR</span>
										</div>
							</div>
						</div>
						<div class="van-cell van-field">
							<div class="van-cell__title van-field__label"><span>
							<img :src="(typeof window!=='undefined'&&window.location?window.location.origin:'https://mxtrx.top')+'/static/USDT.png'" style="width: 30;"/>
							</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2" style="position: relative;">
									<input type="text"
										class="van-field__control" style="max-width: 80%;" v-model="jine*1.043">
									<span style="position: absolute;right: 10px;top: 5px;">	USDT</span>
										</div>
							</div>
						</div>
					
						
						<div class="van-cell van-field" >
							<div class="van-cell__title van-field__label" style="width:10em"><span>Exchange rate</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2">
									1EUR=1.043
								</div>
							</div>
							
						</div>
						<div class="van-cell van-field" >
							<div class="van-cell__title van-field__label" style="width:10em"><span>Reverse exchange rate</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2">
									1USDT=0.9588
								</div>
							</div>
							
						</div>
						
						<div class="van-cell van-field" >
							<div class="van-cell__title van-field__label" style="width:10em"><span>Transaction Fees</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2">
									1%
								</div>
							</div>
							
						</div>
						
						<div class="van-cell van-field" >
							<div class="van-cell__title van-field__label" style="width:10em"><span>You will recive</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2">
									{{(jine*1.043-jine*1.043*0.01).toFixed(2)}} USDT
								</div>
							</div>
							
						</div>
						
						<div class="van-cell van-field" >
							<div class="van-cell__title van-field__label" style="width:10em"><span>USDT address </span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2">
								<input type="text"
									placeholder="" class="van-field__control" style="max-width: 80%;" v-model="usdtaddress">
								</div>
							</div>
							
						</div>
					</div>
				</div>
			
				<div style="text-align: center; margin-top: 100px;" @click="tijiao">
					<p class="btn">confirm</p>
				</div>
			</div>
		</div>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				type:1,
			
				isshow: false,
				userinfo: [],
				bank_name: '123213',
				name: '',
				card_no: '',
				bank_deposit: '',
				jine: '',
				jine2:'',
				bili: '',
				moneytype:'CHN',
				lang:'eng',
				mobile:'',
				reciveusdt:0,
				Fees:0.01,
				balance_revered:0,
				usdtaddress:''
				
			};
		},
		onLoad(options) {
			// const {
			// 	id
			// } = options
			// this.id = id
			this.moneytype = options.moneytype || 'CHN';
			console.log(this.moneytype);
			this.lang = this.$store.state.lang || 'eng';
			this.$u.api.index.shoujia().then(res => {
				this.bili = res.data.shoujia
			})
		},
		onShow() {
			this.getuserinfo()
		},
		methods: {
			txStyle(){
			this.usdt=true;	
			},
			//体现
			tijiao() {
				
				const token = uni.getStorageSync('token');
			
				var param = {
					'token':token,
					'usdtaddress':this.usdtaddress,
					'money':this.jine,
					'type':2,
					'bank_id':this.userinfo.bank[0].id,
					'lang':this.$store.state.lang || 'eng'
				};
			if(Number(this.jine)>Number(this.balance_revered)){
				this.$utils.showToast('Insufficient balance')
				return false;
			}
			if(!this.usdtaddress){
				this.$utils.showToast('please enter usdt address')
				return false;
			}
				const apiBase = (typeof window !== 'undefined' && window.location ? window.location.origin : 'https://mxtrx.top') + '/index.php/api';
				uni.request({
				    url: apiBase + '/user/apply_withdrawal2',
					// method:'POST',
				    data: param,
				    header: {
						'authorization':token,
						'token':token,
				    },
				    success: (res) => {
				        console.log(res.data);
						this.$utils.showToast(res.data.msg)
				        // this.text = 'request success';
						setTimeout(() => {
							this.back()
						}, 1000)
				    }
				});
				
				// console.log(this.mobile);
				
				// const token = uni.getStorageSync('token')
				// this.$u.api.index.apply_withdrawal(token,this.mobile,this.jine, this.userinfo.bank[0].id).then(res => {
				// 	this.$utils.showToast('success')
				// 	setTimeout(() => {
				// 		this.back()
				// 	}, 1000)
				// })
				
			
				
			},
			allin() {
				this.jine = this.userinfo.balance_revered
			},
			getuserinfo() {
				const token = uni.getStorageSync('token');
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data;
					console.log(this.userinfo)
					if (res.data.bank.length == 0) {
						this.dumprun('/pages/setting/bindAccount')
					} else {
						this.bank_name = res.data.bank[0].bank_name
						this.name = res.data.bank[0].name
						
						this.card_no = res.data.bank[0].card_no
						this.bank_deposit = res.data.bank[0].bank_deposit
						this.balance_revered=res.data.balance_revered;
					}
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
	.PageBox {
		color: #635327;
		padding-top: 40px;
		background-color: #13171a
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-nav-bar .van-nav-bar__arrow,
	.van-nav-bar .van-nav-bar__title {
		color: #ccc
	}

	.PageBox .van-cell {
		background-color: #191c23
	}

	.PageBox .van-cell .van-cell__title {
		font-size: 15px;
		font-weight: 700;
		color: #ccc
	}

	.PageBox .box {
		width: 95%;
		padding: 10px 0 10px 10px;
		font-size: 16px;
		margin-top: 5px;
		border-radius: 10px;
		margin-left: 10px;
		background-color: #191c23;
		color: #555
	}

	p {
		width: 80px
	}

	.btn {
		width: 85%;
		padding: 10px 50px;
		border-radius: 20px;
		background-color: #0076fa;
		color: #000;
		font-size: 18px;
		text-align: center;
		margin: 15px 30px 30px
	}
	
	.van-field__body2{
		
	}
	
</style>