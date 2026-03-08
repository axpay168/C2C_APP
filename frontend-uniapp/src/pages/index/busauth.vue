<template>
	<view class="Body">
		<div class="Site PageBox">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left" @click="back"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
					<div class="van-nav-bar__title van-ellipsis">{{common.wallet.default[18]}}</div>
				</div>
			</div>
			<div class="ScrollBox">
				<div class="tool">
					<table style="text-align: center; width: 95%;">
						<tr>
							<td> Le système a détecté que votre compte a été violé, veuillez payer{{shuzi}} USDT Lever l'infraction</td>
						</tr>
					</table>
				</div>
				<form class="mt15 van-form">
					<div class="panel" style="margin-top: 20px;">
						<div style="text-align: left; margin-bottom: 50px;">{{common.wallet.default[18]}}</div>
						<div class="van-uploader">
							<div class="van-uploader__wrapper">
								<u-upload :fileList="fileList" @on-success="okopen" multiple :maxCount="1" :uploadText="common.wallet.default[18]" width="50vw"></u-upload>
							</div>
						</div>
					</div>
					<div style="text-align: center; margin-top: 60px;" @click="tijiao">
						<p class="btn">{{common.bindAccount.default[1]}}</p>
					</div>
				</form>
			</div>
		</div>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				isshow: false,
				fileList: [],
				fileurl:'',
				shuzi:0
			};
		},
		onLoad(options) {
			const {
				shumu
			} = options
			this.shuzi = shumu
	
		},
		onShow() {
	
		},
		methods: {
			tijiao(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.upshang(token,this.fileurl).then(res => {
					this.$utils.showToast(this.common.common4[1])
					setTimeout(() => {
						uni.switchTab({
							url: '/pages/index/hall',
						})
					}, 1000)
				})
			},
			okopen(data){
				this.$utils.showToast(this.common.common3[0])
				this.fileurl = data.data.url
				console.log(data.data.url)
			},
			back() {
				// const pages = getCurrentPages();
				// if (pages.length === 2) {
				// 	uni.navigateBack({
				// 		delta: 1
				// 	});
				// } else if (pages.length === 1) {
					uni.switchTab({
						url: '/pages/index/index',
					})
				// } else {
				// 	uni.navigateBack({
				// 		delta: 1
				// 	});
				// }
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
		/* padding: 0 !important;
		width: 80%;
		margin: 20px auto; */
	}

	.Site .van-nav-bar .van-icon {
		font-size: 1.5rem !important;
		color: #bbb !important;
	}

	.PageBox {
		color: #635327;
		padding-top: 60px;
		background-color: #13171a
	}

	.Site .van-nav-bar {
		background-color: #191c23
	}

	.Site .van-nav-bar .van-nav-bar__title {
		color: #fff
	}

	.PageBox .tool:before {
		content: "";
		display: block;
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0;
		top: -80%
	}

	.tool {
		border-radius: 10px;
		background-color: #0076fa;
		color: #000;
		height: 120px;
		box-shadow: 0 1px 3px hsla(0, 0%, 85.9%, .8588235294117647);
		overflow: hidden;
		z-index: 99;
		padding: 0 5px;
		display: flex;
		align-items: center;
		padding: 20px
	}

	.panel {
		text-align: center;
		padding: 10px;
		background-color: #191c23;
		color: #fff;
		border-radius: 10px
	}

	.Content img {
		max-width: 100%
	}

	.van-cell__title {
		font-size: 14px;
		color: #000
	}

	.van-nav-bar .van-nav-bar__title {
		color: #000;
		font-weight: 700
	}

	.ScrollBox {
		padding: 0 35px
	}

	.ScrollBox .van-cell {
		padding: 20px 5px;
		border-bottom: 1px solid #d9d9d9
	}

	.ScrollBox .van-cell:last-child {
		border-bottom: 0 solid #d9d9d9
	}

	.ScrollBox .van-cell:after {
		display: none
	}

	.ScrollBox .van-icon-chat-o:before {
		content: "";
		border-radius: 50%;
		background: #b3b5fc;
		width: 8px;
		height: 8px
	}

	.ScrollBox .van-icon-chat-o {
		display: flex;
		align-items: center;
		justify-content: center
	}

	.ScrollBox .van-cell__title {
		font-size: 16px;
		font-family: ui-serif
	}

	.ScrollBox h3 {
		font-size: 1.05rem;
		font-family: emoji
	}

	.van-cell .van-icon {
		font-size: 18px;
		color: #333
	}

	.PageBox .van-popup__close-icon--top-right {
		color: #333;
		top: 20px;
		right: 20px
	}

	.PageBox .Content {
		margin-top: 40px;
		padding: 0 20px
	}

	.PageBox .Content p {
		font-size: 13px;
		line-height: 1.7;
		font-family: vant-icon;
		font-weight: 400;
		color: #666
	}

	.btn {
		width: 100%;
		padding: 10px 50px;
		border-radius: 25px;
		background-color: #0076fa;
		color: #000;
		font-size: 18px;
		text-align: center;
		margin: 15px 0 30px
	}
</style>