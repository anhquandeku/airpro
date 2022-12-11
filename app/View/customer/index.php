<?php

use App\Core\View;
use App\Core\Config;

View::$activeItem = 'customer';

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
                        <div id="search-customer-form" name="search-customer-form">
                            <div class="form-group position-relative has-icon-right">
                                <input type="text" class="form-control" placeholder="Tìm kiếm" value="" id="search-customer">
                                <div class="form-control-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="page-title">
                        <div class="row">
                            <div class="col-6 col-md-7 order-md-1 order-last">
                                <label>
                                    <h3>Danh sách khách hàng</h3>
                                </label>
                            </div>
                            <div class="col-6 col-md-5 order-md-2 order-first">
                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-delete-customer' class="btn btn-danger" onClick='handleDelete()'>
                                        <i class="bi bi-trash-fill"></i> Xóa khách hàng
                                    </button>
                                    <button id='open-add-customer-btn' class="btn btn-primary" onClick="openModelAdd()">
                                        <i class="bi bi-plus"></i> Thêm khách hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-6">
                                <label>
                                    <h5> Lọc Theo:</h5>
                                </label>
                                <select class="btn btn btn-primary" name="search-cbb" id="filter-customer">
                                    <option value="1">Tất Cả</option>
                                    <option value="2">Họ tên</option>
                                    <option value="3">Căn cước công dân</option>
                                    <option value="4">Số điện thoại</option>
                                    <option value="5">Hạng</option>
                                    <option value="6">Điểm tích lũy</option>
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
                                                <th>Họ tên</th>
                                                <th>Hạng khách hàng</th>
                                                <th>Số điện thoại</th>
                                                <th>Căn cước công dân</th>
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
                <div class="modal fade text-left" id="add-customer-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm khách hàng</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add-customer-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label for="fullnamekh">Họ tên: </label>
                                        <div class="form-group">
                                            <input type="text" id="fullnamekh" name="fullnamekh" placeholder="Họ tên" class="form-control">
                                        </div>
                                        <label for="hochieukh">Số hộ chiếu: </label>
                                        <div class="form-group">
                                            <input type="text" id="hochieukh" name="hochieukh" placeholder="Số hộ chiếu" class="form-control">
                                        </div>
                                        <label for="cccdkh">Căn cước công dân: </label>
                                        <div class="form-group">
                                            <input type="text" id="cccdkh" name="cccdkh" placeholder="Căn cước công dân" class="form-control">
                                        </div>
                                        <label for="numberphonekh">Số điện thoại: </label>
                                        <div class="form-group">
                                            <input type="text" id="numberphonekh" name="numberphonekh" placeholder="Số điện thoại" class="form-control">
                                        </div>
                                        <label for="emailkh">Email: </label>
                                        <div class="form-group">
                                            <input type="email" id="emailkh" name="emailkh" placeholder="Email" class="form-control">
                                        </div>
                                        <label for="birthdaykh">Ngày sinh: </label>
                                        <div class="form-group">
                                            <input type="date" id="birthdaykh" name="birthdaykh" placeholder="Ngày sinh" class="form-control">
                                        </div>
                                        <label for="genderkh">Giới tính: </label>
                                        <div class="form-group">
                                            <select class="form-select" name="genderkh" id="genderkh">
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                            </select>
                                        </div>
                                        <label for="addresskh">Địa chỉ: </label>
                                        <div class="form-group">
                                            <input type="text" id="addresskh" name="addresskh" placeholder="Địa chỉ" class="form-control">
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1" onclick='submitAdd()'>
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Thêm</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL SUA-->
                <div class="modal fade text-left" id="repair-customer-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Sửa Thông Tin Khách Hàng</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="repair-customer-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label for="re-fullnamekh">Họ tên: </label>
                                        <div class="form-group">
                                            <input type="text" id="re-fullnamekh" name="fullnamekh" placeholder="Họ tên" class="form-control">
                                        </div>
                                        <label for="re-hochieukh">Số hộ chiếu: </label>
                                        <div class="form-group">
                                            <input type="text" id="re-hochieukh" name="hochieukh" placeholder="Số hộ chiếu" class="form-control">
                                        </div>
                                        <label for="re-cccdkh">Căn cước công dân: </label>
                                        <div class="form-group">
                                            <input type="text" id="re-cccdkh" name="cccdkh" placeholder="Căn cước công dân" class="form-control">
                                        </div>
                                        <label for="re-numberphonekh">Số điện thoại: </label>
                                        <div class="form-group">
                                            <input type="text" id="re-numberphonekh" name="numberphonekh" placeholder="Số điện thoại" class="form-control">
                                        </div>
                                        <label for="re-emailkh">Email: </label>
                                        <div class="form-group">
                                            <input type="email" id="re-emailkh" name="emailkh" placeholder="Email" class="form-control">
                                        </div>
                                        <label for="re-birthdaykh">Ngày sinh: </label>
                                        <div class="form-group">
                                            <input type="date" id="re-birthdaykh" name="birthdaykh" placeholder="Ngày sinh" class="form-control">
                                        </div>
                                        <label for="re-genderkh">Giới tính: </label>
                                        <div class="form-group">
                                            <select class="form-select" name="genderkh" id="re-genderkh">
                                                <option value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>
                                            </select>
                                        </div>
                                        <label for="re-addresskh">Địa chỉ: </label>
                                        <div class="form-group">
                                            <input type="text" id="re-addresskh" name="addresskh" placeholder="Địa chỉ" class="form-control">
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button id="repair-queston" type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Sửa</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal Thong bao -->
                <div class="modal fade text-left" id="question-customer-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
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
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="button" class="btn btn-success ml-1" data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span id="thuchien" class="d-none d-sm-block">Thực hiện</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal View -->
                <div class="modal fade" id="view-customer-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item active">Thông Tin Chi Tiết</li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Họ Và Tên:</label>
                                            <input type="text" class="form-control" id="view-hotenkh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên hạng:</label>
                                            <input type="text" class="form-control" id="view-tenhangkh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Số hộ chiếu:</label>
                                            <input type="text" class="form-control" id="view-hochieukh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Căn cước công dân:</label>
                                            <input type="text" class="form-control" id="view-cccdkh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Số điện thoại:</label>
                                            <input type="text" class="form-control" id="view-sdtkh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="text" class="form-control" id="view-emailkh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Ngày sinh:</label>
                                            <input type="text" class="form-control" id="view-datekh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Giới tính:</label>
                                            <input type="text" class="form-control" id="view-genderkh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Địa chỉ:</label>
                                            <input type="text" class="form-control" id="view-addresskh" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Điểm tích lũy:</label>
                                            <input type="text" class="form-control" id="view-tichluykh" disabled>
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
    <script src="<?= View::assets('js/html/customer.js') ?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?= View::assets('js/globalFunctions.js') ?>"></script>
    <script src="<?= View::assets('vendors/boostrap/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let hangkhs;
        //Khởi tạo biến 
        let currentPage = 1; //Trang hiện tại
        let checkedRows = [];
        let filterText = 0; //Giá trị lọc
        let searchText = ""; //Giá trị tìm kiếm
        const search = $('#search-customer'); //Thanh tìm kiếm
        const table = $('#table1 > tbody'); //Bảng dữ liệu
        const filter = $('#filter-customer'); //Thanh lọc 

        //Sự kiện tìm kiếm
        search.on('input', (event) => {
            searchText = event.target.value;
            getListCustomer(currentPage, searchText, filterText)
        })
        //Lọc theo chức vụ
        filter.change((event) => {
            filterText = event.target.value;
            getListCustomer(currentPage, searchText, filterText)
        })

        //Lấy danh sách khách hàng
        const getListCustomer = (currentPage, search, filter) => {
            const ajaxListCustomer = $.ajax({
                url: `<?= Config::get('URL') ?>/customer/getListSearch?rowsPerPage=10&page=${currentPage}&search=${search}&search2=${filter}`,
                type: 'get'
            });
            ajaxListCustomer.done((listCustomer) => {
                console.log(listCustomer);
                table.empty();
                listCustomer.data.map((element, index) => {
                    let className = index % 2 ? 'table-light' : 'table-info'
                    table.append(dataTable(className, element));
                })
                let list = $('.list-checkbox');
                list.hide();
            })
        }

        // on ready
        $(function() {
            getListCustomer(1, "", 0);
        })

        //Thêm 
        const openModelAdd = () => {
            const formAdd = $("form[name='add-customer-form']")[0];
            formAdd.reset();
            $("#add-customer-modal").modal('toggle');
        }
        const submitAdd = () => {
            $("form[name='add-customer-form']").validate({
                rules: rule_customer,
                messages: message_customer,
                submitHandler: function(form, event) {
                    event.preventDefault();
                    // lấy dữ liệu từ form
                    const data = Object.fromEntries(new FormData(form).entries());
                    $.post(`<?= Config::get('URL') ?>/customer/create`, data, function(response) {
                        if (response.thanhcong) {
                            currentPage = 1;
                            getListCustomer(1, "", 0);
                            showToast("Thêm thành công");
                        } else {
                            showToast("Thêm thất bại")
                        }
                        // Đóng modal
                        $("#add-customer-modal").modal('toggle')

                    });
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
                    makh: JSON.stringify(checkedRows)
                }
                $("#myModalLabel110").text("Quản Lý Hãng Hàng Không");
                $("#question-model").text("Bạn có chắc chắn muốn xóa người dùng này không ?");
                $("#question-customer-modal").modal('toggle');
                $('#thuchien').off('click');
                $("#thuchien").click(function() {
                    $.post(`<?= Config::get('URL') ?>customer/deletes`, data, function(response) {
                        if (response.thanhcong) {
                            checkedRows = [];
                            showToast("Xóa thành công");
                            getListCustomer(1, "", 0);
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
            console.log(checkedRows);
        }
        //Xóa 1 đối tượng
        const handleDeleteOne = (id) => {
            let data = {
                makh: id
            };
            $("#myModalLabel110").text("Quản Lý Khách Hàng");
            $("#question-model").text("Bạn có chắc chắn muốn xóa khách hàng này không");
            $("#question-customer-modal").modal('toggle');
            $('#thuchien').off('click');
            $("#thuchien").click(function() {
                $.post(`<?= Config::get('URL') ?>customer/delete`, data, function(response) {
                    console.log(response);
                    if (response.thanhcong) {
                        showToast('Xóa thành công')
                        currentPage = 1;
                        getListCustomer(1, "", 0)
                    } else {
                        showToast('Xóa thất bại')
                    }
                });
            });


        }
        //Xem

        const handleView = (id) => {
            $("#view-customer-modal").modal('toggle');
            let data = {
                makh: id
            };
            $.post(`<?= Config::get('URL') ?>customer/viewCustomer`, data, function(response) {
                console.log("View", response);
                if (response.thanhcong) {
                    $("#view-hotenkh").val(response.FullName);
                    $("#view-tenhangkh").val(response.tenhang);
                    $("#view-hochieukh").val(response.hochieu);
                    $("#view-cccdkh").val(response.cccd);
                    $("#view-sdtkh").val(response.sdt);
                    $("#view-emailkh").val(response.email);
                    $("#view-datekh").val(response.date);
                    $("#view-genderkh").val(response.gender);
                    $("#view-addresskh").val(response.address);
                    $("#view-tichluykh").val(response.diemtichluy);
                }
            });
            $("#view-airline-modal").modal('toggle');
        }

        //Sửa
        const handleEdit = (id) => {
            let data = {
                makh: id
            };
            $.post(`<?= Config::get('URL') ?>customer/viewCustomer`, data, function(response) {
                if (response.thanhcong) {
                    $('#re-fullnamekh').val(response.FullName);
                    $('#re-hochieukh').val(response.hochieu);
                    $('#re-cccdkh').val(response.cccd);
                    $('#re-numberphonekh').val(response.sdt);
                    $('#re-emailkh').val(response.email);
                    $('#re-birthdaykh').val(response.date);
                    $('#re-genderkh').val(response.gender).prop('selected', true);;
                    $('#re-addresskh').val(response.address);
                }
            });
            $("#repair-customer-modal").modal('toggle');

            //Sua form
            $("form[name='repair-customer-form']").validate({
                rules: rule_customer,
                messages: message_customer,
                submitHandler: function(form, event) {
                    event.preventDefault();
                    $("#myModalLabel110").text("Quản Lý Khách Hàng");
                    $("#question-model").text("Bạn có chắc chắn muốn sửa khách hàng này không");
                    $("#question-customer-modal").modal('toggle');
                    $('#thuchien').off('click')
                    $("#thuchien").click(function() {
                        // lấy dữ liệu từ form
                        const data = Object.fromEntries(new FormData(form).entries());
                        data['makh'] = id;
                        $.post(`<?= Config::get('URL') ?>customer/update`, data, function(response) {
                            if (response.thanhcong) {
                                showToast('Sửa thành công');
                                getListCustomer(1, "", 0);
                            } else {
                                showToast('Sửa thất bại')
                            }
                            // Đóng modal
                        });
                    });
                    $("#repair-customer-modal").modal('toggle')
                }
            })
        }
    </script>
</body>