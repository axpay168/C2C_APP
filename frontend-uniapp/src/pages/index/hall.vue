<template>
	<view class="Body" style="width:100%; min-height: 100%;">
		<div class="Site PageBox" style="width:100%; min-height: 100%; height: auto;">
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__title van-ellipsis">{{common.hall.default[0]}}</div>
					<!-- <div class="van-nav-bar__right" @click="dumprun('/pages/setting/userTaskRecord')"><i
							class="van-icon"><img src="../../static/image/news/task00.png"
								class="van-icon__image"></i></div> -->
				</div>
			</div>
			<div class="tool">
				<table style="text-align: center; width: 100%; line-height: 25px; font-size: 18px; padding: 5px;">
					<tr>
						<td style="text-align: center;">
							<div style="font-size: 15px;color: white;"> {{common.buy.label[0]}}</div>
						</td>
					</tr>
					<tr>
						<td style="text-align: center;">
							<div style="font-size: 18px;color: white;">{{userinfo.money}}</div>
						</td>
					</tr>
					<tr>
						<td style="text-align: center;">
							<div style="font-size: 15px;color: white;"> {{common.hall.default[8]}}:USDT</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: left;">
							<div style="margin-top: 10px; text-align: center;"><button
									class="van-button van-button--default van-button--min"
									@click="dumprun('/pages/index/buy')"
									style="width: 120px; height: 32px;border-radius: 20px; color: rgb(255, 255, 255); background: #0076fa;border: 1px solid #ebedf0;">
									
									<div class="van-button__content"><span class="van-button__text"><span style="font-size: 13px; color: rgb(255, 255, 255);">
												{{common.hall.default[2]}}</span></span></div>
								</button>
								<!-- <button class="van-button van-button--default van-button--min"
									@click="dumprun('/pages/index/sell')"
									style="width: 120px; height: 32px; border-radius: 20px; color: rgb(255, 255, 255); background: rgb(240, 184, 13); border-color: rgb(240, 184, 13);">
									<div class="van-button__content"><span class="van-button__text"><span
												style="font-size: 13px; color: rgb(0, 0, 0);"> {{common.hall.default[3]}}</span></span></div>
								</button> -->
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="hallswipe van-swipe">
				<!-- <div class="van-swipe__track van-swipe__track--vertical"> -->
				<div class="van-swipe-item" style="display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;">

					<view class="" style="width: 10%;">
						<img src="../../static/image/news/USDT.png" class="robotheader">
					</view>

					<div style="overflow: hidden;
    margin-left: 10px;
    width: 90%;
    line-height: 100%;
    white-space: nowrap;"> {{rolist.username}}
						{{common.hall.default[10]}}
						{{rolist.amount}}USDT {{rolist.time}}{{common.common5[1]}}{{common.common5[2]}}
					</div>
				</div>
				<!-- </div> -->
			</div>
			<div class="hallswipe van-swipe">
				<!-- <div class="van-swipe__track van-swipe__track--vertical"> -->
				<div class="van-swipe-item" style="display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;">
					<view class="" style="width: 10%;">
						<img src="../../static/image/news/USDT.png" class="robotheader">
					</view>
					<div style="overflow: hidden;
    margin-left: 10px;
    width: 90%;
    line-height: 100%;
    white-space: nowrap;"> {{rolist1.username}}
						{{common.hall.default[10]}}
						{{rolist1.amount}}USDT {{rolist1.time}}{{common.common5[1]}}{{common.common5[2]}}
					</div>
				</div>
				<!-- </div> -->
			</div>
			<div class="hallswipe van-swipe">
				<!-- <div class="van-swipe__track van-swipe__track--vertical"> -->
				<div class="van-swipe-item" style="display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;">
					<view class="" style="width: 10%;">
						<img src="../../static/image/news/USDT.png" class="robotheader">
					</view>
					<div style="overflow: hidden;
    margin-left: 10px;
    width: 90%;
    line-height: 100%;
    white-space: nowrap;"> {{rolist2.username}}
						{{common.hall.default[10]}}
						{{rolist2.amount}}USDT {{rolist2.time}}{{common.common5[1]}}{{common.common5[2]}}
					</div>
				</div>
				<!-- </div> -->
			</div>
			<div class="title01">
				<div class="van-grid" style="padding-left: 5px;">
					<div class="van-grid-item" style="flex-basis: 50%; padding-right: 5px;">
						<div class="van-grid-item__content van-grid-item__content--center"><button @click="qieh(1)"
								class="van-button van-button--default van-button--normal"
								:class="xtype == 2 ? '' : 'tt3'"
								style="color: rgb(255, 255, 255); border-color: #0076fa;"
								:style="xtype == 2 ? 'background: rgb(37, 45, 48)' : 'background: #0076fa'">
								<div class="van-button__content"><span class="van-button__text"><span
											class="tt3">{{common.hall.default[6]}}</span></span>
								</div>
							</button></div>
					</div>
					<div class="van-grid-item" style="flex-basis: 50%; padding-right: 5px;">
						<div class="van-grid-item__content van-grid-item__content--center"><button @click="qieh(2)"
								class="van-button van-button--default van-button--normal"
								:class="xtype == 1 ? '' : 'tt3'"
								style="color: rgb(255, 255, 255); border-color: #0076fa;"
								:style="xtype == 1 ? 'background: rgb(37, 45, 48)' : 'background: #0076fa'">
								<div class="van-button__content"><span class="van-button__text"><span class="">
											{{common.hall.default[7]}}</span></span>
								</div>
							</button></div>
					</div>
				</div>
			</div>
			<div class="ScrollBox records" style="height: auto;">
				<div class="van-pull-refresh">
					<div class="van-pull-refresh__track" style="transition-duration: 0ms; height: auto;">
						<div class="van-pull-refresh__head"></div>
						<div role="feed" class="van-list" aria-busy="true">

							

							<div class="records" style="width: 100%;" v-for="item in list">
								<table class="sellitem">
									<tr>
										<td style="color: rgb(255, 255, 255); width: 50%;"> {{item.username}}</td>
										<td> {{common.hall.list[0]}} {{item.shuliang}} USDT</td>
									</tr>
									<tr>
										<td> {{common.hall.list[1]}} {{item.danjia}}</td>
										<td> {{common.hall.list[2]}} {{item.shengyu}} USDT</td>
									</tr>
									<tr>
										<td> {{common.hall.list[6]}} {{item.mine}}-{{item.maxe}} USDT</td>
										<td style="text-align: right;"><button @click="dakai(item.id,item.danjia)"
												class="van-button van-button--default van-button--normal"
												style="width: 80px; height: 28px; color: rgb(255, 255, 255); background: rgb(0, 118, 250); border-color: rgb(0, 118, 250);">
												<div class="van-button__content"><span class="van-button__text">
														<span
															style="font-size: 14px;">{{common.hall.default[10]}}</span></span>
												</div>
											</button></td>
									</tr>
								</table>
							</div>

							<div class="van-list__finished-text">{{common.vanPull[0]}}</div>
							<div class="van-list__placeholder"></div>
						</div>

						<div role="dialog" :aria-labelledby="common.hall.list[3]" class="van-dialog"
							style="z-index: 2007;" v-if="isshow">
							<div class="van-dialog__header">{{common.hall.list[3]}}</div>
							<div class="van-dialog__content">
								<div style="width: 90%; margin-top: 10px; margin-bottom: 30px;">
									<div class="van-cell van-field" style="margin-left: 20px;">
										<div class="van-cell__value van-cell__value--alone van-field__value">
											<div class="van-field__body"><input type="text"
													:placeholder="common.hall.list[4]" class="van-field__control"
													v-model="ushu"></div>
										</div>
									</div>
									<div style="margin-left: 30px; margin-top: 10px;">
										{{common.hall.list[5]}}:{{(ushu*shijia).toFixed(2)}} EUR
									</div>
								</div>
							</div>
							<div class="van-hairline--top van-dialog__footer"><button @click="isshow = false"
									class="van-button van-button--default van-button--large van-dialog__cancel">
									<div class="van-button__content"><span
											class="van-button__text">{{common.common[3]}}</span></div>
								</button>
								<button @click="chushou"
									class="van-button van-button--default van-button--large van-dialog__confirm van-hairline--left">
									<div class="van-button__content"><span
											class="van-button__text">{{common.common[2]}}</span></div>
								</button></div>
						</div>

					</div>
					<!-- <div style="height: 200000px;"></div> -->
				</div>

			</div>
		</div>
		<div style="height: 100px;"></div>
	</view>



</template>

<script>
	export default {
		data() {
			return {
				isshow: false,
				xtype: 1,
				ushu: '',
				list: [],
				userinfo: [],
				rolist: [],
				rolist1: [],
				rolist2: [],
				secondsInterval: null,
				seconds: 15,
				shijia: '',
				danjia: '',
				orderid: ''
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getlist()
			this.getrobot()
			let that = this
			this.$u.api.index.shoujia().then(res => {
				that.shijia = res.data.shoujia
			})

		},
		onShow() {
			this.getuserinfo()

			const token = uni.getStorageSync('token')
			this.$u.api.index.isotcsell(token).then(res => {
				if (res.msg == 'weigui') {
					this.dumprun('/pages/index/busauth?shumu=' + res.data)
				} else if (res.msg == 'jutishi') {
					this.dumprun('/pages/setting/bindinfo')
				} else {

				}
			})
			
			this.substring();
		},
		methods: {
			
			substring(){
				// 2、js截取某个字符串前面的内容：
				var str = "hardnosed@gmail.com";
				str = str.match(/(\S*)@/)[1];
				console.log(str);//结果aaabbbcccdddeee
				
				// 3、js截取某个字符串后面的内容：
				var str = "hardnosed@gmail.com";
				str = str.match(/@(\S*)/)[1];
				console.log(str);//结果bbbcccdddeeefff
				
			},
			
			dakai(id, danjia) {
				this.orderid = id
				this.danjia = danjia
				this.shijia = danjia
				this.isshow = true
			},
			getuserinfo() {
				const token = uni.getStorageSync('token')
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data
				})
			},
			getrobot() {
				const token = uni.getStorageSync('token')
				this.$u.api.index.robot(token).then(res => {
					// console.log(res)
					this.rolist = res.data[0]
					this.rolist1 = res.data[1]
					this.rolist2 = res.data[2]
					this.secondsInterval = setInterval(() => {
						this.seconds = this.seconds - 1
						if (this.seconds == 0) {
							this.seconds = 15
							this.rolist = res.data[this.seconds]
							this.rolist1 = res.data[this.seconds + 1]
							this.rolist2 = res.data[this.seconds - 1]
						} else {
							this.rolist = res.data[this.seconds]
							this.rolist1 = res.data[this.seconds + 1]
							this.rolist2 = res.data[this.seconds - 1]
						}
					}, 3000)
				})
			},
			getlist() {
				const token = uni.getStorageSync('token')
				if (this.xtype == 1) {
					this.$u.api.index.datings(token).then(res => {
						this.list = res.data
					})
				} else {
					this.$u.api.index.dating(token, 1).then(res => {
						console.log(res.data)
						this.list = res.data
					})
				}
			},
			qieh(data) {
				this.xtype = data
				this.getlist()
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
			chushou() {
				let that = this
				// const token = uni.getStorageSync('token')
				// this.$u.api.index.isups(token).then(res => {
				// 	if(res.data == 1){
				that.chus()
				// 	}else{
				// 		that.$utils.showToast(this.common.busAuth2[5])
				// 	}
				// })
			},
			chus() {
				const token = uni.getStorageSync('token')
				this.$u.api.index.otcsell(token, this.orderid, this.ushu, this.danjia).then(res => {
					this.$utils.showToast('success')
					this.isshow = false
					this.getuserinfo()
				})
			},
			dumprun(url) {
				// if (url == '/pages/index/buy') {
				// let that = this
				// const token = uni.getStorageSync('token')
				// this.$u.api.index.isups(token).then(res => {
				// 	if(res.data == 1){
				// 		uni.navigateTo({
				// 			url
				// 		})
				// 	}else{
				// that.$utils.showToast(this.common.busAuth2[5])
				// 	}
				// })
				// } else {
				uni.navigateTo({
					url
				})
				// }
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

	.head {
		margin-top: 0 !important;
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-nav-bar .van-nav-bar__title {
		color: #ccc;
		font-weight: 700
	}

	.robotheader {
		font-size: 19px;
		border-radius: 50%;
	
		overflow: hidden;
		width: 32px;
		height: 32px
	}

	.href {
		color: #ad890c
	}

	.records {
		background: #191c23;
		width: 95%;
		margin: auto;
		border-radius: 10px;
		color: #9b9b9b;
		margin-bottom: 10px;
		padding: 10px
	}

	.Content img {
		max-width: 100%
	}

	.van-cell__title {
		font-size: 14px;
		color: #000
	}

	.itemDesc {
		border: 2px solid #0076fa;
		width: 36px;
		height: 36px;
		font-size: 12px;
		margin-left: 120px;
		text-align: center;
		background-color: #191c23;
		color: #fff;
		border-radius: 50%
	}

	.PageBox .van-grid-item__content {
		padding: 10px !important;
		display: flex;
		color: #ccc;
		background-color: #191c23
	}

	.PageBox .van-grid-item__text {
		color: #ccc
	}

	.PageBox .van-dialog {
		background-color: #191c23;
		color: #aaa
	}

	.PageBox .van-dialog__confirm {
		background-color: #191c23;
		color: #13c465
	}

	.van-dialog .van-cell {
		background: #353c4a;
		color: #fff
	}

	.van-dialog .van-field__control {
		background-color: #353c4a;
		color: #fff
	}

	.PageBox .van-dialog__cancel {
		background-color: #191c23;
		color: #ccc
	}

	.title00 {
		background: #fdead9;
		width: 95%;
		color: #000;
		margin: auto;
		font-weight: 700;
		line-height: 40px;
		text-align: center
	}

	.MyHeader {
		font-size: 19px;
		border-radius: 50%;
		background: pink;
		overflow: hidden;
		width: 52px;
		height: 52px
	}

	.MyHeader img {
		width: 100%
	}

	.title01 {
		background: #191c23;
		width: 95%;
		color: #000;
		margin: auto;
		font-weight: 700;
		line-height: 40px;
		text-align: center;
		margin-bottom: 10px
	}

	.sellitem {
		background-color: #191c23;
		width: 95%;
		text-align: left;
		color: #9b9b9b;
		font-size: 15px;
		margin-bottom: 10px;
		line-height: 22px;
		margin-top: 10px;
		border-radius: 10px
	}

	.PageBox .tool:before {
		display: block;
		width: 100%;
		height: 100%;
		position: absolute;
		left: 0;
		top: -80%
	}

	.tool {
		height: 140px;
		border-radius: 10px;
		color: #fff;
		background-color: #0076fa;
		overflow: hidden;
		z-index: 99;
		/* padding: 0 5px; */
		display: flex;
		align-items: center;
		margin: 10px 5px;
		/* margin-left: 5px;
		margin-top: 10px;
		margin-bottom: 10px;
		padding: 10px */
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
		background: #191c23;
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

	.hallswipe {
		/* width: 96%; */
		/* margin-left: 6px; */
		margin: 5px;
		padding: 15px;
		height: 60px;
		z-index: 50;
		/* margin-top: 5px;
		margin-bottom: 5px; */
		color: #ccc;
		background-color: #191c23
		/* background-color: antiquewhite; */
	}

	.ScrollBox .van-tab :first-of-type div {
		background-color: #000;
		padding: 5px;
		border: 1px solid;
		border-radius: 20px;
		color: #fff
	}

	.ScrollBox .van-tab--active :first-of-type div,
	.ScrollBox .van-tab--active :first-of-type div div {
		background-color: #f5c73a;
		padding: 5px;
		border-radius: 20px;
		color: #000
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
</style>