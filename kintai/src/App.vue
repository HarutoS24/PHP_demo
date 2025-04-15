<template>

  <el-menu :router="true" mode="horizontal" :default-active="activeIndex">
    <el-button @click="drawer = true">test</el-button>
    <el-menu-item index="1" :route="{ name: 'profile' }">Profile</el-menu-item>
    <el-menu-item index="2" :route="{ name: 'kintai' }">勤怠</el-menu-item>
  </el-menu>
  <el-drawer v-model="drawer" title="メニュー" direction="ltr"></el-drawer>
  <router-view />
  <el-backtop :right="100" :bottom="100" />
</template>

<script setup>
import { ref } from "vue"

const drawer = ref(false)
</script>
