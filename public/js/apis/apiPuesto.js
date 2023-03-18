var ruta = document.querySelector("[name=route]").value;

var apiPuesto= ruta + '/apipuestos';


new Vue({
    //se define el codigo para ubicar la el token de las vistas
    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el:"#puestos_api",
    data:{
        prueba:'hola mundo',
        puestos:[],
        puesto:'',
        banderaModal:true,
        id_puesto:'',
        buscar:'',



    },
    
    created:function(){
        this.puesto_index();
    },

    methods:{
        puesto_index(){
            this.$http.get(apiPuesto).then(function(json){
                this.puestos=json.data;
        });
        },

        ActivarModal(){
            
        this.banderaModal=true;

        this.puesto='';
            $('#ModalPuesto').modal('show');
        },

        puesto_store(){

        let puestoNuevo={
            puesto:this.puesto
        };

        this.$http.post(apiPuesto, puestoNuevo).then(function(json){
            $('#ModalPuesto').modal('hide');
                
                this.puesto_index();

                this.puesto='';

            }).catch(function(json){
                
            console.log(json);
            
            });
        },
        puesto_delete(id){
            swal({
                title: "Esta seguro?",
                text: "Se eliminará el puesto",
                icon: "warning",
                buttons: ["Cancelar", "aceptar"],
                
                })
                .then((confir) => {
                    if (confir) {
                    this.$http.delete(apiPuesto + '/' + id).then(function(json){
                        this.puesto_index();
                    });
                    swal("Perfecto! el puesto se a eliminado!", {
                    icon: "success",
                    });
                } else {
                    
                }
            });
            ///mensaje de confirmacion
            
            // console.log(id);
        },

        puesto_edit(id){

            this.id_puesto=id;

            $('#ModalPuesto').modal('show');

                this.banderaModal=false;

                this.$http.get(apiPuesto +'/' + this.id_puesto).then(function(json){

                    this.puesto=json.data.puesto;

                });
              //console.log(id);

        },

        puesto_update(){

            let PuestoActualizar={
                puesto:this.puesto
            };

            this.$http.patch(apiPuesto + '/' + this.id_puesto,PuestoActualizar).then(function(json){

                $('#ModalPuesto').modal('hide');

                this.puesto_index();

            }).catch(function(json){

                console.log(json);
            });
        }

    },

    computed:{

    //metodo para buscar mascotas
    filtrarPuesto:function(){
        //retorno el array de puestos con un filtro (puestos), la cual sera aquel valor que se retornara
        //para definirle que el puesto me buscar el nombre, y luego me lo explotara a admitir palabras masyusculas, minisculas.
        //luego procede con el match a vereficar si conicide con lo que el usuario esta escribiendo-
        //el trim es para hacer una disminucion de espacios, para evitar que no encuentre valores con espacios.
        return this.puestos.filter((puesto)=>{
            return puesto.puesto.toLowerCase().match(this.buscar.toLowerCase().trim())
        });
    },


    }

});