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
						<div class="van-nav-bar__title van-ellipsis">{{common.recharge.default[3]}}</div>
						<!-- <div class="van-nav-bar__right" @click="dumprun('/pages/setting/rechargeList')"><i class="van-icon"
								style="font-size: 25px;"><img src="../../static/image/news/task01.png"
									class="van-icon__image"></i></div> -->
					</div>
				</div>
				<div class="box">
					<div class="van-cell van-field">
						<div class="van-cell__title van-field__label"><span>{{common.recharge.label[0]}}</span></div>
						<div class="van-cell__value van-field__value">
							<div class="van-field__body2"><input type="text" readonly="readonly" value="USDT(TRC20)"
									class="van-field__control"></div>
						</div>
					</div><!---->
					<div style="display: flex; background-color: rgb(25, 28, 35);">
						<div class="van-cell van-field">
							<div class="van-cell__title van-field__label"><span>{{common.recharge.label[1]}}</span></div>
							<div class="van-cell__value van-field__value">
								<div class="van-field__body2"><input type="text" :value="address"
										class="van-field__control"></div>
							</div>
						</div><i @click="copy(address)" class="copy-qb van-icon" style="margin-top: 15px;"><img
								data-v-650c462d="" src="../../static/image/news/copy.png" class="van-icon__image"><!----></i>
					</div><textarea id="inputBox"
						style="position: absolute; top: 0px; left: 0px; opacity: 0; z-index: -10;"></textarea>
					<div class="mygrid22">
						<div style="font-size: 15px; margin-bottom: 10px; font-weight: bold;">
							{{common.recharge.label[3]}}({{cointype}})</div>
						<div style="display: flex;">
							<div class="van-cell van-field" style="width: 180px;">
								<div class="van-cell__value van-cell__value--alone van-field__value">
									<div class="van-field__body2"><input type="text" placeholder="0"
											class="van-field__control" v-model="dangjia"></div>
								</div>
							</div>
							<div
								style="font-size: 14px; margin-top: 15px; margin-left: 10px; font-weight: bold;"> ≈ {{(dangjia * shijia).toFixed(2)}}
								EUR </div>
						</div>
						<!-- <div
							style="width: 90%; height: 1px; background: rgb(224, 224, 224); margin-bottom: 20px; margin-left: 20px;">
						</div> -->
						<div
							style="margin-bottom: 20px;">
						</div>
					</div>
					<div class="mygrid33">
						<div style="font-size: 16px; font-weight: bold;">{{common.recharge.label[4]}}</div>
						<div style="text-align: center;">
							<div class="van-uploader">
								<div class="van-uploader__wrapper">
									<!-- <div class="van-uploader__upload"><i
											class="van-icon van-icon-photograph van-uploader__upload-icon"></i><input
											type="file" accept="image/*" class="van-uploader__input"></div> -->
									<u-upload :fileList="fileList" @on-success="okopen" multiple :maxCount="1" :uploadText="common.recharge.label[4]" width="50vw"></u-upload>
								</div>
							</div>
						</div>
					</div>
					<div style="text-align: center; margin-top: 10px;" @click="tijiao">
						<p class="btn">{{common.recharge.default[4]}}</p>
					</div>
					<div style="margin-top: 5px; color: rgb(204, 204, 204); text-align: left;">
						<div style="margin-left: 20px;">{{common.recharge4[0]}}</div>
					</div>
				</div>
			</div>
		</div>
		<u-popup v-model="isshow" mode="bottom" length="66%" contentBackgroundColor="white">
			<view class="popup-list mianji">
				<view class="popup-list-item" v-for="item in info" @click="setxttype(item.coin_type,item.coin_address,item.shijia)">
					<text>{{item.coin_type}}</text>
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
				info:[],
				address:'',
				cointype:'',
				shijia:'',
				shijiax:'',
				dangjia:0,
				fileList: [],
				fileurl:'',
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getinfo()
		},
		onShow() {
	
		},
		methods: {
			tijiao(){
				const token = uni.getStorageSync('token')
				let jine = (this.dangjia * this.shijiax).toFixed(2)
				this.$u.api.index.add_Recharge(token,this.fileurl,jine).then(res => {
					this.$utils.showToast('succès')
					setTimeout(() => {
						this.back()
					}, 1000)
				})
			},
			okopen(data){
				this.$utils.showToast('succès')
				this.fileurl = data.data.url
				console.log(data.data.url)
			},
			setxttype(cointype,address,shijia){
				this.cointype = cointype
				this.address = address
				this.shijia = shijia
				this.isshow = false
			},
			getinfo(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.cointype(token).then(res => {
					this.info = res.data
					this.cointype = res.data[0].coin_type
					this.address = res.data[0].caddre
					this.shijiax = res.data[0].shijia
				})
				this.$u.api.index.shoujia().then(res => {
					this.shijia = res.data.shoujia
					// this.youjia = res.data.zuiyou
				})
			},
			//复制
			copy(data){
				const _this = this
				uni.setClipboardData({
					data,
					success() {
						_this.$utils.showToast('succès')
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
	
	.PageBox {
	    color: #ccc;
		padding-top: 40px;
	    background-color: #13171a;
	    font-size: 13px
	}
	
	.Site .van-nav-bar .van-icon {
	    font-size: 1.5rem !important;
	    color: #bbb !important;
	}
	
	.van-cell,.van-nav-bar {
	    background-color: #191c23
	}
	
	.van-nav-bar .van-nav-bar__title {
	    color: #ccc
	}
	
	.van-nav-bar .van-nav-bar__arrow {
	    color: #b5b5b5
	}
	
	.PageBox .van-cell .van-cell__title {
	    font-size: 15px;
	    font-weight: 700;
	    color: #ccc
	}
	
	.PageBox .box {
	    width: 100%;
	    padding: 0 15px;
	    font-size: 16px;
	    margin-top: 15px;
	    color: #555
	}
	
	.box .balance {
	    color: #000;
	    font-size: 16px;
	    margin-bottom: 15px
	}
	
	.box .balance span {
	    color: #4e51bf;
	    padding-left: 5px
	}
	
	.box .toRegister {
	    font-size: 14px;
	    color: #a0a0a0;
	    text-transform: uppercase;
	    border-bottom: 1px dashed #4e51bf
	}
	
	.box .selectBox {
	    border-bottom: 1px dashed #4e51bf
	}
	
	.selectBox .select {
	    max-width: 365px;
	    display: flex;
	    margin: 8px auto;
	    flex-wrap: wrap
	}
	
	.selectBox .select p {
	    padding: 10px 15px;
	    border-radius: 4px;
	    font-size: 16px;
	    background-color: #191c23;
	    border: 1px solid #4e51bf;
	    color: #4e51bf;
	    margin: 8px 25px 12px 0
	}
	
	.selectBox .select p:last-child {
	    margin-right: 0
	}
	
	p.active {
	    background-color: #4e51bf!important;
	    color: #fff!important
	}
	
	p {
	    width: 80px
	}
	
	.mygrid22 {
	    margin-top: 1px;
	    margin-bottom: 5px
	}
	
	.mygrid22,.mygrid33 {
	    border-radius: 5px;
	    background-color: #191c23;
	    padding: 10px;
	    overflow: hidden;
	    width: 100%;
	    position: relative;
	    z-index: 2
	}
	
	.mygrid33 {
	    margin-top: 3px;
	    margin-bottom: 3px
	}
	
	.selectAmount .amount {
	    margin-top: 20px
	}
	
	.selectAmount .select {
	    justify-content: space-around;
	    width: 100%;
	    display: flex;
	    justify-content: flex-start;
	    margin: 8px auto;
	    flex-wrap: wrap
	}
	
	.selectAmount .select p {
	    padding: 8px 25px;
	    border-radius: 4px;
	    font-size: 15px;
	    background-color: #f4f5ff;
	    color: #4e51bf;
	    margin-top: 10px;
	    margin-left: 5px
	}
	
	.informationBox {
	    border-bottom: 1px dashed #c9c9c9
	}
	
	.information-title {
	    margin: 40px 0 34px 0
	}
	
	.information {
	    display: flex;
	    font-size: 18px;
	    align-items: center;
	    margin-bottom: 26px
	}
	
	.information input {
	    flex: 1;
	    height: 40px
	}
	
	.QRBox .QR-title {
	    margin-top: 20px
	}
	
	.QRBox .upload {
	    display: flex;
	    flex-direction: column;
	    margin: 15px 0 0 0
	}
	
	.QRBox .upload .QRCode {
	    width: 130px;
	    height: 130px
	}
	
	.QRBox .upload .QRCode img {
	    width: 100%;
	    height: 100%
	}
	
	.QRBox .upload .imgBox {
	    border: 1px solid #c9c9c9;
	    padding: 30px
	}
	
	.QRBox .infoBox {
	    font-size: 18px
	}
	
	.QRBox .infoBox .address {
	    margin-top: 30px
	}
	
	.QRBox .infoBox .code {
	    margin-top: 2px;
	    color: #4e51bf;
	    display: flex;
	    justify-content: space-between;
	    align-items: center
	}
	
	.QRBox .infoBox .code>span:first-child {
	    flex: 1;
	    word-break: break-all
	}
	
	.QRBox .infoBox .copy {
	    display: inline-block;
	    padding: 8px 10px;
	    border-radius: 6px;
	    margin-left: 20px;
	    color: #fff;
	    background-color: #4e51bf
	}
	
	.QRBox .infoBox .recharge {
	    display: flex;
	    flex-direction: column;
	    margin-top: 5px
	}
	
	.QRBox .infoBox .recharge .price {
	    padding-left: 10px
	}
	
	.QRBox .infoBox .recharge .copy {
	    display: inline-block;
	    padding: 8px 10px;
	    border-radius: 6px;
	    margin-left: 20px;
	    color: #fff;
	    background-color: #4e51bf
	}
	
	.QRBox .infoBox .order {
	    margin: 20px 0 30px 0
	}
	
	.QRBox .infoBox .account {
	    display: flex;
	    justify-content: space-between;
	    align-items: center
	}
	
	.QRBox .infoBox .account input {
	    width: 150px;
	    height: 40px;
	    border-radius: 4px;
	    background-color: #dcf8ff;
	    border: 1px solid #4e51bf;
	    padding-left: 10px;
	    font-size: 18px
	}
	
	.QRBox .upload .btn {
	    padding: 10px 30px;
	    border-radius: 6px;
	    background-color: #4e51bf;
	    color: #fff;
	    text-align: center;
	    margin: 41px 0 70px 0
	}
	
	.description {
	    font-size: 18px;
	    color: #555;
	    background-color: #f3f3f3;
	    padding: 40px 19px
	}
	
	.description p {
	    color: #666;
	    font-size: 18px;
	    margin-bottom: 8px
	}
	
	.description .title {
	    color: #555;
	    font-size: 18px;
	    margin-bottom: 30px
	}
	
	.van-loading {
	    z-index: 99999
	}
	
	.popUpWindows,.van-loading {
	    position: fixed;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%,-50%)
	}
	
	.popUpWindows {
	    width: 50%;
	    min-width: 280px;
	    max-width: 400px;
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
	
	.popUpWindows .title {
	    text-align: center;
	    color: #4e51bf;
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
	    background-color: rgba(90,90,90,.6);
	    z-index: 3
	}
	
	.infoBox .van-cell-group:after {
	    content: none
	}
	
	.infoBox .van-cell-group .van-field {
	    border-bottom: 1px solid #4e51bf
	}
	
	.van-button__text {
	    white-space: nowrap
	}
	
	.tool {
	    display: flex;
	    justify-content: center
	}
	
	.box .van-uploader__upload {
	    background-color: #252d30;
	    border-radius: 4px
	}
	
	.withdraw {
	    width: 150px;
	    height: 43px;
	    color: #fff;
	    line-height: 40px;
	    text-align: center;
	    border: 1px solid #4f51c0;
	    background: #4f51c0;
	    border-top-left-radius: 10px;
	    border-bottom-left-radius: 10px
	}
	
	.withdraw img {
	    width: 25px;
	    height: 25px;
	    margin-right: 5px;
	    vertical-align: middle
	}
	
	.recharge {
	    width: 150px;
	    height: 43px;
	    line-height: 40px;
	    border: 1px solid #4f51c0;
	    text-align: center;
	    background: #fff;
	    border-radius: 10px;
	    border-top-left-radius: 0;
	    border-bottom-left-radius: 0
	}
	
	.recharge img {
	    width: 25px;
	    height: 25px;
	    margin-right: 5px;
	    vertical-align: middle
	}
	
	.withdrawBg {
	    background: #fff;
	    color: #696969
	}
	
	.rechargeBg {
	    background: #4f51c0;
	    color: #fff
	}
	
	.van-cell--borderless {
	    background-color: #13c465;
	    color: #fff
	}
	
	.btn {
	    width: 85%;
	    padding: 10px 50px;
	    border-radius: 20px;
	    background-color: #0076fa;
	    color: #000;
	    font-size: 18px;
	    text-align: center;
	    margin: 15px 30px 10px
	}
	.van-field__body2{
		
	}
</style>