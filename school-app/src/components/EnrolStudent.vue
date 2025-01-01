<template>
    <div class="container">
        <h2>Student Registration</h2>
        <form @submit.prevent="save">
            <div class="form-group">
                <label>Student Name</label>
                <input type="text" v-model="student.name" class="form-control" placeholder="Student Name">
            </div>

            <div class="form-group">
                <label>Grade</label>
                <input type="text" v-model="student.grade" class="form-control" placeholder="Grade">
            </div>

            <div class="form-group">
                <label>Student Address</label>
                <input type="text" v-model="student.address" class="form-control" placeholder="Student Address">
            </div>

            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" v-model="student.date_of_birth" class="form-control">
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" v-model="student.phone" class="form-control" placeholder="Phone">
            </div>

            <div class="form-group">
                <label>State</label>
                <input type="text" v-model="student.state" class="form-control" placeholder="State">
            </div>

            <div class="form-group">
                <label>Nationality</label>
                <input type="text" v-model="student.nationality" class="form-control" placeholder="Nationality">
            </div>

            <div class="form-group">
                <label>School Record</label>
                <input type="file" @change="handleFileUpload($event, 'school_record')" class="form-control">
            </div>

            <div class="form-group">
                <label>Birth Certificate</label>
                <input type="file" @change="handleFileUpload($event, 'birth_certificate')" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<script>
import axios from 'redaxios';

export default {
    name: 'EnrolStudent',
    data() {
        return {
            student: {
                id: '',
                name: '',
                grade: '',
                address: '',
                date_of_birth: '',
                phone: '',
                state: '',
                nationality: '',
                school_record: '',
                birth_certificate: ''
            }
        };
    },
    methods: {
        handleFileUpload(event, field) {
            this.student[field] = event.target.files[0];
            this.student[field] = event.target.files[0];

        },
        save() {
           
            this.saveData();
        },
        saveData() {

            const formData = new FormData();
            for (let key in this.student) {
                formData.append(key, this.student[key]);
            }
            axios.post("http://127.0.0.1:8000/api/auth/enrol_student", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(({ data }) => {
                 console.log([...formData.entries()]);
                console.log(data);
                console.log('trey retun something');


                alert(data.message);

            })
            .catch(error => {
                alert('Error saving data.');
                console.error(error.response.data);
            });

        },
        resetForm() {
            this.student = {
                id: '',
                name: '',
                grade: '',
                address: '',
                date_of_birth: '',
                phone: '',
                state: '',
                nationality: '',
                school_record: '',
                birth_certificate: ''
            };
        }
    }
};
</script>
