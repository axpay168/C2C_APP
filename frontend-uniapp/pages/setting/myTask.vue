<template>
	<view class="Body">
		<div class="Site PageBox">
		
			<div class="van-nav-bar van-nav-bar--fixed">
				<div class="van-nav-bar__content">
					<div class="van-nav-bar__title van-ellipsis">{{common.task.default[0]}}</div>
				</div>
			</div>
			<div class="ScrollBox">
				<div class="van-tabs van-tabs--line" z-index="99" icon-size="80">
					<div class="van-tabs__wrap">
						<div role="tablist" class="van-tabs__nav van-tabs__nav--line"
							style="background: rgb(25, 28, 35);">
							<div role="tab" class="van-tab" @click="qieb(0)"
								:class="zhuangtai == 0 ? 'van-tab--active' : ''"
								:style="zhuangtai == 0 ? 'color: rgb(128, 188, 255)' : 'color: rgb(204, 204, 204)'">
								<span class="van-tab__text van-tab__text--ellipsis">{{common.task.tabs[0]}}</span></div>
							<div role="tab" class="van-tab" @click="qieb(1)"
								:class="zhuangtai == 1 ? 'van-tab--active' : ''"
								:style="zhuangtai == 1 ? 'color: rgb(128, 188, 255)' : 'color: rgb(204, 204, 204)'">
								<span class="van-tab__text van-tab__text--ellipsis">{{common.task3[1]}}</span></div>
							<div role="tab" class="van-tab" @click="qieb(3)"
								:class="zhuangtai == 3 ? 'van-tab--active' : ''"
								:style="zhuangtai == 3 ? 'color: rgb(128, 188, 255)' : 'color: rgb(204, 204, 204)'">
								<span class="van-tab__text van-tab__text--ellipsis">{{common.task.tabs[2]}}</span></div>
							<div role="tab" class="van-tab" @click="qieb(2)"
								:class="zhuangtai == 2 ? 'van-tab--active' : ''"
								:style="zhuangtai == 2 ? 'color: rgb(128, 188, 255)' : 'color: rgb(204, 204, 204)'">
								<span class="van-tab__text van-tab__text--ellipsis">{{common.task3[2]}}</span></div>
							<!-- <div class="van-tabs__line" style="transform: translateX(65px) translateX(150%);"></div> -->
						</div>
					</div>
					<div class="van-tabs__content"><!----><!----><!----></div>
				</div>
				<div class="van-pull-refresh">
					<div class="van-pull-refresh__track" style="transition-duration: 0ms;">
						<div class="van-pull-refresh__head"></div>
						<div role="feed" class="van-list" v-if="xuanz == 0 && zhuangtai == 0">
							<div class="FundItem van-cell van-cell--borderless" v-for="item in list">
								<div class="van-cell__value van-cell__value--alone">
									<!-- rgb(118, 119, 121); -->
									<div style="color: #fff;">
										<div style="color: #fff;">{{common.common6[1]}}:
											T{{item.addtime}}</div>
										<div>{{common.sell.label[6]}}: {{item.money}}</div>
										<div>{{common.mytask2[1]}}: {{item.danjia}} EUR </div>
										<div>{{common.mytask2[2]}}: {{item.danjia * item.money}} EUR </div>
										<div>{{common.common6[4]}}: 
											<span v-if="item.status == 0">{{common.task.tabs[5]}}</span>
											<span v-if="item.status == 1">{{common.task.tabs[3]}}</span>
											<span v-if="item.status == 2">{{common.task.tabs[2]}}</span>
											{{common.mytask2[5]}}: {{item.addtime_text}}
										</div>
									</div>
								</div>
							</div>
							<div class="van-list__placeholder"></div>
						</div>
						<div role="feed" class="van-list" v-if="xuanz == 0 && zhuangtai == 1">
							<div class="FundItem van-cell van-cell--borderless" v-for="item in list"  v-if="item.status == 0">
								<div class="van-cell__value van-cell__value--alone">
									<div style="color: #fff;">
										<div style="color: #fff;">{{common.common6[1]}}:
											T{{item.addtime}}</div>
										<div>{{common.sell.label[6]}}: {{item.money}}</div>
										<div>{{common.mytask2[1]}}: {{item.danjia}} EUR </div>
										<div>{{common.mytask2[2]}}: {{item.danjia * item.money}} EUR </div>
										<div>{{common.common6[4]}}: 
											<span v-if="item.status == 0">{{common.task.tabs[5]}}</span>
											<span v-if="item.status == 1">{{common.task.tabs[3]}}</span>
											<span v-if="item.status == 2">{{common.task.tabs[2]}}</span>
											{{common.mytask2[5]}}: {{item.addtime_text}}
										</div>
									</div>
								</div>
							</div>
							
							<div class="van-list__placeholder"></div>
						</div>
						<div role="feed" class="van-list" v-if="xuanz == 0 && zhuangtai == 2">
							<div class="FundItem van-cell van-cell--borderless" v-if="item.status == 1" v-for="item in list">
								<div class="van-cell__value van-cell__value--alone">
									<div style="color: #fff;">
										<div style="color: #fff;">{{common.common6[1]}}:
											T{{item.addtime}}</div>
										<div>{{common.sell.label[6]}}: {{item.money}}</div>
										<div>{{common.mytask2[1]}}: {{item.danjia}} EUR </div>
										<div>{{common.mytask2[2]}}: {{item.danjia * item.money}} EUR </div>
										<div>{{common.common6[4]}}: 
											<span v-if="item.status == 0">{{common.task.tabs[5]}}</span>
											<span v-if="item.status == 1">{{common.task.tabs[3]}}</span>
											<span v-if="item.status == 2">{{common.task.tabs[2]}}</span>
											{{common.mytask2[5]}}: {{item.addtime_text}}
										</div>
									</div>
								</div>
							</div>
							<div class="van-list__placeholder"></div>
						</div>
						<div role="feed" class="van-list" v-if="xuanz == 0 && zhuangtai == 3">
							<div class="FundItem van-cell van-cell--borderless" v-if="item.status == 2" v-for="item in list">
								<div class="van-cell__value van-cell__value--alone">
									<div style="color:#fff;">
										<div style="color: #fff;">{{common.common6[1]}}:
											T{{item.addtime}}</div>
										<div>{{common.sell.label[6]}}: {{item.money}}</div>
										<div>{{common.mytask2[1]}}: {{item.danjia}} EUR </div>
										<div>{{common.mytask2[2]}}: {{item.danjia * item.money}} EUR </div>
										<div>{{common.common6[4]}}: 
											<span v-if="item.status == 0">{{common.task.tabs[5]}}</span>
											<span v-if="item.status == 1">{{common.task.tabs[3]}}</span>
											<span v-if="item.status == 2">{{common.task.tabs[2]}}</span>
											{{common.mytask2[5]}}: {{item.addtime_text}}
										</div>
									</div>
								</div>
							</div>
							<div class="van-list__placeholder"></div>
						</div>
						<div role="feed" class="van-list"
							v-if="xuanz == 1 && zhuangtai == 0 || xuanz == 1 && zhuangtai == 2">
							<div class="FundItem van-cell van-cell--borderless" v-for="item in list">
								<div class="van-cell__value van-cell__value--alone">
									<div style="color: #fff;">
										<table>
											<tr>
												<td width="65%"><span
														style="color: rgb(15, 203, 129);">{{common.hall4[7]}}
														USDT</span></td>
												<td style="text-align: right;color: #bbb !important;">
													<span>{{common.task3[2]}}</span></td>
											</tr>
											<tr style="color: #bbb !important;">
												<td width="60%"> {{common.hall.list[1]}}: {{item.maijia}} EUR </td>
												<td> {{item.addtime_text}} </td>
											</tr>
											<tr style="color: #bbb !important;">
												<td width="60%"> {{common.hall.list[0]}}: {{item.mainum}} USDT </td>
												<td> {{item.maijia * item.mainum}} EUR </td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="van-list__placeholder"></div>
						</div>
					</div>
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
				xuanz: 0,
				zhuangtai: 0,
				list: []
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getlist()
		},
		onShow() {

		},
		methods: {
			getlist() {
				const token = uni.getStorageSync('token')
				if (this.xuanz == 0) {
					this.$u.api.index.getdtrecod(token).then(res => {
						this.list = res.data
					})
				} else {
					this.$u.api.index.getsell(token).then(res => {
						this.list = res.data
					})
				}
			},
			qiea(data) {
				this.xuanz = data
				this.getlist()
			},
			qieb(data) {
				this.zhuangtai = data
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
		padding-top: 55px;
		background-color: #13171a
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-nav-bar .van-nav-bar__title {
		color: #ccc
	}

	.van-nav-bar .van-nav-bar__arrow {
		color: #b5b5b5
	}

	.van-cell__title.record>p {
		margin-bottom: 5px
	}

	.van-tabs__nav {
		background-color: #8c60f1
	}

	.van-cell {
		margin-top: 5px;
		color: #aaa
	}

	.linkinfo {
		margin-left: -5px;
		text-indent: 5px
	}

	.linkinfo a:link {
		color: #ff8a00
	}

	.van-pull-refresh {
		min-height: calc(100vh - 90px)
	}

	.TaskItem {
		padding: 20px 10px;
		box-shadow: 0 0 3px #ccc
	}

	.TaskItem .van-cell__title {
		line-height: 25px
	}

	.item_title h4 {
		font-size: 13px;
		font-family: emoji
	}

	.FundItem {
		width: 100%;
		background-color:rgb(25 28 35);
	color: #eee !important; 
		margin: auto;
		margin-bottom: 5px;
		margin-top: 0px;
		padding-bottom: 15px;
		border-radius: 8px
	}

	.TaskItem .va .TaskItem .van-cell__value {
		overflow: visible
	}

	.van-list {
		overflow: hidden
	}

	.van-list .mygrid {
		padding: 0
	}

	.van-list .icon a {
		width: 2.6rem;
		height: 2.6rem
	}

	.Site .van-tabs__nav {
		background: #fffaef
	}

	.TaskItem .post>p,
	.TaskItem .record>p {
		color: #444;
		font-size: 12px;
		font-family: emoji;
		margin-top: 5px
	}

	.item_title {
		margin-bottom: 15px;
		display: flex;
		flex-wrap: wrap
	}

	.goPage {
		margin-top: 15px !important
	}

	.goPage a {
		color: #4e51bf !important
	}

	.ScrollBox .van-cell__value {
		margin-top: -3px
	}

	.ScrollBox .van-uploader__upload {
		background-color: #e3e6f2;
		border-radius: 4px
	}

	.ScrollBox .uploader_img .van-icon:before {
		display: none
	}

	.van-grid-item__content {
		padding: 10px !important;
		display: flex;
		background-color: #191c23
	}

	.ScrollBox .uploader_img .van-icon {
		background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADEAAAAsCAYAAADM1FBZAAADDUlEQVRogd3aTagVdRjH8c8Zbze8RQZx9SopvSwye1nIpRIUicBVtZBKQkySInRTUSS4iUTaBLloWUlK9KoGIb1YCUEFQQuhVBBpkWAktkjIulba4jkHx7lzzsyZc5sz+YW7mP/L839+M/+X5/mf29r90SEpFuERLMNctDSHP/Aj9mEPznUqRlKNnsU2XF6ra/2xXLzk77BGiJK0KzfjJc0WkGYSX2IB8SVuFl8gzV84Xq9fhVyBeanna8WLXzuCx108rfZjLU7V5l55VuNNzG4/r8HTCe5INfob6zRTAOzF66nnWZhMcFWq8HecrNOrChzJPF+d5DZrNuezBSN5rYbEKFbiepzAAZwp07EpIpaKA+y6VNnPYn1+UdS5CdNpLj5xsQCYjw9xU5GBJoh4AuNd6sbwZJGBJoi4raD+1iIDTRBRdCb9WmSgCSLeKqh/r8hAE0R8ha1d6nbgnSIDTdlin8c3eBQ34Cfh/O4yncuKaGEVHmgPcrw9wL4+ne3Fp+2/vikj4hq8gXsz5evxPh7D6SqDzxRFa2JczNmsgA4P4lvTD6pa6SViVJyYiwtsLBbz+faZcqpfeol4EXeVtDMfn2PJwB5VoNuaWIan+rQ1js9EJHqsgi834j6xcZzEBzjUs0ebPBEjeFVkTf2yQESdK8Q2WYZ52C5SzfTMeAEv4zk5OUSavOm0AbeUdCCPRfgYc0q0XYnv8XCOL4m4RnpNwQvNdrxMvIFBWSLyg16DrxaXEt0i2A4b8EqvBlkRY5goMFqWe3oMfj/eFjtgGTZiS7fK/zp22ohNmbI79SegwzYhfhp1BIDbXdiqJ8SuM1bBTgu75KzXOkSMinB6Au+KM6Uqc0z/srVFsQvxg4jDBmXaTX2d+cRMCMilCUnRwFwyIpqS3VUmUS1GahQJpobtxKAkODtsJwZkKsHRYXsxIIcTcYr+XzmII4nIo/cP2ZkqnMMzxJo4j4fw9TA96pMpkWcc4MJh9xvuFtfopfLaIXFGJFuT2NkpbGX+LaLDleLHjybxJ37BP9mKfwG37XP02t2knwAAAABJRU5ErkJggg==) no-repeat;
		width: 17px;
		height: 17px;
		background-size: 100%
	}

	.TaskItem .van-button {
		width: 73px !important
	}

	.van-uploader .van-uploader__input-wrapper button {
		width: 65px;
		padding: 5px 0;
		border-radius: 10px;
		height: auto;
		font-size: 13px;
		background: #4e51bf
	}

	.van-uploader {
		margin-top: 30px
	}

	.orderList {
		width: 100%;
		height: auto;
		background: transparent;
		margin-bottom: 15px
	}

	.order {
		width: 100%;
		height: 115px;
		box-shadow: 1px 1px 5px rgba(0, 0, 0, .2);
		border-radius: 10px;
		display: flex;
		padding: 10px;
		background: #8c60f1
	}

	.orderLeft {
		flex-grow: 1;
		border-right: 1.5px solid #af9bf4;
		padding-right: 10px
	}

	.orderLeft>img {
		display: block;
		width: 45px;
		height: 45px;
		margin: 22.5px auto;
		border-radius: 50%;
		background: #fff;
		padding: 10px;
		box-sizing: content-box
	}

	.orderRight {
		display: flex;
		justify-content: space-around;
		align-items: center;
		flex-grow: 5;
		padding-left: 10px
	}

	.orderRight>button {
		height: 55px;
		border-radius: 5px;
		border: none
	}
</style>