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
				<div
					style="background-color: rgb(25, 28, 35); color: rgb(231, 231, 231); padding: 10px; font-size: 15px;">
					<div style="display: flex; margin-left: 15px;"><i class="van-icon" style="font-size: 22px;"><img src="../../static/image/news/b2.png" class="van-icon__image"></i>
						
						<!-- // 中国 - China (chn)
						// 日本 - Japan (jpn)
						// 韩国 - South Korea (kor)
						// 英语 - English (eng)
						// 泰国 - Thailand (tha)
						// 越南 - Vietnam (vnm)
						// 新加坡 - Singapore (sgp)
						// 香港 - Hong Kong (hkg)
						// 法国 - France (fra)
						// 德国 - Germany (ger)
						// 俄罗斯 - Russia (rus)
						// 印度 - India (ind)
						// 马来西亚 - Malaysia (mys)
						// 意大利 - Italy (ita)
						// 欧洲 - Europe (eur) -->
					
						<div style="margin-left: 5px;" v-if="moneytype == 'chn'"> {{common.wallet.default[9]}}(CHN) : {{userinfo['money']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'jpn'"> {{common.wallet.default[9]}}(JPY) : {{userinfo['jpn']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'kor'"> {{common.wallet.default[9]}}(KRW) : {{userinfo['jpn']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'eng'"> {{common.wallet.default[9]}}(GBP) : {{userinfo['eng']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'tha'"> {{common.wallet.default[9]}}(THB) : {{userinfo['tha']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'vnm'"> {{common.wallet.default[9]}}(VND) : {{userinfo['vnm']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'sgp'"> {{common.wallet.default[9]}}(HKD) : {{userinfo['sgp']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'hkg'"> {{common.wallet.default[9]}}(HKD) : {{userinfo['hkg']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'fra'"> {{common.wallet.default[9]}}(EUR) : {{userinfo['fra']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'ger'"> {{common.wallet.default[9]}}(EUR) : {{userinfo['ger']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'rus'"> {{common.wallet.default[9]}}(RUB) : {{userinfo['rus']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'ind'"> {{common.wallet.default[9]}}(INR) : {{userinfo['ind']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'mys'"> {{common.wallet.default[9]}}(MYR) : {{userinfo['mys']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'ita'"> {{common.wallet.default[9]}}(EUR) : {{userinfo['ita']}}</div>
						
						<div style="margin-left: 5px;" v-if="moneytype == 'eur'"> {{common.wallet.default[9]}}(EUR) : {{userinfo['balance_revered']}}</div>
						
						<!-- // 马来西亚 - Malaysia (mys)
						// 意大利 - Italy (ita)
						// 欧洲 - Europe (eur) --> 
						
						<!-- <div style="margin-left: 5px;" v-else-if="lang == 'eur'"> {{common.wallet.default[9]}}(EUR) : {{userinfo['balance_revered']}}</div>
						
						<div style="margin-left: 5px;" v-else> {{common.wallet.default[9]}}({{moneytype}}) : {{userinfo[lang]}}</div> -->
					</div>
					<!-- <div style="margin-left: 25px; margin-top: 10px;"> {{userinfo.balance_revered}} </div> -->
				</div>
				<div class="box">
					<div>
						<!-- <div class="van-cell van-field" style="display: none;">
							<div class="van-cell__title van-field__label"><span>{{common.bindAccount.fields[3]}}</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2"><input type="text"
										:placeholder="common.bindAccount.placeholder[3]" class="van-field__control"
										:value="bank_name" v-model="bank_name"></div>
							</div>
						</div>
						<div class="van-cell van-field" style="display: none;">
							<div class="van-cell__title van-field__label"><span>{{common.bindAccount.fields[0]}}</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2"><input type="text"
										:placeholder="common.bindAccount.placeholder[0]" class="van-field__control"
										:value="name" v-model="name"></div>
							</div>
						</div>
						<div class="van-cell van-field" style="display: none;">
							<div class="van-cell__title van-field__label"><span>{{common.bindAccount.fields[2]}}</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2"><input type="text"
										:placeholder="common.bindAccount.placeholder[2]" class="van-field__control"
										:value="card_no" v-model="card_no"></div>
							</div>
						</div> -->
						<div class="van-cell van-field">
							<div class="van-cell__title van-field__label"><span>{{common.bindAccount.fields[1]}}</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2"><input type="text"
										:placeholder="common.bindAccount.placeholder[1]" class="van-field__control" v-model="mobile"></div>
							</div>
						</div>
						<div style="display: flex; background-color: rgb(25, 28, 35);align-items: center;">
							<div class="van-cell van-field">
								<div class="van-cell__title van-field__label"><span>{{common.wallet.label[1]}}</span>
								</div>
								<div class="van-cell__value van-field__value">
									<div class="van-field__body2"><input type="text"
											:placeholder="common.wallet.placeholder[1]" class="van-field__control"
											v-model="jine"></div>
								</div>
							</div><button class="van-button van-button--default van-button--min" @click="allin"
								style="width: 100px; height: 30px; color: rgb(255, 255, 255); background: rgb(240, 184, 13); border-color: rgb(240, 184, 13);">
								<div class="van-button__content"><span class="van-button__text"><span
											style="color: rgb(0, 0, 0);">{{common.task.tabs[0]}}</span></span></div>
							</button>
						</div>
						
						<div class="van-cell van-field"  style="display: none;">
							<div class="van-cell__title van-field__label"><span>{{common.txfs}}</span>
							</div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2">
									
									<select class="van-field__control" v-model="type">
										<option selected value='1'>{{common.yhk}}</option>
										<option value='2'>USDT</option>
									</select>
								</div>
							</div>
							
						</div>
						
						
					</div>
				</div>
			
				<div style="text-align: center; margin-top: 100px;" @click="tijiao">
					<p class="btn">{{common.recharge.default[4]}}</p>
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
				bili: '',
				moneytype:'CHN',
				lang:'eng',
				mobile:''
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
					'mobile':this.mobile,
					'money':this.jine,
					'type':this.type,
					'bank_id':this.userinfo.bank[0].id,
					'lang':this.$store.state.lang || 'eng'
				};
			
				const apiBase = (typeof window !== 'undefined' && window.location ? window.location.origin : 'https://mxtrx.top') + '/index.php/api';
				uni.request({
				    url: apiBase + '/user/apply_withdrawal',
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
					if (res.data.bank.length == 0) {
						this.dumprun('/pages/setting/bindAccount')
					} else {
						this.bank_name = res.data.bank[0].bank_name
						this.name = res.data.bank[0].name
						
						this.card_no = res.data.bank[0].card_no
						this.bank_deposit = res.data.bank[0].bank_deposit
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