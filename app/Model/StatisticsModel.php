<?php

namespace App\Model;

use App\Core\Cookie;
use App\Core\DatabaseFactory;
use PDO;

class StatisticsModel
{

    public static function statisticByDay($ngaybd, $ngaykt)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT DATE(ngay_lap_hoa_don) as thoigian,SUM(thanh_tien) as tongtien FROM `hoa_don` 
        WHERE ngay_lap_hoa_don BETWEEN '$ngaybd 00:00:00' AND '$ngaykt 23:59:59' 
        GROUP BY DATE(ngay_lap_hoa_don)
        ORDER BY DATE(ngay_lap_hoa_don)";
        $query = $database->query($sql);
        $data = $query->fetchAll();

        $arr = array();

        foreach ($data as $k) {
            $tg = $k->thoigian;
            $sql1 = "SELECT SUM(v.gia_goc) as tienvon
            FROM `chi_tiet_hoa_don` as cthd, ve as v ,hoa_don as hd
            WHERE cthd.ma_ve = v.ma_ve AND DATE(hd.ngay_lap_hoa_don)='$tg' AND cthd.ma_hoa_don = hd.ma_hoa_don";
            $qr = $database->query($sql1);
            $data = $qr->fetch();
            $arr1 = array();
            $arr1['thoigian'] = $k->thoigian;
            $arr1['tienthuve'] = $k->tongtien;
            $arr1['tienvon'] = $data->tienvon;
            $arr1['loinhuan'] = $k->tongtien - $data->tienvon;
            array_push($arr, $arr1);
        }

        $check = true;
        if (!$query) {
            $check = false;
        }
        $response = [
            'thanhcong' => $check,
            'data' => $arr,
        ];
        return $response;
    }

    public static function statisticByMonth($thangbd, $thangkt)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT MONTH(ngay_lap_hoa_don) as thoigian1,YEAR(ngay_lap_hoa_don) as thoigian2,SUM(thanh_tien) as tongtien FROM `hoa_don` 
        WHERE ngay_lap_hoa_don BETWEEN '$thangbd-01 00:00:00' AND '$thangkt-31 23:59:59' 
        GROUP BY MONTH(ngay_lap_hoa_don),YEAR(ngay_lap_hoa_don)
        ORDER BY YEAR(ngay_lap_hoa_don),MONTH(ngay_lap_hoa_don)";
        $query = $database->query($sql);
        $data = $query->fetchAll();

        $arr = array();

        foreach ($data as $k) {
            $thang = $k->thoigian1;
            $nam = $k->thoigian2;
            $sql1 = "SELECT SUM(v.gia_goc) as tienvon
            FROM `chi_tiet_hoa_don` as cthd, ve as v ,hoa_don as hd
            WHERE cthd.ma_ve = v.ma_ve AND MONTH(hd.ngay_lap_hoa_don)='$thang' AND YEAR(hd.ngay_lap_hoa_don)='$nam'
            AND cthd.ma_hoa_don = hd.ma_hoa_don";
            $qr = $database->query($sql1);
            $data = $qr->fetch();
            $arr1 = array();
            $arr1['thang'] = $k->thoigian1;
            $arr1['nam'] = $k->thoigian2;
            $arr1['tienthuve'] = $k->tongtien;
            $arr1['tienvon'] = $data->tienvon;
            $arr1['loinhuan'] = $k->tongtien - $data->tienvon;
            array_push($arr, $arr1);
        }

        $check = true;
        if (!$query) {
            $check = false;
        }
        $response = [
            'thanhcong' => $check,
            'data' => $arr,
        ];
        return $response;
    }

    public static function statisticByYear($nambd, $namkt)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT YEAR(ngay_lap_hoa_don) as thoigian,SUM(thanh_tien) as tongtien FROM `hoa_don` 
        WHERE ngay_lap_hoa_don BETWEEN '$nambd-01-01 00:00:00' AND '$namkt-12-31 23:59:59' 
        GROUP BY YEAR(ngay_lap_hoa_don)
        ORDER BY YEAR(ngay_lap_hoa_don)";
        $query = $database->query($sql);
        $data = $query->fetchAll();

        $arr = array();

        foreach ($data as $k) {
            $tg = $k->thoigian;
            $sql1 = "SELECT SUM(v.gia_goc) as tienvon
            FROM `chi_tiet_hoa_don` as cthd, ve as v ,hoa_don as hd
            WHERE cthd.ma_ve = v.ma_ve AND YEAR(hd.ngay_lap_hoa_don)='$tg' AND cthd.ma_hoa_don = hd.ma_hoa_don";
            $qr = $database->query($sql1);
            $data = $qr->fetch();
            $arr1 = array();
            $arr1['thoigian'] = $k->thoigian;
            $arr1['tienthuve'] = $k->tongtien;
            $arr1['tienvon'] = $data->tienvon;
            $arr1['loinhuan'] = $k->tongtien - $data->tienvon;
            array_push($arr, $arr1);
        }

        $check = true;
        if (!$query) {
            $check = false;
        }
        $response = [
            'thanhcong' => $check,
            'data' => $arr,
        ];
        return $response;
    }
}
