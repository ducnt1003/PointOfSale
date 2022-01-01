<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Đổi mật khẩu</div>

          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Mật khẩu cũ</label
                >
                <div class="col-md-6">
                  <input
                    type="password"
                    class="
                      form-control
                      
                    "
                    name="current_password"
                    autocomplete="current_password"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Mật khẩu mới</label
                >
                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control is-invalid"
                    name="password"
                    autocomplete="password"
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Xác nhận mật khẩu</label
                >
                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    name="password_confirmation"
                    autocomplete="password_confirmation"
                  />
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    Cập nhật
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>