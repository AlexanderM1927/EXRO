<template>
  <div class="q-pa-md">
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10 container">
        <formula :configuration="configuration"></formula>
      </div>
      <div class="col-1"></div>
    </div>
  </div>
</template>

<script>
import { functions } from "../functions.js";

export default {
  name: "calculate-form-component",
  mixins: [functions],
  data() {
    return {
      id: this.$route.params.id,
      configuration: {
        messageCalculate: 'La información proporcionada a través de la plataforma de “Cálculos Programas Químicos” se ofrece de buena fe. Los usuarios de la información asumen todos los riesgos y responsabilidades y liberan expresamente a Exro SAS y Quimexcol Zona Franca SAS, sus funcionarios y agentes de cualquier responsabilidad. Debido a que las condiciones de uso y datos de cada proceso pueden cambiar con el tiempo, o con las condiciones actualizadas. Los usuarios de la información aquí establecida o generada durante el uso de la plataforma  son responsables de determinar la idoneidad de la información. Ante cualquier inquietud se debe acudir a nuestro Equipo Técnico y/o de Ventas y Servicios para aclarar o interpretar los resultados. Los usuarios de la plataforma no están autorizados para compartir la información o tecnología.'
      }
    };
  },
  created() {
    this.$options.components.formula = require("./Formulas/Form" +
      this.id).default;
  },
  methods: {},
};
</script>
