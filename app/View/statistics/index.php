<?php

use App\Core\View;

View::$activeItem = 'statistics';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AirPro</title>

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?= View::assets('css/bootstrap.css') ?>" />

    <link rel="stylesheet" href="<?= View::assets('vendors/toastify/toastify.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/perfect-scrollbar/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('vendors/bootstrap-icons/bootstrap-icons.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('css/app.css') ?>" />
    <link rel="shortcut icon" href="<?= View::assets('images/favicon.ico') ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= View::assets('css/quan.css') ?>" />
</head>

<body>
    <div id="app">
        <!-- SIDEBAR -->
        <?php View::partial('sidebar')  ?>
        <div id="main" class="layout-navbar">
            <!-- HEADER -->
            <?php View::partial('header')  ?>
            <?php View::partial('changepass')  ?>
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-7 order-md-1 order-last">
                                <label>
                                    <h3>Thống kê doanh thu</h3>
                                </label>
                            </div>
                            <div class="col-12 col-md-5 order-md-2 order-first">
                                <div class=" loat-start float-lg-end mb-3">
                                    <select class="btn btn btn-primary" name="search-cbb" id="time"
                                        onchange="timeAjax()">
                                        <option value="ngay">Thống kê theo ngày</option>
                                        <option value="thang">Thống kê theo tháng</option>
                                        <option value="nam">Thống kê theo năm</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row" id='view-time'>
                            <div class="col-12 col-md-5">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-4 col-4">
                                        <label class="col-form-label">
                                            <h6>Ngày bắt đầu</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <input type="date" class="form-control" id="view-ngaybd" name="ngaybd"
                                            onchange="checkdate()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-4 col-4">
                                        <label class="col-form-label">
                                            <h6>Ngày kết thúc</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <input type="date" class="form-control" id="view-ngaykt" name="ngaykt"
                                            onchange="checkdate()">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4>Doanh thu theo thời gian</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-profile-visit"></div>
                            </div>
                        </div>
                    </section>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-danger" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Thời gian</th>
                                                <th>Tổng tiền thu được</th>
                                                <th>Tổng tiền vốn</th>
                                                <th>Lợi nhuận</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= View::assets('vendors/toastify/toastify.js') ?>"></script>
    <script src="<?= View::assets('vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= View::assets('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.min.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.validate.js') ?>"></script>
    <script src="<?= View::assets('js/main.js') ?>"></script>
    <script src="<?= View::assets('vendors/apexcharts/apexcharts.js') ?>"></script>
    <script src="<?= View::assets('js/changepass.js') ?>"></script>
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script>
    let cates = [];
    let datas = [];

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    $(function() {
        $('#view-ngaybd').val(new Date().toDateInputValue());
        $('#view-ngaykt').val(new Date().toDateInputValue());
        let data = {
            ngaybd: $('#view-ngaybd').val(),
            ngaykt: $('#view-ngaykt').val()
        };
        cates = [];
        datas = [];
        cates.push($('#view-ngaykt').val());
        $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByDay`, data, function(response) {
            tien = response.data;
            tien.forEach(data => {
                datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
            });
            run();
            const table1 = $('#table1 > tbody');
            table1.empty();
            checkedRows = [];
            $row = 0;

            tien.forEach(data => {
                let disabled = "disabled btn icon icon-left btn-secondary";
                if ($row % 2 == 0) {

                    table1.append(`
                    <tr class="table-light">
                        <td>${data.thoigian}</td>
                        <td>${data.tienthuve}</td>
                        <td>${data.tienvon}</td>                        
                        <td>${data.loinhuan}</td>
                    </tr>`);
                } else {
                    table1.append(`
                    <tr class="table-info">
                        <td>${data.thoigian}</td>
                        <td>${data.tienthuve}</td>
                        <td>${data.tienvon}</td>                        
                        <td>${data.loinhuan}</td>
                    </tr>`);
                }
                $row += 1;
            });
        });
    });

    function checkdate() {
        if ($('#view-ngaykt').val() > (new Date().toDateInputValue())) {
            alert("Ngày kết thúc không được lớn hơn ngày hiện tại");
            $('#view-ngaykt').val(new Date().toDateInputValue());
        } else if ($('#view-ngaybd').val() > $('#view-ngaykt').val()) {
            alert("Ngày bắt đầu không được lớn hơn ngày kết thúc");
            $('#view-ngaybd').val($('#view-ngaykt').val());
            $('#view-ngaybd').focus();
        } else {
            cates = [];
            datas = [];
            let data = {
                ngaybd: $('#view-ngaybd').val(),
                ngaykt: $('#view-ngaykt').val()
            }
            $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByDay`, data, function(response) {
                tien = response.data;
                tien.forEach(data => {
                    datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
                    cates.push(data.thoigian);
                });
                run();
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;

                tien.forEach(data => {
                    let disabled = "disabled btn icon icon-left btn-secondary";
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    }
                    $row += 1;
                });
            });
        }
    }

    function checkmonth() {
        if ($('#thangkt').val() > (new Date().toDateInputValue().substr(0, 7))) {
            alert("Tháng kết thúc không được lớn hơn tháng hiện tại");
            $('#thangkt').val(new Date().toDateInputValue().substr(0, 7));
        } else if ($('#thangbd').val() > $('#thangkt').val()) {
            alert("Tháng bắt đầu không được lớn hơn tháng kết thúc");
            $('#thangbd').focus();
            $('#thangbd').val($('#thangkt').val());
        } else {
            cates = [];
            datas = [];
            let data = {
                thangbd: $('#thangbd').val(),
                thangkt: $('#thangkt').val()
            }
            $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByMonth`, data, function(response) {
                tien = response.data;
                tien.forEach(data => {
                    datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
                    cates.push(data.nam + "-" + data.thang);
                });
                run();
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;

                tien.forEach(data => {
                    let disabled = "disabled btn icon icon-left btn-secondary";
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>${data.nam+"-"+data.thang}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>${data.nam+"-"+data.thang}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    }
                    $row += 1;
                });
            });
        }
    }

    function checkyear() {
        if ($('#yearbd').val() > $('#yearkt').val()) {
            alert("Tháng bắt đầu không được lớn hơn tháng kết thúc");
            $('#yearbd').focus();
            $('#yearbd').val($('#yearkt').val());
        } else {
            cates = [];
            datas = [];
            $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByYear`, data, function(response) {
                tien = response.data;
                tien.forEach(data => {
                    datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
                    cates.push(data.thoigian);
                });
                run();
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;

                tien.forEach(data => {
                    let disabled = "disabled btn icon icon-left btn-secondary";
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    }
                    $row += 1;
                });
            });
        }
    }

    function timeAjax() {
        let search = $('#time option').filter(':selected').val();
        if (search == "ngay") {
            $('#view-time').empty();
            $('#view-time').append(`<div class="col-12 col-md-5">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-4 col-4">
                                        <label class="col-form-label">
                                            <h6>Ngày bắt đầu</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <input type="date" class="form-control" id="view-ngaybd" name="ngaybd"
                                            onchange="checkdate()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-4 col-4">
                                        <label class="col-form-label">
                                            <h6>Ngày kết thúc</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <input type="date" class="form-control" id="view-ngaykt" name="ngaykt"
                                            onchange="checkdate()">
                                    </div>
                                </div>
                            </div>`);
            $('#view-ngaybd').val(new Date().toDateInputValue());
            $('#view-ngaykt').val(new Date().toDateInputValue());
            cates = [];
            datas = [];
            let data = {
                ngaybd: $('#view-ngaybd').val(),
                ngaykt: $('#view-ngaykt').val()
            };
            $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByDay`, data, function(response) {
                tien = response.data;
                tien.forEach(data => {
                    datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
                    cates.push(data.thoigian);
                });
                run();
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;

                tien.forEach(data => {
                    let disabled = "disabled btn icon icon-left btn-secondary";
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    }
                    $row += 1;
                });
            });

        } else if (search == "thang") {
            $('#view-time').empty();
            $('#view-time').append(`<div class="col-12 col-md-5">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-4 col-4">
                                        <label class="col-form-label">
                                            <h6>Tháng bắt đầu</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <input type="month" class="form-control" id="thangbd" name="thangbd"
                                            onchange="checkmonth()">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-4 col-4">
                                        <label class="col-form-label">
                                            <h6>Tháng kết thúc</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-8 col-8">
                                        <input type="month" class="form-control" id="thangkt" name="thangkt"
                                            onchange="checkmonth()">
                                    </div>
                                </div>
                            </div>`);
            $('#thangbd').val(new Date().toDateInputValue().substr(0, 7));
            $('#thangkt').val(new Date().toDateInputValue().substr(0, 7));
            cates = [];
            datas = [];
            let data = {
                thangbd: $('#thangbd').val(),
                thangkt: $('#thangkt').val()
            };
            $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByMonth`, data, function(response) {
                tien = response.data;
                tien.forEach(data => {
                    datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
                    cates.push(data.nam + "-" + data.thang);
                });
                run();
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;

                tien.forEach(data => {
                    let disabled = "disabled btn icon icon-left btn-secondary";
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>${data.nam+"-"+data.thang}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>${data.nam+"-"+data.thang}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    }
                    $row += 1;
                });
            });

        } else if (search == "nam") {
            $('#view-time').empty();
            $('#view-time').append(`<div class="col-12 col-md-4">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-5 col-6">
                                        <label class="col-form-label">
                                            <h6>Năm bắt đầu</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-5 col-6">
                                    <select class="form-select" id="yearbd" onchange="checkyear()">
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group row align-items-center">
                                    <div class="col-lg-5 col-6">
                                        <label class="col-form-label">
                                            <h6>Năm kết thúc</h6>
                                        </label>
                                    </div>
                                    <div class="col-lg-5 col-6">
                                    <select class="form-select" id="yearkt" onchange="checkyear()">
                                    </select>
                                    </div>
                                </div>
                            </div>`);
            for (var i = 2022; i > 2000; i--) {
                $('#yearbd').append(` 
                                    <option value="${i}">${i}</option>`);
                $('#yearkt').append(` 
                                    <option value="${i}">${i}</option>`);
            }
            cates = [];
            datas = [];
            let data = {
                nambd: $('#yearbd').val(),
                namkt: $('#yearkt').val()
            };
            $.post(`http://localhost/SoftwareTechnologyAdmin/statistics/statisticByYear`, data, function(response) {
                tien = response.data;
                tien.forEach(data => {
                    datas.push(Math.round(data.loinhuan / 10000000 * 100) / 100);
                    cates.push(data.thoigian);
                });
                run();
                const table1 = $('#table1 > tbody');
                table1.empty();
                checkedRows = [];
                $row = 0;

                tien.forEach(data => {
                    let disabled = "disabled btn icon icon-left btn-secondary";
                    if ($row % 2 == 0) {

                        table1.append(`
                        <tr class="table-light">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    } else {
                        table1.append(`
                        <tr class="table-info">
                            <td>${data.thoigian}</td>
                            <td>${data.tienthuve}</td>
                            <td>${data.tienvon}</td>                        
                            <td>${data.loinhuan}</td>
                        </tr>`);
                    }
                    $row += 1;
                });
            });
        }
    }

    function run() {
        $("#chart-profile-visit").empty();

        var optionsProfileVisit = {
            annotations: {
                position: "back",
            },
            dataLabels: {
                enabled: false,
            },
            chart: {
                type: "bar",
                height: 300,
            },
            fill: {
                opacity: 1,
            },
            plotOptions: {},
            series: [{
                name: "Lợi nhuận (chục triệu)",
                data: datas,
            }, ],
            colors: "#435ebe",
            xaxis: {
                categories: cates,
            },
        };

        var chartProfileVisit = new ApexCharts(
            document.querySelector("#chart-profile-visit"),
            optionsProfileVisit
        );

        chartProfileVisit.render();
    }
    </script>
</body>