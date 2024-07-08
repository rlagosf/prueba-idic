<template>
  <div>
      <h2>{{ formTitle }}</h2>
      <form @submit.prevent="submitForm">
          <div>
              <label for="nombre">Nombre / Razón Social:</label>
              <input id="nombre" type="text" v-model="formData.nombre">
          </div>
          <div>
              <label for="rut">RUT:</label>
              <input id="rut" type="text" v-model="formData.rut">
          </div>
          <div>
              <label for="telefono">Teléfono:</label>
              <input id="telefono" type="text" v-model="formData.telefono">
          </div>
          <div>
              <label for="email">Email:</label>
              <input id="email" type="email" v-model="formData.email">
          </div>
          <div>
              <label for="direccion">Dirección Casa Matriz:</label>
              <input id="direccion" type="text" v-model="formData.direccion">
          </div>
          <div>
              <label for="tipo">Tipo:</label>
              <select id="tipo" v-model="formData.tipo">
                  <option value="empresa">Empresa</option>
                  <option value="persona">Persona Natural</option>
              </select>
          </div>
          <button type="submit">{{ submitButtonText }}</button>
      </form>
  </div>
</template>

<script>
export default {
  data() {
      return {
          formData: {
              nombre: '',
              rut: '',
              telefono: '',
              email: '',
              direccion: '',
              tipo: 'empresa'  // Valor por defecto: Empresa
          }
      };
  },
  props: {
      formTitle: {
          type: String,
          required: true
      },
      submitButtonText: {
          type: String,
          default: 'Guardar'  // Texto del botón de submit por defecto: Guardar
      }
  },
  methods: {
      submitForm() {
          // Lógica para enviar el formulario al backend (guardar o actualizar cliente)
          this.$emit('form-submitted', this.formData);  // Emitir evento 'form-submitted' con los datos del formulario
      }
  }
}
</script>

<style>
/* Estilos para ClientForm */
</style>
