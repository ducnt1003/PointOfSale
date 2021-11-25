<template>
  <section class="section-content padding-y-sm bg-default">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 card padding-y-sm card">
          <ul class="nav bg radius nav-pills nav-fill mb-3 bg" role="tablist">
            <li class="nav-item">
              <button
                class="btn nav-link active show"
                data-toggle="pill"
                @click.prevent="selectCate(0)"
              >
                <i class="fa fa-tags"></i> All
              </button>
            </li>
            <li
              class="nav-item"
              v-for="category in categories"
              :key="category['id']"
            >
              <button
                class="btn nav-link"
                data-toggle="pill"
                @click.prevent="selectCate(category['id'])"
              >
                <i class="fa fa-tags"></i> {{ category["name"] }}
              </button>
            </li>
          </ul>
          <span id="items">
            <div class="row">
              <div class="col-md-3" v-for="stock in stocks" :key="stock['id']">
                <figure class="card card-product">
                  <div class="img-wrap">
                    <img src="/assets/images/items/3.jpg" />
                    <a class="btn-overlay" href="#"
                      ><i class="fa fa-search-plus"></i> Quick view</a
                    >
                  </div>
                  <figcaption class="info-wrap">
                    <a href="#" class="title">{{ stock["name"] }}</a>
                    <div class="action-wrap">
                      <button
                        @click.prevent="addToCart(stock['id'])"
                        class="btn btn-primary btn-sm float-right"
                      >
                        <i class="fa fa-cart-plus"></i> Add
                      </button>
                      <div class="price-wrap h5">
                        <span class="price-new">{{ stock["price"] }}</span>
                      </div>
                      <!-- price-wrap.// -->
                    </div>
                    <!-- action-wrap -->
                  </figcaption>
                </figure>
                <!-- card // -->
              </div>
              <!-- col // -->
            </div>
            <!-- row.// -->
          </span>
        </div>
        <div class="col-md-4">
          <div class="card">
            <table calss="table ">
              <thead class="text-muted">
                <tr>
                  <th scope="col">Customer</th>
                  <th scope="col">New</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <model-select
                      :options="customers"
                      v-model="selected"
                      placeholder="select customer"
                    >
                    </model-select>
                  </td>
                  <td>
                    <div
                      class="m-btn-group m-btn-group--pill btn-group mr-2"
                      role="group"
                      aria-label="..."
                    >
                      <router-link :to="{ name: 'customer' }"
                        ><button type="button" class="m-btn btn btn-default">
                          <i class="fa fa-plus"></i></button
                      ></router-link>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card">
            <span id="cart">
              <table class="table table-hover shopping-cart-wrap">
                <thead class="text-muted">
                  <tr>
                    <th scope="col">Item</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col" class="text-right">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="cart in carts" :key="cart['product_id']">
                    <td>
                      <figure class="media">
                        <div class="img-wrap">
                          <img
                            src="/assets/images/items/1.jpg"
                            class="img-thumbnail img-xs"
                          />
                        </div>
                      </figure>
                    </td>
                    <td class="text-center">
                      <div
                        class="m-btn-group m-btn-group--pill btn-group mr-2"
                        role="group"
                        aria-label="..."
                      >
                        <button
                          type="button"
                          class="m-btn btn btn-default"
                          @click.prevent="minusCart(cart['product_id'])"
                        >
                          <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="m-btn btn btn-default">
                          {{ cart["quantity"] }}
                        </button>
                        <button
                          type="button"
                          class="m-btn btn btn-default"
                          @click.prevent="addToCart(cart['product_id'])"
                        >
                          <i class="fa fa-plus"></i>
                        </button>
                      </div>
                    </td>
                    <td>
                      <div class="price-wrap">
                        <var class="price">${{ cart["price"] }}</var>
                      </div>
                      <!-- price-wrap .// -->
                    </td>
                    <td>
                      <div class="price-wrap">
                        <var class="price"
                          >${{ cart["price"] * cart["quantity"] }}</var
                        >
                      </div>
                      <!-- price-wrap .// -->
                    </td>
                    <td class="text-right">
                      <button
                        class="btn btn-outline-danger"
                        @click.prevent="removeCart(cart['product_id'])"
                      >
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </span>
          </div>
          <!-- card.// -->
          <div class="box">
            <dl class="dlist-align">
              <dt>Discount:</dt>
              <dd class="text-right"><a href="#">%0</a></dd>
            </dl>
            <dl class="dlist-align">
              <dt>Total:</dt>
              <dd class="text-right h4 b">${{ Total }}</dd>
            </dl>
            <div class="row">
              <div class="col-md-6">
                <button
                  @click.prevent="cancel()"
                  class="btn btn-default btn-error btn-lg btn-block"
                >
                  <i class="fa fa-times-circle"></i> Cancel
                </button>
              </div>
              <div class="col-md-6">
                <button
                  @click.prevent="charge(selected['value'])"
                  class="btn btn-primary btn-lg btn-block"
                >
                  <i class="fa fa-shopping-bag"></i> Charge
                </button>
              </div>
            </div>
          </div>
          <!-- box.// -->
        </div>
      </div>
    </div>
    <!-- container //  -->
  </section>
</template>
<script>
import { ModelSelect } from "vue-search-select";

export default {
  data() {
    return {
      stocks: [],
      categories: [],
      carts: [],
      results: [],
      customers: [],
      selected: {
        value:'',
        text:'',
      },
    };
  },

  created() {
    let uri = "http://127.0.0.1:8000/admin/orders/index";
    this.axios.get(uri).then((response) => {
      this.stocks = response.data;
    });
    uri = "http://127.0.0.1:8000/admin/orders/cate";
    this.axios.get(uri).then((response) => {
      this.categories = response.data;
    });
    uri = "http://127.0.0.1:8000/admin/orders/cart";
    this.axios.get(uri).then((response) => {
      this.carts = response.data;
    });
    uri = "http://127.0.0.1:8000/admin/customers/index";
    this.axios.get(uri).then((response) => {
      this.customers = response.data;
    });
  },
  computed: {
    Total() {
      let total = 0;
      for (let i = 0; i < this.carts.length; i++) {
        total += this.carts[i].price * this.carts[i].quantity;
      }
      return total;
    },
  },
  methods: {
    selectCate(id) {
      if (id != 0) {
        let uri = `http://127.0.0.1:8000/admin/orders/select-cate/${id}`;
        this.axios.get(uri).then((response) => {
          this.stocks = response.data;
        });
      } else {
        let uri = "http://127.0.0.1:8000/admin/orders/index";
        this.axios.get(uri).then((response) => {
          this.stocks = response.data;
        });
      }
    },
    addToCart(id) {
      let uri = `http://127.0.0.1:8000/admin/orders/add-to-cart-pos/${id}`;
      this.axios.get(uri).then((response) => {
        this.carts = response.data;
      });
    },
    minusCart(id) {
      let uri = `http://127.0.0.1:8000/admin/orders/minus-cart/${id}`;
      this.axios.get(uri).then((response) => {
        this.carts = response.data;
      });
    },
    removeCart(id) {
      let uri = `http://127.0.0.1:8000/admin/orders/remove-cart/${id}`;
      this.axios.get(uri).then((response) => {
        this.carts = response.data;
      });
    },
    charge(id) {
      window.open("/admin/orders/print", "_blank");
      let uri = `http://127.0.0.1:8000/admin/orders/charge-cart/${id}`;
      this.axios.get(uri).then((response) => {
        this.carts = [];
      });

    },
    cancel() {
      let uri = `http://127.0.0.1:8000/admin/orders/cancel-cart`;
      this.axios.delete(uri).then((response) => {});
      this.carts = [];
    },
  },
  components: {
    ModelSelect,
  },
};
</script>
