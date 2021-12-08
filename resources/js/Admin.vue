<template>
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="" role="button"
            ><i class="fas fa-bars"></i
          ></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto"></ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <div class="dropdown" style="margin-right: 6px">
          <button
            class="btn btn-secondary dropdown-toggle"
            type="button"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          ></button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Chỉnh sửa thông tin</a>
            <a class="dropdown-item" href="#">Đổi mật khẩu</a>
            <a class="dropdown-item" href="#">Đăng xuất</a>
          </div>
        </div>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="/orders/pos" class="brand-link">
        <img
          src="/template/dist/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image img-circle elevation-3"
          style="opacity: 0.8"
        />
        <span class="brand-text font-weight-light">Rhust-app</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img
              src="/template/dist/img/user2-160x160.jpg"
              class="img-circle elevation-2"
              alt="User Image"
            />
          </div>
          <div class="info">
            <a href="#" class="d-block">Admin</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-chart-bar" style="margin-left: 4px"></i>
                <p style="margin-left: 5px">Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/orders/pos" class="nav-link">
                <i class="far fa-circle" style="margin-left: 4px">></i>
                <p style="margin-left: 5px">POS</p>
              </a>
            </li>
            <li class="nav-item">
              <router-link to="/admin/vue/categories" class="nav-link"
                ><i class="fab fa-product-hunt" style="margin-left: 4px"></i>
                <p style="margin-left: 5px">
                  Danh mục
                  <i class="right fas fa-angle-left"></i></p
              ></router-link>
            </li>
            <!-- product-->
            <li class="nav-item">
              <router-link to="/admin/vue/products" class="nav-link">
                <i class="nav-icon fas fa-store"></i>
                <p>
                  Sản phẩm
                  <i class="right fas fa-angle-left"></i>
                </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/admin/vue/purchases" class="nav-link">
                <i class="fas fa-money-check-alt" style="margin-left: 4px"></i>
                <p style="margin-left: 5px">
                  Đơn nhập hàng
                  <i class="right fas fa-angle-left"></i>
                </p>
              </router-link>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a
                    href=""
                    class="nav-link"
                  >
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tạo đơn hàng</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Danh sách đơn hàng</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- end product-->
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- @include('admin.alert') -->

          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->

              <transition name="fade">
                <router-view></router-view>
              </transition>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-active {
  opacity: 0;
}
</style>
<script>
export default {};
</script>
