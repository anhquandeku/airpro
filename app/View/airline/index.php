<?php

use App\Core\Config;
use App\Core\View;

View::$activeItem = 'airline';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AirPro</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= View::assets('css/bootstrap.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('css/app.css') ?>" />
    <link rel="shortcut icon" href="<?= View::assets('images/favicon.ico') ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= View::assets('css/quan.css') ?>" />
    <link rel="stylesheet" href="<?= View::assets('css/global.css') ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

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
                    <div class="col-sm-6">
                        <h6>Tìm Kiếm</h6>
                        <div id="search-airline-form" name="search-airline-form">
                            <div class="form-group position-relative has-icon-right">
                                <input id="search-airline" type="text" class="form-control" placeholder="Tìm kiếm" value="">
                                <div class="form-control-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6">
                                <label>
                                    <h3>Danh sách hãng hàng không</h3>
                                </label>
                            </div>
                            <div class="col-6 col-md-5 order-md-2 order-first">
                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-airline' class="btn btn-danger" onclick=" handleDelete()">
                                        <i class="bi bi-trash-fill"></i> Xóa hãng
                                    </button>
                                    <button id='open-add-airline-btn' class="btn btn-primary" onClick='openModelAdd()'>
                                        <i class="bi bi-plus"></i> Thêm hãng
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-12 col-md-7 order-md-1 order-last">
                                <label>
                                    <h5> Lọc Theo:</h5>
                                </label>
                                <select class="btn btn btn-primary" name="search-cbb" id="filter-airline">
                                    <option value="0" selected>Tất Cả </option>
                                    <option value="1">Mã hãng hàng không </option>
                                    <option value="2">Tên hãng hàng không</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-danger" id="table1">
                                        <thead>
                                            <tr>
                                                <th class="list-checkbox">Chọn</th>
                                                <th>Mã</th>
                                                <th>Tên hãng hàng không</th>
                                                <th>Mô tả</th>
                                                <th>Tác Vụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <nav class="mt-5">
                                        <ul id="pagination" class="pagination justify-content-center">
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                    </section>
                </div>

                <!-- MODAL ADD -->
                <div class="modal fade text-left" id="add-airline-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm Hãng Hàng Không</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add-airline-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label for="mahanghangkhong">Mã hãng hàng không: </label>
                                        <div class="form-group">
                                            <input type="text" id="mahanghangkhong" name="mahanghangkhong" placeholder="Mã Hãng" class="form-control">
                                        </div>
                                        <label for="tenhanghangkhong">Tên hãng hàng không: </label>
                                        <div class="form-group">
                                            <input type="text" id="tenhanghangkhong" name="tenhanghangkhong" placeholder="Tên hãng" class="form-control">
                                        </div>
                                        <label for="motahanghangkhong">Mô tả: </label>
                                        <div class="form-group">
                                            <textarea type="text" id="motahanghangkhong" name="motahanghangkhong" placeholder="Mô tả" class="form-control"> </textarea>
                                        </div>
                                        <label for="loaihanghangkhong">Loại hãng: </label>
                                        <div class="form-group">
                                            <select class="form-select" name="loaihanghangkhong" id="loaihanghangkhong">
                                                <option value="1">Ký hợp đồng</option>
                                                <option value="0" selected>Công ty quản lý</option>
                                            </select>
                                        </div>
                                        <label for="ngaybanhanghangkhong">Ngày bán: </label>
                                        <ul id="view-thu-list" class="list-unstyled mb-0">
                                            <?php
                                            $s = "";
                                            for ($i = 2; $i <= 7; $i++) {
                                                $s .= "<li class='d-inline-block me-0 mb-1 w-50'>
                                                        <div class='form-check'>
                                                    <div class='custom-control custom-checkbox'> 
                                                    <input type='checkbox'  class='form-check-input form-check-success sc' >
                                                        <label class='form-check-label'>Thứ $i </label>
                                                        </div>
                                                        </div>
                                                        </li>";
                                            }
                                            $s .= "     <li class='d-inline-block me-0 mb-1 w-50'>
                                                    <div class='form-check'>
                                                    <div class='custom-control custom-checkbox'> 
                                                        <input type='checkbox' class='form-check-input form-check-success sc' >
                                                        <label class='form-check-label'>Chủ nhật </label>
                                                        </div>
                                                        </div>
                                                        </li>";
                                            echo $s;

                                            ?>
                                        </ul>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" onclick="submitAdd()">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Thêm</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL SUA-->
                <div class="modal fade text-left" id="repair-airline-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa Hãng Hàng Không</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form name="repair-airline-form" action="/" method="POST">
                                <div class="modal-body">
                                    <label for="mahanghangkhong1">Mã hãng hàng không: </label>
                                    <div class="form-group">
                                        <input type="text" readonly id="mahanghangkhong1" name="mahanghangkhong1" placeholder="Mã Hãng" class="form-control">
                                    </div>
                                    <label for="tenhanghangkhong1">Tên hãng hàng không: </label>
                                    <div class="form-group">
                                        <input type="text" id="tenhanghangkhong1" name="tenhanghangkhong1" placeholder="Tên hãng" class="form-control">
                                    </div>
                                    <label for="motahanghangkhong1">Mô tả: </label>
                                    <div class="form-group">
                                        <textarea type="text" id="motahanghangkhong1" name="motahanghangkhong1" placeholder="Mô tả" class="form-control"> </textarea>
                                    </div>
                                    <label for="loaihanghangkhong1">Loại hãng: </label>
                                    <div class="form-group">
                                        <select class="form-select" name="loaihanghangkhong1" id="loaihanghangkhong1">
                                            <option value="1">Ký hợp đồng</option>
                                            <option value="0">Công ty quản lý</option>
                                        </select>
                                    </div>
                                    <label for="ngaybanhanghangkhong1">Ngày bán: </label>
                                    <ul id="view-thu-list" class="list-unstyled mb-0">
                                        <?php
                                        $s = "";
                                        for ($i = 2; $i <= 7; $i++) {
                                            $s .= "<li class='d-inline-block me-0 mb-1 w-50'>
                                                        <div class='form-check'>
                                                    <div class='custom-control custom-checkbox'> 
                                                    <input type='checkbox'  class='form-check-input form-check-success sc2' >
                                                        <label class='form-check-label'>Thứ $i </label>
                                                        </div>
                                                        </div>
                                                        </li>";
                                        }
                                        $s .= "     <li class='d-inline-block me-0 mb-1 w-50'>
                                                    <div class='form-check'>
                                                    <div class='custom-control custom-checkbox'> 
                                                        <input type='checkbox'  class='form-check-input form-check-success sc2' >
                                                        <label class='form-check-label'>Chủ nhật </label>
                                                        </div>
                                                        </div>
                                                        </li>";
                                        echo $s;

                                        ?>
                                    </ul>
                                </div>

                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span class="d-sm-block">Đóng</span>
                                </button>
                                <button id="repair-queston" type="submit" class="btn btn-primary ml-1">
                                    <span class=" d-sm-block">Sửa</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Thong bao -->
                <div class="modal fade text-left" id="question-airline-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title white" id="myModalLabel110">
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body" id="question-model">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class=" d-sm-block">Đóng</span>
                                </button>
                                <button type="button" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span id="thuchien" class=" d-sm-block">Thực hiện</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal View -->
                <div class="modal fade" id="view-airline-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item active">Thông Tin Chi Tiết</li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã hãng hàng không:</label>
                                            <input type="text" class="form-control" id="view-mahanghangkhong" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên hãng hàng không:</label>
                                            <input type="text" class="form-control" id="view-tenhanghangkhong" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mô tả:</label>
                                            <input type="text" class="form-control" id="view-motahanghangkhong" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Loại hãng:</label>
                                            <select class="form-select" name="view-loaihanghangkhong" id="view-loaihanghangkhong" disabled>
                                                <option value="1">Ký hợp đồng</option>
                                                <option value="0">Công ty quản lý</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Ngày bán:</label>
                                            <ul id="view-thu-list" class="list-unstyled mb-0">
                                                <?php
                                                $s = "";
                                                for ($i = 2; $i <= 7; $i++) {
                                                    $s .= "<li class='d-inline-block me-0 mb-1 w-50'>
                                                        <div class='form-check'>
                                                    <div class='custom-control custom-checkbox'> 
                                                    <input type='checkbox'  class='form-check-input form-check-success sc1' disabled >
                                                        <label class='form-check-label'>Thứ $i </label>
                                                        </div>
                                                        </div>
                                                        </li>";
                                                }
                                                $s .= "     <li class='d-inline-block me-0 mb-1 w-50'>
                                                    <div class='form-check'>
                                                    <div class='custom-control custom-checkbox'> 
                                                        <input type='checkbox'  class='form-check-input form-check-success sc1' disabled>
                                                        <label class='form-check-label'>Chủ nhật </label>
                                                        </div>
                                                        </div>
                                                        </li>";
                                                echo $s;

                                                ?>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <?php View::partial('footer')  ?>
            </div>

        </div>
    </div>
    <script src="<?= View::assets('vendors/jquery/jquery.min.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.validate.js') ?>"></script>
    <script src="<?= View::assets('js/main.js') ?>"></script>
    <script src="<?= View::assets('js/changepass.js') ?>"></script>
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script src="<?= View::assets('js/html/airline.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?= View::assets('js/globalFunctions.js') ?>"></script>
    <script src="<?= View::assets('vendors/boostrap/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        //Khởi tạo biến 
        let currentPage = 1; //Trang hiện tại
        let checkedRows = [];
        let filterText = 0; //Giá trị lọc
        let searchText = ""; //Giá trị tìm kiếm
        const search = $('#search-airline'); //Thanh tìm kiếm
        const table = $('#table1 > tbody'); //Bảng dữ liệu
        const filter = $('#filter-airline'); //Thanh lọc 

        //Sự kiện tìm kiếm
        search.on('input', (event) => {
            searchText = event.target.value;
            getListAirline(currentPage, searchText, filterText)
        })
        //Lọc theo chức vụ
        filter.change((event) => {
            filterText = event.target.value;
            getListUser(currentPage, searchText, filterText)
        })
        //Lấy danh sách hãng hàng không
        const getListAirline = (currentPage, search, filter) => {
            const ajaxListAirline = $.ajax({
                url: `<?= Config::get('URL') ?>/airline/advancedSearch?rowsPerPage=5&page=${currentPage}&search=${search}&search2=${filter}`,
                type: 'get'
            });
            ajaxListAirline.done((listAirline) => {
                table.empty();
                listAirline.data.map((element, index) => {
                    let className = index % 2 ? 'table-light' : 'table-info'
                    table.append(tableAirline(className , element.ma_hang_hang_khong, element.ten, element.mo_ta));
                })
                let list = $('.list-checkbox');
                list.hide();
            })
        }
        // on ready
        $(function() {
            let listDate = document.getElementsByClassName('sc');
            getListAirline(1, "", 0);
            const formAdd = $("form[name='add-airline-form']")[0];
        })

        //Thêm 
        const openModelAdd = () => {
            const formAdd = $("form[name='add-airline-form']")[0];
            formAdd.reset();
            $("#add-airline-modal").modal('toggle');
        }
        const submitAdd = () => {
            $("form[name='add-airline-form']").validate({
                rules: rule_airline,
                messages: message_airline,
                submitHandler: function(form, event) {
                    event.preventDefault();
                    let listDate = document.getElementsByClassName('sc');
                    let checkedDate = $('input.sc[type="checkbox"]:checked');
                    let dataDate = "";
                    for (i = 0; i < listDate.length; i++) {
                        if (listDate[i].checked == true) {
                            dataDate += '1';
                        } else {
                            dataDate += '0';
                        }
                    }
                    if (checkedDate.length == 0) {
                        alert("Chưa chọn ngày bán");
                    } else {
                        // lấy dữ liệu từ form
                        const data = Object.fromEntries(new FormData(form).entries());
                        data['ngay_ban'] = dataDate;
                        $.post(`<?= Config::get('URL') ?>airline/addAirline`, data, function(response) {
                            if (response.thanhcong) {
                                currentPage = 1;
                                getListAirline(1, "", 0);
                                showToast("Thêm thành công");
                            } else {
                                showToast("Thêm thất bại")
                            }
                            // Đóng modal
                            $("#add-airline-modal").modal('toggle')

                        });
                    }

                }
            });
        }

        //Xóa
        const handleDelete = () => {
            if (checkedRows.length == 0) {
                let list = $('.list-checkbox');
                list.toggle();
            } else {
                let data = {
                    mahhks: JSON.stringify(checkedRows)
                }
                $("#myModalLabel110").text("Quản Lý Hãng Hàng Không");
                $("#question-model").text("Bạn có chắc chắn muốn xóa hãng hàng không này không ?");
                $("#question-airline-modal").modal('toggle');
                $('#thuchien').off('click');
                $("#thuchien").click(function() {
                    $.post(`<?= Config::get('URL') ?>airline/deletes`, data, function(response) {
                        if (response.thanhcong) {
                            checkedRows = [];
                            showToast("Xóa thành công");
                            getListAirline(1, "", 0);
                        } else {
                            showToast("Xóa thất bại");
                        }
                    });
                });
            }

        }
        //Chọn
        const handleCheck = (event) => {
            if (event.target.checked) {
                checkedRows.push(event.target.id);
            } else {
                checkedRows = checkedRows.filter(item => item != event.target.id);
            }
        }
        //Xem

        const handleView = (id) => {
            let data = {
                mahhk: id
            };
            $.post(`<?= Config::get('URL') ?>airline/getAirline`, data, function(response) {
                if (response.thanhcong) {
                    var x = document.getElementsByClassName('sc1');
                    for (i = 0; i < x.length; i++) {
                        x[i].checked = false;
                    }
                    $("#view-mahanghangkhong").val(response.ma_hang_hang_khong);
                    $("#view-tenhanghangkhong").val(response.ten);
                    $("#view-motahanghangkhong").val(response.mo_ta);
                    $("#view-loaihanghangkhong").val(response.loai_hang);
                    var db = response.ngay_ban;
                    var x = document.getElementsByClassName('sc1');
                    for (i = 0; i < x.length; i++) {
                        if (db[i] == '1') {
                            x[i].checked = true;
                        }
                    }
                }
            });
            $("#view-airline-modal").modal('toggle');
        }

        //Sửa
        const handleEdit = (id) => {
            let data = {
                mahhk: id
            };

            $.post(`<?= Config::get('URL') ?>airline/getAirline`, data, function(response) {
                console.log(response);
                if (response.thanhcong) {
                    var x = document.getElementsByClassName('sc2')
                    for (i = 0; i < x.length; i++) {
                        x[i].checked = false;
                    }
                    $('#mahanghangkhong1').val(response.ma_hang_hang_khong);
                    $('#tenhanghangkhong1').val(response.ten);
                    $('#motahanghangkhong1').val(response.mo_ta);
                    $('#loaihanghangkhong1').val(response.loai_hang);
                    var db = response.ngay_ban;
                    var x = document.getElementsByClassName('sc2');
                    for (i = 0; i < x.length; i++) {
                        if (db[i] == '1') {
                            x[i].checked = true;
                        }
                    }
                }
            });
            $("#repair-airline-modal").modal('toggle');

            //Sua form
            $("form[name='repair-airline-form']").validate({
                rules: rule_airline,
                messages: message_airline,
                submitHandler: function(form, event) {
                    let listDate = document.getElementsByClassName('sc');
                    let checkedDate = $('input.sc[type="checkbox"]:checked');
                    let dataDate = "";
                    for (i = 0; i < listDate.length; i++) {
                        if (listDate[i].checked == true) {
                            dataDate += '1';
                        } else {
                            dataDate += '0';
                        }
                    }
                    if (checkedDate.length == 0) {
                        alert("Chưa chọn ngày bán");
                    } else {
                        event.preventDefault();
                        $("#myModalLabel110").text("Quản lý hãng hàng không");
                        $("#question-model").text("Bạn có chắc chắn muốn sửa hãng hàng không này không");
                        $("#question-airline-modal").modal('toggle');
                        $('#thuchien').off('click')
                        $("#thuchien").click(function() {
                            // lấy dữ liệu từ form
                            const data = Object.fromEntries(new FormData(form).entries());
                            data['ngay_ban1'] = dataDate;
                            data['mahanghangkhong1'] = $('#mahanghangkhong1').val();
                            $.post(`<?= Config::get('URL') ?>airline/update`, data, function(response) {
                                if (response.thanhcong) {
                                    showToast('Sửa thành công');
                                    getListAirline(1, "", 0);

                                } else {
                                    showToast('Sửa thất bại')
                                }
                                // Đóng modal
                                $("#repair-airline-modal").modal('toggle')
                            });
                        });
                    }
                }
            })
        }
    </script>
</body>