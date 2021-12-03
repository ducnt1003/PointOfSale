<template>
  <div class="card card-primary mt-3">
    <div class="card-header">
      <h3 class="card-title">CATEGORY</h3>
      <button
        type="button"
        class="btn btn-info btn-sm"
        style="float: right"
        @click="showModal"
      >
        Create new Category
      </button>
    </div>
    <table id="example" class="display nowrap" cellspacing="0" width="100%">
      <thead>
        <tr>
          <td>Id</td>
          <td>Name</td>
          <td>Description</td>
          <td>Tax</td>
          <td>Unit</td>
          <td>Photo</td>
          <td>&nbsp;</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in categories" :key="category['id']">
          <td>{{ category["id"] }}</td>
          <td>{{ category["name"] }}</td>
          <td>{{ category["description"] }}</td>
          <td>{{ category["tax"] }}</td>
          <td>{{ category["unit"] }}</td>
          <td>
            <img class="img-thumbnail" width="60px" :src="category['photo']" />
          </td>
          <td>
            <a class="btn btn-primary btn-sm" href="#">
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
        <h3 class="card-title">Create new Category</h3>
      </div>
      <div slot="body">
        <form @submit.prevent="addCategory">
          <div class="card-body">
            <div class="form-group">
              <label>Tên Danh Mục</label>
              <input
                type="text"
                v-model="category.name"
                class="form-control"
                placeholder="Nhập tên danh mục"
              />
            </div>
            <div class="form-group">
              <label>Danh Mục Cha</label>
              <select class="form-control" v-model="category.parent_id">
                <option value="0" selected>Danh mục cha</option>
                <option
                  v-for="parCate in categories"
                  :key="parCate['id']"
                  v-bind:value="parCate['id']"
                >
                  {{ parCate["name"] }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label>Mô tả danh mục</label>
              <textarea
                class="form-control"
                v-model="category.description"
              ></textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Thuế</label>
                  <input
                    type="number"
                    v-model="category.tax"
                    class="form-control"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Đơn vị</label>
                  <input
                    type="text"
                    v-model="category.unit"
                    class="form-control"
                  />
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="upload">Ảnh</label>
              <input
                type="file"
                class="form-control"
                id="upload"
                v-on:change="onChange"
              />
              <div id="image_show"></div>
              <input type="hidden" id="photo" name="photo" />
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo Danh Mục</button>
          </div>
        </form>
      </div>
    </Modal>
  </div>
</template>

<script>
import Modal from "../components/Modal.vue";
export default {
  data() {
    return {
      category: [],
      categories: [],
      isModalVisible: false,
    };
  },
  created() {
    let uri = "http://127.0.0.1:8000/admin/categories/list";
    this.axios.get(uri).then((response) => {
      this.categories = response.data;
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
    addCategory() {
      console.log(this.category);
      let uri = "http://127.0.0.1:8000/admin/categories/add-cate";
      this.axios.post(uri, this.category).then((response) => {
        this.category = response.data;
        this.categories.push(this.category);
      });
    },
  },
  components: {
    Modal,
  },
};
</script>

