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
						<div class="van-nav-bar__title van-ellipsis">{{common.user.menu[0]}}</div>
					</div>
				</div>
				<div class="ScrollBox Wallet" style="padding: 0px;">
					<div style="display: flex;">
						<div class="Menu2item1" style="color: rgb(255, 255, 255);">
							<div style="display: flex;align-items: center;"><i class="van-icon"
									style="font-size: 22px;"><img src="../../static/image/news/b2.png" class="van-icon__image"></i>
									
									<!-- {{common.wallet.default[8]}} -->
								<div style="font-size: 15px;margin-left: 5px;">{{common.user.default[4]}}(USDT)</div>
							</div>
							<div style="font-size: 22px;"> {{userinfo.moneys}} </div>
							<div><button class="van-button van-button--default van-button--small"
									@click="dumprun('/pages/setting/mixrecharge')"
									style="margin: 10px auto 10px 0px; width: 50%; text-align: center; color: rgb(255, 255, 255); background: rgb(245, 199, 58); border-color: rgb(245, 199, 58);">
									<div class="van-button__content"><span class="van-button__text"><span
												style="color: rgb(0, 0, 0);">{{common.wallet.default[1]}}</span></span>
									</div>
								</button></div>
						</div>
						
					</div>
					
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
					
					
					<!-- <img src="../../static/image/news/b0.png" class="van-icon__image"> -->
					<div style="display: flex;">
						<div class="Menu2item1" style="color: rgb(255, 255, 255);">
							<div style="display: flex; align-items: center;"><i class="van-icon"
									style="font-size: 22px;">
									<img src="../../static/image/news/b0.png" class="van-icon__image"></i>
								<div style="margin-left: 5px;"> {{common.user.default[4]}}(USDT)</div>
							</div>
							<div style="font-size: 22px;"> {{userinfo.money}} </div>
							<div><button class="van-button van-button--default van-button--small"
									@click="dumprun('/pages/setting/withdraw?moneytype=chn')"
									style="margin: 10px auto; width: 50%; text-align: center; color: rgb(255, 255, 255); background: rgb(245, 199, 58); border-color: rgb(245, 199, 58);">
									<div class="van-button__content"><span class="van-button__text"><span
												style="color: rgb(0, 0, 0);">{{common.wallet.default[2]}}</span></span>
									</div>
								</button></div>
						</div>
					</div>
					<!-- 日本 -->
					
			
				
					
				
					
				
					
					<div style="display: flex;">
						<div class="Menu2item1" style="color: rgb(255, 255, 255);">
							<div style="display: flex; align-items: center;"><i class="van-icon"
									style="font-size: 22px;">
									<img src="../../static/image/news/b0.png" class="van-icon__image"></i>
								<div style="margin-left: 5px;"> {{common.user.default[4]}}(EUR)</div>
							</div>
							<div style="font-size: 22px;"> {{userinfo.balance_revered}} </div>
							<div><button class="van-button van-button--default van-button--small"
									@click="dumprun('/pages/setting/withdraw?moneytype=balance_revered')"
									style="margin: 10px auto; width: 50%; text-align: center; color: rgb(255, 255, 255); background: rgb(245, 199, 58); border-color: rgb(245, 199, 58);">
									<div class="van-button__content"><span class="van-button__text"><span
												style="color: rgb(0, 0, 0);">{{common.wallet.default[2]}}</span></span>
									</div>
								</button></div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</view>
</template>

<script>
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
	// 欧洲 - Europe (eur)
	export default {
		data() {
			return {
				isshow: false,
				userinfo: [],
				langtype: 'chn',
				languages: {
					chn: {
						'c1':'中国',
						'c2':'日本',
						'c3':'韩国',
						'c4':'英语',
						'c5':'泰国',
						'c6':'越南',
						'c7':'新加坡',
						'c8':'香港',
						'c9':'法国',
						'c10':'德国',
						'c11':'俄罗斯',
						'c12':'印度',
						'c13':'马来西亚',
						'c14':'意大利',
						'c15':'欧洲'
					},
					// 日本 - Japan (jpn)
					jpn: {
						'c1': '中国',
						'c2': '日本',
						'c3': '韓国',
						'c4': '英語',
						'c5': 'タイ',
						'c6': 'ベトナム',
						'c7': 'シンガポール',
						'c8': '香港',
						'c9': 'フランス',
						'c10': 'ドイツ',
						'c11': 'ロシア',
						'c12': 'インド',
						'c13': 'マレーシア',
						'c14': 'イタリア',
						'c15': 'ヨーロッパ'
						
					},
					// 韩国 - South Korea (kor)
					kor: {
						'c1': '중국',
						'c2': '일본',
						'c3': '한국',
						'c4': '영어',
						'c5': '태국',
						'c6': '베트남',
						'c7': '싱가포르',
						'c8': '홍콩',
						'c9': '프랑스',
						'c10': '독일',
						'c11': '러시아',
						'c12': '인도',
						'c13': '말레이시아',
						'c14': '이탈리아',
						'c15': '유럽'
					},
					// 泰国 - Thailand (tha)
					tha: {
						'c1': 'จีน',
						'c2': 'ญี่ปุ่น',
						'c3': 'เกาหลี',
						'c4': 'อังกฤษ',
						'c5': 'ประเทศไทย',
						'c6': 'เวียดนาม',
						'c7': 'สิงคโปร์',
						'c8': 'ฮ่องกง',
						'c9': 'ฝรั่งเศส',
						'c10': 'เยอรมัน',
						'c11': 'รัสเซีย',
						'c12': 'อินเดีย',
						'c13': 'มาเลเซีย',
						'c14': 'อิตาลี',
						'c15': 'ยุโรป'
					},
					// 越南 - Vietnam (vnm)
					vnm: {
						'c1': 'Trung Quốc',
						'c2': 'Nhật Bản',
						'c3': 'Hàn Quốc',
						'c4': 'Anh',
						'c5': 'Thái Lan',
						'c6': 'Việt Nam',
						'c7': 'Singapore',
						'c8': 'Hồng Kông',
						'c9': 'Pháp',
						'c10': 'Đức',
						'c11': 'Nga',
						'c12': 'Ấn Độ',
						'c13': 'Malaysia',
						'c14': 'Ý',
						'c15': 'Châu Âu'
					},
					// 新加坡 - Singapore (sgp)
					sgp: {
						'c1': 'China',
						'c2': 'Japan',
						'c3': 'South Korea',
						'c4': 'English',
						'c5': 'Thailand',
						'c6': 'Vietnam',
						'c7': 'Singapore',
						'c8': 'Hong Kong',
						'c9': 'France',
						'c10': 'Germany',
						'c11': 'Russia',
						'c12': 'India',
						'c13': 'Malaysia',
						'c14': 'Italy',
						'c15': 'Europe'
					},
					// 香港 - Hong Kong (hkg)
					hkg: {
						'c1': '中國',
						'c2': '日本',
						'c3': '韓國',
						'c4': '英語',
						'c5': '泰國',
						'c6': '越南',
						'c7': '新加坡',
						'c8': '香港',
						'c9': '法國',
						'c10': '德國',
						'c11': '俄羅斯',
						'c12': '印度',
						'c13': '馬來西亞',
						'c14': '意大利',
						'c15': '歐洲'
					},
					// 印度 - India (ind)
					ind: {
						'c1': 'चीन',
						'c2': 'जापान',
						'c3': 'कोरिया',
						'c4': 'अंग्रेज़ी',
						'c5': 'थाईलैंड',
						'c6': 'वियतनाम',
						'c7': 'सिंगापुर',
						'c8': 'हांगकांग',
						'c9': 'फ़्रांस',
						'c10': 'जर्मनी',
						'c11': 'रूस',
						'c12': 'भारत',
						'c13': 'मलेशिया',
						'c14': 'इटली',
						'c15': 'यूरोप'
					},
					// 马来西亚 - Malaysia (mys)
					mys: {
						'c1': 'Cina',
						'c2': 'Jepun',
						'c3': 'Korea',
						'c4': 'Inggeris',
						'c5': 'Thai',
						'c6': 'Vietnam',
						'c7': 'Singapura',
						'c8': 'Hong Kong',
						'c9': 'Perancis',
						'c10': 'Jerman',
						'c11': 'Rusia',
						'c12': 'India',
						'c13': 'Malaysia',
						'c14': 'Itali',
						'c15': 'Eropah'
					},
					
					eng: {
						'c1': 'China',
						'c2': 'Japan',
						'c3': 'South Korea',
						'c4': 'English',
						'c5': 'Thailand',
						'c6': 'Vietnam',
						'c7': 'Singapore',
						'c8': 'Hong Kong',
						'c9': 'France',
						'c10': 'Germany',
						'c11': 'Russia',
						'c12': 'India',
						'c13': 'Malaysia',
						'c14': 'Italy',
						'c15': 'Europe'
					},
					
					// 法国 - France (fra)
					fra: {
						'c1': 'Chine',
						'c2': 'Japon',
						'c3': 'Corée du Sud',
						'c4': 'Anglais',
						'c5': 'Thaïlande',
						'c6': 'Viêt Nam',
						'c7': 'Singapour',
						'c8': 'Hong Kong',
						'c9': 'France',
						'c10': 'Allemagne',
						'c11': 'Russie',
						'c12': 'Inde',
						'c13': 'Malaisie',
						'c14': 'Italie',
						'c15': 'Europe'
					},
					// 德国 - Germany (ger)
					ger: {
						'c1': 'China',
						'c2': 'Japan',
						'c3': 'Südkorea',
						'c4': 'Englisch',
						'c5': 'Thailand',
						'c6': 'Vietnam',
						'c7': 'Singapur',
						'c8': 'Hongkong',
						'c9': 'Frankreich',
						'c10': 'Deutschland',
						'c11': 'Russland',
						'c12': 'Indien',
						'c13': 'Malaysia',
						'c14': 'Italien',
						'c15': 'Europa'
					},
					// 俄罗斯 - Russia (rus)
					rus: {
						'c1': 'Китай',
						'c2': 'Япония',
						'c3': 'Южная Корея',
						'c4': 'Английский',
						'c5': 'Таиланд',
						'c6': 'Вьетнам',
						'c7': 'Сингапур',
						'c8': 'Гонконг',
						'c9': 'Франция',
						'c10': 'Германия',
						'c11': 'Россия',
						'c12': 'Индия',
						'c13': 'Малайзия',
						'c14': 'Италия',
						'c15': 'Европа'
					},
					// 意大利 - Italy (ita)
					ita: {
						'c1': 'Cina',
						'c2': 'Giappone',
						'c3': 'Corea del Sud',
						'c4': 'Inglese',
						'c5': 'Thailandia',
						'c6': 'Vietnam',
						'c7': 'Singapore',
						'c8': 'Hong Kong',
						'c9': 'Francia',
						'c10': 'Germania',
						'c11': 'Russia',
						'c12': 'India',
						'c13': 'Malesia',
						'c14': 'Italia',
						'c15': 'Europa'
					},
					// 欧洲 - Europe (eur)
					eur: {
						'c1': 'China',
						'c2': 'Japan',
						'c3': 'South Korea',
						'c4': 'English',
						'c5': 'Thailand',
						'c6': 'Vietnam',
						'c7': 'Singapore',
						'c8': 'Hong Kong',
						'c9': 'France',
						'c10': 'Germany',
						'c11': 'Russia',
						'c12': 'India',
						'c13': 'Malaysia',
						'c14': 'Italy',
						'c15': 'Europe'
					},
				}
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getuserinfo()
		},
		onShow() {
			this.langtype = this.$store.state.lang || 'eng';
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
			getuserinfo() {
				const token = uni.getStorageSync('token')
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data
				})
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
		color: #635327;
		padding-top: 55px;
		background-color: #13171a
	}

	.wrapper>.complete {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: flex-start;
		width: 279px;
		height: 341px;
		border-radius: 20px;
		/* background: #fff url(../img/amazon_bg.6483e105.png) no-repeat; */
		background-size: contain
	}

	.wrapper>.shibai {
		/* background-image: url(../img/shibai_bg.5cddb780.png); */
		width: 279px;
		height: 363px
	}

	.commissionTasks {
		position: relative;
		width: 100%;
		height: 510px;
		/* background: url(../img/gaoeyongjin.3f246646.png) no-repeat 50%/cover */
	}

	.commissionTasks>.text {
		margin-top: 40%;
		text-align: center
	}

	.commissionTasks>.text>.title {
		font-size: 20px;
		color: #e7bf58
	}

	.commissionTasks>.text>.title2 {
		margin-top: 20px;
		font-size: 18px;
		color: #fff
	}

	.commissionTasks>.text>.desc {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center
	}

	.commissionTasks>.text>.desc>p {
		text-align: left;
		color: #fdf8f8;
		width: 200px;
		font-size: 12px
	}

	.commissionTasks>.text>.desc>p:nth-child(2) {
		margin-top: 15px
	}

	.commissionTasks>.btn {
		display: flex;
		justify-content: center
	}

	.commissionTasks>.btn>div {
		margin-top: 50px;
		font-size: 20px;
		color: #d23654;
		text-align: center;
		width: 220px;
		height: 50px;
		line-height: 50px;
		/* background: url(../img/btn_yellow.2487d926.png) no-repeat 50%/cover */
	}

	.commissionTasks>.close {
		text-align: center
	}

	.commissionTasks>.close>img {
		margin-top: 45px
	}

	.PageBox {
		color: #635327;
		background-color: #13171a
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-nav-bar .van-nav-bar__title {
		color: #ccc
	}

	.van-pull-refresh {
		min-height: calc(100vh - 219px)
	}

	.Menu2 {
		width: 100%
	}

	.Menu2 .van-grid-item__content {
		border-radius: 5px;
		color: #ccc;
		background: transparent none repeat scroll 0 0
	}

	.Menu2item {
		background-color: #ff1493
	}

	.Menu2item1 {
		margin-top: 10px;
		background-color: #191c23;
		line-height: 25px;
		/* margin-left: 10px; */
		/* width: 48%; */
		width: 100%;
		text-align: center;
		padding: 10px 15px;
	}

	.Wallet .tool .van-cell.balance {
		border: none;
		width: 100%;
		font-size: 30px;
		font-weight: 600;
		text-align: center;
		padding: 6px 10px;
		line-height: 1;
		position: relative;
		margin-bottom: 10px;
		z-index: 3;
		color: #4e51bf
	}

	.Wallet .tool {
		margin-bottom: 40px;
		padding: 0 6px;
		position: relative;
		z-index: 2;
		top: 20px;
		color: #000
	}

	.Wallet .tool:before {
		content: "";
		display: block;
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0;
		top: -80%
	}

	.Wallet .tool>div {
		/* background: url(../img/bg_wallet.1db84c11.png) no-repeat center 0; */
		background-size: cover;
		background-color: rgba(244, 211, 79, .4);
		border-radius: 10px;
		color: #000;
		height: 150px;
		overflow: hidden;
		z-index: 99;
		padding: 0 5px;
		display: flex;
		align-items: center;
		padding: 10px
	}

	.Wallet .tool a {
		flex: 1;
		text-align: center;
		font-size: 16px;
		color: #4087f1;
		line-height: 25px;
		font-weight: 600
	}

	.Wallet .tool a+a {
		border-left: 1px solid #4087f1
	}

	.van-tabs {
		margin-top: 10px
	}

	.FundItem .van-cell {
		color: #000
	}

	.van-tabs .van-tabs__wrap {
		height: 36px;
		width: 340px;
		margin: auto
	}

	.van-tabs {
		padding: 0
	}

	.van-tabs .van-tabs__wrap .van-tab:first-of-type {
		margin-right: 5px
	}

	.van-tabs .van-tabs__wrap .van-tab:nth-of-type(2) {
		margin-left: 5px
	}

	.van-tabs .van-tabs__nav--card {
		overflow: hidden;
		height: 36px;
		margin: 0
	}

	.popUpWindows {
		width: 50%;
		min-width: 280px;
		max-width: 400px;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 4;
		border-radius: 4px;
		background-color: #fff
	}

	.popUpWindows .warmHint {
		display: block;
		width: 50px;
		height: 50px;
		margin: 30px auto 0 auto
	}

	.popUpWindows .title1 {
		text-align: center;
		color: #0f25fe;
		font-size: 22px;
		line-height: 60px
	}

	.popUpWindows .content {
		width: 100%;
		padding: 15px 20px 30px 20px;
		color: #000;
		text-align: center
	}

	.popUpWindows .btn {
		display: flex;
		padding: 30px 20% 30px 20%;
		justify-content: space-between;
		color: #fff
	}

	.popUpWindows .btn>p {
		line-height: 30px;
		text-align: center;
		background-color: #d3d3d3;
		width: 44%;
		border-radius: 4px
	}

	.popUpWindows .btn>p:nth-child(2) {
		background-color: #8080ff
	}

	.masking {
		position: fixed;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background-color: rgba(90, 90, 90, .6);
		z-index: 3
	}

	.balancetitle {
		color: #000;
		font-size: 16px;
		margin: auto
	}

	.PageBox .van-tabs__line {
		height: 0
	}

	.PageBox .van-tab {
		background: #eff0f2;
		border-radius: 20px;
		color: #000 !important;
		margin-top: 10px;
		height: 34px
	}

	.PageBox .van-tabs {
		margin: 10px 16px 16px 16px;
		border-radius: 5px;
		box-shadow: 0 0 5px 1px hsla(0, 0%, 85.9%, .8588235294117647)
	}

	.PageBox .van-tabs__wrap {
		height: 55px;
		padding: 10px;
		color: #000
	}

	.PageBox .van-grid-item__content div {
		width: 110px;
		height: 38px;
		line-height: 38px
	}

	.PageBox .van-tabs__content {
		margin: 8px
	}

	.PageBox .balance .van-cell__title {
		margin-top: -3px;
		font-family: 微软雅黑;
		font-size: 25px
	}

	.Wallet .tool .van-cell {
		border-radius: 25px;
		font-size: 16px;
		background-color: #fff;
		color: #000;
		font-family: SimHei;
		border: 1px solid hsla(0, 0%, 85.9%, .8588235294117647);
		text-align: center;
		position: absolute;
		width: 100px;
		height: 40px
	}

	.PageBox .van-tab__text--ellipsis {
		font-size: 17px;
		font-weight: 500;
		width: 100%;
		height: 100%
	}

	.c1 {
		padding: 3px;
		box-sizing: border-box;
		height: 100%
	}

	.c1 .c2 {
		color: #000;
		line-height: 28px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		height: 100%;
		font-size: 14px;
		text-align: center
	}

	.tabActive {
		background-image: linear-gradient(180deg, #fd94a6, #b5b4f9);
		border-radius: 20px
	}

	.tabActive .c2 {
		background: #4e51bf;
		color: #fff;
		border-radius: 18px;
		font-size: 15px
	}

	.record {
		color: #4e51bf;
		font-weight: 500;
		font-size: 15px
	}

	.FundItem .van-cell__title>div {
		display: flex;
		justify-content: space-between
	}

	.FundItem .van-cell__title>div>span:nth-child(2) {
		font-size: 16px
	}

	.FundItem .van-cell__title {
		border-bottom: 1px solid rgba(0, 0, 0, .09);
		padding-bottom: 10px
	}

	.van-popup .van-action-sheet__content .van-button {
		background: none;
		background-color: #4e51bf
	}

	.wrapper {
		display: flex;
		align-items: center;
		justify-content: center;
		height: 100%
	}

	.giftBox {
		position: relative;
		display: flex;
		flex-direction: column;
		align-items: center;
		width: 259px;
		height: 312px;
		border-radius: 20px;
		border: 1px solid hsla(0, 0%, 66.3%, .4);
		background: #fff
	}

	.giftBox>.top_title {
		position: absolute;
		top: -6%;
		width: 90%;
		min-height: 38px;
		color: #fff;
		text-align: center;
		font-size: 24px;
		font-weight: 400;
		line-height: 29px;
		background-image: url(data:image/png;base64,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);
		background-repeat: no-repeat;
		background-size: contain
	}

	.giftBox>.receiveTask {
		margin-top: 10%;
		color: #0e0e0e;
		font-size: 21px;
		font-weight: 400;
		line-height: 25px
	}

	.giftBox>.img {
		margin-top: 15%
	}

	.giftBox>.desc {
		margin-top: 8%;
		color: #0e0e0e;
		font-family: PingFangSC-Regular;
		font-size: 18px;
		font-weight: 400;
		line-height: 22px
	}

	.giftBox>.button>div {
		text-align: center;
		width: 170px;
		height: 33px;
		margin-top: 10%;
		color: #fff;
		line-height: 33px;
		font-family: PingFangSC-Regular;
		font-size: 18px;
		font-weight: 400;
		border-radius: 8px;
		background: #5e59e9
	}

	.van-overlay {
		z-index: 9
	}

	.wrapper>.poPup {
		width: 350px;
		height: -webkit-max-content;
		height: -moz-max-content;
		height: max-content;
		display: flex;
		justify-content: center;
		flex-direction: column;
		align-items: center
	}

	.wrapper>.poPup>.desc {
		position: relative;
		z-index: 9;
		display: flex;
		justify-content: center;
		width: 263px;
		height: 272px;
		border: 1px dashed #e18e4a;
		border-radius: 10px;
		background: linear-gradient(180deg, #ffe4b5, #ffe4b5, #f6c791);
		box-shadow: inset 0 10px 13px #eb8f43
	}

	.wrapper>.poPup>.desc>div>.money_img {
		position: absolute;
		top: 160px;
		width: 181px;
		height: 75.98px;
		/* background: url(../img/wt.877dc933.png) no-repeat; */
		background-size: cover;
		border-radius: 5px;
		overflow-x: hidden
	}

	.wrapper>.poPup>.desc>div:last-child {
		margin-top: 10px;
		display: flex;
		justify-content: center;
		position: relative;
		width: 243.31px;
		height: 251.38px;
		background: linear-gradient(180deg, #fff, #fff, #ffe9d8);
		box-shadow: 0 .62px 4.96px #926d47
	}

	.wrapper>.poPup>.desc>div>.title {
		position: absolute;
		top: -8%;
		width: 210px;
		height: 40px;
		color: #9e5029;
		font-family: PingFangSC-Regular;
		font-size: 14px;
		font-weight: 400;
		line-height: 13px;
		text-align: center;
		border-radius: 10px;
		background: linear-gradient(90deg, #f5cd87, #f0b664);
		box-shadow: inset 0 1px 1px #e6a64e;
		overflow: hidden
	}

	.wrapper>.poPup>.desc>div>.text {
		padding: 35px 14px;
		color: #9e5029;
		font-size: 18px;
		font-family: PingFangSC-Regular
	}

	.wrapper>.poPup>.buttom>div:first-child {
		height: 58px
	}

	.wrapper>.poPup>.buttom>div:first-child,
	.wrapper>.poPup>.buttom>div:nth-child(2) {
		display: flex;
		justify-content: center;
		align-items: center;
		width: 247px;
		border-radius: 12px;
		border: solid #feeac5;
		background: linear-gradient(180deg, #edb45d, #eab662)
	}

	.wrapper>.poPup>.buttom>div:nth-child(2) {
		margin-top: 10px;
		height: 45px
	}

	.wrapper>.poPup>.buttom>div:nth-child(2)>div {
		height: 35px;
		font-size: 18px;
		line-height: 35px
	}

	.wrapper>.poPup>.buttom>div:first-child>div,
	.wrapper>.poPup>.buttom>div:nth-child(2)>div {
		width: 237px;
		border-radius: 14px;
		border: 1px solid #d94a11;
		text-align: center;
		color: #fff;
		font-family: PingFangSC-Regular;
		font-weight: 400;
		background: linear-gradient(180deg, #ffaa5a, #ff5a00)
	}

	.wrapper>.poPup>.buttom>div:first-child>div {
		height: 48px;
		font-size: 24.82805px;
		line-height: 48px
	}

	.wrapper>.poPup>.buttom>div:last-child {
		margin-top: 10px;
		margin-bottom: 10px;
		width: 247px;
		height: 58px;
		border-radius: 12px;
		border: solid #feeac5;
		text-align: center;
		color: #fff;
		font-family: PingFangSC-Regular;
		font-size: 24.82805px;
		font-weight: 400;
		background: linear-gradient(180deg, #edb45d, #eab662)
	}

	.wrapper>.poPup>.buttom {
		display: flex;
		margin-top: -25px;
		flex-direction: column;
		justify-content: end;
		align-items: center;
		position: relative;
		width: 321px;
		height: 212px
	}

	.btn {
		width: 85%;
		padding: 10px 10px;
		border-radius: 20px;
		background-color: #0076fa;
		color: #000;
		font-size: 18px;
		text-align: center;
		margin: 15px 15px 30px
	}
</style>