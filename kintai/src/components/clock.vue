<template>
    <div class="clock_wrapper">
        {{ time }}
    </div>

</template>

<script>
export default {
    name: 'clock',
    data() {
        return {
            time: '00:00:00'
        }
    },
    created() {
        this.get_current_time_str()
    },
    mounted() {
        const timerID = setInterval(this.get_current_time_str, 1000)
    },
    methods: {
        get_current_time_str() {
            const today = new Date()

            let hour = today.getHours()
            let min = today.getMinutes()
            let sec = today.getSeconds()

            hour = hour < 10 ? "0" + hour : hour
            min = min < 10 ? "0" + min : min
            sec = sec < 10 ? "0" + sec : sec

            this.time = `${hour}:${min}:${sec}`
        }
    }
}
</script>

<style scoped>
.clock_wrapper {
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-left: auto;
    margin-right: auto;
    font-size: 100px;
    width: 500px;
    height: 200px;
    text-align: center;
}
</style>
