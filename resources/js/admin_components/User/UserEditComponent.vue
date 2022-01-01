<template>
  <div class="card">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <h1>Profile</h1>
        </div>
      </div>
      <!-- /.container-fluid -->
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
          <label for="upload">Ảnh</label>
          <input type="file" class="form-control" id="upload" />
          <div id="image_show">
            <a href="" target="_blank">
              <img src="" width="100px" />
            </a>
          </div>
          <input type="hidden" id="photo" value="" name="photo" />
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <label>Vai trò</label>
            <select name="role" class="form-control select2" style="width: 20%">
              <option selected="selected">{{}}</option>

              <option>{{}}</option>
            </select>
          </div>

          <div class="form-group col-md-6">
            <label>Cửa hàng</label>
            <select
              name="store"
              class="form-control select2"
              style="width: 20%"
            >
              <option selected="selected" value="">{{}}</option>

              <option>{{}}</option>
            </select>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
      </div>
    </form>
  </div>
</template>