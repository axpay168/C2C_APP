<template>
	<view class="Body">
		<view class="PageBox">
			<view class="van-nav-bar van-nav-bar--fixed">
				<view class="van-nav-bar__content">
					<view class="van-nav-bar__left">
						<i class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i>
					</view>
					<view class="van-nav-bar__title van-ellipsis">
						忘記密碼
					</view>
				</view>
			</view>
			<view class="ScrollBox">
				<view class="van-tabs van-tabs--line">
					<view class="van-tabs__wrap van-tabs__wrap--scrollable">
						<view class="van-tabs__nav van-tabs__nav--line van-tabs__nav--complete" style="border-color: rgb(240, 184, 13);background-color: #13171a !important;">
							<view class="van-tab van-tab--active" style="color: rgb(240, 184, 13);">
								<span class="van-tab__text">
									<view class="activeTab">
										<p style="font-size: 16px;">郵箱</p>
									</view>
								</span>
							</view>
							<view class="van-tab" style="color: rgb(204, 204, 204);">
								<span class="van-tab__text">
									<view class="">
										<p style="font-size: 16px;">手機</p>
									</view>
								</span>
							</view>
							<view class="van-tabs__line" style="background-color: rgb(240, 184, 13); width: 60px; transform: translateX(96.5px) translateX(-50%);">
								
							</view>
						</view>
					</view>
					<view class="van-tabs__content">
						
					</view>
				</view>
				<form class="van-form">
					<view class="input van-cell van-cell--borderless van-field">
						<view class="van-field__left-icon"><i class="van-icon van-icon-manager"><!----></i></view>
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body"><input type="text" autocomplete="off" placeholder="請輸入郵箱"
									class="van-field__control"></view>
						</view>
					</view><!---->
					<view class="van-cell van-field"
						style="height: 0px; width: 0px; padding: 0px; position: absolute;">
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body"><input type="password" autocomplete="off"
									class="van-field__control"></view>
						</view>
					</view>
					<view class="input van-cell van-cell--borderless van-field">
						<view class="van-field__left-icon"><i class="van-icon van-icon-coupon"><!----></i></view>
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body"><input type="tel" inputmode="numeric" autocomplete="off"
									placeholder="請輸入驗證碼" class="van-field__control">
								<view class="van-field__button"><button type="button"
										class="van-button van-button--default van-button--mini van-button--round"
										style="margin-right: -30px; color: rgb(255, 255, 255); background: rgb(245, 199, 58); border-color: rgb(245, 199, 58);">
										<view class="van-button__content"><span data-v-161babb2=""
												class="van-button__text"><span data-v-161babb2=""
													style="color: rgb(0, 0, 0);">點擊獲取</span></span></view>
									</button></view>
							</view>
						</view>
					</view>
					<view class="input van-cell van-cell--borderless van-field">
						<view class="van-field__left-icon"><i class="van-icon van-icon-lock"><!----></i></view>
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body"><input type="password" autocomplete="off" placeholder="請輸入密碼"
									class="van-field__control">
								<view class="van-field__right-icon"><i class="van-icon van-icon-closed-eye"><!----></i>
								</view>
							</view>
						</view>
					</view>
					<view class="input van-cell van-cell--borderless van-field">
						<view class="van-field__left-icon"><i class="van-icon van-icon-lock"><!----></i></view>
						<view class="van-cell__value van-cell__value--alone van-field__value">
							<view class="van-field__body"><input type="password" autocomplete="off" placeholder="請確認您的密碼"
									class="van-field__control">
								<view class="van-field__right-icon"><i class="van-icon van-icon-closed-eye"><!----></i>
								</view>
							</view>
						</view>
					</view>
					<view style="padding: 33px 16px;">
						<p class="btn">重置密碼</p>
					</view>
				</form>
			</view>
		</view>
	</view>
</template>

<script>
</script>

<style>
	.PageBox {
	    width: 100%;
	    height: 100%;
	    padding-top: 2.875rem !important;
	    position: relative
	}
</style>