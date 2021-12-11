<template>
	<view class="scroll-list">
		<view class="scroll-y" :animation="animationData">
			<view class="item" v-for="(item, index) in list" :key="index" :class="index%2?'on':''">
				<view class="t1">{{ item.phone }}</view>
				<view class="t2">{{ item.cc }}</view>
				<view class="t3">{{ item.time }}</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		name: "tony-scroll",
		props: {
			list: '',
			is_scroll: true,
		},
		data() {
			return {
				orderScrollY: 0,
				animationData: {},
				interval: null,
				hs: 0,
				hy: 0,
				hw: 0,
			}
		},
		components: {},
		mounted() {},
		methods: {
			async startScroll() {
				let rectInfo1 = await this.$u.getRect('.scroll-list');
				let rectInfo2 = await this.$u.getRect('.scroll-y');
				this.hs = rectInfo1.height;
				this.hy = rectInfo2.height;
				this.hw = this.hy - this.hs - (this.hs - this.hy % this.hs);

				if (this.list.length <= 10 || this.hw < 0) {
					return;
				}

				let speed = 30;
				let animation = uni.createAnimation({
					duration: 0,
					timingFunction: 'linear',
					delay: 0
				});
				this.animation = animation;

				clearInterval(this.interval);
				this.interval = setInterval(() => {
					if (!this.is_scroll) {
						return;
					}
					if (this.orderScrollY > this.hw) {
						animation.translateY(0).step();
						this.orderScrollY = 0;
						this.animationData = animation.export();
					} else {
						this.orderScrollY = this.orderScrollY + 1;
						animation.translateY(-this.orderScrollY).step();
						this.animationData = animation.export();
					}
				}, speed);

			},
		}
	};
</script>

<style>
	.scroll-list {
		height: 600rpx;
		width: 100%;
		overflow: hidden;
		position: relative;
		margin-top: 30rpx;
		background-color: #FFFFFF;
	}

	.scroll-list .scroll-y {
		width: 100%;
		position: absolute;
	}

	.item {
		width: 100%;
		height: 72rpx;
		line-height: 72rpx;
		text-align: center;
		color: #191919;
		font-size: 24rpx;
	}

	.item.on {
		background-color: #f2f2f2;
	}

	.item .t1 {
		width: 30%;
		float: left;
	}

	.item .t2 {
		width: 40%;
		float: left;
	}

	.item .t3 {
		width: 30%;
		float: left;
		color: #f46b56
	}
</style>
