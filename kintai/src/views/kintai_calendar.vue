<template>
  <el-card>
    <el-header>
      シフト一覧
    </el-header>
    <el-table :data="tableData" :default-sort="{ prop: 'schedule_date', order: 'descending' }">
      <el-table-column prop="schedule_date" label="日付" width="180" sortable>
      </el-table-column>
      <el-table-column prop="schedule_start" label="出勤予定" width="180">

      </el-table-column>
      <el-table-column prop="schedule_end" label="退勤予定" width="180">

      </el-table-column>
      <el-table-column prop="record_start" label="出勤実績" width="180">

      </el-table-column>
      <el-table-column prop="record_end" label="退勤実績" width="180">

      </el-table-column>
      <el-table-column label="" width="180">
        <template #default="scope">
          <el-button type="danger" v-if="later_than_today(scope.row.schedule_date)"
            @click="schedule_remove(scope.row.id, scope.row.schedule_date)">シフト削除</el-button>
        </template>
      </el-table-column>
    </el-table>
  </el-card>
  <el-card>
    <div class="picker_wrapper">
      <el-header>シフト追加</el-header>
      <el-date-picker v-model="schedule_date" format="YYYY-MM-DD" value-format="YYYY-MM-DD"
        :disabled-date="disabledDate" />
      <el-time-picker v-model="schedule_in" format="HH:mm" value-format="HH:mm" />
      <el-time-picker v-model="schedule_out" format="HH:mm" value-format="HH:mm" :disabled-hours="disabledHours"
        :disabled-minutes="disabledMinutes" />
      <el-button type="success"
        @click="schedule_register(1, schedule_date, schedule_in, schedule_out)">シフト追加</el-button>
    </div>
  </el-card>
  <el-card>
    <el-button @click="record_remove(1)" type="danger">出勤実績を削除（テスト用の機能）</el-button>
  </el-card>

</template>

<script>

import kintai_api from '@/js/api/kintai_api'

export default {
  name: 'kintai_calendar',
  data() {
    return {
      tableData: [],
      loading: true,
      schedule_date: '2025-04-17',
      schedule_in: '00:00',
      schedule_out: '00:00',
      test: 'a'
    }
  },
  created() {
    this.fetch_data()
    this.schedule_date = this.get_tomorrow_date_str()
  },
  methods: {
    get_tomorrow_date_str() {
      const today = new Date()

      let year = today.getFullYear()
      let month = today.getMonth() + 1
      let date = today.getDate() + 1

      year = year < 10 ? "0" + year : year
      month = month < 10 ? "0" + month : month
      date = date < 10 ? "0" + date : date

      return `${year}-${month}-${date}`
    },
    disabledDate(time) {
      return time.getTime() < Date.now() - 86400000
    },
    makeRange(start, end) {
      const result = []
      for (let i = start; i <= end; i++) {
        result.push(i)
      }
      return result
    },
    disabledHours() {
      const hour_start = Number(this.schedule_in.slice(0, 2));
      return this.makeRange(0, hour_start - 1);
    },
    disabledMinutes() {
      const hour_start_str = this.schedule_in.slice(0, 2);
      const hour_end_str = this.schedule_out.slice(0, 2);
      if (hour_start_str == hour_end_str) {
        const minute_start = Number(this.schedule_in.slice(3, 5))
        return this.makeRange(0, minute_start)
      } else {
        return []
      }
    },
    later_than_today(target_date) {
      const today = new Date()

      let year = today.getFullYear()
      let month = today.getMonth() + 1
      let date = today.getDate()

      month = month < 10 ? '0' + month : month
      date = date < 10 ? '0' + date : date
      return target_date > `${year}-${month}-${date}`
    },
    async fetch_data() {
      this.loading = true
      try {
        this.tableData = await kintai_api.get_kintai_calendar()
      } catch (error) {

      }
      this.loading = false
    },
    async schedule_remove(id, date) {
      try {
        await kintai_api.schedule_remove(id, date)
        this.fetch_data()
      } catch (error) {
        window.alert(error)
      }
    },
    async schedule_register(id, date, in_time, out_time) {
      try {
        await kintai_api.schedule_register(id, date, in_time, out_time)
        this.fetch_data()
      } catch (error) {
        window.alert(error)
      }
    },
    async record_remove(id) {
      try {
        await kintai_api.record_remove(id)
        this.fetch_data()
      } catch (error) {
        window.alert(error)
      }
    },
  }
}
</script>

<style>
.picker_wrapper .el-date-editor {
  margin: 0 20px;
}
</style>