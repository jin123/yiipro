<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		//$this->nTime = time();
        $map['shakeid'] = $_GET['shakeid'];
    //    $map['wechater'] = $this->wecha_id;
		//var_dump($map['shakeid']);exit;
        $strength = M('ShakeParter')->where($map)->getField('strength');
        $this->strength = $strength?$strength:0;

		$shakeInfo = D('Shake')->getShakeInfo($this->shakeid,$this->token);

		$this->assign('shakeInfo',$shakeInfo);
		$this->assign('strength',$this->strength);
		$this->assign('nTime',$this->nTime);
		$this->assign('wecha_id',$this->wecha_id);
		$this->assign('shakeid',$this->shakeid);
		$this->assign('token',$this->token);
		$this->render('index');
	}
	public function actionIsStart()
    {
        $shakeInfo = D('Shake')->getShakeInfo(trim($_REQUEST['shakeid']),trim($_REQUEST['token']));
		file_put_contents('shakeinfosql.txt',D('Shake')->getLastSql());
        $startTime = $shakeInfo['start_time'];
        $duration = $shakeInfo['duration'];
        $nTime = time();
		$where['shakeid']=trim($_REQUEST['shakeid']);
		$list_delay=M('Shake')->where($where)->find();
		$delay=$list_delay['delay'];
        if (empty($startTime) or $nTime < $startTime) {
            $result['start'] = 1;
        } elseif ($nTime > $startTime + $delay ) {//+ $duration
            $result['start'] = 3;
        } else {
            $result['start'] = 2;
        }
		$result['duration']=$duration;
        exit(json_encode($result));
    }
    function actionAddStrength(){
    
    
     $strength = trim($_POST['strength'])?trim($_POST['strength']):0;
        $shakeid = trim($_POST['shakeid']);
        // $start_time = $_POST['start_time'];
        $wechater = trim($_POST['wechater']);
        if (D('Shake')->addStrength($strength, $shakeid, $wechater)) {
            $result['success'] = 1;
        } else {
            $result['success'] = 0;
        }
        echo json_encode($result);
    
    
    }
}