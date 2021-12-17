<template>
  <Modal @close="close()">
    <div class="card-header" slot="header">
      <h3 class="card-title">Thanh toán</h3>
    </div>
    <div slot="body">
      <form @submit.prevent="purchasePayment()">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="menu">Tổng tiền</label>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Nhập mã đơn hàng"
                  :value="purchase.money"
                  disabled
                />
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="menu">Ngày trả</label>
                <input
                  type="text"
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
                  class="form-control"
                  placeholder="Nhập tên đơn hàng"
                />
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <label for="menu">Ghi chú</label>
            <textarea v-model="purchase.title" class="form-control"></textarea>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary pull-right" @click.prevent="purchasePayment()">Lưu</button>
          </div>
        </div>
      </form>
    </div>
  </Modal>
</template>

<script>
import Modal from "../components/Modal.vue";

export default {
  name: "PurchasePayment",
  props: ["purchase"],
  data() {
    return {};
  },
  methods: {
    close() {
      this.$emit("close");
      console.log(this.purchase);
    },
    purchasePayment() {
      let uri = `http://127.0.0.1:8000/admin/purchases/purchase-payment`;
      this.axios.put(uri, this.purchase).then((response) => {
        this.purchases = response.data;
        this.close();
      });
    },
  },
  components: {
    Modal,
  },
};
</script>

