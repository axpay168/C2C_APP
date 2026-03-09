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
						<div class="van-nav-bar__title van-ellipsis">{{common.userInfo.default[0]}}</div>
					</div>
				</div>
				<div class="ScrollBox">
					<div>
						<form class="mt15 van-form">
							<div class="van-cell van-cell--center van-cell--large">
								<div class="van-cell__title"><span>{{common.userInfo.default[1]}}</span></div>
								<div class="van-cell__value">
									<div class="userFace"><img
											:src="userinfo.avatar"></div>
								</div>
							</div>
							<div role="button" tabindex="0"
								class="van-cell van-cell--clickable van-cell--center van-cell--large">
								<div class="van-cell__title"><span>{{common.userInfo.default[15]}}</span></div>
								<div class="van-cell van-field" style="width: 150px;">
									<div class="van-cell__value van-cell__value--alone van-field__value">
										<div class="van-field__body2"><input type="text" :placeholder="common.userInfo.default[8]"
												class="van-field__control" v-model="nickname"></div>
									</div>
								</div>
							</div>
							<div class="van-cell van-cell--center van-cell--large">
								<div class="van-cell__title"><span>{{common.userInfo.default[2]}}</span></div>
								<div class="van-cell__value"><span>{{userinfo.username}}</span>
								</div>
							</div>
							<!-- <div class="van-cell van-cell--center van-cell--large">
								<div class="van-cell__title"><span>郵箱</span></div>
							</div> -->
							<div class="van-cell van-cell--center van-cell--large">
								<div class="van-cell__title"><span>{{common.userInfo.default[16]}}</span>
								</div>
								<div class="van-cell__value">{{userinfo.code}}</div>
							</div>
							<div role="button" tabindex="0"
								class="van-cell van-cell--clickable van-cell--center van-cell--large">
								<div class="van-cell__title"><span>{{common.userInfo.default[6]}}</span>
								</div>
								<div class="van-cell__value" @click="isshow = true"><span>{{common.userInfo.default[8]}}</span>
								</div><i
									class="van-icon van-icon-arrow van-cell__right-icon"></i>
							</div>
						</form>
					</div>
					<div style="text-align: center; margin-top: 20px;" @click="tijiao">
						<p class="btn">{{common.userInfo.default[12]}}</p>
					</div>
				</div><!----><!---->
			</div>
		</div>
		<u-popup v-model="isshow" mode="bottom" length="66%" contentBackgroundColor="#999">
			<view class="popup-list">
				<div role="button" tabindex="0"
					class="van-cell van-cell--clickable van-cell--center van-cell--large">
					<div class="van-cell__title"><span>{{common.userInfo.default[6]}}</span></div>
					<div class="van-cell van-field" style="width: 150px;">
						<div class="van-cell__value van-cell__value--alone van-field__value">
							<div class="van-field__body2"><input type="text" :placeholder="common.userInfo.default[8]"
									class="van-field__control" v-model="password"></div>
						</div>
					</div>
				</div>
				<div style="text-align: center; margin-top: 20px;" @click="gaimi">
					<p class="btn">{{common.userInfo.default[12]}}</p>
				</div>
			</view>
		</u-popup>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				isshow: false,
				userinfo:[],
				nickname:'',
				password:''
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
			gaimi(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.change_pwd(token,this.password).then(res => {
					this.$utils.showToast('success')
					this.isshow = false
				})
			},
			tijiao(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.upshang(token,this.nickname).then(res => {
					this.$utils.showToast('success')
					setTimeout(() => {
						this.back()
					}, 1000)
				})
			},
			getuserinfo(){
				const token = uni.getStorageSync('token')
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data
					this.nickname = res.data.nickname
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
	
	.van-nav-bar .van-nav-bar__title {
	    color: #ccc
	}
	
	.van-nav-bar .van-nav-bar__arrow {
	    color: #b5b5b5
	}
	
	.van-cell__left-icon {
	    width: 24px;
	    height: 24px;
	    margin-right: 10px
	}
	
	.van-icon__image {
	    width: 100%;
	    height: 100%
	}
	
	.van-cell__title {
	    font-size: 14px;
	    color: #000
	}
	
	.ScrollBox {
	    padding: 0 0;
	    color: #ccc
	}
	
	.ScrollBox .van-cell {
	    border-bottom: 1px solid #d9d9d9;
	    background-color: #191c23
	}
	
	.ScrollBox .van-cell:after {
	    display: none
	}
	
	.ScrollBox .van-cell__title {
	    font-size: 14px;
	    font-family: Alibaba;
	    font-weight: 400;
	    color: #ccc
	}
	
	.ScrollBox .van-cell__value {
	    display: flex;
	    color: #ccc;
	    justify-content: flex-end
	}
	
	.ScrollBox .userFace {
	    width: 75px;
	    height: 75px;
	    background: #eff0f2;
	    border-radius: 50%;
	    padding: 6px;
	    overflow: hidden
	}
	
	.ScrollBox .userFace img {
	    width: 100%
	}
	
	.ScrollBox .isTrue {
	    color: #333;
	    padding-right: 20px
	}
	
	.van-cell:nth-child(4) .van-cell__left-icon img {
	    transform: scale(1.1)
	}
	
	.ScrollBox .van-cell__value {
	    font-size: 15px
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