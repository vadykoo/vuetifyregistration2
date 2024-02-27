<template>
    <v-app>
        <v-main>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-toolbar dark color="primary">
                                <v-toolbar-title class="custom-title">Register form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-form @submit.prevent="submitForm">
                                    <v-text-field label="Full name" v-model="fullName" outlined
                                        class="custom-input"></v-text-field>
                                    <v-select label="Country" v-model="selectedCountry" :items="countries" outlined
                                        class="custom-input" item-color="primary" item-value="name" item-text="nameWithFlag"
                                        append-icon="mdi-menu-down" @change="onChangeCountry"></v-select>
                                    <!-- Phone number input with v-mask -->
                                    <v-text-field label="Phone number" v-model="phoneNumber"
                                        v-mask="'+### ## ###-##-##'" outlined class="custom-input"></v-text-field>

                                    <v-text-field label="Email" v-model="email" outlined
                                        class="custom-input"></v-text-field>
                                    <!-- Display errors if any -->
                                    <v-alert v-if="hasErrors" type="error" class="mt-4">
                                        <ul>
                                            <li v-for="(error, key) in formErrors" :key="key">{{ error }}</li>
                                        </ul>
                                    </v-alert>

                                    <v-btn color="primary" type="submit">Submit</v-btn>
                                </v-form>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import countriesData from '../countries.json';

export default {
    data() {
        return {
            fullName: '',
            selectedCountry: 'Israel',
            countries: countriesData.map(country => ({
                ...country,
                nameWithFlag: `${country.flag} ${country.name}`,
            })),
            phoneNumber: '',
            email: '',
            formErrors: {},
        };
    },
    computed: {
        hasErrors() {
            return Object.keys(this.formErrors).length > 0;
        }
    },
    methods: {
        countryCode() {
            return this.countries.find(country => country.name === this.selectedCountry)?.idd || '';
        },
        onChangeCountry() {
            this.phoneNumber = this.countryCode();
        },
        submitForm() {
            // Send POST request to api/register with form data
            const formData = {
                fullName: this.fullName,
                selectedCountry: this.selectedCountry,
                phoneNumber: this.phoneNumber,
                email: this.email
            };

            axios.post('api/register', formData)
                .then(response => {
                    // Handle success response
                    console.log('Form submitted successfully', response);
                    // Reset form fields after successful submission
                    this.fullName = '';
                    this.selectedCountry = 'Israel';
                    // this.phoneNumber = '';
                    this.email = '';
                    this.formErrors = {}; // Clear form errors
                })
                .catch(error => {
                    // Handle error response
                    if (error.response && error.response.data && error.response.data.errors) {
                        // If errors are returned from the API
                        this.formErrors = error.response.data.errors;
                    } else {
                        console.error('Error submitting form', error);
                    }
                });
        }
    },
    mounted() {
        this.onChangeCountry()
    }
};
</script>

<style>
    .v-input fieldset {
        border-radius: 25px;
        background-color: white;
    }

    .v-card__text {
        background-color: rgb(242, 242, 242);
    }
</style>
