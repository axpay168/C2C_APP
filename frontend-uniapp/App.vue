<script>
	import pageAnimation from './components/page-animation'
	export default {
		mixins: [pageAnimation],
		// 此处globalData为了演示其作用，不是uView框架的一部分
		globalData: {},
		onLaunch() {
			//设置语言
			this.$utils.setTabbar(this)
			//自定义缓存清理方法，应放在onLaunch最上方
			this.clearStorage()
			//开启socket
			this.$store.dispatch("startSocket")
		},
		methods: {
			clearStorage() {
				//当前版本号
				const currentH5Version = 1.0
				//缓存中的版本号
				const h5Version = uni.getStorageSync('h5Version') || 0
				//如果当前版本号大于缓存中的版本号，则清除缓存
				if (currentH5Version > h5Version) {
					uni.clearStorageSync()
					//清除缓存后，保存当前版本号
					uni.setStorageSync('h5Version', currentH5Version)
				}
			}
		},
		onHide() {
			this.$store.commit('setHasShowAd', false)
		}
	}
</script>
<style>
	/* page,
	html,
	body {
		background-color: #333;
	} */
</style>
<style lang="scss">
	@import 'common/design-tokens.scss';
	@import 'components/page-animation/index.css';
	@import "uview-ui/index.scss";
	@import "common/demo.scss";
	@import "static/iconfont/iconfont.css";
	@import 'static/animate.min.css';

	.icon {
		width: 1em;
		height: 1em;
		vertical-align: -0.15em;
		fill: currentColor;
		overflow: hidden;
	}

	image {
		will-change: transform
	}

	@font-face {
		font-family: 'Din';
		src: url('static/DIN-Regular.ttf');
	}

	// @font-face {
	// 	font-family: 'puhui';
	// 	src: url('static/puhui.ttf');
	// }
	page,
	body,
	html {
		// padding-top: env(safe-area-inset-top);
		font-family: Din;
		background-color: #13171a
	}
</style>
