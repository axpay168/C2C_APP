import i18n from '@/common/locales/config.js'
// const {common} = i18n.messages[i18n.locale];

const install = (Vue, vm) => {
	// H5 使用當前域名，開發環境用 /api（需 proxy），其他用當前域名
	const getBaseUrl = () => {
		if (process.env.NODE_ENV === 'development') return '/api';
		if (typeof window !== 'undefined' && window.location && window.location.origin) {
			return window.location.origin + '/index.php/api';
		}
		return 'https://mxtrx.top/index.php/api';
	};
	Vue.prototype.$u.http.setConfig({
		baseUrl: getBaseUrl(),
		// 如果将此值设置为true，拦截回调中将会返回服务端返回的所有数据response，而不是response.data
		// 设置为true后，就需要在this.$u.http.interceptor.response进行多一次的判断，请打印查看具体值
		// originalData: true, 
		// 设置自定义头部content-type
		// header: {
		// 	'Access-Control-Allow-Origin': '*', //跨域加上头
		// 	'Content-Type': 'application/x-www-form-urlencoded'
		// }
	});
	// 请求拦截，配置Token等参数
	Vue.prototype.$u.http.interceptor.request = (config) => {
		let lang = uni.getStorageSync('lang') || 'eng';
		config.data['lang'] = lang
		config.header['Authorization'] = uni.getStorageSync('token');
		config.header['Content-Type'] = 'application/x-www-form-urlencoded'
		

		// 方式一，存放在vuex的token，假设使用了uView封装的vuex方式，见：https://uviewui.com/components/globalVariable.html
		// config.header.token = vm.token;
		
		// 方式二，如果没有使用uView封装的vuex方法，那么需要使用$store.state获取
		// config.header.token = vm.$store.state.token;
		
		// 方式三，如果token放在了globalData，通过getApp().globalData获取
		// config.header.token = getApp().globalData.username;
		
		// 方式四，如果token放在了Storage本地存储中，拦截是每次请求都执行的，所以哪怕您重新登录修改了Storage，下一次的请求将会是最新值
		// const token = uni.getStorageSync('token');
		// config.header.token = token;
		
		return config; 
	}
	// 响应拦截，判断状态码是否通过
	Vue.prototype.$u.http.interceptor.response = (res) => {
		// console.log(res.data)
		// 如果把originalData设置为了true，这里得到将会是服务器返回的所有的原始数据
		// 判断可能变成了res.statueCode，或者res.data.code之类的，请打印查看结果
		// res = JSON.parse(res)
		if(res.type == 'ok' || res.code == 1) {
			// 如果把originalData设置为了true，这里return回什么，this.$u.post的then回调中就会得到什么
			return res;  
		} else if(res.code === '401'){
			vm.$utils.showToast(res.data)
			vm.$store.commit('deleteUser')
			setTimeout(()=>{
				uni.redirectTo({
					url:'/pages/common/login'
				})
			},1200)
			return false;
		}else if(res.type === '998'){
			vm.$utils.showToast(res.data)
			setTimeout(()=>{
				
			},1200)
			return false;
		} else{
			vm.$utils.showToast(res.msg)
			return false;
		}
	}
}

export default {
	install
}