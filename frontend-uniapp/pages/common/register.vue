<template>
	<view class="Body">
		<view class="PageBox">
			<view class="logo logo-row">
				<text class="logo-title">{{i18n.home.label[0]}}</text>
				<text class="back-login" @click="dumprun('/pages/common/login')" @tap="dumprun('/pages/common/login')">{{i18n.register.label[1]}}</text>
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
					<view 
						class="btn" 
						:class="{ 'btn-disabled': isSubmitting, 'btn-clicking': isClicking }"
						@click="handleRegisterClick" 
						@tap="handleRegisterClick"
						style="cursor: pointer; opacity: isSubmitting ? 0.6 : 1; transition: all 0.2s;">
						{{ isSubmitting ? (i18n.register.text[3] || '注册中...') : i18n.register.text[4] }}
					</view>
					<text class="href" @click="dumprun('/pages/common/login')" @tap="dumprun('/pages/common/login')" style="cursor: pointer;">{{i18n.register.label[1]}}</text>
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
				// 點擊動畫狀態
				isClicking: false,
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
			handleRegisterClick(e) {
				console.log('[REGISTER] 按鈕被點擊', e)
				// 阻止事件冒泡
				if (e && e.stopPropagation) {
					e.stopPropagation()
				}
				// 添加點擊動畫效果
				this.isClicking = true
				setTimeout(() => {
					this.isClicking = false
				}, 200)
				// 調用註冊方法
				this.reg()
			},
			reg(){
				console.log('[REGISTER] ========== 開始執行註冊邏輯 ==========')
				console.log('[REGISTER] 當前狀態:', {
					isSubmitting: this.isSubmitting,
					regtype: this.regtype,
					usestring: this.usestring,
					password: this.password ? '***' : '(空)',
					re_password: this.re_password ? '***' : '(空)'
				})
				
				// 防止重复提交
				if (this.isSubmitting) {
					console.warn('[REGISTER] 正在提交中，忽略重複點擊')
					return false;
				}
				
				let {regtype,usestring,code,invitecode,password,re_password,i18n,area_code} = this
				console.log('[REGISTER] 註冊類型:', regtype === 1 ? '郵箱' : '手機號', '帳號:', usestring)
				
				// 验证邮箱/手机号
				if(!usestring || usestring.trim() === ''){
					const errorMsg = regtype == 1
						? (i18n.register && i18n.register.placeholder && i18n.register.placeholder[0] ? i18n.register.placeholder[0] : '请输入邮箱')
						: (i18n.register2 && i18n.register2[2] ? i18n.register2[2] : '请输入手机号')
					console.warn('[REGISTER] ❌ 驗證失敗: 帳號為空')
					console.log('[REGISTER] 準備顯示錯誤提示:', errorMsg)
					if (this.$utils && this.$utils.showToast) {
						this.$utils.showToast(errorMsg)
					} else {
						uni.showToast({
							title: errorMsg,
							icon: 'none'
						})
					}
					return false
				}
				
				// 验证邮箱格式
				if(regtype == 1){
					if(!this.$u || !this.$u.test || !this.$u.test.email){
						console.error('[REGISTER] $u.test.email 不存在')
						// 簡單的郵箱格式驗證
						const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
						if(!emailRegex.test(usestring)){
							console.warn('[REGISTER] ❌ 驗證失敗: 郵箱格式錯誤', usestring)
							const errorMsg = (i18n.register && i18n.register.placeholder && i18n.register.placeholder[7]) ? i18n.register.placeholder[7] : 'Invalid Email address'
							if (this.$utils && this.$utils.showToast) {
								this.$utils.showToast(errorMsg)
							} else {
								uni.showToast({ title: errorMsg, icon: 'none' })
							}
							return false
						}
					} else if(!this.$u.test.email(usestring)){
						console.warn('[REGISTER] ❌ 驗證失敗: 郵箱格式錯誤', usestring)
						const errorMsg = (i18n.register && i18n.register.placeholder && i18n.register.placeholder[7]) ? i18n.register.placeholder[7] : 'Invalid Email address'
						if (this.$utils && this.$utils.showToast) {
							this.$utils.showToast(errorMsg)
						} else {
							uni.showToast({ title: errorMsg, icon: 'none' })
						}
						return false
					}
					console.log('[REGISTER] ✅ 郵箱格式驗證通過:', usestring)
				} else {
					// 验证手机号格式（简单验证）
					if(!this.$u || !this.$u.test || !this.$u.test.number){
						console.error('[REGISTER] $u.test.number 不存在')
						// 簡單的手機號驗證
						if(!/^\d+$/.test(usestring) || usestring.length < 6){
							console.warn('[REGISTER] ❌ 驗證失敗: 手機號格式錯誤', usestring)
							const errorMsg = (i18n.register && i18n.register.placeholder && i18n.register.placeholder[9]) ? i18n.register.placeholder[9] : 'Please enter a valid phone number'
							if (this.$utils && this.$utils.showToast) {
								this.$utils.showToast(errorMsg)
							} else {
								uni.showToast({ title: errorMsg, icon: 'none' })
							}
							return false
						}
					} else if(!this.$u.test.number(usestring) || usestring.length < 6){
						console.warn('[REGISTER] ❌ 驗證失敗: 手機號格式錯誤', usestring)
						const errorMsg = (i18n.register && i18n.register.placeholder && i18n.register.placeholder[9]) ? i18n.register.placeholder[9] : 'Please enter a valid phone number'
						if (this.$utils && this.$utils.showToast) {
							this.$utils.showToast(errorMsg)
						} else {
							uni.showToast({ title: errorMsg, icon: 'none' })
						}
						return false
					}
					console.log('[REGISTER] ✅ 手機號格式驗證通過:', usestring)
				}
				
				//判断密码
				if(!password || password.length < 6){
					console.warn('[REGISTER] ❌ 驗證失敗: 密碼長度不足', password ? password.length : 0)
					const errorMsg = (i18n.register && i18n.register.placeholder && i18n.register.placeholder[8]) ? i18n.register.placeholder[8] : '密码不能低于6位'
					if (this.$utils && this.$utils.showToast) {
						this.$utils.showToast(errorMsg)
					} else {
						uni.showToast({ title: errorMsg, icon: 'none' })
					}
					return false
				}
				console.log('[REGISTER] ✅ 密碼長度驗證通過')
				
				//判断两次密码是否一致
				if(password != re_password){
					console.warn('[REGISTER] ❌ 驗證失敗: 兩次密碼不一致')
					const errorMsg = (this.i18n && this.i18n.register && this.i18n.register.placeholder && this.i18n.register.placeholder[5]) 
						? this.i18n.register.placeholder[5] 
						: '两次密码不一致'
					if (this.$utils && this.$utils.showToast) {
						this.$utils.showToast(errorMsg)
					} else {
						uni.showToast({ title: errorMsg, icon: 'none' })
					}
					return false
				}
				console.log('[REGISTER] ✅ 兩次密碼一致性驗證通過')
				
				// 验证邀请码（後端要求必填）
				if(!invitecode || invitecode.trim() === ''){
					console.warn('[REGISTER] ❌ 驗證失敗: 邀請碼為空')
					const errorMsg = (this.i18n && this.i18n.register && this.i18n.register.placeholder && this.i18n.register.placeholder[4]) 
						? this.i18n.register.placeholder[4] 
						: '请输入邀请码'
					if (this.$utils && this.$utils.showToast) {
						this.$utils.showToast(errorMsg)
					} else {
						uni.showToast({ title: errorMsg, icon: 'none' })
					}
					return false
				}
				console.log('[REGISTER] ✅ 邀請碼驗證通過')
				
				// 设置提交状态
				this.isSubmitting = true;
				
				// 显示加载提示
				uni.showLoading({
					title: (this.i18n && this.i18n.register && this.i18n.register.text && this.i18n.register.text[3]) ? this.i18n.register.text[3] : '注册中...',
					mask: true
				});
				
				// 处理手机号格式
				let finalUsestring = usestring;
				if(this.regtype == 2){
					finalUsestring = area_code + '' + usestring
				}
				
				// 调用注册API
				console.log('[REGISTER] 準備調用 API，參數:', {
					username: finalUsestring,
					password: '***',
					invitation_code: invitecode || '(空)',
					code: code || '(空)'
				})
				console.log('[REGISTER] 完整驗證通過，準備提交註冊')
				
				this.$u.api.index.register(
					finalUsestring,
					password,
					invitecode || '',
					code || ''
				).then(res=>{
					console.log('[REGISTER] API 響應:', res)
					// 隐藏加载提示
					uni.hideLoading();
					this.isSubmitting = false;
					
					// 檢查響應數據
					// 注意：HTTP 攔截器會在 code !== 1 時返回 false，所以這裡的 res 可能是 false
					if(res === false){
						// HTTP 攔截器已經處理了錯誤並顯示了錯誤訊息
						console.warn('[REGISTER] 註冊失敗，HTTP 攔截器已處理錯誤')
						return;
					}
					
					if(res && res.code === 1){
						// 註冊成功
						console.log('[REGISTER] 註冊成功')
						const successMsg = res.msg || (this.i18n && this.i18n.register && this.i18n.register.text && this.i18n.register.text[3]) 
							? this.i18n.register.text[3] 
							: '注册成功'
						this.$utils.showToast(successMsg)
						
						// 跳转至登录页面
						setTimeout(()=>{
							console.log('[REGISTER] 準備跳轉到登入頁面')
							uni.redirectTo({
								url:'/pages/common/login'
							})
						},1500)
					} else {
						// 註冊失敗 - 顯示錯誤訊息
						console.warn('[REGISTER] 註冊失敗，響應數據:', res)
						let errorMsg = '注册失败，请稍后重试';
						if(res && res.msg){
							errorMsg = res.msg;
						} else if(res && res.data && typeof res.data === 'string'){
							errorMsg = res.data;
						}
						// 只有在 HTTP 攔截器沒有顯示錯誤訊息時才顯示
						if(res !== false){
							this.$utils.showToast(errorMsg);
						}
						console.error('[REGISTER] 註冊失敗:', res);
					}
				}).catch(err => {
					console.error('[REGISTER] API 調用失敗:', err)
					// 隐藏加载提示
					uni.hideLoading();
					this.isSubmitting = false;
					
					// 错误处理
					let errorMsg = (this.i18n && this.i18n.register && this.i18n.register.codes && this.i18n.register.codes[5]) ? this.i18n.register.codes[5] : '注册失败，请稍后重试';
					if(err && err.msg){
						errorMsg = err.msg;
					} else if(err && err.message){
						errorMsg = err.message;
					} else if(err && err.data && typeof err.data === 'string'){
						errorMsg = err.data;
					} else if(typeof err === 'string'){
						errorMsg = err;
					}
					
					console.error('[REGISTER] 註冊失敗:', err);
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
	
	.logo.logo-row {
	    display: flex;
	    align-items: center;
	    justify-content: space-between;
	    padding-right: 20px;
	    box-sizing: border-box
	}
	
	.logo-title {
	    flex: 0 0 auto;
	}
	
	.back-login {
	    font-size: 14px;
	    color: #0076fa;
	    cursor: pointer;
	    flex-shrink: 0;
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
	    margin: 15px 30px 30px;
	    cursor: pointer;
	    user-select: none;
	    transition: all 0.2s ease;
	    position: relative;
	    overflow: hidden;
	}
	
	.btn:active,
	.btn.btn-clicking {
	    transform: scale(0.95);
	    box-shadow: 0 2px 8px rgba(0, 118, 250, 0.3);
	}
	
	.btn:hover:not(.btn-disabled) {
	    background-color: #0066e0;
	    box-shadow: 0 4px 12px rgba(0, 118, 250, 0.4);
	}
	
	.btn.btn-disabled {
	    opacity: 0.6;
	    cursor: not-allowed;
	}

</style>