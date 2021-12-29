<template>
  <div class="card card-primary mt-3">
    <div class="card-header">
      <h3 class="card-title">PRODUCT</h3>
      <router-link :to="{name: 'products.create'}"
        type="button"
        class="btn btn-info btn-sm"
        style="float: right"
        
      >
        Create new Product
      </router-link>
    </div>
    <datatable title="List Product" :columns="tableColumns1" :rows="products" :perPage="[5,10]" >
      <th slot="thead-tr">Ảnh</th>
      <th slot="thead-tr">&nbsp;</th>
      <template slot="tbody-tr" slot-scope="props">
        <td>
          <img
            v-if="props.row['photo']"
            class="img-thumbnail"
            width="120px"
            :src="props.row['photo']"
            :alt="props.row['name']"
          />
        </td>
        <td>
          <a class="btn btn-primary btn-sm" href="#">
            <i class="fas fa-edit"></i>
          </a>
          <a class="btn btn-danger btn-sm" href="#">
            <i class="fas fa-trash"></i>
          </a>
        </td>
      </template>
    </datatable>
    <Modal v-show="isModalVisible" @close="closeModal">
      <div class="card-header" slot="header">
        <h3 class="card-title">Create new Product</h3>
      </div>
      <div slot="body"></div>
    </Modal>
  </div>
</template>

<script>
import Modal from "../components/Modal.vue";
import DataTable from "vue-materialize-datatable";

export default {
  data() {
    return {
      product: {},
      products: [],
      products_paginate: [],
      isModalVisible: false,
      tableColumns1: [
        {
          label: "ID",
          field: "id",
          numeric: false,
          html: false,
        },
        {
          label: "Tên sản phẩm",
          field: "name",
          numeric: false,
          html: false,
        },
        {
          label: "Danh mục",
          field: "category.name",
          numeric: false,
          html: false,
        },
        {
          label: "Mô tả",
          field: "description",
          numeric: false,
          html: false,
        },
        {
          label: "Giá bán",
          field: "price",
          numeric: false,
          html: false,
        },
        {
          label: "Giá nhập",
          field: "import_price",
          numeric: false,
          html: false,
        },
      ],
    };
  },
  created() {
    let uri = "http://127.0.0.1:8000/admin/products/list";
    this.axios.get(uri).then((response) => {
      this.products = response.data;
      console.log(this.products);
    });
  },
  computed: {},
  methods: {
    displayPrs() {},
    showModal() {
      this.isModalVisible = true;
    },
    closeModal() {
      this.isModalVisible = false;
    },
    onChange(e) {
      this.product["photo"] = e.target.files[0];
    },
    setPages(e) {
      console.log(e);
      this.products_paginate = e;
    },
  },
  components: {
    Modal,
    datatable: DataTable,
  },
};
</script>


