<template>
  <el-card>
    <el-header>
      Profile
    </el-header>
    <el-container>
      <el-aside width="200px">
        <el-avatar :size="200" :src="'https://fuss10.elemecdn.com/e/5d/4a731a90594a4af544c0c25941171jpeg.jpeg'" />
      </el-aside>
      <el-container>
        <el-header>
          HARUTO SATO
        </el-header>
        <el-main style="font">
          今まで趣味の範囲でプログラムを書くことが多かったのですが、最近は企業で仕事としてプログラミングをしたりしています！
        </el-main>
      </el-container>
    </el-container>
  </el-card>
  <el-card>
    経歴
  </el-card>
  <el-card>
    資格
  </el-card>
</template>

<script>
export default {
  name: 'profile'
}
</script>

<style scoped>
.el-card {
  margin: 30px 0;
}
</style>
