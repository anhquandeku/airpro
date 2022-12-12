<?php

use App\Core\Config;
use App\Core\View;

View::$activeItem = 'account';

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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
                        <div id="search-user-form" name="search-user-form">
                            <div class="form-group position-relative has-icon-right">
                                <input id="search-bar-user" type="text" class="form-control" placeholder="Tìm kiếm" value="">
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
                                    <h3>Danh sách người dùng</h3>
                                </label>
                            </div>
                            <div class="col-6 col-md-5 order-md-2 order-first">
                                <div class=" loat-start float-lg-end mb-3">
                                    <button id='btn-createaccount' class="btn btn-primary" onclick="loadFormAdd()">
                                        <i class="bi bi-plus"></i> Thêm tài khoản
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 1rem;">
                            <div class="col-6">
                                <label>
                                    <h5> Lọc Theo:</h5>
                                </label>
                                <select class="btn btn btn-primary" name="search-cbb" id="filter-user">
                                    <option value="0">Tất cả</option>
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
                                                <th>Mã</th>
                                                <th>Tên Đăng Nhập</th>
                                                <th>Chức vụ</th>
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
                <!-- <div class="modal fade text-left" id="add-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Thêm Tài Khoản</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add-user-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label for="email">Tên Đăng Nhập: </label>
                                        <div class="form-group">
                                            <input type="text" id="email" name="email" placeholder="Mã Số" class="form-control">
                                        </div>
                                        <label for="fullname">Họ tên: </label>
                                        <div class="form-group">
                                            <input type="text" id="fullname" name="fullname" placeholder="Họ tên" class="form-control">
                                        </div>
                                        <label for="password">Mật khẩu: </label>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" placeholder="Mật khẩu" class="form-control">
                                        </div>
                                        <label for="cars-quyen">Chức vụ: </label>
                                        <select class="form-group" name="maquyen" id="cars-quyen">
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Thêm</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div> -->

                <div class="modal fade text-left" id="add-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <div class="col-sm-1 offset-11" style="padding-left: 30px; padding-bottom: 38px;">
                                    <button type="button" class="btn btn-danger ml-1" data-bs-dismiss="modal" style="padding-top: 5px;">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Đóng</span>
                                    </button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <div class="page-title">
                                    <div class="row">
                                        <div class="col-12 col-md-6 order-md-1 order-last">
                                            <label>
                                                <h5>Bảng Người Dùng</h5>
                                            </label>
                                            <label>
                                                <h6 style="margin-left: 50px; margin-right: 10px;"> Tạo tài khoản cho:</h6>
                                            </label>
                                            <select class="btn btn btn-primary" name="pc-cbb" id="select-position">
                                                <option value="CV002">Nhân viên</option>
                                                <option value="CV001">Khách hàng</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <section class="section">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-danger" id="table-customer">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã</th>
                                                            <th>Họ tên</th>
                                                            <th>Email</th>
                                                            <th>Tác vụ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <nav class="mt-5">
                                                    <ul id="pagination2" class="pagination justify-content-center">
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                </section>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Thong bao -->
                <div class="modal fade text-left" id="question-user-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110" aria-hidden="true">
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
                <div class="modal fade" id="view-user-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">

                            <div class="modal-body">
                                <ul class="list-group">
                                    <li class="list-group-item active">Thông Tin Chi Tiết</li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã tài khoản:</label>
                                            <input type="text" class="form-control" id="view-hoten" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Tên Đăng Nhập:</label>
                                            <input type="text" class="form-control" id="view-ms" disabled>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="form-group">
                                            <label>Mã chức vụ:</label>
                                            <input type="text" class="form-control" id="view-quyen" disabled>
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
                <!-- Modal thông báo pc -->
                <div class="modal fade text-left" id="add-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="z-index: 10000 !important;">
                                <h4 class="modal-title">Thêm Tài Khoản</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form name="add-user-form" action="/" method="POST">
                                    <div class="modal-body">
                                        <label for="password">Mật khẩu: </label>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" placeholder="Mật khẩu" class="form-control">
                                        </div>
                                        <label for="cars-quyen">Chức vụ: </label>
                                        <select class="form-group" name="maquyen" id="cars-quyen">
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Đóng</span>
                                </button>
                                <button type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Thêm</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                <?php View::partial('footer')  ?>
            </div>
        </div>
    </div>
    =
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="<?= View::assets('js/globalFunctions.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.min.js') ?>"></script>
    <script src="<?= View::assets('vendors/jquery/jquery.validate.js') ?>"></script>
    <script src="<?= View::assets('js/main.js') ?>"></script>
    <script src="<?= View::assets('js/changepass.js') ?>"></script>
    <script src="<?= View::assets('js/menu.js') ?>"></script>
    <script src="<?= View::assets('js/api.js') ?>"></script>
    <script src="<?= View::assets('js/html/account.js') ?>"></script>
    <script src="<?= View::assets('vendors/boostrap/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        //Khởi tạo biến 
        let currentPage = 1; //Trang hiện tại
        let checkedRows = [];
        let filter = 0; //Giá trị lọc
        let searchText = ""; //Giá trị tìm kiếm
        const search = $('#search-bar-user'); //Thanh tìm kiếm
        const table = $('#table1 > tbody'); //Bảng dữ liệu
        const filterPosition = $('#filter-user'); //Thanh lọc 

        //Bảng người dùng
        const tableCustomer = $('#table-customer > tbody');
        let quyens;
        // on ready
        $(function() {
            getListUser(currentPage, '', 0);
        });

        //Sự kiện tìm kiếm
        search.on('input', (event) => {
            searchText = event.target.value;
            getListUser(currentPage, searchText, filter)
        })
        //Lọc theo chức vụ
        filterPosition.change((event) => {
            filter = event.target.value;
            getListUser(currentPage, searchText, filter)
        })

        //Hàm thay đổi trang
        const changePage = (newPage) => {
            currentPage = newPage;
            getListUser(currentPage, searchText, filter);
        }


        //Lấy danh sách user
        const getListUser = (currentPage, search, filter) => {
            //Api lấy danh sách user
            const ajaxListUser = $.ajax({
                url: `<?= Config::get('URL') ?>/account/advancedSearch?rowsPerPage=10&page=${currentPage}&search=${search}`,
                type: 'get'
            });

            //Api lấy danh sách chức vụ
            const ajaxPosition = $.ajax({
                url: `<?= Config::get('URL') ?>/position/getPositions`,
                type: 'get'
            })

            $.when(ajaxListUser, ajaxPosition).done((listUser, listPosition) => {
                const user = listUser[0] ? listUser[0] : [];
                const position = listPosition[0] ? listPosition[0] : [];
                let dataUser = filter != 0 ? user.data.filter(item => item.ma_cv == filter) : user.data;
                filterPosition.empty();
                quyens = position.data;
                table.empty();

                dataUser.map((element, index) => {
                    let className = index % 2 ? 'table-light' : 'table-info'
                    table.append(dataTable(element.ma_tk, element.username, position.data.filter(item => item.ma_chuc_vu == element.ma_cv)[0].ten_chuc_vu, className, element.trang_thai));

                })

                filterPosition.append(`<option value = 0> Tất cả </option>`);
                position.data.map((element, index) => {
                    let selected = element.ma_chuc_vu === filter ? 'selected' : ''
                    $("#filter-user").append(`<option value="${element.ma_chuc_vu}" ${selected}>${element.ten_chuc_vu}</option>`);
                });

                //Phân trang
                const pagination = $('#pagination');
                pagination.empty();
                if (user.totalPage > 1) {
                    for (let i = 1; i <= user.totalPage; i++) {
                        if (i == currentPage) {
                            pagination.append(`
                        <li class="page-item active">
                            <button class="page-link" onClick='changePage(${i})'>${i}</button>
                        </li>`)
                        } else {
                            pagination.append(`
                        <li class="page-item">
                            <button class="page-link" onClick='changePage(${i})'>${i}</button>
                        </li>`)
                        }

                    }
                }
            })
        }

        //Khóa tài khoản
        const lockAccount = (id, action) => {
            $('#question-user-modal').modal('toggle');
            $("#myModalLabel110").text(action ? 'Khóa tài khoản' : 'Mở khóa tài khoản')
            $('#question-model').text(action ? 'Tài khoản này sẽ bị khóa?' : 'Tài khoản này sẽ được mở?');
            $('#thuchien').off('click')
            $('#thuchien').click(() => {
                handleLockAccount(id, action);
            })
        }

        const handleLockAccount = (id, action) => {
            let data = {
                email: id
            }
            $.post(`<?= Config::get('URL') ?>/account/delete`, data, (response) => {
                if (response.thanhcong) {
                    showToast(action ? "Khóa thành công" : "Mở khóa thành công");
                    getListUser(1, '', 0);
                } else {
                    showToast(action ? "Khóa thành thất bại" : "Mở khóa thất bại");
                }
            })
        }

        //Thêm tài khoản

        /**Load form */
        const loadFormAdd = () => {
            $("#add-user-modal").modal('toggle');
            getListStaff();
            $('#select-position').change((event) => {
                if (event.target.value == 'CV001') {
                    getListCustomer();
                } else {
                    getListStaff();
                }
            })

        }

        const getListCustomer = () => {
            $.ajax({
                url: `<?= Config::get('URL') ?>/customer/getListSearch?rowsPerPage=10&page=1&search&search2=0`,
                type: 'get'
            }).done((response) => {
                tableCustomer.empty();
                response.data && response.data.map((element, index) => {
                    let className = index % 2 ? 'table-light' : 'table-info'
                    if (!element.ma_tk) tableCustomer.append(addTableCustomer(element, className));
                })

            })
        }

        const getListStaff = () => {
            $.ajax({
                url: `<?= Config::get('URL') ?>/staff/getList`,
                type: 'get'
            }).done((response) => {
                console.log(response);
                tableCustomer.empty();
                response.data && response.data.map((element, index) => {
                    let className = index % 2 ? 'table-light' : 'table-info'
                    if (!element.ma_tk) tableCustomer.append(addTableStaff(element, className));
                })
            })
        }

        /** Thêm  */
        const createAccount = (ma, ho_ten, email) => {
            let data = {
                ma: ma,
                password: email,
                email: email,
                maquyen: $('#select-position').val(),
            }
            $.post(`<?= Config::get('URL') ?>/account/create`, data, (response) => {
                if (response.thanhcong) {
                    showToast('Tạo tài khoản thành công');
                    loadFormAdd();
                    getListUser(1, '', 0);
                }
            })
        }
    </script>
</body>

</html>