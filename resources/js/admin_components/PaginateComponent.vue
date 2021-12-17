<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item">
        <button
          type="button"
          class="page-link"
          v-if="page != 1"
          @click="page--"
        >
          Previous
        </button>
      </li>
      <li class="page-item">
        <button
          type="button"
          class="page-link"
          v-for="pageNumber in pages.slice(page - 1, page + 5)"
          :key="pageNumber"
          @click="page = pageNumber"
        >
          {{ pageNumber }}
        </button>
      </li>
      <li class="page-item">
        <button
          type="button"
          @click="page++"
          v-if="page < pages.length"
          class="page-link"
        >
          Next
        </button>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Paginate",
  props: ["posts"],
  data() {
    return {
      page: 1,
      perPage: 9,
      pages: [],
    };
  },
  computed: {
    displayedPosts() {
      return this.paginate(this.posts);
    },
  },
  watch: {
    posts() {
      this.setPages();
    },
  },
  methods: {
    setPages() {
      let numberOfPages = Math.ceil(this.posts.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
      this.$emit('setPages',this.posts);
      console.log(this.posts);
    },
    paginate(posts) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return posts.slice(from, to);
    },
  },
};
</script>

<style scoped>
button.page-link {
  display: inline-block;
}
button.page-link {
  font-size: 20px;
  color: #29b3ed;
  font-weight: 500;
}
.offset {
  width: 500px !important;
  margin: 20px auto;
}
</style>
