<template>
  <div>
    <div class="card card-primary mt-3">
      <div class="card-header">
        <h3 class="card-title">Purchase</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-sm">
            <label for="menu">Nhà cung cấp</label>
            <table class="col-md-12">
              <tr>
                <td>
                  <input
                    type="text"
                    name="purchase_id"
                    class="form-control"
                    placeholder="Nhập mã đơn hàng"
                  />
                </td>
                <td class="pull-right">
                  <button type="button" class="btn">
                    <i class="fa fa-plus"></i>
                  </button>
                </td>
              </tr>
            </table>
          </div>

          <div class="col-sm">
            <div class="form-group">
              <label for="menu">Cửa hàng nhập</label>
              <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Nhập tên đơn hàng"
              />
            </div>
          </div>
          <div class="col-sm">
            <div class="form-group">
              <label for="menu">Người nhập</label>
              <input
                type="text"
                name="place_order"
                class="form-control"
                placeholder="Nơi đặt hàng"
              />
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 offset-md-8">
            <div class="form-group">
              <label for="menu">Ngày nhập</label>
              <input
                type="text"
                name="stock_id"
                class="form-control"
                placeholder="Nhập kho nhận hàng"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card  mt-3">
      <div class="card-header">
        <h3 class="card-title">Chi tiết</h3>
      </div>
      <div class="card">
        <div class="row">
          <div class="md-8">
            <div class="form-control">
              <model-select :options="products" v-model="selected">
              </model-select>
            </div>
          </div>

          <button type="button" class="btn">
            <i class="fa fa-plus"></i>
          </button>
        </div>
      </div>
      <div>
        <table class="table text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Import Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class="card  mt-3">
      <div class="card-header">
        <h3 class="card-title">Giảm giá</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="menu">Loại giảm</label>
              <input
                type="text"
                name="purchase_id"
                class="form-control"
                placeholder="Nhập mã đơn hàng"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="menu">Lượng giảm</label>
              <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Nhập tên đơn hàng"
              />
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <label for="menu">Ghi chú</label>
          <textarea class="form-control"></textarea>
        </div>
      </div>
    </div>
    <div class="card  mt-3">
      <div class="card-header">
        <h3 class="card-title">Thanh toán</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="menu">Tổng tiền</label>
              <input
                type="text"
                name="purchase_id"
                class="form-control"
                placeholder="Nhập mã đơn hàng"
              />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="menu">Ngày trả</label>
              <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Nhập tên đơn hàng"
              />
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="menu">Phương thức thanh toán</label>
              <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Nhập tên đơn hàng"
              />
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <label for="menu">Ghi chú</label>
          <textarea class="form-control"></textarea>
        </div>
        <div class="card-footer">
          <button class="btn btn-primary pull-right">Lưu</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ModelSelect } from "vue-search-select";

export default {
  data() {
    return {
      selected: {
        value: "",
        text: "",
      },
      products: [
        { value: "1", text: "aa" + " - " + "1" },
        { value: "2", text: "ab" + " - " + "2" },
        { value: "3", text: "bc" + " - " + "3" },
        { value: "4", text: "cd" + " - " + "4" },
        { value: "5", text: "de" + " - " + "5" },
      ],
    };
  },
  components: {
    ModelSelect,
  },
};
</script>

