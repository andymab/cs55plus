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
            <div class="d-flex align-center">
              <v-select label="Выберите модель" v-model="model" :items="models" hide-details density="compact"></v-select>
              <div class="mx-2"></div>

              <v-text-field v-model="mpnsearch" label="поиск по детали или по партномеру" hide-details density="compact"
                append-inner-icon="mdi-magnify" single-line></v-text-field>
            </div>


          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-card v-if="filteredmodels.length">
            <v-list :items="filteredmodels" item-props lines="three">
              <template v-slot:default="{ item }">
                <v-list-item :key="item[0]">
                  <v-list-item-content>
                    <v-list-item-title>{{ item[0] }}</v-list-item-title>
                    <v-list-item-subtitle>
                      <div>{{ item[1] }}</div>
                    </v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </template>
            </v-list>
          </v-card>
        </v-col>
      </v-row>
    </v-responsive>
  </v-container>
</template>

<script>
export default {
  name: "Cs55Plus",
  watch: {
    //   search: {
    //       handler: debounce(function () {
    //           this.$emit('input', this.search);
    //       }, 300)
    //   }
  },
  data() {
    return {
      model: "CS 55 PLUS",
      models: [],
      mpnsearch: "",
      search: "",
      items: [],
    };
  },
  mounted() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      fetch('zp.json')
        .then(response => response.json())
        .then(data => {
          this.items = data;
          this.getmodels();
        })
        .catch(error => {
          console.error('Error:', error);
        });
    },
    getmodels() {
      const self = this;
      let models = [...new Set(self.items.map(item => item[2]).filter(value => value !== ""))];


      const uniqueValues = new Set();

      models.forEach(item => {
        if (item && item.trim().length) {
          const splitValues = item.split(",").map(value => value.trim().toUpperCase()); //value.replace(/\s/g, "") не надо а то потом фильтровать не удобно будет
          if (splitValues.length > 2) {
            splitValues.forEach(value => {
              if (!uniqueValues.has(value)) {
                self.models.push(value);
                uniqueValues.add(value);
              }
            });
          }

        }
      });



    }

  },
  computed: {
    filteredmodels() {
      const filteredArray = this.items.filter(item => {
        return (
          item[1] && item[1].includes(this.mpnsearch) &&
          item[2] && item[2].includes(this.model)
        );          
      });

      return filteredArray;
    }
  }
};
</script>

<style>
.v-theme--light .v-main {
  background-color: #e0e0e0;
}
</style>
