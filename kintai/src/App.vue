<template>
  <el-menu :router="true" mode="horizontal">
    <el-menu-item id="drawer-button" @click="drawer_expand">
      <el-icon>
        <More />
      </el-icon>
    </el-menu-item>
    <User_card />
  </el-menu>
  <el-drawer v-model="drawer" title="項目一覧" direction="ltr">
    <el-menu :router="true" mode="vertical">
      <el-menu-item index="1" :route="{ name: 'profile' }" @click="drawer_shrink">Profile</el-menu-item>
      <el-menu-item index="2" :route="{ name: 'kintai_calendar' }" @click="drawer_shrink">勤怠カレンダー</el-menu-item>
      <el-menu-item index="3" :route="{ name: 'kintai_register' }" @click="drawer_shrink">勤怠登録</el-menu-item>
    </el-menu>
  </el-drawer>
  <router-view />
  <el-backtop :right="100" :bottom="100" />

</template>

<script setup>
import { ref } from "vue"
import User_card from "./components/user_card.vue"

</script>
<script>
export default {
  name: 'app',
  data() {
    return {
      drawer: true,
    }
  },
  methods: {
    drawer_expand() {
      this.drawer = true
    },
    drawer_shrink() {
      this.drawer = false
    }
  }
}

</script>

<style scoped>
#drawer-button {
  margin-top: auto;
  margin-bottom: auto;
}

.app {
  color: black;
}
</style>

<style>
.el-drawer__header {
  margin: 0 !important;
}

.el-card {
  margin: 50px 200px !important;
  border-radius: 30px !important;
}

.el-card .el-header {
  font-weight: bold;
  font-size: 1.3rem;
  color: darkcyan;
}
</style>
