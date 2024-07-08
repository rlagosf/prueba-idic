<template>
  <div>
      <h2>Listado de Clientes</h2>
      <ul>
          <!-- Iteración sobre la lista de clientes recibida por props -->
          <li v-for="client in clients" :key="client.id">
              <!-- Enlace dinámico a la ruta del cliente específico -->
              <router-link :to="'/clients/' + client.id">
                  <!-- Mostrar nombre del cliente y tipo (empresa o persona natural) -->
                  {{ client.nombre }} - {{ client.tipo === 'empresa' ? 'Empresa' : 'Persona Natural' }}
              </router-link>
          </li>
      </ul>
  </div>
</template>

<script>
export default {
  props: {
      clients: {
          type: Array,
          required: true
      }
  }
}
</script>

<style>
/* Estilos para ClientList */
</style>
