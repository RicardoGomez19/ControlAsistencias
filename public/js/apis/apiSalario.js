var ruta = document.querySelector("[name=route]").value;

var apiSalarios = ruta + '/api/apiSalarios';
var apiPuesto = ruta + '/apipuestos';

new Vue({
    //se define el codigo para ubicar la el token de las vistas
    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el:"#salarios_api",
    data:{
        prueba: 'hola mundo',
        puestos:[],
        salarios:[],
        anio: '',
        mes: '',
        valor: '',
        fecha_inicio: '',
        fecha_fin:'',
        banderaModal: true,
        id_puesto: '',
        id:'',
        buscar:'',



    },
    
    created:function(){
        this.salario_index();
        this.puestos_index();
    },

    methods:{
        salario_index(){
            this.$http.get(apiSalarios).then(function(json){
                this.salarios = json.data;
                
        }).catch(function (json) {
                console.log(json);
            })
        },

        ActivarModal(){ 
            this.banderaModal=true;
            this.valor = '';
            this.anio = '';
            this.mes = '';
            this.fecha_inicio = '';
            this.fecha_fin = '';
            this.id_puesto ='';

            $('#ModalSalario').modal('show');
        },

        salario_store(){

        let salarioNuevo={
            valor: this.valor,
            anio: this.anio,
            mes: this.mes,
            fecha_inicio: this.fecha_inicio,
            fecha_fin: this.fecha_fin,
            id_puesto: this.id_puesto
        };

            this.$http.post(apiSalarios, salarioNuevo).then(function (json) {
            this.salario_index();
            $('#ModalSalario').modal('hide');
                
            

            this.valor = '';
            this.anio = '';
            this.mes = '';
            this.fecha_inicio = '';
            this.fecha_fin = '';
            this.id_puesto = '';
            }).catch(function(json){
                
            console.log(salarioNuevo);
            
            });
        },
        salario_delete(id){
            swal({
                title: "Esta seguro?",
                text: "Se eliminará el salario",
                icon: "warning",
                buttons: ["Cancelar", "aceptar"],
                
                })
                .then((confir) => {
                    if (confir) {
                    this.$http.delete(apiSalarios + '/' + id).then(function(json){
                        this.salario_index();
                    });
                    swal("Perfecto! el salario se a eliminado!", {
                    icon: "success",
                    });
                } else {
                    
                }
            });
            ///mensaje de confirmacion
            
            // console.log(id);
        },

        salario_edit(id){

            this.id=id;

            $('#ModalSalario').modal('show');

                this.banderaModal=false;

                this.$http.get(apiSalarios + '/' + id).then(function(json){

                    this.valor = json.data.valor;
                    this.anio = json.data.anio;;
                    this.mes = json.data.mes;
                    this.fecha_inicio = json.data.fecha_inicio;
                    this.fecha_fin = json.data.fecha_fin;
                    this.id_puesto = json.data.puestos.puesto;
                });
              //console.log(id);

        },

        salario_update() {
            let SalarioActualizar = {
                valor: this.valor,
                anio: this.anio,
                mes: this.mes,
                fecha_inicio: this.fecha_inicio,
                fecha_fin: this.fecha_fin,
                id_puesto: this.id_puesto
            };

            this.$http.patch(apiSalarios + '/' + this.id, SalarioActualizar)
                .then((json) => {
                this.salario_index();
                $('#ModalSalario').modal('hide');
                })
                .catch((error) => {
                console.log(error);
                });
            },

         puestos_index: function () {
            this.$http.get(apiPuesto).then(function (json) {
                this.puestos = json.data;

            })
        },


    },

    computed:{

    //metodo para buscar mascotas
    filtrarSalario:function(){
        //retorno el array de puestos con un filtro (puestos), la cual sera aquel valor que se retornara
        //para definirle que el puesto me buscar el nombre, y luego me lo explotara a admitir palabras masyusculas, minisculas.
        //luego procede con el match a vereficar si conicide con lo que el usuario esta escribiendo-
        //el trim es para hacer una disminucion de espacios, para evitar que no encuentre valores con espacios.
        return this.salarios.filter((salario)=>{
            return salario.valor.toLowerCase().match(this.buscar.toLowerCase().trim())
        });
    },


    }

});