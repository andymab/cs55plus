<template>
  <v-container class="fill-height">
    <v-responsive class="text-center fill-height">
      <div class="text-body-2 font-weight-light mb-n1">
        Партномера на модели машин
      </div>

      <h1 class="text-h2 font-weight-bold">
        CHA<span class="text-red">N</span>GAN
      </h1>

      <div class="py-4" />

      <v-row class="d-flex align-center justify-center">
        <v-col cols="auto">
          <v-card variant="tonal" width="600px">
            <div class="d-flex">
              <v-select
                label="Выберите модель"
                v-model="model"
                :items="[
                  'CS55PLUS',
                  'Colorado',
                  'Florida',
                  'Georgia',
                  'Texas',
                  'Wyoming',
                ]"
                hide-details
                density="compact"
              ></v-select>
              <v-text-field
                v-model="mpnsearch"
                label="поиск по детали или по партномеру"
                hide-details
                density="compact"
                append-inner-icon="mdi-magnify"
                single-line
              ></v-text-field>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-responsive>
  </v-container>
</template>

<script lang="ts">
export default {
  name: "Cs55Plus",
  data() {
    return {
      model: "CS55PLUS",
      mpnsearch: "",
      search: "",
    };
  },
  watch: {
    //   search: {
    //       handler: debounce(function () {
    //           this.$emit('input', this.search);
    //       }, 300)
    //   }
  },
};
</script>

<style>
.v-theme--light .v-main {
  background-color: #e0e0e0;
}
</style>
