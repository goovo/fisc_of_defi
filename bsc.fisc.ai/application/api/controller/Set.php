<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Setting;
use app\common\model\Bep20Email;
use app\common\model\Bep20Address;
/**
 * 配置参数控制层
 */
class Set extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['get', 'json','email'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

    /**
     * 测试方法
     *
     * @ApiTitle    (测试名称)
     * @ApiSummary  (测试描述信息)
     * @ApiMethod   (POST)
     * @ApiRoute    (/api/demo/test/id/{id}/name/{name})
     * @ApiHeaders  (name=token, type=string, required=true, description="请求的Token")
     * @ApiParams   (name="id", type="integer", required=true, description="会员ID")
     * @ApiParams   (name="name", type="string", required=true, description="用户名")
     * @ApiParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据")
     * @ApiReturnParams   (name="code", type="integer", required=true, sample="0")
     * @ApiReturnParams   (name="msg", type="string", required=true, sample="返回成功")
     * @ApiReturnParams   (name="data", type="object", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}", description="扩展数据返回")
     * @ApiReturn   ({
         'code':'1',
         'msg':'返回成功'
        })
     */


    public function get($env)
    {
		if( trim(strtolower($env)) == 'prod' ) {
			$env = 'prod';
		} else {
			$env = 'test';
		}
		$map['env'] = $env;
		$map['state'] = 1;
		$one = Setting::where($map)->find();
        $this->success('返回成功', $one );
    }

	public function json()
    {
		$data = ['ver'=>100, 'json'=>'https://bsc.fisc.ai/uploads/GinPledge.json' ];
        $this->success('返回成功', $data );
    }

    /**
     * 提交邮件地址
     *
     */
    public function email()
    {
		// 若存在 bep20 地址，则检索其ID并关联email
		$bid = 0;
		if( isset($_REQUEST['bep20']) ) {
			$bep20 = trim($_REQUEST['bep20']);
			$map = ['address'=>$bep20];
			$address = Bep20Address::where($map)->find();
			if( isset($address->id) ) {
				$bid = $address->id;
			} else {
				$Address = new Bep20Address;
				$Address->address = $bep20;
				$Address->save();
				$bid = $Address->id;
			}
		}

		if( isset($_REQUEST['email']) ) {
			$email = trim($_REQUEST['email']);
			$map = ['email'=>$email];
			$eMail = Bep20Email::where($map)->find();
			if( isset($eMail->id) ) {
				$eMail->bid = $bid;
				$eMail->save();
			} else {
				$Mail = new Bep20Email;
				$Mail->email = $email;
				$Mail->bid = $bid;
				$Mail->save();
			}
		}
        $this->success('数据正常');
    }

    /**
     * 需要登录的接口
     *
     */
    public function test2()
    {
        $this->success('返回成功', ['action' => 'test2']);
    }

    /**
     * 需要登录且需要验证有相应组的权限
     *
     */
    public function test3()
    {
        $this->success('返回成功', ['action' => 'test3']);
    }

}
