<template>
  <el-table :data="tableData">
    <el-table-column prop="date" label="Date" width="180">
    </el-table-column>
    <el-table-column prop="name" label="Name" width="180">
    </el-table-column>
    <el-table-column prop="address" label="Address">
    </el-table-column>
  </el-table>
</template>

<script>
export default {
  name: 'kintai',
  data() {
    return {
      tableData: [{
        date: '2016-05-03',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-02',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-04',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-01',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }]
    }
  },
  methods: {
    fetch_data() {

    }
  }
}
</script>

<style scoped>
.el-table {
  margin: 30px 0;
}
</style>