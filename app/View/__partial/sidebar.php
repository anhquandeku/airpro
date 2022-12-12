<?php

use App\Core\Cookie;
use App\Core\View;

?>
<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-center">
                <div class="logo">
                    <a href="index.html"><img src="<?= View::assets('images/logo/logo.jpeg') ?>" alt="Logo" srcset="" /></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item <?= View::$activeItem == 'dashboard' ? 'active' : '' ?>">
                    <a href="<?= View::getBaseUrl() ?>" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li id="CN13" class=" sidebar-item CV001 <?= View::$activeItem == 'index' ? 'active' : '' ?>">
                    <a href="<?= View::url('userticket/index') ?>" class="sidebar-link">
                        <i class="bi bi-cast"></i>
                        <span>Đặt vé</span>
                    </a>
                </li>
                <li id="CN01" class=" sidebar-item  <?= View::$activeItem == 'account' ? 'active' : '' ?>">
                    <a href="<?= View::url('account/') ?>" class="sidebar-link">
                        <i class="bi bi-person-circle"></i>
                        <span>Tài khoản</span>
                    </a>
                </li>
                <li id="CN02" class=" sidebar-item  <?= View::$activeItem == 'airline' ? 'active' : '' ?>">
                    <a href="<?= View::url('airline/') ?>" class="sidebar-link">
                        <i class="bi bi-cloud"></i>
                        <span>Hãng hàng không</span>
                    </a>
                </li>
                <li id="CN03" class=" sidebar-item  <?= View::$activeItem == 'airport' ? 'active' : '' ?>">
                    <a href="<?= View::url('airport/') ?>" class="sidebar-link">
                        <i class="bi bi-pentagon"></i>
                        <span>Sân bay</span>
                    </a>
                </li>
                <li id="CN04" class=" sidebar-item  <?= View::$activeItem == 'customer' ? 'active' : '' ?>">
                    <a href="<?= View::url('customer/') ?>" class="sidebar-link">
                        <i class="bi bi-people"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                <li id="CN05" class=" sidebar-item  <?= View::$activeItem == 'flight' ? 'active' : '' ?>">
                    <a href="<?= View::url('flight/') ?>" class="sidebar-link">
                        <i class="bi bi-symmetry-horizontal"></i>
                        <span>Chuyến bay</span>
                    </a>
                </li>
                <li id="CN06" class=" sidebar-item  <?= View::$activeItem == 'plane' ? 'active' : '' ?>">
                    <a href="<?= View::url('plane/') ?>" class="sidebar-link">
                        <i class="bi bi-cursor"></i>
                        <span>Máy bay</span>
                    </a>
                </li>
                <li id="CN07" class=" sidebar-item  <?= View::$activeItem == 'position' ? 'active' : '' ?>">
                    <a href="<?= View::url('position/') ?>" class="sidebar-link">
                        <i class="bi bi-person-check"></i>
                        <span>Chức vụ</span>
                    </a>
                </li>
                <li id="CN08" class=" sidebar-item  <?= View::$activeItem == 'promotion' ? 'active' : '' ?>">
                    <a href="<?= View::url('promotion/') ?>" class="sidebar-link">
                        <i class="bi bi-gift"></i>
                        <span>Chương trình khuyến mãi</span>
                    </a>
                </li>
                <li id="CN09" class=" sidebar-item  <?= View::$activeItem == 'rank' ? 'active' : '' ?>">
                    <a href="<?= View::url('rank/') ?>" class="sidebar-link">
                        <i class="bi bi-bookmark"></i>
                        <span>Hạng khách hàng</span>
                    </a>
                </li>
                <li id="CN10" class=" sidebar-item  <?= View::$activeItem == 'staff' ? 'active' : '' ?>">
                    <a href="<?= View::url('staff/') ?>" class="sidebar-link">
                        <i class="bi bi-people-fill"></i>
                        <span>Nhân viên</span>
                    </a>
                </li>
                <li id="CN11" class=" sidebar-item  CV001 <?= View::$activeItem == 'wallet' ? 'active' : '' ?>">
                    <a href="<?= View::url('wallet/') ?>" class="sidebar-link">
                        <i class="bi bi-wallet2"></i>
                        <span>Ví Airpro</span>
                    </a>
                </li>
                <li id="CN18" class=" sidebar-item  <?= View::$activeItem == 'ticket' ? 'active' : '' ?>">
                    <a href="<?= View::url('ticket/') ?>" class="sidebar-link">
                        <i class="bi bi-cash-stack"></i>
                        <span>Quản lý vé</span>
                    </a>
                </li>
                <li id="CN12" class=" sidebar-item  <?= View::$activeItem == 'statistics' ? 'active' : '' ?>">
                    <a href="<?= View::url('statistics/') ?>" class="sidebar-link">
                        <i class="bi bi-graph-up"></i>
                        <span>Thống kê</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
<script src="<?= View::assets('vendors/jquery/jquery.min.js') ?>"></script>
<script src="<?= View::assets('vendors/jquery/jquery.validate.js') ?>"></script>
<script>
    const list = $('.CV001');
    let data = `<?= Cookie::get('user_quyen') ?>`
    if(data != 'CV001') list.addClass('d-none'); else{
        const item = $('.sidebar-item');
        item.addClass('d-none');
        list.removeClass('d-none');
        $('.home').removeClass('d-none');
    }
</script>