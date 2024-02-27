<template>
    <v-app>
      <v-main>
        <v-container fluid fill-height>
          <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
              <v-card class="elevation-12">
                <v-toolbar dark color="primary">
                  <v-toolbar-title class="custom-title"> form</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-form>
                    <v-text-field label="Full name" v-model="fullName" outlined class="custom-input"></v-text-field>
                    <v-select
                      label="Country"
                      v-model="selectedCountry"
                      :items="countries"
                      outlined
                      class="custom-input"
                      item-color="primary"
                      item-value="name"
                      item-text="nameWithFlag"
                      append-icon="mdi-menu-down"
                    ></v-select>
                       <!-- Phone number input with v-mask -->
                        <v-text-field
                        label="Phone number"
                        v-model="formattedPhoneNumber"
                        v-mask="'+### ## ###-##-##'"
                        outlined
                        class="custom-input"
                        :rules="[phoneValidationRule]"
                        ></v-text-field>

                        <!-- Email input (no mask) -->
                        <v-text-field label="Email" v-model="email" outlined class="custom-input"></v-text-field>
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
    };
  },
  computed: {
    formattedPhoneNumber: {
      get() {
        const countryCode = this.countries.find(country => country.name === this.selectedCountry)?.idd || '';
        return `${countryCode} ${this.phoneNumber}`;
      },
      set(value) {
        // Handle changes to the formatted phone number
        // For example, update other related data properties
        // or trigger an action when the value is modified
        this.phoneNumber = value;
      },
    },
    phoneValidationRule() {
      // Add custom validation rule for phone number
      return (value) => {
        const isValid = /^\+\d{1,3} \d{6,14}$/.test(value);
        return isValid || 'Please enter a valid phone number with country code.';
      };
    },
  },
};
</script>
