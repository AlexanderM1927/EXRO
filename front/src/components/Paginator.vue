<template>
  <div
      class="pagination-centered"
      v-if="data.data && data.data.length > 0 && data.lastPage > 1"
  >
    <q-pagination
      v-model="currentPage"
      :max="data.lastPage"
      :max-pages="5"
      direction-links
      flat
      color="grey"
      active-color="primary"
    />
  </div>
</template>
<script>
export default {
  name: 'projects-component',
  props: ['data'],
  data () {
    return {
      pagesToShow: [],
      currentPage: 0
    }
  },
  mounted () {
    this.currentPage = this.data.currentPage
    this.getPagesToShow()
  },
  watch: {
    currentPage (newVal) {
      this.changePage(newVal)
    }
  },
  methods: {
    getPagesToShow () {
      this.pagesToShow = []
      for (let i = 1; i <= this.data.lastPage; i++) {
        if (i >= this.currentPage - 2 && i <= this.currentPage + 2) {
          this.pagesToShow.push(i)
        }
      }
    },
    changePage (newPage) {
      if (newPage !== '#') {
        this.currentPage = parseInt(newPage)
        this.$emit('getAction', newPage)
        this.getPagesToShow()
      }
    }

  }
}
</script>
<style scoped>
.pagination-centered {
  margin-top: 1rem;
  display: flex;
  width: 100%;
  justify-content: center;
}
.page-link {
  cursor: pointer;
}
</style>
