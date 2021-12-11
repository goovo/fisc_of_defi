<template>
	<view class="container">
		<image class="bg" src="../static/images/index_bg.png" mode="widthFix"></image>
		<view class="header">
			<u-icon class="icon_nav" name="nav" custom-prefix="custom-icon" size="38" color="#06F7A1"></u-icon>
			<u-icon class="icon_wallet" name="wallet" custom-prefix="custom-icon" size="38" color="#06F7A1"></u-icon>
		</view>
		<view class="caption">
			<u-image src="../static/images/ic_logo.png" mode="heightFix" :height="76" :show-loading="false">
			</u-image>
			<view class="title">
				<view>FIL算力锚锚定质押通证</view>
				<view>通过质押FISC进行FIL挖矿，并获得FIL收益</view>
			</view>
			<view class="share">
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
			</view>
			<view class="bottom">
				<u-image class="item" src="../static/images/ic_ipfs.png" mode="widthFix" :width="170" :fade="false"
					:show-loading="false"></u-image>
				<u-image class="item" src="../static/images/ic_filecoin.png" mode="widthFix" :width="170" :fade="false"
					:show-loading="false"></u-image>
			</view>
		</view>
		<view class="plan">
			<text class="title">公募预售</text>
			<view class="plan-count">
				<view>598,000枚 FISC</view>
				<view>售价: 2U</view>
			</view>
			<view class="plan-content">
				<view>
					<text class="plan-num">第一阶段</text>
					<text class="plan-date">2021年12月8日</text>
				</view>
				<view class="end-time">
					<u-count-down :timestamp="plan_time_end" :show-days="true" :hide-zero-day="true"></u-count-down>
				</view>
				<view class="plan-progress">
					<view class="progress-txt">{{plan_progress}}%</view>
					<view class="progress-bar">
						<u-line-progress :striped="true" :percent="plan_progress" :striped-active="true">
							<view class="progress-btn" :style="{marginLeft: plan_progress+'%'}"></view>
						</u-line-progress>
					</view>
					<view class="progress-txt2">
						<u-icon class="icon" name="warn" custom-prefix="custom-icon" size="32" color="#06F7A1"></u-icon>
						剩余250万枚 FISC
					</view>
				</view>
			</view>
			<u-row gutter="16" class="stage">
				<u-col span="4">
					<view class="stage-item">
						<view class="title">第二轮</view>
						<text class="content">
							1,196,000枚FISC
							2022年12月2日开始发售
							36天后开始
						</text>
					</view>
				</u-col>
				<u-col span="4">
					<view class="stage-item">
						<view class="title">第三轮</view>
						<text class="content">
							1,196,000枚FISC
							2022年12月2日开始发售
							36天后开始
						</text>
					</view>
				</u-col>
				<u-col span="4">
					<view class="stage-item">
						<view class="title2">质押正式上线</view>
					</view>
				</u-col>
			</u-row>
			<view class="buy-btn">
				购买<view class="icon"></view>
			</view>
		</view>
		<view class="rule">
			<view class="title">条规</view>
			<text class="content">
				1、这是一个条规这是一个条规这是一个条规这是一个条规这是一个。
				2、这是一个条规这是一个条规这是一个条规这是一个条规这是一个。
				3、这是一个条规这是一个条规这是一个条规这是一个条规这是一个。
				4、这是一个条规这是一个条规这是一个条规这是一个条规这是一个。
			</text>
		</view>
		<view class="email">
			<view class="title">输入订阅邮箱</view>
			<view class="input-box">
				<input class="input" type="text" placeholder="请输入你的邮箱" />
				<view class="btn">点击订阅</view>
			</view>
		</view>
		<view class="about">
			<view class="title">关注我们</view>
			<view class="way">
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
				<u-icon class="item" name="" custom-prefix="custom-icon" size="30" color="#06F7A1"></u-icon>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				plan_time_end: 888000,
				plan_progress: 80,
			}
		},
		mounted() {

		},
		onShow() {
			this.$DApp.init();
		},
		onHide() {},
		methods: {}
	}
</script>

<style scoped lang="scss">
	.container {}

	.bg {
		top: 220rpx;
		position: absolute;
		-webkit-animation: breathe 3s infinite;
		animation: breathe 3s infinite;
	}

	.header {
		width: 100%;
		padding: 44rpx;
	}

	.header .icon_nav {
		float: left;
	}

	.header .icon_wallet {
		float: right;
	}

	.caption {
		position: relative;
		text-align: center;
		margin-top: 50rpx;
	}

	.caption .title {
		margin-top: 20rpx;
		font-size: 28rpx;
		color: #06F7A1;
		line-height: 48rpx;
	}

	.caption .share {
		width: 100%;
		position: relative;
		margin-top: 20rpx;
	}

	.caption .share .item {
		width: 60rpx;
		height: 60rpx;
		margin: 0 8rpx;
		padding: 15rpx;
		border-radius: 50%;
		background-color: rgba(255, 255, 255, 0.12);
	}

	.caption .bottom {
		width: 100%;
		text-align: center;
		margin-top: 30rpx;
	}

	.caption .bottom .item {
		width: 100rpx;
		display: inline-block;
	}

	.plan {
		width: 100%;
		margin-top: 20rpx;
		padding: 30rpx;
		display: inline-block;
		position: relative;
		background-color: rgba(255, 255, 255, 0.05);
	}

	.plan .title {
		color: #ffffff;
		font-size: 28rpx;
		font-weight: bold;
		display: flex;
		justify-content: center;
	}

	.plan .plan-count {
		font-size: 24rpx;
		color: #ffffff;
		position: absolute;
		top: 30rpx;
		right: 36rpx;
		text-align: right;
		line-height: 40rpx;
	}

	.plan-content {
		margin-top: 20rpx;
		padding: 0 18rpx;
	}

	.plan-content .plan-num {
		font-size: 20rpx;
		color: #D8D8D8;
	}

	.plan-content .plan-date {
		margin-left: 14rpx;
		font-size: 24rpx;
		color: #ffffff;
	}

	.plan-content .end-time {
		margin-top: 44rpx;
		text-align: center;
		font-weight: bold;
		margin-bottom: 30rpx;
	}

	.plan-content .plan-progress {
		padding: 20rpx 10rpx;
		position: relative;
	}

	.plan-content .plan-progress .progress-txt {
		font-size: 20rpx;
		color: #06F7A1;
		float: right;
		padding-bottom: 16rpx;
		padding-right: 10rpx;
		position: relative;
	}

	.plan-content .plan-progress .progress-txt2 {
		height: 48rpx;
		line-height: 48rpx;
		font-size: 20rpx;
		color: #06F7A1;
		float: right;
		padding-right: 10rpx;
		position: relative;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.plan-content .plan-progress .progress-txt2 .icon {
		margin-right: 6rpx;
	}

	.plan-content .plan-progress .progress-bar {
		padding: 16rpx 0rpx;
		position: relative;
	}

	.plan-content .progress-bar .progress-btn {
		width: 52rpx;
		height: 52rpx;
		left: -26rpx;
		position: absolute;
		background: url(../static/images/ic_progress_btn.png) no-repeat center bottom/100% 100%;
	}

	.plan .stage {
		width: 100%;
		padding: 20rpx 0rpx;
	}

	.plan .stage-item {
		width: 100%;
		min-height: 250rpx;
		border-radius: 8rpx;
		padding: 20rpx;
		background-color: rgba(254, 254, 254, 0.12);
		position: relative;
		display: grid;
		align-items: center;
	}

	.plan .stage-item .title {
		margin-bottom: 8rpx;
		color: #07E99A;
		font-size: 20rpx;
		line-height: 32rpx;
		text-align: center;
	}

	.plan .stage-item .content {
		color: #ffffff;
		font-size: 18rpx;
		line-height: 32rpx;
	}

	.plan .stage-item .title2 {
		color: #07E99A;
		font-size: 24rpx;
		font-weight: bold;
		text-align: center;
		text-shadow: 1px 1px 2px #000;
	}

	.plan .buy-btn {
		width: 382rpx;
		height: 84rpx;
		color: #ffffff;
		font-size: 28rpx;
		text-align: center;
		padding-bottom: 20rpx;
		display: flex;
		justify-content: center;
		align-items: center;
		margin: 30rpx auto 0;
		background: url(../static/images/ic_buy_btn.png) no-repeat center bottom/100% 100%;
	}

	.plan .buy-btn .icon {
		width: 30rpx;
		height: 30rpx;
		margin-left: 10rpx;
		align-items: center;
		background: url(../static/images/ic_coin.png) no-repeat center bottom/100% 100%;
	}

	.rule {
		padding: 32rpx 62rpx;
	}

	.rule .title {
		color: #07E99A;
		font-size: 24rpx;
		margin-bottom: 24rpx;
	}

	.rule .content {
		color: #ffffff;
		font-size: 24rpx;
		line-height: 36rpx;
	}

	.email {
		text-align: center;
		padding: 36rpx 0 0;
	}

	.email .title {
		color: #07E99A;
		font-size: 28rpx;
	}

	.email .input-box {
		margin: 36rpx auto 0;
		width: 480rpx;
		height: 64rpx;
		border-radius: 8rpx;
		overflow: hidden;
		position: relative;
	}

	.email .input {
		font-size: 30rpx;
		height: 100%;
		background-color: #ffffff;
		border-radius: 8rpx;
		text-align: left;
		padding: 0 10rpx 0 20rpx;
	}

	.email .btn {
		width: 180rpx;
		height: 100%;
		font-size: 30rpx;
		color: #ffffff;
		background-color: #097226;
		top: 0;
		right: 0;
		line-height: 64rpx;
		position: absolute;
		border-top-right-radius: 8rpx;
		border-bottom-right-radius: 8rpx;
		text-shadow: 1px 1px 2px #333;
	}

	.about {
		text-align: center;
		padding: 50rpx 0 120rpx;
	}

	.about .title {
		color: #07E99A;
		font-size: 28rpx;
	}

	.about .way {
		width: 100%;
		position: relative;
		margin-top: 30rpx;
	}

	.about .way .item {
		width: 60rpx;
		height: 60rpx;
		margin: 0 8rpx;
		padding: 15rpx;
		border-radius: 50%;
		background-color: rgba(255, 255, 255, 0.12);
	}

	@keyframes breathe {
		0% {
			box-shadow: 0px 13px 30px -10px rgba(0, 0, 0, 0.8);
			-webkit-transform: rotate3d(0, 0, 0, 5deg) translate3d(0, 0, 0);
			transform: rotate3d(0, 0, 0, 5deg) translate3d(0, 0, 0);
			opacity: .4;
		}

		50% {
			box-shadow: 0px 60px 30px -30px rgba(0, 0, 0, 0.3);
			-webkit-transform: rotate3d(-30, 0, -10, 2deg) translate3d(2px, -2px, 30px);
			transform: rotate3d(-30, 0, -10, 2deg) translate3d(2px, -2px, 30px);
			opacity: 1;
		}

		100% {
			box-shadow: 0px 13px 30px -10px rgba(0, 0, 0, 0.8);
			-webkit-transform: rotate3d(0, 0, 0, 5deg) translate3d(0, 0, 0);
			transform: rotate3d(0, 0, 0, 5deg) translate3d(0, 0, 0);
			opacity: .4;
		}
	}
</style>
