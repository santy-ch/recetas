<template>
     <input type="submit" class="btn btn-danger d-block w-100" value="Eliminar" v-on:click="eliminarReceta"> 
</template>

<script>
export default {
    props:['idReceta'],
    methods:{
        eliminarReceta(){
                    this.$swal({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
      const params={
          id:this.idReceta
      }
      axios.post(`/recetas/${this.idReceta}`, {params, _method:'delete'})
      .then(respuesta=>{

          this.$swal({
            title: "eliminado",
            text: "se ha eliminado",
            icon: 'listo',
            confirmButtonText: 'aceptar'
      })
      this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
      })
        .catch(error=>{
            console.log(error);
        })
    
    
  }
})

        }
    }
}
</script>