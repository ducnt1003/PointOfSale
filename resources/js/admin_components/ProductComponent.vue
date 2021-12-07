<template>
  <div class="card card-primary mt-3">
    <div class="card-header">
      <h3 class="card-title">PRODUCT</h3>
      <button
        type="button"
        class="btn btn-info btn-sm"
        style="float: right"
        @click="showModal"
      >
        Create new Product
      </button>
    </div>
    <table id="example" class="display nowrap" cellspacing="0" width="100%">
      <thead>
        <tr>
          <td>ID</td>
          <td>Tên sản phẩm</td>
          <td>Danh mục</td>
          <td>Mô tả</td>
          <td>Giá bán</td>
          <td>Giá nhập</td>
          <td>Màu sắc</td>
          <td>Active</td>
          <td>Photo</td>
          <td>Barcode</td>
          <td style="width: 100px">&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product['id']">
          <td>{{ product["id"] }}</td>
          <td>{{ product["name"] }}</td>
          <td>{{ product["category_id"] }}</td>
          <td>{{ product["description"] }}</td>
          <td>{{ product["price"] }}</td>
          <td>{{ product["import_price"] }}</td>
          <td>{{ product["color"] }}</td>
          <td>
            <span v-if="product['active'] == 0" class="btn btn-danger btn-xs"
              >NO</span
            >
            <span v-if="product['active'] != 0" class="btn btn-success btn-xs"
              >YES</span
            >
          </td>
          <td>
            <img
              v-if="product['photo']"
              class="img-thumbnail"
              width="120px"
              :src="product['photo']"
              :alt="product['name']"
            />
          </td>
          <td>
            <a
              class="btn btn-primary btn-sm"
              href="/admin/products/barcodes/${product['id']}"
            >
              <i class="fas fa-barcode"></i>
            </a>
          </td>
          <td>
            <a class="edit btn-primary btn-sm" href="#">
              <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm" href="#">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <Modal v-show="isModalVisible" @close="closeModal">
      <div class="card-header" slot="header">
        <h3 class="card-title">Create new Product</h3>
      </div>
      <div slot="body"></div>
    </Modal>
  </div>
</template>
<script type="text/javascript">
$(document).ready(function () {
  $("#example").DataTable({
    dom: "Bfrtip",
    // buttons: [
    //     'copy',
    // ]
    info: false,
  });
});
</script>
<script>
import Modal from "../components/Modal.vue";

export default {
  data() {
    return {
      product: [],
      products: [],
      isModalVisible: false,
    };
  },
  created() {
    let uri = "http://127.0.0.1:8000/admin/products/list";
    this.axios.get(uri).then((response) => {
      this.products = response.data;
    });
  },
  methods: {
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    onChange(e) {
      this.category["photo"] = e.target.files[0];
    },
  },
  components: {
    Modal,
  },
};
</script>




