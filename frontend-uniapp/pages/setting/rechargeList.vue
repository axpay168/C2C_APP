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
						<div class="van-nav-bar__title van-ellipsis">充值訂單</div>
					</div>
				</div>
				<div class="panel">
					<div role="feed" class="van-list">
						<div class="van-list__placeholder"></div>
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
			};
		},
		onLoad(options) {
			const {
				id
			} = options
			this.id = id
	
		},
		onShow() {
	
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
	    overflow: auto;
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
	
	.PageBox .bgc {
	    width: 100%;
	    height: 46px;
	    position: fixed;
	    top: 0;
	    z-index: 200
	}
	
	.PageBox .panel {
	    width: 95%;
	    margin-left: 10px;
	    margin-top: 10px;
	    color: #000
	}
	
	.FundItem {
	    margin-top: 10px;
	    background-color: #191c23;
	    border-radius: 10px
	}
	
	.topTitle {
	    position: absolute;
	    max-width: 70%;
	    font-size: 18px;
	    color: #ccc;
	    background-color: transparent;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%,-50%);
	    z-index: 9999;
	    overflow: hidden;
	    text-overflow: ellipsis;
	    white-space: nowrap;
	    display: block
	}
	
	.PageBox .mytable {
	    background-color: #fff;
	    width: 91%;
	    margin: 0 auto;
	    margin-top: 6px;
	    font-size: 18px
	}
	
	.PageBox table {
	    width: 100%;
	    border: none;
	    border-collapse: collapse
	}
	
	.PageBox th:first-child {
	    background-color: #b3b5fc;
	    font-weight: 600;
	    font-size: 13px;
	    border: none;
	    height: 33px;
	    width: 26%
	}
	
	.PageBox th:nth-child(2) {
	    background-color: #b3b5fc;
	    font-weight: 600;
	    font-size: 13px;
	    border: none;
	    height: 33px;
	    width: 24%px
	}
	
	.PageBox th:nth-child(3) {
	    background-color: #b3b5fc;
	    font-weight: 600;
	    font-size: 13px;
	    border: none;
	    height: 33px;
	    width: 24%
	}
	
	.PageBox th:nth-child(4) {
	    background-color: #b3b5fc;
	    font-weight: 600;
	    font-size: 13px;
	    border: none;
	    height: 33px;
	    width: 26%
	}
	
	.PageBox th {
	    border-right: 1px solid #fff!important
	}
	
	.PageBox table tr td {
	    font-size: 11px;
	    color: #626262;
	    padding: 8px 0;
	    text-align: center;
	    border: none;
	    border-right: 1px solid #fff!important
	}
	
	table tbody tr:nth-child(odd) {
	    background: #eff0f2
	}
	
	table tbody tr:nth-child(2n) {
	    background: #e1e1f9
	}

</style>