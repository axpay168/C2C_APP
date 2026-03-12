<template>
	<view class="Body">
		<div class="Main Site" style="overflow: visible;">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__left" @click="back"><i
							class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
					<div class="van-nav-bar__title van-ellipsis"></div>
				</div>
			</div>
			<div class="Site PageBox">
				<div class="van-nav-bar van-nav-bar--fixed">
					<div class="van-nav-bar__content">
						<div class="van-nav-bar__left" @click="back"><i
								class="van-icon van-icon-arrow-left van-nav-bar__arrow"><!----></i></div>
						<div class="van-nav-bar__title van-ellipsis">{{common.common4[0]}}</div>
					</div>
				</div>
				
				<div class="tool">
					<table style="text-align: center; width: 95%;color: #fff;">
						<tr>
							<td> {{common.sell.label[0]}}:{{userinfo.money != null ? userinfo.money : '0'}} USDT </td>
						</tr>
						<tr>
							<td> {{common.wallet.default[22]}}:{{((userinfo.money || 0) * (userinfo.baobl || 0)).toFixed(2)}} USDT</td>
						</tr>
						<tr>
							<td> {{address}} </td>
						</tr>
					</table>
				</div>
				
				<!-- <div style="margin: 60px auto 0px; width: 60%; text-align: center;"><button
						@click="dumprun('/pages/index/busauth')"
						class="van-button van-button--default van-button--large van-button--round"
						style="color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
						<div class="van-button__content"><span
								class="van-button__text"><span
									style="color: rgb(255, 255, 255);">违规{{common.recharge.label[4]}}</span></span></div>
					</button></div> -->
				
				
				
				<div class="ScrollBox">
					<form class="mt15 van-form">
						<div class="box">
							<div class="panel" style="margin-top: 20px;text-align: center;">
								<div class="van-uploader">
									<div class="van-uploader__wrapper">
										<u-upload :fileList="fileList" @on-success="okopen" multiple :maxCount="1" :uploadText="common.wallet.default[18]" width="50vw"></u-upload>
									</div>
								</div>
							</div>
							<div class="panel" style="margin-top: 20px;text-align: center;">
								<div class="van-uploader">
									<div class="van-uploader__wrapper">
										<u-upload :fileList="fileList1" @on-success="okopen1" multiple :maxCount="1" :uploadText="common.common4[5]" width="50vw"></u-upload>
									</div>
								</div>
							</div>
							<div class="panel" style="margin-top: 20px;text-align: center;">
								<div class="van-uploader">
									<div class="van-uploader__wrapper">
										<u-upload :fileList="fileList2" @on-success="okopen2" multiple :maxCount="1" :uploadText="common.common4[5]" width="50vw"></u-upload>
									</div>
								</div>
							</div>
							
							<div style="margin: 30px auto 0px; width: 60%; text-align: center;"><button
									@click="tijiao"
									class="van-button van-button--default van-button--large van-button--round"
									style="color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
									<div class="van-button__content"><span
											class="van-button__text"><span
												style="color: rgb(255, 255, 255);">{{common.bindAccount.default[1]}}</span></span></div>
								</button></div>
						</div>
						
					</form>
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
				bankname:'',
				userinfo: [],
				realname:'',
				banknum:'',
				mobile:'',
				userinfo:[],
				fileList: [],
				fileurl:'',
				fileList1: [],
				fileurl1:'',
				fileList2: [],
				fileurl2:'',
				address:'',
				isbind:0,
				submitting: false
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
	
		},
		methods: {
			getuserinfo(){
				const token = uni.getStorageSync('token')
				let that = this
				this.$u.api.index.getUserinfo(token).then(res => {
					if (!res || !res.data) return
					this.userinfo = res.data
					if (res.data.bank && res.data.bank.length > 0) {
						that.bankname = res.data.bank[0].bank_name
						that.realname = res.data.bank[0].name
						that.banknum = res.data.bank[0].card_no
						that.mobile = res.data.bank[0].bank_deposit
						that.isbind = 1
					} else {
						that.isbind = 0
					}
				}).catch(() => { that.userinfo = { money: 0, baobl: 0 } })
				this.$u.api.index.cointype(token).then(res => {
					if (res && res.data && res.data.length > 0 && res.data[0]) {
						this.address = res.data[0].caddre || ''
					}
				}).catch(() => {})
			},
			okopen(data){
				this.$utils.showToast(this.common.common3 && this.common.common3[0] ? this.common.common3[0] : 'Uploaded')
				this.fileurl = (data && data.data && data.data.url) ? data.data.url : ''
			},
			okopen1(data){
				this.$utils.showToast(this.common.common3 && this.common.common3[0] ? this.common.common3[0] : 'Uploaded')
				this.fileurl1 = (data && data.data && data.data.url) ? data.data.url : ''
			},
			okopen2(data){
				this.$utils.showToast(this.common.common3 && this.common.common3[0] ? this.common.common3[0] : 'Uploaded')
				this.fileurl2 = (data && data.data && data.data.url) ? data.data.url : ''
			},
			tijiao(){
				if (this.submitting) return
				const token = uni.getStorageSync('token')
				if (!token) {
					this.$utils.showToast(this.common.common4 && this.common.common4[8] ? this.common.common4[8] : 'Please login first')
					return
				}
				if (!this.fileurl || !this.fileurl1 || !this.fileurl2) {
					this.$utils.showToast('Please upload all 3 images (ID card + 2 proofs)')
					return
				}
				this.submitting = true
				uni.showLoading({ title: '...' })
				this.$u.api.index.bind_real(token, this.fileurl, this.fileurl1, this.fileurl2).then(res => {
					uni.hideLoading()
					this.submitting = false
					this.$utils.showToast(res.msg || (this.common.common4 && this.common.common4[1] ? this.common.common4[1] : 'Success'))
					setTimeout(() => { uni.navigateBack({ fail: () => { uni.switchTab({ url: '/pages/index/index' }) } }) }, 1500)
				}).catch(err => {
					uni.hideLoading()
					this.submitting = false
					this.$utils.showToast(err && err.msg ? err.msg : 'Submit failed')
				})
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
	    padding: 0 !important;
	}
	
	.Site .van-nav-bar .van-icon {
	    font-size: 1.5rem !important;
	    color: #bbb !important;
	}
	
	.PageBox {
	    color: #ccc;
		padding-top: 20px;
	    background-color: #13171a
	}
	
	.PageBox .box {
	    width: 95%;
	    padding: 10px 0 10px 10px;
	    font-size: 13px;
	    margin-top: 15px;
	    border-radius: 10px;
	    margin-left: 10px;
	    background-color: #191c23;
	    color: #ccc
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
		color: #fff;
		height: 120px;
		box-shadow: 0 1px 3px hsla(0, 0%, 85.9%, .8588235294117647);
		overflow: hidden;
		z-index: 99;
		padding: 0 5px;
		display: flex;
		align-items: center;
		padding: 20px
	}
	
	.van-nav-bar {
	    background-color: #191c23
	}
	
	.van-divider {
	    margin: 0
	}
	
	.van-nav-bar .van-nav-bar__title {
	    color: #ccc
	}
	
	.PageBox .van-cell {
	    background-color: #191c23
	}
	
	.van-cell .van-cell__title {
	    font-size: 16px;
	    width: 130px;
	    color: #ccc
	}
	
	.van-uploader .van-uploader__preview,.van-uploader .van-uploader__preview-image,.van-uploader .van-uploader__upload {
	    margin: 0;
	    background-color: #f7f8fa;
	    border-radius: 8px
	}
	
	.van-field {
	    font-weight: 700
	}
	
	.btn {
	    width: 85%;
	    padding: 10px 50px;
	    border-radius: 20px;
	    background-color: #0076fa;
	    color: #000;
	    font-size: 16px;
	    text-align: center;
	    margin: 15px 30px 30px
	}

</style>