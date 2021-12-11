<script>
	import Vue from 'vue';
	export default {
		// 公共数据
		globalData: {
			address_my: ''
		},
		onLaunch: function() {
			uni.getSystemInfo({
				success: function(e) {
					// #ifndef MP
					Vue.prototype.StatusBar = e.statusBarHeight;
					if (e.platform == 'android') {
						Vue.prototype.CustomBar = e.statusBarHeight + 50;
					} else {
						Vue.prototype.CustomBar = e.statusBarHeight + 45;
					}
					// #endif

					// #ifdef MP-WEIXIN
					Vue.prototype.StatusBar = e.statusBarHeight;
					let custom = wx.getMenuButtonBoundingClientRect();
					Vue.prototype.Custom = custom;
					Vue.prototype.CustomBar = custom.bottom + custom.top - e.statusBarHeight;
					// #endif

					// #ifdef MP-ALIPAY
					Vue.prototype.StatusBar = e.statusBarHeight;
					Vue.prototype.CustomBar = e.statusBarHeight + e.titleBarHeight;
					// #endif

					// #ifdef H5
					/* 窗口宽度 大于420px且不在PC页面时，跳转至PC页面 */
					// if (e.windowWidth > 420 && !window.top.isPC) {
					// 	let url = window.location.href;
					// 	// decodeURIComponent(url);
					// 	window.location.href = '/h5/static/html/pc.html?url=' + url;
					// }
					// #endif
				}
			});

			//#ifdef APP-PLUS
			uniCloud.callFunction({
				name: 'chb-check-update',
				data: {
					appid: plus.runtime.appid,
					version: plus.runtime.version
				},
				success(e) {
					if (e.result.isUpdate) { //需要更新
						// 提醒用户更新
						uni.showModal({
							title: '更新提示',
							content: e.result.note ? e.result.note : '有新的版本',
							showCancel: false,
							confirmText: '立即升级',
							success: (ee) => {
								if (ee.confirm) {
									plus.runtime.openURL(e.result.url);
								}
							}
						})
					}
				}
			});
			//#endif  
		},
		onShow: function() {
			console.log('App Show')
		},
		onHide: function() {
			console.log('App Hide')
		},
		methods: {
			userRefresh() {
				return new Promise((resolve, reject) => {
					if (!uni.getStorageSync('token')) {
						reject("not token");
						return;
					}
					this.$u.api.user({}).then(res => {
						if (res.code == 0) {
							uni.setStorageSync('user', res.data);
							uni.setStorageSync('token', res.data.userinfo.token);
							resolve(res.data)
						} else {
							reject(res);
						}
					});
				});
			},
		}
	}
</script>

<style lang="scss">
	@import "uview-ui/index.scss";
	@import "common/global.scss";
	@import "./static/font/iconfont.css";
</style>
