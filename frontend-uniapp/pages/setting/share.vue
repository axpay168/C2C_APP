<template>
	<view class="Body">
		<view class="Main Site" style="overflow: visible;">
			<view class="van-nav-bar van-nav-bar--fixed">
				<view class="van-nav-bar__content">
					<view class="van-nav-bar__left"><i class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i>
					</view>
					<view class="van-nav-bar__title van-ellipsis"></view>
				</view>
			</view>
			<view class="all">
				<view class="van-nav-bar van-nav-bar--fixed">
					<view class="van-nav-bar__content">
						<view class="van-nav-bar__left" @click="back"><i
								class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i></view>
						<view class="van-nav-bar__title van-ellipsis">{{common.invite[0]}}</view>
					</view>
				</view>
				<view style="margin-top: 50px;"></view>
				<view class="activity">
					<view style="margin: 0px auto; text-align: center; line-height: 25px; font-size: 18px;">
						<view>
							<view style="color: rgb(204, 204, 204);">{{common.invite[1]}}</view>
							<view style="margin: 10px;">{{list.share_code}}</view>
							<view><button @click="copy(list.share_code)"
									class="van-button van-button--default van-button--normal"
									style="color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
									<view class="van-button__content"><span
											class="van-button__text">{{common.invite[3]}}</span></view>
								</button></view>
							<view>{{common.invite[2]}}</view>
							<view class="mt-50 mx-auto text-center p-30 bg-white border-radius-20" style="width: 210px;">

								<uqrcode ref="qrcode" canvas-id="qrcode" :value="uQRCode" :size="180">
									<template v-slot:loading>
										<text style="color: green;">loading...</text>
									</template>
								</uqrcode>

								<!-- <uqrcode ref="uqrcode"></uqrcode> -->
							</view>
						</view>
					</view>
				</view><textarea id="inputBox"
					style="position: absolute; top: 0px; left: 0px; opacity: 0; z-index: -10;"></textarea>
			</view>
		</view>
	</view>
</template>
<script>
	// import UQRCodeStyleRound from '../../uni_modules/Sansnn-uQRCode/js_sdk/uqrcode/uqrcode';
	export default {
		data() {
			return {
				isshow: false,
				list: [],
				uQRCode: '',
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getlist()
		},
		// onReady() {
		// 	/* 注册扩展插件 */
		// 	this.$refs.qrcode.registerStyle(UQRCodeStyleRound); // qrcode为组件的ref名称
		//   },
		onShow() {

		},
		methods: {
			getlist() {
				const token = uni.getStorageSync('token')
				const _this = this
				this.$u.api.index.obtain_share(token).then(res => {
					// console.log(res)
					if (res.data.share_code == 0) {
						_this.$utils.showToast('permission denied')
					} else {
						this.list = res.data,
							this.uQRCode = res.data.share_link;
						// this.$nextTick(function() {
						// 	this.$refs.uqrcode.make({
						// 		size: 180,
						// 		text: res.data.share_link
						// 	})
						// })
						// qrcode为组件的ref名称
						// this.$refs.qrcode.make({
						//   success: () => {
						//     console.log('生成成功');
						//   },
						//   fail: err => {
						//     console.log(err)
						//   }
						// });
					}
				})
			},
			//复制
			copy(data) {
				const _this = this
				uni.setClipboardData({
					data,
					success() {
						_this.$utils.showToast(_this.common.dialog[3])
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
	.Site .van-nav-bar .van-icon {
		font-size: 1.5rem !important;
		color: #bbb !important;
	}

	.all {
		overflow: auto;
		height: 100%;
		background-color: #13171a;
		box-sizing: content-box;
		background-size: cover
	}

	.PageBox {
		color: #635327;
		background-color: #13171a
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-nav-bar .van-nav-bar__title {
		color: #ccc;
		font-weight: 700
	}

	.title {
		color: #fff;
		height: 46px;
		line-height: 46px;
		font-size: 17px;
		letter-spacing: 1px;
		position: fixed;
		background: #f46926;
		z-index: 99;
		top: 0;
		width: 100%;
		text-align: center
	}

	.activity {
		// width: 350px;
		height: 500px;
		position: relative;
		// margin-left: 30px;
		color: #ccc;
		background-color: #191c23;
		border-radius: 10px
	}

	.cover_img {
		width: 100%;
		height: auto
	}

	.cover_img>img {
		width: 100%;
		height: auto;
		display: block
	}

	.inviteTit {
		width: 220px;
		height: 125px;
		position: absolute;
		top: 130px;
		left: 80px;
		padding: 10px 30px;
		text-align: center;
		font-weight: 600
	}

	.inviteTit>p:first-child {
		color: #fff;
		font-size: 18px;
		line-height: 20px
	}

	.inviteTit>p:last-child {
		color: #0ff;
		font-size: 25px;
		line-height: 30px
	}

	.invitePeople {
		width: 200px;
		height: 52px;
		border-radius: 10px;
		background: linear-gradient(180deg, #ffe74d, #ffc91b);
		box-sizing: border-box;
		padding: 4px;
		position: absolute;
		bottom: 45px;
		left: 75px;
		font-size: 24px;
		font-weight: 600;
		line-height: 44px;
		text-align: center;
		color: #ff395b
	}

	.receivableAmount {
		width: 100%;
		padding: 25px 0;
		height: 230px;
		box-sizing: border-box
	}

	.receivableAmount-img {
		width: 230px;
		height: 100%;
		margin: 0 auto;
		// background: url(../img/30.7d48fd33.png) no-repeat 50%/100%;
		overflow: hidden
	}

	.QRCode {
		margin: 20px auto;
		height: 230px;
		padding-left: 70px;
		text-align: center
	}

	.amount {
		margin-top: 55px;
		height: 25px;
		width: 100%;
		text-align: center;
		line-height: 25px;
		font-size: 12px;
		transform: scale(.95);
		color: #8332ff
	}

	.moeny {
		height: 50px;
		line-height: 50px;
		font-size: 30px
	}

	.moeny,
	.receiveBtn {
		width: 100%;
		text-align: center;
		font-weight: 600;
		color: #ff395b
	}

	.receiveBtn {
		height: 30px;
		line-height: 30px;
		font-size: 16px;
		margin-top: 10px
	}

	.rewardList {
		width: 100%;
		height: 70px;
		padding: 15px 0
	}

	.rewardList>view {
		width: 165px;
		height: 100%;
		line-height: 40px;
		margin: 0 auto;
		color: #000;
		border-radius: 20px;
		background: #fee9d0;
		text-align: center;
		font-size: 16px;
		font-weight: 600;
		padding: 0 10px;
		box-sizing: content-box;
		color: #333
	}

	.exposition {
		width: 100%;
		height: auto;
		padding: 0 30px 40px
	}

	.exposition p {
		color: #313131;
		margin-top: 6px
	}

	.success {
		width: 300px;
		height: 238px;
		background: linear-gradient(180deg, #fe93a4, #4f52bf);
		border-radius: 20px
	}

	.successImg {
		width: 70px;
		height: 70px;
		position: absolute;
		top: -35px;
		left: 115px
	}

	.successImg>img {
		width: 100%;
		height: 100%
	}

	.successContent {
		width: 290px;
		height: 248px;
		background: #fff;
		border-radius: 20px;
		margin: 5px;
		overflow: hidden;
		text-align: center;
		padding: 0 20px
	}

	.successContent>h2 {
		width: 100%;
		height: 40px;
		line-height: 40px;
		margin-top: 30px;
		font-size: 18px;
		color: #fe889d
	}

	.successContent>p {
		width: 100%;
		height: auto;
		margin-top: 10px;
		line-height: 30px;
		letter-spacing: 1px
	}

	.successContent>view {
		width: 100%;
		height: 40px;
		margin-top: 20px;
		display: flex;
		justify-content: space-between
	}

	.successContent>view>view {
		width: 120px;
		height: 100%;
		text-align: center;
		line-height: 40px;
		color: #fff;
		background: #4e51bf;
		border-radius: 15px
	}

	.fail {
		width: 300px;
		height: 258px;
		background: linear-gradient(180deg, #4f52bf, #fe93a4);
		border-radius: 20px;
		overflow: hidden
	}

	.failImg {
		width: 70px;
		height: 70px;
		position: absolute;
		top: -35px;
		left: 115px
	}

	.failImg>img {
		width: 100%;
		height: 100%
	}

	.failContent {
		width: 290px;
		height: 248px;
		background: #fff;
		border-radius: 20px;
		margin: 5px;
		overflow: hidden;
		text-align: center;
		padding: 0 20px
	}

	.failContent>h2 {
		width: 100%;
		height: 40px;
		line-height: 40px;
		margin-top: 30px;
		font-size: 18px;
		color: #fe889d
	}

	.failContent>p {
		width: 100%;
		height: auto;
		margin-top: 50px;
		line-height: 30px;
		letter-spacing: 1px
	}

	.failContent>view {
		width: 100%;
		height: 40px;
		margin-top: 20px;
		display: flex;
		justify-content: space-between
	}

	.failContent>view>view {
		width: 120px;
		height: 100%;
		text-align: center;
		line-height: 40px;
		color: #fff;
		background: #4e51bf;
		border-radius: 15px
	}

	.rem {
		font-size: 500px
	}
</style>