<?php

namespace App\Controller;

use App\Core\Auth;
use App\Core\Cookie;
use App\Core\Controller;
use App\Core\Request;
use App\Model\StatisticsModel;

class StatisticsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function statistics()
    {
        Auth::checkAuthentication();
        Auth::ktraquyen("CN12");
        $this->View->render('statistics/statistics');
    }

    public function statisticByDay(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN12");
        $ngaybd = Request::post('ngaybd');
        $ngaykt = Request::post('ngaykt');
        $kq = StatisticsModel::statisticByDay($ngaybd,$ngaykt);
        if($kq == null ){
            $response['thanhcong'] = false;
        } else{   
            $response['data'] = $kq['data'];
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
    }

    public function statisticByMonth(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN12");
        $thangbd = Request::post('thangbd');
        $thangkt = Request::post('thangkt');
        $kq = StatisticsModel::statisticByMonth($thangbd,$thangkt);
        if($kq == null ){
            $response['thanhcong'] = false;
        } else{   
            $response['data'] = $kq['data'];
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
    }

    public function statisticByYear(){
        Auth::checkAuthentication();
        Auth::ktraquyen("CN12");
        $nambd = Request::post('nambd');
        $namkt = Request::post('namkt');
        $kq = StatisticsModel::statisticByYear($nambd,$namkt);
        if($kq == null ){
            $response['thanhcong'] = false;
        } else{   
            $response['data'] = $kq['data'];
            $response['thanhcong'] = true;
        }
        $this->View->renderJSON($response);
    }
}