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
            <button
              class="btn btn-primary btn-sm"
              @click="showEditModal(category['id'])"
            >
              <i class="fas fa-edit"></i>
            </button>
            <a class="btn btn-danger btn-sm" @click="showDeleteModal(category['id'])">
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
                class="form-control"
                placeholder="Nhập tên danh mục"
                v-model="category.name"
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
                    class="form-control"
                    v-model="category.tax"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Đơn vị</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="category.unit"
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
            <button class="btn btn-primary">Tạo Danh Mục</button>
          </div>
        </form>
      </div>
    </Modal>
    <Modal v-show="isEditModalVisible" @close="closeEditModal">
      <div class="card-header" slot="header">
        <h3 class="card-title">Edit Category</h3>
      </div>
      <div slot="body">
        <form @submit.prevent="editCategory(categoryEdit.id)">
          <div class="card-body">
            <div class="form-group">
              <label>Tên Danh Mục</label>
              <input
                type="text"
                class="form-control"
                placeholder="Nhập tên danh mục"
                v-model="categoryEdit.name"
              />
            </div>
            <div class="form-group">
              <label>Danh Mục Cha</label>
              <select class="form-control" v-model="categoryEdit.parent_id">
                <option value="0">Danh mục cha</option>
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
                v-model="categoryEdit.description"
              ></textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Thuế</label>
                  <input
                    type="number"
                    class="form-control"
                    v-model="categoryEdit.tax"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Đơn vị</label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="categoryEdit.unit"
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
            <button class="btn btn-primary">Sửa Danh Mục</button>
          </div>
        </form>
      </div>
    </Modal>
    <Modal v-show="isDeleteModalVisible" @close="closeDeleteModal">
      <div class="card-header" slot="header">
        <h3 class="card-title">Delete Category</h3>
      </div>
      <div class="card-body" slot="body">Bạn có muốn xóa Category này?</div>
      <div class="card-footer" slot="footer">
          <button class="modal-default-button btn-warning" @click="deleteCate(categoryEdit.id)">Delete</button>
          <button class="modal-default-button btn-error" @click="closeDeleteModal">Exit</button>
      </div>
    </Modal>
  </div>
</template>

<script>
import Modal from "../components/Modal.vue";
export default {
  data() {
    return {
      category: {},
      categoryEdit: {},
      categories: [],
      isModalVisible: false,
      isEditModalVisible: false,
      isDeleteModalVisible: false,
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
    showEditModal(id) {
      var item = this.categories.find((item) => item.id == id);
      this.categoryEdit = item;
      this.isEditModalVisible = true;
    },
    closeEditModal() {
      this.isEditModalVisible = false;
    },
    showDeleteModal(id) {
      var item = this.categories.find((item) => item.id == id);
      this.categoryEdit = item;
      this.isDeleteModalVisible = true;
    },
    closeDeleteModal() {
      this.isDeleteModalVisible = false;
    },
    onChange(e) {
      this.category["photo"] = e.target.files[0];
    },
    addCategory() {
      console.log(this.category);
      try {
        let uri = "http://127.0.0.1:8000/admin/categories/add-cate";
        this.axios.post(uri, this.category).then((response) => {
          let newCate = response.data;
          this.categories.push(newCate);
          this.closeModal();
        });
      } catch (error) {
        console.error(error.response.data); // NOTE - use "error.response.data` (not "error")
      }
    },
    editCategory(id) {
      console.log(this.categoryEdit);
      try {
        let uri = `http://127.0.0.1:8000/admin/categories/edit-cate/${id}`;
        this.axios.put(uri, this.categoryEdit).then((response) => {
          console.log(response.data);
          let index = this.categories.findIndex((x) => x.id == id);
          this.categories[index]=this.categoryEdit;
          this.closeEditModal();
          //this.categories.push(this.category);
        });
      } catch (error) {
        console.error(error.response.data); // NOTE - use "error.response.data` (not "error")
      }
    },
    deleteCate(id) {
      console.log(this.categoryEdit);
      try {
        let uri = `http://127.0.0.1:8000/admin/categories/delete-cate/${id}`;
        this.axios.delete(uri).then((response) => {
          console.log(response.data);
          //this.categories.push(this.category);
          this.categories.splice(this.categories.indexOf(id), 1);
          this.isDeleteModalVisible = false;

        });
      } catch (error) {
        console.error(error.response.data); // NOTE - use "error.response.data` (not "error")
      }
    },
  },
  components: {
    Modal,
  },
};
</script>

