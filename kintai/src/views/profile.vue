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
        <el-main style="font-size: 18px">
          趣味・興味があることが言語、プログラミング、車の改造等々しょっちゅう移り変わります！<br>
          いろんなことが少しだけできる器用貧乏なところがありますが、伸ばしていければと思ってます！
        </el-main>
      </el-container>
    </el-container>
  </el-card>
  <el-card>
    <el-header>経歴</el-header>
    <el-table :data="history_data">
      <el-table-column prop="name" label=""></el-table-column>
      <el-table-column prop="sentence" label="" />
    </el-table>
  </el-card>
  <el-card>
    <el-header>資格</el-header>
    <el-table :data="skills_data">
      <el-table-column prop="name" label=""></el-table-column>
      <el-table-column prop="sentence" label="" />
    </el-table>
  </el-card>
</template>

<script>
export default {
  name: 'profile',
  data() {
    return {
      history_data: [
        {
          'name': '滋賀県立彦根東高等学校',
          'sentence': '2019/04-2022/03'
        },
        {
          'name': '大阪公立大学',
          'sentence': '2022/04-'
        }
      ],
      skills_data: [
        {
          'name': '実用技能検定準一級合格',
          'sentence': '2022/09'
        },
        {
          'name': 'TOEIC公開テスト975点',
          'sentence': '2023/12'
        }
      ]
    }
  }
}
</script>

<style scoped>
.el-card {
  margin: 30px 0;
}
</style>
