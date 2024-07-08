<template>
  <div>
      <h2>Detalles del Cliente</h2>
      <div>
          <p><strong>Nombre / Razón Social:</strong> {{ client.nombre }}</p>
          <p><strong>RUT:</strong> {{ client.rut }}</p>
          <p><strong>Teléfono:</strong> {{ client.telefono }}</p>
          <p><strong>Email:</strong> {{ client.email }}</p>
          <p><strong>Dirección Casa Matriz:</strong> {{ client.direccion }}</p>
          <p><strong>Tipo:</strong> {{ client.tipo === 'empresa' ? 'Empresa' : 'Persona Natural' }}</p>
      </div>
      <button @click="deleteClient">Eliminar Cliente</button>
  </div>
</template>

<script>
export default {
  props: {
      client: {
          type: Object,
          required: true
      }
  },
  methods: {
      deleteClient() {
          // Lógica para eliminar el cliente
          if (confirm('¿Está seguro que desea eliminar este cliente?')) {
              // Emitir evento para indicar que se quiere eliminar este cliente
              this.$emit('client-deleted', this.client.id);
          }
      }
  }
}
</script>

<style>
/* Estilos para ClientDetails */
</style>
