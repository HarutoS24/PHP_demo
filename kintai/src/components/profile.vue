<template>
  <el-card>
    <template #header>
      Profile
    </template>
    <el-container>
      <el-aside width="200px">
        <el-image :src="'https://fuss10.elemecdn.com/e/5d/4a731a90594a4af544c0c25941171jpeg.jpeg'" />
      </el-aside>
      <el-main>
        テスト
      </el-main>
    </el-container>
  </el-card>
  <el-card>
    経歴
  </el-card>
  <el-card>
    Skills
  </el-card>
</template>

<script>
export default {
  name: 'profile'
}
</script>

<style scoped>
.el-card {
  margin-top: 30px
}
</style>
