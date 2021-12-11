// 此处第二个参数vm，就是我们在页面使用的this，你可以通过vm获取vuex等操作，更多内容详见uView对拦截器的介绍部分：
// https://uviewui.com/js/http.html#%E4%BD%95%E8%B0%93%E8%AF%B7%E6%B1%82%E6%8B%A6%E6%88%AA%EF%BC%9F
const install = (Vue, vm) => {
	//发送验证码
	let smsSend = (params = {}) => vm.$u.get('/api/sms/send', params);
	let smsCheck = (params = {}) => vm.$u.get('/api/sms/check', params);
	//登录
	let login = (params = {}) => vm.$u.get('/api/user/login', params);
	//手机号登录
	let mobilelogin = (params = {}) => vm.$u.get('/api/user/mobilelogin', params);
	//注册
	let register = (params = {}) => vm.$u.get('/api/user/register', params);
	//退出登录
	let logout = (params = {}) => vm.$u.get('/api/user/logout', params);
	//用户信息
	let user = (params = {}) => vm.$u.get('/api/user/index', params);
	//资金划转
	let transfer = (params = {}) => vm.$u.get('/api/user/transfer', params);
	// 根据user_id获取他人信息
	let getother = (params = {}) => vm.$u.get('/api/user/getother', params);

	//设置自动抢单
	let setauto = (params = {}) => vm.$u.get('/api/my/setauto', params);
	//提现
	let outut = (params = {}) => vm.$u.get('/api/my/outut', params);
	//邀请列表
	let inviteList = (params = {}) => vm.$u.get('/api/my/invite', params);
	//团队列表
	let teamList = (params = {}) => vm.$u.get('/api/my/team', params);
	//收益列表
	let earnList = (params = {}) => vm.$u.get('/api/my/getlog', params);
	//我的订单
	let orderList = (params = {}) => vm.$u.get('/api/my/order', params);
	//充值记录
	let inutList = (params = {}) => vm.$u.get('/api/my/inut', params);
	//提现记录
	let outlogList = (params = {}) => vm.$u.get('/api/my/outlog', params);
	//下单
	let myRun = (params = {}) => vm.$u.get('/api/my/run', params);
	//用户内部转账日志
	let transferlog = (params = {}) => vm.$u.get('/api/my/transferlog', params);

	//收益动态
	let indexGetlog = (params = {}) => vm.$u.get('/api/index/getlog', params);
	//商户入口—数据提交
	let merchant = (params = {}) => vm.$u.get('/api/index/putdata', params);


	//代理等级
	let levelList = (params = {}) => vm.$u.get('/api/level/info', params);
	//静态收益信息
	let ratePerson = (params = {}) => vm.$u.get('/api/rate/person', params);
	//联系客服
	let contact = (params = {}) => vm.$u.get('/api/common/contact', params);

	//检测手机
	let checkMobile = (params = {}) => vm.$u.get('/api/validate/check_mobile_exist', params);
	//检测昵称
	let checkUsername = (params = {}) => vm.$u.get('/api/validate/check_username_available', params);
	//检测邀请码
	let checkInvitecode = (params = {}) => vm.$u.get('/api/validate/check_invitecode_exist', params);

	// 将各个定义的接口名称，统一放进对象挂载到vm.$u.api(因为vm就是this，也即this.$u.api)下
	vm.$u.api = {
		smsSend,
		smsCheck,
		login,
		mobilelogin,
		register,
		logout,
		user,
		transfer,
		getother,

		setauto,
		outut,
		inviteList,
		teamList,
		earnList,
		orderList,
		inutList,
		outlogList,
		myRun,
		transferlog,

		indexGetlog,
		merchant,
		
		levelList,
		ratePerson,
		contact,
		checkMobile,
		checkUsername,
		checkInvitecode,
	};
}

export default {
	install
}
