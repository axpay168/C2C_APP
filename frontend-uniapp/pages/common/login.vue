<template>
	<view class="login-container">
		<!-- 頂部導航欄 -->
		<view class="login-header">
			<view class="header-left" @click="handleBack">
				<text class="back-icon">←</text>
			</view>
			<view class="header-right" @click="showLanguage = true">
				<text class="lang-text" :class="{ active: currentLang === 'chn' }">中文</text>
				<text class="lang-separator">|</text>
				<text class="lang-text" :class="{ active: currentLang === 'eng' }">EN</text>
			</view>
		</view>

		<!-- Logo 區域 -->
		<view class="logo-section">
			<view class="logo-wrapper">
				<image src="../../static/image/news/logo.png" mode="aspectFit" class="logo-image"></image>
			</view>
			<view class="welcome-text">{{ currentLang === 'chn' ? '欢迎!' : 'Welcome!' }}</view>
		</view>

		<!-- 登入表單 -->
		<view class="login-form">
			<!-- 手機號/郵箱輸入框 -->
			<view class="input-wrapper">
				<input 
					type="text" 
					v-model="user_string"
					:placeholder="(i18n.login && i18n.login.placeholder && i18n.login.placeholder[0]) ? i18n.login.placeholder[0] : '请输入手机号码'"
					class="login-input"
					autocomplete="off"
				/>
			</view>

			<!-- 密碼輸入框 -->
			<view class="input-wrapper">
				<input 
					:type="showPassword ? 'text' : 'password'"
					v-model="password"
					:placeholder="(i18n.login && i18n.login.placeholder && i18n.login.placeholder[1]) ? i18n.login.placeholder[1] : '请输入密码'"
					class="login-input"
					autocomplete="off"
				/>
				<view class="password-toggle" @click="togglePassword">
					<text class="eye-icon">{{ showPassword ? '👁️' : '👁️‍🗨️' }}</text>
				</view>
			</view>

			<!-- 記住密碼 -->
			<view class="remember-password">
				<view class="checkbox-wrapper" @click="rememberPasswordFunc">
					<view class="checkbox" :class="{ checked: rememberPassword }">
						<text v-if="rememberPassword" class="checkmark">✓</text>
					</view>
					<text class="remember-text">{{ currentLang === 'chn' ? '记住密码' : 'Remember password' }}</text>
				</view>
			</view>

			<!-- 登入按鈕 -->
			<view class="login-button-wrapper">
				<button class="login-button" @click="login" @tap="login">{{ currentLang === 'chn' ? '登录' : 'Login' }}</button>
			</view>

			<!-- 註冊和忘記密碼鏈接 -->
			<view class="login-links">
				<text class="link-text" @click="dumprun('/pages/common/register')">{{ currentLang === 'chn' ? '去注册' : 'Register' }}</text>
				<text class="link-text" @click="handleForgotPassword">{{ currentLang === 'chn' ? '忘记密码' : 'Forgot password' }}</text>
			</view>

			<!-- 免責聲明 -->
			<view class="disclaimer">
				<text class="disclaimer-text">{{ currentLang === 'chn' ? '登录即表示您已接受上述条款和条件。' : 'Logging in means you have accepted the above terms and conditions.' }}</text>
			</view>

			<!-- 版本號 -->
			<view class="version">
				<text class="version-text">V1.0.1</text>
			</view>
		</view>

		<!-- 語言選擇彈窗 -->
		<u-popup v-model="showLanguage" mode="bottom" length="60%" :title="(i18n.selectLang ? i18n.selectLang : 'Select Language')"
			contentBackgroundColor="white">
			<view class="popup-list">
				<view class="popup-list-item" v-for="item in langs" :key="item.value" :class="{active : item.selected}" @click="setLang(item)">
					<text>{{item.name}}</text>
				</view>
			</view>
		</u-popup>
	</view>
</template>
<script>
	import langslist from "@/common/data.js"
	export default {
		data() {
			return {
				password: uni.getStorageSync('loginPassword') || '',
				user_string: uni.getStorageSync('loginAccount') || '',
				showLanguage: false,
				langs: langslist,
				rememberPassword: uni.getStorageSync('rememberPassword') || false,
				google_code: '',
				showPassword: false,
				currentLang: uni.getStorageSync('lang') || 'chn'
			};
		},
		onLoad() {
			console.log('[LOGIN] 頁面載入，當前語言:', this.currentLang)
			console.log('[LOGIN] 已保存的帳號:', this.user_string ? '有' : '無')
			console.log('[LOGIN] 已保存的密碼:', this.password ? '有' : '無')
			// console.log(this.$store.state.lang);
			// console.log(JSON.stringify(this.$t("common")));
			
			// const _this = this
			// uni.setNavigationBarTitle({
			// 	title: _this.$t("common.login")
			// })
		},
		onShow() {
			this.setDefaultLang()
			this.currentLang = uni.getStorageSync('lang') || 'chn'
			this.$u.api.index.shoujia().then(res => {
				if (res && res.data) uni.setStorageSync('shoujia', res.data.shoujia)
			}).catch(err => {
				console.warn('shoujia failed:', err)
			})
		},
		computed: {
			i18n() {
				return this.$t("common")
			},
			// setting() {
			// 	return this.$t("setting")
			// }
		},
		methods: {
			setDefaultLang() {
				let langsData = this.langs.map(el => {
					el.selected = false
					return el
				})
				const lang = (this.$store.state.lang || 'eng').replace(/^en$/, 'eng')
				const has = langsData.findIndex(item => item.value == lang)
				if (has >= 0) {
					langsData[has].selected = true
				} else {
					if (langsData && langsData.length > 0) {
						langsData[0].selected = true
					}
				}
				this.langs = langsData
			},
			open() { 
				this.$u.api.index.downurl().then(res => {
					window.location.href = res.data;
				})
			},
			dumprun(url) {
				// this.$u.api.setting.getUserStatus(this.ciaddress).then(res => {
				// if (res.code == 0) {
				// 	this.getApprove()
				// } else {
				uni.navigateTo({
					url
				})
				// }
				// })
			},
			//设置语言
			setLang(item) {
				console.log('[LOGIN] 切換語言:', item.value, item.name)
				let langs = this.langs.map(el => {
					el.selected = false
					if (el.value == item.value) el.selected = true
					return el
				})
				this.langs = langs
				this._i18n.locale = item.value
				this.lang = item
				this.currentLang = item.value
				uni.setStorageSync('lang', item.value);
				this.$store.commit('setLangyan', item.value);
				console.log('[LOGIN] 語言已切換為:', item.value)

				setTimeout(() => {
					this.showLanguage = false
				}, 200)
			},
			login() {
				console.log('[LOGIN] 點擊登入按鈕')
				let { user_string, password } = this
				console.log('[LOGIN] 輸入的帳號:', user_string, '密碼長度:', password ? password.length : 0)
				
				if (!user_string || user_string.trim() === '') {
					const msg = (this.i18n && this.i18n.mobile) ? this.i18n.mobile : (this.currentLang === 'chn' ? '請輸入帳號' : 'Please enter your email')
					console.warn('[LOGIN] 驗證失敗: 帳號為空')
					this.$utils.showToast(msg)
					return
				}
				if (!password || password.trim() === '') {
					const msg = (this.i18n && this.i18n.password) ? this.i18n.password : (this.currentLang === 'chn' ? '請輸入密碼' : 'Please enter your password')
					console.warn('[LOGIN] 驗證失敗: 密碼為空')
					this.$utils.showToast(msg)
					return
				}
				this._doLogin(user_string.trim(), password)
			},
			_doLogin(account, password) {
				console.log('[LOGIN] 開始登入，帳號:', account)
				
				// 顯示載入提示
				uni.showLoading({ 
					title: this.currentLang === 'chn' ? '登入中...' : 'Logging in...', 
					mask: true 
				})
				
				// 使用統一的 API 調用方式
				this.$u.api.index.login(account, password).then(res => {
					console.log('[LOGIN] API 響應:', res)
					uni.hideLoading()
					
					// 檢查響應數據
					if (res && res.code === 1 && res.data && res.data.userinfo) {
						console.log('[LOGIN] 登入成功，Token:', res.data.userinfo.token)
						
						// 登入成功
						const successMsg = (this.i18n && this.i18n.login && this.i18n.login.label && this.i18n.login.label[0]) 
							? this.i18n.login.label[0] 
							: (this.currentLang === 'chn' ? '登入成功' : 'Login successful')
						this.$utils.showToast(successMsg)
						
						// 處理記住密碼
						if (this.rememberPassword) {
							uni.setStorageSync('loginAccount', account)
							uni.setStorageSync('loginPassword', password)
							console.log('[LOGIN] 已保存帳號密碼到本地存儲')
						} else {
							uni.removeStorageSync('loginAccount')
							uni.removeStorageSync('loginPassword')
							console.log('[LOGIN] 已清除本地存儲的帳號密碼')
						}
						
						// 保存 token
						uni.setStorageSync('token', res.data.userinfo.token)
						console.log('[LOGIN] Token 已保存到本地存儲')
						
						// 跳轉到首頁
						setTimeout(() => {
							console.log('[LOGIN] 準備跳轉到首頁')
							uni.reLaunch({ url: '/pages/index/index' })
						}, 1200)
					} else {
						// 登入失敗 - 顯示錯誤訊息
						console.warn('[LOGIN] 登入失敗，響應數據:', res)
						let errorMsg = '登入失敗'
						if (res && res.msg) {
							errorMsg = res.msg
						} else if (res && res.data && typeof res.data === 'string') {
							errorMsg = res.data
						} else {
							errorMsg = this.currentLang === 'chn' ? '登入失敗，請檢查帳號密碼' : 'Login failed, please check your account and password'
						}
						this.$utils.showToast(errorMsg)
						console.error('[LOGIN] 登入失敗:', res)
					}
				}).catch(err => {
					console.error('[LOGIN] API 調用失敗:', err)
					uni.hideLoading()
					
					// 錯誤處理
					let errorMsg = this.currentLang === 'chn' ? '網路請求失敗' : 'Network request failed'
					
					if (err && err.msg) {
						errorMsg = err.msg
					} else if (err && err.message) {
						errorMsg = err.message
					} else if (err && err.errMsg) {
						if (err.errMsg.indexOf('fail') >= 0) {
							errorMsg = this.currentLang === 'chn' ? '無法連接伺服器，請檢查網路' : 'Cannot connect to server, please check network'
						} else if (err.errMsg.indexOf('timeout') >= 0) {
							errorMsg = this.currentLang === 'chn' ? '請求超時' : 'Request timeout'
						}
					} else if (typeof err === 'string') {
						errorMsg = err
					}
					
					this.$utils.showToast(errorMsg)
					console.error('[LOGIN] 登入請求失敗:', err)
				})
			},
			handleBack() {
				// 返回上一頁或關閉
				const pages = getCurrentPages();
				if (pages.length > 1) {
					uni.navigateBack();
				}
			},
			handleForgotPassword() {
				// 跳轉到忘記密碼頁面
				uni.navigateTo({
					url: '/pages/common/resetpwd'
				});
			},
			togglePassword() {
				this.showPassword = !this.showPassword
				console.log('[LOGIN] 密碼顯示狀態切換為:', this.showPassword ? '顯示' : '隱藏')
			},
			rememberPasswordFunc() {
				this.rememberPassword = !this.rememberPassword
				uni.setStorageSync('rememberPassword', this.rememberPassword)
				console.log('[LOGIN] 記住密碼狀態:', this.rememberPassword ? '已勾選' : '已取消')
			}
		}
	}
</script>
<style lang="scss" scoped>
	.login-container {
		min-height: 100vh;
		background: linear-gradient(180deg, #E3F2FD 0%, #BBDEFB 100%);
		padding: 0;
		position: relative;
		box-sizing: border-box;
	}

	/* 頂部導航欄 */
	.login-header {
		display: flex;
		justify-content: space-between;
		align-items: center;
		padding: 20px 20px 10px 20px;
		position: relative;
		z-index: 10;
	}

	.header-left {
		width: 40px;
		height: 40px;
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
	}

	.back-icon {
		font-size: 24px;
		color: #1976D2;
		font-weight: bold;
	}

	.header-right {
		display: flex;
		align-items: center;
		gap: 8px;
		cursor: pointer;
	}

	.lang-text {
		font-size: 16px;
		color: #666;
		transition: color 0.3s;
		
		&.active {
			color: #1976D2;
			font-weight: 600;
		}
	}

	.lang-separator {
		font-size: 16px;
		color: #999;
	}

	/* Logo 區域 */
	.logo-section {
		display: flex;
		flex-direction: column;
		align-items: center;
		padding: 40px 20px 30px 20px;
	}

	.logo-wrapper {
		width: 120px;
		height: 120px;
		background: #fff;
		border-radius: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
		box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		margin-bottom: 20px;
		padding: 10px;
		box-sizing: border-box;
	}

	.logo-image {
		width: 100%;
		height: 100%;
		object-fit: contain;
	}

	.welcome-text {
		font-size: 24px;
		font-weight: 600;
		color: #1976D2;
		margin-top: 10px;
		text-align: center;
	}

	/* 登入表單 */
	.login-form {
		padding: 0 30px 20px 30px;
		max-width: 500px;
		margin: 0 auto;
	}

	.input-wrapper {
		position: relative;
		margin-bottom: 20px;
		background: #fff;
		border-radius: 12px;
		padding: 0 16px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		display: flex;
		align-items: center;
	}

	.login-input {
		width: 100%;
		height: 50px;
		font-size: 16px;
		color: #333;
		border: none;
		outline: none;
		background: transparent;
		
		&::placeholder {
			color: #999;
		}
	}

	.password-toggle {
		position: absolute;
		right: 16px;
		top: 50%;
		transform: translateY(-50%);
		cursor: pointer;
		width: 30px;
		height: 30px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.eye-icon {
		font-size: 20px;
	}

	/* 記住密碼 */
	.remember-password {
		margin: 20px 0 30px 0;
		display: flex;
		align-items: center;
		padding-left: 4px;
	}

	.checkbox-wrapper {
		display: flex;
		align-items: center;
		cursor: pointer;
	}

	.checkbox {
		width: 20px;
		height: 20px;
		border: 2px solid #1976D2;
		border-radius: 4px;
		display: flex;
		align-items: center;
		justify-content: center;
		margin-right: 8px;
		background: #fff;
		transition: all 0.3s;

		&.checked {
			background: #1976D2;
			border-color: #1976D2;
		}
	}

	.checkmark {
		color: #fff;
		font-size: 14px;
		font-weight: bold;
	}

	.remember-text {
		font-size: 14px;
		color: #666;
	}

	/* 登入按鈕 */
	.login-button-wrapper {
		margin: 30px 0;
	}

	.login-button {
		width: 100%;
		height: 50px;
		background: #1976D2;
		color: #fff;
		border: none;
		border-radius: 12px;
		font-size: 18px;
		font-weight: 600;
		cursor: pointer;
		transition: all 0.3s;
		box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
		display: flex;
		align-items: center;
		justify-content: center;

		&:hover {
			background: #1565C0;
			box-shadow: 0 6px 16px rgba(25, 118, 210, 0.4);
		}

		&:active {
			background: #0D47A1;
			transform: scale(0.98);
		}
	}

	/* 鏈接 */
	.login-links {
		display: flex;
		justify-content: center;
		gap: 20px;
		margin: 30px 0 20px 0;
	}

	.link-text {
		font-size: 14px;
		color: #1976D2;
		cursor: pointer;
		transition: opacity 0.3s;

		&:active {
			opacity: 0.7;
		}
	}

	/* 免責聲明 */
	.disclaimer {
		text-align: center;
		margin: 30px 0 20px 0;
		padding: 0 20px;
	}

	.disclaimer-text {
		font-size: 12px;
		color: #999;
		line-height: 1.5;
	}

	/* 版本號 */
	.version {
		text-align: center;
		margin-top: 40px;
		padding-bottom: 30px;
	}

	.version-text {
		font-size: 12px;
		color: #999;
	}

	/* 彈出層列表 */
	.popup-list {
		.popup-list-item {
			height: 96rpx;
			line-height: 96rpx;
			padding: 0 30rpx;
			@extend .font-size-32;
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
					background-image: url('./../../static/image/icon/select.png');
					background-size: cover;
					position: absolute;
					right: 80rpx;
					top: 50%;
					margin-top: -10rpx;
				}
			}
		}
	}
</style>