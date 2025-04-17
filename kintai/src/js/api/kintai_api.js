import axios from "axios";

async function get_kintai_calendar() {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/get_kintai_calendar')
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
    }
}

async function exists_clock_in(id) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/exists_clock_in/' + id)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
        throw new Error(error)
    }
}

async function exists_clock_out(id) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/exists_clock_out/' + id)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
        throw new Error(error)
    }
}

async function schedule_register(id, date, in_time, out_time) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/schedule_register/' + id + '/' + date + '/' + in_time + '/' + out_time)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
        throw new Error(error)
    }
}

async function schedule_remove(id, date) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/schedule_remove/' + id + '/' + date)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
        throw new Error(error)
    }
}

async function record_clock_in(id) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/record_clock_in/' + id)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
    }
}

async function record_clock_out(id) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/record_clock_out/' + id)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
    }
}

async function record_remove(id) {
    try {
        const response = await axios.get('http://localhost/PHP_demo/index.php/api/Kintai/record_remove/' + id)
        console.log(response.data)
        return response.data
    } catch (error) {
        console.log(error)
    }
}

export default {
    get_kintai_calendar,
    exists_clock_in,
    exists_clock_out,
    schedule_register,
    schedule_remove,
    record_clock_in,
    record_clock_out,
    record_remove
}