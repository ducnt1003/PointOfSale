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
              @click="showBarcodeModal(product['id'])"
            >
              <i class="fas fa-barcode"></i>
            </a>
          </td>
          <td>
            <a class="edit btn-primary btn-sm" @click="showEditModal(product['id'])">
              <i class="fas fa-edit"></i>
            </a>
            <a class="btn btn-danger btn-sm" @click="showDeleteModal(product['id'])">
              <i class="fas fa-trash"></i>
            </a>
          </td>
        </tr>
      </tbody>
    </table>
    <Modal v-show="isModalVisible" @close="closeModal">
      <div slot="header">
        <h3 class="card-title">Create new Products</h3>
      </div>
      <div slot="body">
          <form @submit.prevent="addProduct">
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label >Tên Sản Phẩm</label>
                              <input type="text"
                                     v-model="product.name"
                                     class="form-control"
                                     placeholder="Nhập tên sản phẩm">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Danh mục</label>
                              <select class="form-control" v-model="product.category_id">
                                  <option
                                      v-for="category in categories "
                                      :key="category['id']"
                                      v-bind:value="category.id">{{ category.name }}</option>
                                  <option value="0">Khác</option>
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label >Tên nhãn hiệu</label>
                              <select class="form-control" v-model="product.brand_id">
                                  <option
                                      v-for="brand in brands"
                                      :key="brand['id']"
                                      :value="brand['id']">{{ brand["name"] }}</option>
                                  <option value="0">Khác</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Màu sắc</label>
                              <input type="text"
                                     class="form-control"
                                     v-model="product.color"
                              >
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Giá Nhập</label>
                              <input type="number"
                                     class="form-control"
                                     v-model="product.import_price"
                              >
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label>Giá Bán</label>
                              <input type="number"
                                     class="form-control"
                                     v-model="product.price"
                              >
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>Mô tả</label>
                      <textarea class="form-control"
                                v-model="product.description"></textarea>
                  </div>

                  <div class="form-group">
                      <label for="upload">Ảnh sản phẩmm</label>
                      <input type="file"
                             class="form-control"
                             id="upload"
                             v-on:change="onChange">
                      <div id="image_show"></div>
                      <input type="hidden" id="photo" name="photo">
                  </div>
                  <div class="form-group">
                      <label>Kích Hoạttt</label>
                      <div class="form-check">
                          <input class="form-check-input" value="1" type="radio" name="active" id="active" checked="">
                          <label class="form-check-label" for="active">Có</label>
                      </div>
                      <div class="form-check">
                          <input class="form-check-input" value="0" type="radio" name="active" id="no_active" >
                          <label class="form-check-label" for="no_active">Không</label>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                  <button class="btn btn-primary">Tạo Sản Phẩm</button>
              </div>
          </form>
      </div>
    </Modal>
      <Modal v-show="isEditModalVisible" @close="closeEditModal">
          <div slot="header">
              <h3 class="card-title">Edit Product</h3>
          </div>
          <div slot="body">
              <form @submit.prevent="editProduct(productEdit.id)">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label >Tên Sản Phẩm</label>
                                  <input type="text"
                                         v-model="productEdit.name"
                                         class="form-control"
                                         placeholder="Nhập tên sản phẩm">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Danh mục</label>
                                  <select class="form-control" v-model="productEdit.category_id">
                                      <option
                                          v-for="category in categories "
                                          :key="category['id']"
                                          v-bind:value="category.id">{{ category.name }}</option>
                                      <option value="0">Khác</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label >Tên nhãn hiệu</label>
                                  <select class="form-control" v-model="productEdit.brand_id">
                                      <option
                                          v-for="brand in brands"
                                          :key="brand['id']"
                                          :value="brand['id']">{{ brand["name"] }}</option>
                                      <option value="0">Khác</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Màu sắc</label>
                                  <input type="text"
                                         class="form-control"
                                         v-model="productEdit.color"
                                  >
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Giá Nhập</label>
                                  <input type="number"
                                         class="form-control"
                                         v-model="productEdit.import_price"
                                  >
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>Giá Bán</label>
                                  <input type="number"
                                         class="form-control"
                                         v-model="productEdit.price"
                                  >
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label>Mô tả</label>
                          <textarea class="form-control"
                                    v-model="productEdit.description"></textarea>
                      </div>

                      <div class="form-group">
                          <label for="upload">Ảnh sản phẩm</label>
                          <input type="file"
                                 class="form-control"
                                 v-on:change="onChange">
                      </div>
                      <div class="form-group">
                          <label>Kích Hoạttt</label>
                          <div class="form-check">
                              <input class="form-check-input" value="1" type="radio" name="active" checked="">
                              <label class="form-check-label" for="active">Có</label>
                          </div>
                          <div class="form-check">
                              <input class="form-check-input" value="0" type="radio" name="active"  >
                              <label class="form-check-label" for="no_active">Không</label>
                          </div>
                      </div>
                  </div>
                  <div class="card-footer">
                      <button class="btn btn-primary">Sửa Sản Phẩm</button>
                  </div>
              </form>
          </div>
      </Modal>
      <Modal v-show="isEditModalVisible" @close="closeBarcodeModal">
          <div slot="header">
              <h3 class="card-title">Barcode</h3>
          </div>
          <div slot="body">
              <div v-html="product.barcode">
              </div>
              <h2 style="margin-left: 20px">{{product.product_code}}</h2>
          </div>
      </Modal>
      <Modal v-show="isBarcodeModalVisible" @close="closeBarcodeModal">
          <div slot="header">
              <h3 class="card-title">Barcode</h3>
          </div>
          <div slot="body">
              <div v-html="product.barcode">
              </div>
              <h2 style="margin-left: 20px">{{product.product_code}}</h2>
          </div>
      </Modal>
      <Modal v-show="isDeleteModalVisible" @close="closeDeleteModal">
          <div class="card-header" slot="header">
              <h3 class="card-title">Delete Category</h3>
          </div>
          <div class="card-body" slot="body">Bạn có muốn xóa Product này?</div>
          <div class="card-footer" slot="footer">
              <button class="modal-default-button btn-warning" @click="deleteCate(productEdit.id)">Delete</button>
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
      product: {},
      products: [],
      isModalVisible: false,
      isBarcodeModalVisible:false,
      isEditModalVisible:false,
      categories:[],
      brands:[],
      productEdit:{},
      isDeleteModalVisible:false,
    };
  },
  created() {
    let uri = "http://127.0.0.1:8000/admin/products/list";
    this.axios.get(uri).then((response) => {
      this.products = response.data;
    });
    uri = "http://127.0.0.1:8000/admin/categories/list";
    this.axios.get(uri).then((response) => {
        this.categories = response.data;
    });
    uri = "http://127.0.0.1:8000/admin/brands/list";
    this.axios.get(uri).then((response) => {
        this.brands = response.data;
    });
  },
  methods: {
    showModal() {
      this.isModalVisible = true;
    },
    showBarcodeModal(id){
        var item = this.products.find((item) => item.id == id);
        this.product = item;
        this.isBarcodeModalVisible=true;
    },
    closeBarcodeModal(){
        this.isBarcodeModalVisible=false;
    },
    showEditModal(id) {
        var item = this.products.find((item) => item.id == id);
        this.productEdit = item;
        this.isEditModalVisible = true;
    },
    closeEditModal() {
        this.isEditModalVisible = false;
    },
    showDeleteModal(id){
        var item = this.products.find((item)=>item.id == id);
        this.productEdit = item;
        this.isDeleteModalVisible = true;
    },
      closeDeleteModal() {
          this.isDeleteModalVisible = false;
      },
    closeModal() {
        this.isModalVisible = false;
    },
    onChange(e) {
        this.product['photo'] = e.target.files[0];
    },
      addProduct(e){
          console.log(this.product);
          // e.preventDefault();
          // let existingObj = this;
          //
          // const config = {
          //     headers: {
          //         'content-type': 'multipart/form-data'
          //     }
          // }
        try {
            let uri = "http://127.0.0.1:8000/admin/products/add-product";
            // this.product.append('img',this.product['photo']);
            this.axios.post(uri,this.product).then(response => {
                let newProduct = response.data;
                this.products.push(newProduct);
                this.closeModal();
            })
        }catch (error){
            console.error(error.response.data);
        }
      },
      editProduct(id){
          console.log(this.productEdit.id);
          try {
              let uri = `http://127.0.0.1:8000/admin/products/edit-product/${id}`;
              this.axios.put(uri, this.productEdit).then((response) => {
                  console.log(response.data);
                  let index = this.products.findIndex((x) => x.id == id);
                  this.products[index]=this.productEdit;
                  this.closeEditModal();
              });
          }catch (error){
              console.log(error.response.data);
          }
      },
      deleteCate(id){
        console.log(this.productEdit);
        try{
            let uri = `http://127.0.0.1:8000/admin/products/delete-product/${id}`;
            this.axios.delete(uri).then((response)=>{
                console.log(response.data);
                let i = this.products.map(data => data.id).indexOf(id);
                this.products.splice(i, 1)
                    this.isDeleteModalVisible = false;
            });
        }catch (error){
            console.log(error.response.data);
        }
      }
  },

  components: {
    Modal,
  },
};
</script>




