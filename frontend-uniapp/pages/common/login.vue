<template>
	<view class="Body">
		<view class="PageBox">
			<view class="header_bg">
				<view style="text-align: right; font-size: 16px; padding: 5px;">
					<view class="van-row">
						<view class="van-col van-col--18" style="text-align: left;" @click="open">
							{{i18n.common5[6]}}
						</view>
						<view class="van-col van-col--6" @click="showLanguage = true">
							{{i18n.language}}
						</view>
					</view>
				</view>
			</view>
			<view class="logo">
				<image src="../../static/image/news/logo.png" mode="widthFix" style="text-align: center;width: 220px;">
				</image>
			</view>
			<view class="loginpanel">
				<view style="padding-top: 20px;">
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
					<view class="input van-cell van-cell--borderless van-cell--large van-field">
						<view class="van-field__left-icon">
							<i class="van-icon van-icon-manager"></i>
						</view>
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body">
								<input type="text" autocomplete="off" v-model="user_string"
									:placeholder="i18n.login.placeholder[0]" class="van-field__control">
							</view>
						</view>
					</view>
					<view class="input van-cell van-cell--borderless van-cell--large van-field">
						<view class="van-field__left-icon">
							<i class="van-icon">
								<image src="../../static/image/news/pwd.png" class="van-icon__image"></image>
							</i>
						</view>
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body">
								<input type="password" autocomplete="off" v-model="password"
									:placeholder="i18n.login.placeholder[1]" class="van-field__control">
								<view class="van-field__right-icon">
									<i class="van-icon van-icon-closed-eye"></i>
								</view>
							</view>
						</view>
					</view>
					<view style="text-align: right; margin-top: 20px; margin-right: 20px;">
						<!-- <text>忘記密碼?</text> -->
					</view>
				</view>
				<view style="padding: 10px 0px; text-align: center;">
					<view class="btn" @click="login" @tap="login" style="cursor: pointer;">{{i18n.login.label[1]}}</view>
					<view>
						{{i18n.login.default[0]}} | <text class="href"
							@click="dumprun('/pages/common/register')" @tap="dumprun('/pages/common/register')" style="cursor: pointer;">{{i18n.login.default[1]}}</text>
					</view>
				</view>
				<view id="Service" @click="dumprun('/pages/index/serviceCenter')">
					<image src="../../static/image/news/customer.png" mode="widthFix"></image>
					{{i18n.common[0]}}
				</view>
			</view>
		</view>
		<!-- 选择语言的popup -->
		<u-popup v-model="showLanguage" mode="bottom" length="60%" :title="i18n.selectLang"
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
				google_code: ''
			};
		},
		onLoad() {},
		onShow() {
			this.setDefaultLang()
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
		},
		methods: {
			setDefaultLang() {
				if (!this.langs || !Array.isArray(this.langs)) return
				let langsData = this.langs.map(el => {
					if (el && typeof el === 'object') el.selected = false
					return el
				})
				const lang = (this.$store.state.lang || 'eng').replace(/^en$/, 'eng')
				const has = langsData.findIndex(item => item && item.value == lang)
				if (has >= 0 && langsData[has]) {
					langsData[has].selected = true
				} else if (langsData.length > 0 && langsData[0]) {
					langsData[0].selected = true
				}
				this.langs = langsData
			},
			open() { 
				this.$u.api.index.downurl().then(res => {
					window.location.href = res.data;
				})
			},
			dumprun(url) {
				uni.navigateTo({
					url
				})
			},
			setLang(item) {
				let langs = this.langs.map(el => {
					el.selected = false
					if (el.value == item.value) el.selected = true
					return el
				})
				this.langs = langs
				this._i18n.locale = item.value
				this.lang = item
				uni.setStorageSync('lang', item.value);
				this.$store.commit('setLangyan', item.value);

				setTimeout(() => {
					this.showLanguage = false
				}, 200)
			},
			login() {
				let { user_string, password } = this
				if (!user_string || !user_string.trim()) {
					this.$utils.showToast(this.i18n.mobile || 'Please enter your email')
					return
				}
				if (!password || !password.trim()) {
					this.$utils.showToast(this.i18n.password || 'Please enter your password')
					return
				}
				this._doLogin(user_string.trim(), password)
			},
			_doLogin(account, password) {
				uni.showLoading({ title: this.i18n.login && this.i18n.login.label ? this.i18n.login.label[0] : '登入中...', mask: true })
				this.$u.api.index.login(account, password).then(res => {
					uni.hideLoading()
					if (res && res.code === 1 && res.data && res.data.userinfo) {
						this.$utils.showToast(this.i18n.login.label[0])
						if (this.rememberPassword) {
							uni.setStorageSync('loginAccount', account)
							uni.setStorageSync('loginPassword', password)
						} else {
							uni.removeStorageSync('loginAccount')
							uni.removeStorageSync('loginPassword')
						}
						uni.setStorageSync('token', res.data.userinfo.token)
						setTimeout(() => {
							uni.reLaunch({ url: '/pages/index/index' })
						}, 1200)
					} else {
						const msg = (res && res.msg) ? res.msg : (this.i18n.login && this.i18n.login.codes ? this.i18n.login.codes[5] : '登入失敗')
						this.$utils.showToast(msg)
					}
				}).catch(err => {
					uni.hideLoading()
					let msg = '網路請求失敗'
					if (err && err.msg) msg = err.msg
					else if (err && err.message) msg = err.message
					else if (err && err.errMsg) {
						if (err.errMsg.indexOf('fail') >= 0) msg = '無法連接伺服器，請檢查網路'
						else if (err.errMsg.indexOf('timeout') >= 0) msg = '請求超時'
					}
					this.$utils.showToast(msg)
				})
			},
			rememberPasswordFunc() {
				this.rememberPassword = !this.rememberPassword
				uni.setStorageSync('rememberPassword', this.rememberPassword)
			}
		}
	}
</script>
<style lang="scss" scoped>
	// 弹出层列表
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
