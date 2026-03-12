import Vue from 'vue'
import Vuex from 'vuex'
import httpApi from '@/common/http.api.js';
import i18n from '@/common/locales/config.js'
const lang = i18n.messages[i18n.locale]

Vue.use(Vuex)

import Socketio from '@/js_sdk/hyoga-uni-socket_io/uni-socket.io.js';
const store = new Vuex.Store({
	state: {
		baseUrl: process.env.NODE_ENV === 'development' ? '/api' : 'http://68.64.180.142:8080/index.php/api',
		baseDomain: process.env.NODE_ENV === 'development' ? '' : 'http://68.64.180.142:8080',
		lang: uni.getStorageSync('lang') || 'eng',
		token: uni.getStorageSync('token') || '',
		user: uni.getStorageSync('user') || {},
		socket:null,
	},
	actions: {
		login({
			commit,
			state
		}, params) {
			return new Promise((resole, reject) => {
				const {
					_this
				} = params
				_this.$u.api.index.login(params.data.account, params.data.password).then(res => {
					//保存token至缓存
					commit('saveUser', res)
					resole(true)
				}).catch((res) => {
					reject(res)
				})
			})
		},
		startSocket({commit,state}){
			return new Promise((resolve) => {
				try {
					if (state.socket) {
						resolve(true)
						return
					}
					const base = state.baseDomain || (typeof window !== 'undefined' && window.location && window.location.origin ? window.location.origin : '')
					if (!base) {
						resolve(false)
						return
					}
					let settled = false
					const done = (ok) => {
						if (settled) return
						settled = true
						resolve(!!ok)
					}
					state.socket = Socketio(base, {
						transports: [ 'websocket', 'polling' ],
						reconnection: true
					})
					state.socket.on('connect', () => done(true))
					state.socket.on('connect_error', () => done(false))
					setTimeout(() => done(false), 5000)
				} catch (e) {
					resolve(false)
				}
			})
		}
	},
	mutations: {
		//登陆过后保存用户信息
		saveUser(state, data) {
			state.token = data.message
			uni.setStorageSync('token', data.message)
		},
		//刷新用户信息
		refreshUser(state, data) {
			state.user = data
			uni.setStorageSync('user', data)
		},
		//清除用户信息
		deleteUser(state) {
			state.token = '',
			state.user = {}

			uni.removeStorageSync('token')
			uni.removeStorageSync('user')
		},
		//设置语言
		setLangyan(state,lang){
			state.lang = lang
		},
		//存储所有法币汇率和当前所选的法币汇率
		setFiats(state,arr){
			let has = arr.find(item => item.currency_code == state.fiat.currency_code)
			if(has) state.fiat = has
			state.fiats = arr
			
			
			uni.setStorageSync('fiat',state.fiat)
			uni.setStorageSync('fiats',state.fiats)
		},
		saveFiat(state,fiat){
			state.fiat = fiat
			uni.setStorageSync('fiat',state.fiat)
		},
		//是否展示过弹窗广告
		setHasShowAd(state,bool){
			state.hasShowAd = bool
		},

	}
})

export default store
