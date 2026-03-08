<template>
	<view class="Body">
		<view class="PageBox">
			<view class="logo">
				{{i18n.home.label[0]}}
			</view>
			<view class="ScrollBoxre loginpanel">
				<view class="regType" v-if="regtype == 1">
					<h2>{{i18n.register2[0]}}</h2>
					<view style="margin: 0px auto; text-align: right; width: 50%;">
						<button type="button" @click="regtype = 2" class="van-button van-button--default van-button--mini"
							style="font-size: 20px; color: rgb(255, 255, 255); background: rgb(19, 23, 26); border-color: rgb(19, 23, 26);">
							<view class="van-button__content">
								<span class="van-button__text">{{i18n.register2[1]}}</span>
							</view>
						</button>
					</view>
				</view>
				<view class="regType" v-if="regtype == 2">
					<button type="button" @click="regtype = 1" class="van-button van-button--default van-button--mini"
						style="font-size: 20px; color: rgb(255, 255, 255); background: rgb(19, 23, 26); border-color: rgb(19, 23, 26);">
						<view class="van-button__content">
							<span class="van-button__text">{{i18n.register2[0]}}</span>
						</view>
					</button>
					<view style="margin: 0px auto; text-align: right; width: 50%;">
						<h2>{{i18n.register2[1]}}</h2>
					</view>
				</view>

				<view class="van-cell van-field" style="height: 0px; width: 0px; padding: 0px; position: absolute;">
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<input type="text" autocomplete="off" class="van-field__control">
						</view>
					</view>
				</view>
				<view class="van-cell van-field" style="height: 0px; width: 0px; padding: 0px; position: absolute;">
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<input type="password" autocomplete="off" class="van-field__control">
						</view>
					</view>
				</view>

				<view class="van-cell van-cell--borderless van-field" v-if="regtype == 1">
					<view class="van-field__left-icon">
						<i class="van-icon">
							<image src="../../static/image/news/user.png" mode="widthFix" class="van-icon__image"></image>
						</i>
					</view>
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<view class="van-field__control van-field__control--custom">
								<input :placeholder="i18n.register.placeholder[0]" v-model="usestring"
									style="border: 0px; flex: 1 1 0%; width: 100px; background: transparent;">
							</view>
						</view>
					</view>
				</view>
				<view class="van-cell van-cell--borderless van-field" v-if="regtype == 2">
					<view class="van-field__left-icon">
						<i class="van-icon van-icon-tel"></i>
					</view>
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<view class="van-field__control van-field__control--custom">
								<view class="van-dropdown-menu">
									<view class="van-dropdown-menu__bar" @click="dumprun('/pages/common/area')">
										<view class="van-dropdown-menu__item">
											<span class="van-dropdown-menu__title">
												<view class="van-ellipsis">
													{{area_code}}
												</view>
											</span>
										</view>
									</view>
									<view class="van-dropdown-item van-dropdown-item--down" style="top: 0px; display: none;">
										
									</view>
								</view>
								<input type="tel" :placeholder="i18n.register2[2]" v-model="usestring"
									style="border: 0px; flex: 1 1 0%; width: 100px; background: transparent;">
							</view>
						</view>
					</view>
				</view>
		<!-- 		<view class="van-cell van-cell--borderless van-field">
					<view class="van-field__left-icon">
						<i class="van-icon">
							<image src="../../static/image/news/smscode.png" mode="widthFix" class="van-icon__image"></image>
						</i>
					</view>
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<input type="tel" v-model="code" inputmode="numeric" autocomplete="off" :placeholder="i18n.register.placeholder[1]"
								class="van-field__control">
							<view class="van-field__button">
								<button type="button" @click="huoqu"
									class="van-button van-button--default van-button--mini van-button--round"
									style="margin-right: -30px; color: rgb(255, 255, 255); background: rgb(173, 137, 12); border-color: rgb(173, 137, 12);">
									<view class="van-button__content"><span class="van-button__text" v-if="!hasSend">{{i18n.register.text[2]}}</span><span class="van-button__text" v-else>{{seconds}}s</span></view>
								</button>
							</view>
						</view>
					</view>
				</view> -->
				<view class="van-cell van-cell--borderless van-field">
					<view class="van-field__left-icon">
						<i class="van-icon">
							<image src="../../static/image/news/pwd.png" mode="widthFix" class="van-icon__image"></image>
						</i>
					</view>
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<view class="van-field__control van-field__control--custom">
								<input type="password" :placeholder="i18n.register.placeholder[2]" v-model="password"
									style="border: 0px; flex: 1 1 0%; width: 100px; background: transparent;">
							</view>
						</view>
					</view>
				</view>
				<view class="van-cell van-cell--borderless van-field">
					<view class="van-field__left-icon">
						<i class="van-icon">
							<image src="../../static/image/news/pwd.png" mode="widthFix" class="van-icon__image"></image>
						</i>
					</view>
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<view class="van-field__control van-field__control--custom">
								<input type="password" :placeholder="i18n.register.placeholder[3]" v-model="re_password"
									style="border: 0px; flex: 1 1 0%; width: 100px; background: transparent;">
							</view>
						</view>
					</view>
				</view>
				<view class="van-cell van-cell--borderless van-field">
					<view class="van-field__left-icon">
						<i class="van-icon">
							<image src="../../static/image/news/invite.png" mode="widthFix" class="van-icon__image"></image>
						</i>
					</view>
					<view class="van-cell__value van-cell__value--alone van-field__value">
						<view class="van-field__body">
							<view class="van-field__control van-field__control--custom">
								<input type="text" :placeholder="i18n.register.placeholder[4]" v-model="invitecode"
									style="border: 0px; flex: 1 1 0%; width: 100px; background: transparent;">
							</view>
						</view>
					</view>
				</view>
				<view style="padding: 33px 16px; text-align: center;">
					<view class="btn" @tap="reg" :class="{ 'btn-disabled': isSubmitting }" style="cursor: pointer; opacity: isSubmitting ? 0.6 : 1;">{{isSubmitting ? '注册中...' : i18n.register.text[4]}}</view>
					<text class="href" @tap="dumprun('/pages/common/login')" style="cursor: pointer;">{{i18n.register.label[2]}}</text>
				</view>
				<view id="Service" @click="dumprun('/pages/index/serviceCenter')">
					<image src="../../static/image/news/customer.png" mode="widthFix"></image>
					<!-- {{i18n.common[0]}} -->
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				regtype: 1,
				area_code:null,
				usestring: '',
				password: '',
				re_password:"",
				invitecode:"",
				code:"",
				// 是否已发送验证码
				hasSend:false,
				seconds:120,
				secondsInterval:null,
				// 是否正在提交
				isSubmitting: false,
			};
		},
		onLoad(options) {
			const {
				pid
			} = options
			this.invitecode = pid
	
		},
		onShow() {
			this.area_code = uni.getStorageSync('area_code') || "+84"
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
			reg(){
				// 防止重复提交
				if (this.isSubmitting) {
					return false;
				}
				
				let {regtype,usestring,code,invitecode,password,re_password,i18n,area_code} = this
				
				// 验证邮箱/手机号
				if(!usestring || usestring.trim() === ''){
					this.$utils.showToast(regtype == 1 ? '请输入邮箱' : '请输入手机号')
					return false
				}
				
				// 验证邮箱格式
				if(regtype == 1){
					if(!this.$u.test.email(usestring)){
						this.$utils.showToast('请输入正确的邮箱格式')
						return false
					}
				} else {
					// 验证手机号格式（简单验证）
					if(!this.$u.test.number(usestring) || usestring.length < 6){
						this.$utils.showToast('请输入正确的手机号')
						return false
					}
				}
				
				//判断密码
				if(!password || password.length < 6){
					this.$utils.showToast('密码不能低于6位')
					return false
				}
				
				//判断两次密码是否一致
				if(password != re_password){
					this.$utils.showToast(this.i18n.register.placeholder[5] || '两次密码不一致')
					return false
				}
				
				// 验证邀请码（如果后端要求必填，这里可以取消注释）
				// if(!invitecode || invitecode.trim() === ''){
				// 	this.$utils.showToast('请输入邀请码')
				// 	return false
				// }
				
				// 设置提交状态
				this.isSubmitting = true;
				
				// 显示加载提示
				uni.showLoading({
					title: '注册中...',
					mask: true
				});
				
				// 处理手机号格式
				let finalUsestring = usestring;
				if(this.regtype == 2){
					finalUsestring = area_code + '' + usestring
				}
				
				// 调用注册API
				this.$u.api.index.register(
					finalUsestring,
					password,
					invitecode || '',
					code || ''
				).then(res=>{
					// 隐藏加载提示
					uni.hideLoading();
					this.isSubmitting = false;
					
					if(res && res.msg){
						this.$utils.showToast(res.msg)
					} else {
						this.$utils.showToast('注册成功')
					}
					
					// 跳转至登录页面
					setTimeout(()=>{
						uni.redirectTo({
							url:'/pages/common/login'
						})
					},1500)
				}).catch(err => {
					// 隐藏加载提示
					uni.hideLoading();
					this.isSubmitting = false;
					
					// 错误处理
					let errorMsg = '注册失败，请稍后重试';
					if(err && err.msg){
						errorMsg = err.msg;
					} else if(err && err.message){
						errorMsg = err.message;
					} else if(typeof err === 'string'){
						errorMsg = err;
					}
					
					console.error('注册失败:', err);
					this.$utils.showToast(errorMsg);
				})
			},
			//发送验证码
			huoqu(){
				// 设置节流,防止频繁点击
				this.$u.throttle(()=>{
					const {regtype,usestring,area_code,hasSend,i18n} = this
					let mobile = ''
					if(hasSend) return
					//如果是手机
					if(regtype == 2){
						if(!this.$u.test.number(usestring) || !usestring){
							this.$utils.showToast(this.i18n.register.placeholder[7])
							return false
						}
					}else{
						//如果是邮箱
						if(!this.$u.test.email(usestring) || !usestring){
							this.$utils.showToast(this.i18n.register.placeholder[7])
							return false
						}
					}
					if(regtype == 2){
						mobile = area_code+''+usestring
					}else{
						mobile = usestring
					}
					//发送接口
					this.$u.api.index.send_email_mobile(mobile).then(res => {
						this.$utils.showToast(res.msg)
						//倒计时
						this.hasSend = true
						this.secondsInterval = setInterval(() => {
							this.seconds = this.seconds - 1
							if (this.seconds == 0) {
								clearInterval(this.secondsInterval)
								this.hasSend = false
								this.seconds = 120
							}
						}, 1000)
					})
				},1000)
			},
			dumprun(url) {
				uni.navigateTo({
					url
				})
			},
		},
		computed: {
			i18n() {
				return this.$t("common")
			},
		}
	}
</script>

<style>
	.PageBox {
	    color: #635327;
	    padding: 0;
	    background-color: #13171a
	}
	
	.regType {
	    margin: 20px;
	    margin-top: 0;
	    width: 100%;
	    margin-bottom: 0;
	    color: #0076fa;
	    display: flex;
	    padding: 10px
	}
	
	.van-dropdown-menu .van-dropdown-menu__bar {
	    height: auto;
	    box-shadow: none;
	    background: transparent
	}
	
	.van-dropdown-menu .van-dropdown-menu__title {
	    padding: 0 10px 0 0;
	    margin-right: 10px;
	    color: #d7d7d7
	}
	
	.van-field .van-dropdown-menu>>>.van-dropdown-item__content ul li {
	    padding: 0 15px;
	    height: 254px!important;
	    color: #eee
	}
	
	.van-dropdown-menu .van-dropdown-item__content ul li {
	    padding: 4px 0;
	    width: 100%;
	    font-size: 14px;
	    background-color: #191c23;
	    color: #eee
	}
	
	.van-dropdown-menu .van-dropdown-item__content ul li.on {
	    color: #eee
	}
	
	.van-dropdown-menu .van-dropdown-item__content ul li span {
	    white-space: nowrap;
	    overflow: hidden;
	    text-overflow: ellipsis
	}
	
	.van-dropdown-menu .van-dropdown-item__content ul li+li {
	    color: #333
	}
	
	.BrowserTips {
	    background-color: rgba(0,0,0,.8);
	    position: fixed;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    text-align: right;
	    z-index: 99999
	}
	
	.van-nav-bar .van-nav-bar__text {
	    color: #999
	}
	
	.slidercaptcha .card-body {
	    padding: 1rem
	}
	
	.slidercaptcha canvas:first-child {
	    border-radius: 4px;
	    border: 1px solid #e6e8eb
	}
	
	.slidercaptcha.card .card-header {
	    background-image: none;
	    background-color: rgba(0,0,0,.03)
	}
	
	.refreshIcon {
	    top: -54px
	}
	
	.href {
	    color: #b5b5b5
	}
	
	.header_bg {
	    width: 100%;
	    z-index: 0
	}
	
	.register_title {
	    font-size: 27px;
	    color: #f46926;
	    z-index: 10;
	    padding-top: 210px;
	    padding-left: 50px;
	    font-family: Alibaba
	}
	
	.logo {
	    width: 100%;
	    font-size: 25px;
	    color: #fff;
	    text-align: left;
	    margin-top: 30px;
	    margin-left: 30px
	}
	
	.loginpanel {
	    height: 580px;
	    background-size: cover;
	    width: 100%;
	    padding-bottom: 30px
	}
	
	.logo image {
	    margin: 20px auto;
	    text-align: center;
	    width: 200px
	}
	
	.van-form {
	    padding: 0 35px
	}
	
	.van-cell--borderless {
	    width: 85%;
	    background-color: #191c23;
	    border-radius: 5px;
	    overflow: hidden;
	    color: #fff;
	    margin-top: 25px;
	    margin-left: 30px;
	    padding: 0 30px 0 13px;
	    height: 45px
	}
	
	.van-cell--borderless .van-icon {
	    font-size: 25px!important;
	    color: #fff!important;
	    margin-top: 8px
	}
	
	.van-cell--borderless .van-field__right-icon .van-icon-closed-eye {
	    font-size: 21px!important;
	    color: #fff!important;
	    margin-right: -10px
	}
	
	.van-button--danger {
	    max-width: 200px;
	    margin: auto;
	    font-family: Alibaba;
	    font-size: 15px!important;
	    font-weight: 700;
	    background: linear-gradient(90deg,#fff,#fff);
	    color: #ccc;
	    border-radius: 1.2rem;
	    height: 46px
	}
	
	.van-cell--borderless .van-field__right-icon .van-icon-eye {
	    font-size: 18px!important;
	    color: #fff!important;
	    margin-right: -10px
	}
	
	.van-cell--borderless .van-field__control {
	    color: #fff!important;
	    padding-left: 4px
	}
	
	.van-nav-bar .van-nav-bar__text {
	    color: #333;
	    font-size: 15px;
	    font-family: Alibaba;
	    position: relative
	}
	
	.Site .van-nav-bar .van-icon {
	    color: #333
	}
	
	.van-search__content {
	    padding: 0
	}
	
	.van-search__content .van-cell {
	    margin: 0;
	    padding-left: 15px
	}
	
	.PageBox .van-overlay {
	    background-color: transparent
	}
	
	.goLo a {
	    color: #fe889d
	}
	
	.PageBox .van-popup ul>li {
	    font-size: 17px!important;
	    display: flex;
	    justify-content: space-between
	}
	
	.PageBox .van-popup .van-search__action view {
	    width: 22px;
	    display: flex;
	    align-items: center
	}
	
	.van-search__content .van-cell {
	    height: 35px;
	    border-radius: 1rem
	}
	
	.van-search__content .van-icon {
	    display: none
	}
	
	.van-search {
	    padding: 20px 0 6px
	}
	
	.PageBox .van-search__action view image {
	    width: 100%
	}
	
	.van-cell .van-field__control::-webkit-input-placeholder,.van-cell .van-field__control>input::-webkit-input-placeholder {
	    color: #939393!important;
	    font-size: 19px;
	    font-family: Alibaba
	}
	
	.van-cell .van-field__control::-moz-placeholder,.van-cell .van-field__control>input::-moz-placeholder {
	    color: #939393!important;
	    font-size: 19px;
	    font-family: Alibaba
	}
	
	.van-cell .van-field__control:-ms-input-placeholder,.van-cell .van-field__control>input::-ms-input-placeholder {
	    color: #939393!important;
	    font-size: 18px;
	    font-family: Alibaba
	}
	
	.van-cell .van-cell__value,.van-cell .van-dropdown-menu,.van-cell .van-field__body,.van-cell .van-field__control,.van-cell input {
	    height: 100%
	}
	
	.van-cell input {
	    color: #fff!important;
	    padding-left: 7px!important;
	    height: 100%;
	    font-size: 18px
	}
	
	.van-cell .van-ellipsis {
	    font-size: 18px;
	    line-height: 45px;
	    color: #fff
	}
	
	.van-cell .van-dropdown-menu__title:after {
	    background-size: 100% 100%;
	    width: 9px;
	    height: 5px;
	    border: none;
	    transform: rotate(0deg);
	    top: 62%;
	    right: -7px
	}
	
	.goLo {
	    text-align: left;
	    color: #4e51bf;
	    margin-top: 20px;
	    font-size: 15px;
	    font-family: Alibaba
	}
	
	.van-nav-bar .van-nav-bar__text:after {
	    content: "";
	    position: absolute;
	    background-size: 100% 100%;
	    width: 9px;
	    height: 5px;
	    top: 9px;
	    right: -15px
	}
	
	.Site .van-nav-bar__right {
	    padding-right: 40px
	}
	
	.van-cell .van-field__button .van-button--info {
	    background-color: #ccc;
	    border: none
	}
	
	.PageBox text:link {
	    color: #635327
	}
	
	.btn {
	    width: 85%;
	    padding: 10px 50px;
	    border-radius: 5px;
	    background-color: #0076fa;
	    color: #fff;
	    font-size: 18px;
	    text-align: center;
	    margin: 15px 30px 30px
	}

</style>