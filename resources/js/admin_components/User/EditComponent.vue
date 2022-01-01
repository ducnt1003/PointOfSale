<template>
  <div class="col-md-12">
    <div class="card card-primary mt-3">
      <div class="card-header">
        <h3 class="card-title">Chỉnh sửa thông tin</h3>
      </div>
      <form action="" method="post">
        <div class="card-body">
          <div class="form-group">
            <label>Tên người dùng</label>
            <input type="text" name="name" value="" class="form-control" />
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="" class="form-control" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" value="" class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday" value="" class="form-control" />
          </div>
          <div class="form-group">
            <label for="upload">Ảnh đại diện</label>
            <input type="file" class="form-control" id="upload" />
            <div id="image_show">
              <a href="" target="_blank">
                <img src="" width="100px" />
              </a>
            </div>
            <input type="hidden" id="photo" value="" name="photo" />
          </div>
        </div>

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </div>
      </form>
    </div>
  </div>
</template>