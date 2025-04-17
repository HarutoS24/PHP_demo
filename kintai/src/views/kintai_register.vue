<template>
    <el-card>
        <el-header>
            勤怠登録
        </el-header>
        <clock />
        <div class="button_wrapper">
            <el-button type="success" @click="record_clock_in(1)" :disabled="clock_in">出勤</el-button>
            <el-button type="danger" @click="record_clock_out(1)" :disabled="clock_out">退勤</el-button>
        </div>
    </el-card>
</template>

<script setup>
import clock from '../components/clock.vue'
</script>

<script>
import kintai_api from '@/js/api/kintai_api'
export default {
    data() {
        return {
            clock_in: false,
            clock_out: null
        }
    },
    created() {
        this.exists_clock_in(1)
        this.exists_clock_out(1)
    },
    methods: {
        async exists_clock_in(id) {
            try {
                const result = await kintai_api.exists_clock_in(id)
                this.clock_in = result
                return result
            } catch (error) {
                window.alert(error)
            }
        },
        async exists_clock_out(id) {
            try {
                const result = await kintai_api.exists_clock_out(id)
                this.clock_out = result
                return result
            } catch (error) {
                window.alert(error)
            }
        },
        async record_clock_in(id) {
            this.clock_in = true
            try {
                await kintai_api.record_clock_in(id)
            } catch (error) {
                window.alert(error)
            }
        },
        async record_clock_out(id) {
            this.clock_out = true
            try {
                await kintai_api.record_clock_out(id)
            } catch (error) {
                window.alert(error)
            }
        },
    }
}
</script>


<style scoped>
.button_wrapper {
    width: 200px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    text-align: center;
}
</style>
