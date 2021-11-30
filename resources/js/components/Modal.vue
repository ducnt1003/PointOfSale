<template>
  <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container">
        <div class="modal-header">
          <slot name="header"> default header </slot>
        </div>

        <div class="modal-body">
          <slot name="body">
            <div class="container-fluid">
              <form @submit.prevent="addCustomer">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tên khách hàng</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="customer.name"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Số điện thoại</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="customer.phone"
                        />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="customer.email"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Địa chỉ</label>
                        <input
                          type="text"
                          class="form-control"
                          v-model="customer.address"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                    <button class="btn btn-primary">Save</button>
                  </div>
                </div>
              </form>
            </div>
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button class="modal-default-button" @click="close">Exit</button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 700px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
<script>
export default {
  name: "Modal",
  data() {
    return {
      customer: {},
    };
  },
  methods: {
    close() {
      this.$emit("close");
    },
    addCustomer() {
      let uri = "http://127.0.0.1:8000/admin/customers/store";
      this.axios.post(uri, this.customer).then((response) => {
        //this.$router.push({ name: "pos" });
      });
    },
  },
};
</script>
