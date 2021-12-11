<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\model\Bep20Address;
use app\common\model\PledgeLogs;
use app\common\model\ProfitLogs;
use think\exception\HttpResponseException;
use think\Request;
use think\Response;

/**
 * 数据统计
 */
class Statistics extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['get', 'putFisc', 'putFil', 'info','pledgelogs','profitlogs'  ];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

	// 
    public function get()
    {
		$one = [
			'fil_mint_num'				=>	61.21,			// 昨天5P算力挖出多少FIL
			'fisc_pledge_num'		=>	12.29,			// 昨天有多少FISC在质押中
			'fisc_to_fil_num'			=>	0.0012,			// 昨天每枚质押的FISC获得多少FIL
			'fisc_destroy_num'		=>	0.00019,		// 昨天有多少FISC被销毁
			'fisc_destroy_total'		=>	611.8219,		// fisc总共销毁数量
			'fisc_price_dex'			=>	9.8791,			// fisc当前在去中心化交易所的价格
			'fil_price_dex'				=>	70.871,			// FIL当前在去中心化交易所的价格
			'fisc_total_num'			=>	5000000,		// fisc发行总数
			'fisc_year_apy'			=>	27190,			// Fisc APY(复利年化收益率%)
			'fisc_to_fil_today'		=>	0.00021,		// 预计今天每枚FISC质押产出fil的数量
			'fisc_today_price'		=>	0.8,					// 今天的Fisc公募价
			'fisc_days_surplus'		=>	363749,		// Fisc公募剩余数
			'fisc_day_end'			=>	time(),			// Fisc公募截至日期-时间戳
			'fisc_public_sale_str'	=>	'1',					// 公募当前阶段
			'fisc_current_salenum'	=>	500000,		// 当前阶段公募数量
			'fisc_next_salenum'		=>	500000,		// 下一阶段公募数量
		];
        $this->success('返回成功', $one );
    }

	// 提交参数
	// 1:  质押成功时，将bep20地址、质押fisc数量传递到后台接口
    public function putFisc()
    {
		$to = 'Y';  // default value
		if( isset($_REQUEST['bep20']) && isset($_REQUEST['fisc_num']) ) {
			$bep20		= trim($_REQUEST['bep20']);
			$fiscNum	= trim($_REQUEST['fisc_num']);
			if( isset($_REQUEST['to']) ) {
				$to	= $_REQUEST['to']=='Y' ? 'Y': 'N';
			} else 
			$id = $this->getIdFromBep20($bep20);

			$one = new PledgeLogs;
			$one->bid	= $id;
			$one->to		= $to;
			$one->num	= $fiscNum;
			$one->save();		
		}
		
		
		
        $this->success('数据成功提交', null );
    }

	// 2:  提取质押奖励时，将bep20地址、提取fil数量传递到后台接口
    public function putFil()
    {
		if( isset($_REQUEST['bep20']) && isset($_REQUEST['fil_num']) ) {
			$bep20		= trim($_REQUEST['bep20']);
			$fil_num	= trim($_REQUEST['fil_num']);
			$id = $this->getIdFromBep20($bep20);

			$one = new ProfitLogs;
			$one->bid   = $id;
			$one->num = $fil_num;
			$one->save();
		}
		
        $this->success('数据成功提交'  );
    }

	// 根据bep20地址查询并返回信息
	public function info()
    {
		$one = [
			'bep20'						=>	'0x16939ef78684453bfdfb47825f8a5f714f12623a',	// bep20地址
			'fisc_have_num'			=>	61.21,			// 当前持有fisc额度
			'fisc_pledge_num'		=>	12.29,			// 质押中的fisc额度
			'fil_total_num'				=>	0.0012,			// 总共获取的Fil收益  
		];
        $this->success('查询成功', $one );
    }

	// 质押日志列表
	public function pledgelogs()
    {
		$_REQUEST['bep20'] = 1;
		$_REQUEST['page'] = 1;
		$_REQUEST['pageSize'] = 10;
		$data = [
				[
					'id'		=> 1,
					'time'		=> '2021-10-30 12:31:59',
					'to'		=> '质押',
					'num'	=> 992.11,
				],
				[
					'id'		=> 2,
					'time'		=> '2021-10-30 21:16:57',
					'to'		=> '质押',
					'num'	=> 5210,
				],
			];
        $this->fisc_success('查询成功', $data );
    }

	// 质押收益列表
	public function profitlogs()
    {
		$_REQUEST['page'] = 1;
		$_REQUEST['pageSize'] = 10;
		$data = [
				[
					'id'		=> 1,
					'time'		=> '2021-10-30 12:31:59', 
					'num'	=> 0.511,
				],
				[
					'id'		=> 2,
					'time'		=> '2021-10-30 21:16:57', 
					'num'	=> 1.9921,
				],
			];
        $this->fisc_success('查询成功', $data );
    }

	// 检索并返回ID
	protected function getIdFromBep20($bep20) {
		$id = 0;
		if($bep20 ) {
			$map['address'] = $bep20;
			$have = Bep20Address::where($map)->find();
			if( isset($have['id']) )
				$id = $have['id'];
			else {
				$one = new Bep20Address;
				$one->address = $bep20;
				$one->save();
				$id = $one->id;
			}
		}
		return $id;
	}

	// 返回信息封装
	protected function fisc_success($msg, $data = null, $code = 0, $type = null, array $header = [])
    {
        $result = [
            'code' => $code,
            'msg'  => $msg,
            'time' => Request::instance()->server('REQUEST_TIME'),
            'data' => $data,
        ];
		if( isset($_REQUEST['page']) ) {
			$result['page'] = $_REQUEST['page'];
		}
		if( isset($_REQUEST['pageSize']) ) {
			$result['pageSize'] = $_REQUEST['pageSize'];
		}
        // 如果未设置类型则自动判断
        $type = $type ? $type : ($this->request->param(config('var_jsonp_handler')) ? 'jsonp' : $this->responseType);

        if (isset($header['statuscode'])) {
            $code = $header['statuscode'];
            unset($header['statuscode']);
        } else {
            //未设置状态码,根据code值判断
            $code = $code >= 1000 || $code < 200 ? 200 : $code;
        }
        $response = Response::create($result, $type, $code)->header($header);
        throw new HttpResponseException($response);
    }


}
