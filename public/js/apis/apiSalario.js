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
        buscar: '',
        status: '1',

        // variables de paginacion
		paginaActual: 1,
		mostrarPorPagina: 6,
    	// fin variables de paginacion


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
            this.anio = '';
            this.mes = '';
            this.valor = '';
            this.fecha_inicio = '';
            this.fecha_fin = '';
            this.id_puesto = '';
            this.status = '1';   

            $('#ModalSalario').modal('show');
        },

        salario_store(){

        let salarioNuevo={
            
            anio: this.anio,
            mes: this.mes,
            valor: this.valor,
            fecha_inicio: this.fecha_inicio,
            fecha_fin: this.fecha_fin,
            id_puesto: this.id_puesto,
            status: this.status,
            };
            if (
                !salarioNuevo.anio ||
                !salarioNuevo.mes ||
                !salarioNuevo.valor ||
                !salarioNuevo.fecha_inicio ||
                !salarioNuevo.fecha_fin ||
                !salarioNuevo.id_puesto) {
                swal("Por favor", "Rellene todos los campos del formulario", "warning");
                return
            };

            this.$http.post(apiSalarios, salarioNuevo).then(function (json) {
            this.salario_index();
            
                this.anio = '';
                this.mes = '';
                this.valor = '';
                this.fecha_inicio = '';
                this.fecha_fin = '';
                this.id_puesto = '';
                this.status = '1';
            }).catch(function (json) {
                swal("El puesto ya tiene un salario asignado", "Intente con otro.", "error");
            });

            $('#ModalSalario').modal('hide');
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
            this.banderaModal=false;
            this.id=id;

                this.$http.get(apiSalarios + '/' + id).then(function(json){
                    this.anio = json.data.anio;;
                    this.mes = json.data.mes;
                    this.valor = json.data.valor;
                    this.fecha_inicio = json.data.fecha_inicio;
                    this.fecha_fin = json.data.fecha_fin;
                    this.id_puesto = json.data.id_puesto;
                });
              //console.log(id);
            $('#ModalSalario').modal('show');

        },

        salario_update() {
            let SalarioActualizar = {
                
                anio: this.anio,
                mes: this.mes,
                valor: this.valor,
                fecha_inicio: this.fecha_inicio,
                fecha_fin: this.fecha_fin,
                id_puesto: this.id_puesto,
                status: this.status,
    
            };
                if (
                !SalarioActualizar.anio ||
                !SalarioActualizar.mes ||
                !SalarioActualizar.valor ||
                !SalarioActualizar.fecha_inicio ||
                !SalarioActualizar.fecha_fin ||
                !SalarioActualizar.id_puesto) {
                swal("Por favor", "Rellene todos los campos del formulario", "warning");
                return
            };
            this.$http.patch(apiSalarios + '/' + this.id, SalarioActualizar)
                .then((json) => {
                this.salario_index();
                
                })
                
                .catch((error) => {
                console.log(error);
                });
            $('#ModalSalario').modal('hide');
            },

         puestos_index: function () {
            this.$http.get(apiPuesto).then(function (json) {
                this.puestos = json.data;

            })
        },
         
        // metodos de paginacion
		siguientePagina: function () {
			if (this.paginaActual < this.numeroDePaginas) { this.paginaActual++ }
		},

		anteriorPagina: function () {
			if (this.paginaActual != 1) { this.paginaActual-- }
		},

		seccionarPagina: function (pagina) {
			this.paginaActual = pagina;
		},
        // fin metodos de paginacion


    },

    computed:{

    //metodo para buscar mascotas
    filtrarSalario:function(){
        //retorno el array de puestos con un filtro (puestos), la cual sera aquel valor que se retornara
        //para definirle que el puesto me buscar el nombre, y luego me lo explotara a admitir palabras masyusculas, minisculas.
        //luego procede con el match a vereficar si conicide con lo que el usuario esta escribiendo-
        //el trim es para hacer una disminucion de espacios, para evitar que no encuentre valores con espacios.
        return this.salarios.filter((salario)=>{
            return salario.valor.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
                salario.puestos.puesto.toLowerCase().match(this.buscar.toLowerCase().trim())
                

                // salario.anio.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
                // salario.mes.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
                // salario.fecha_fin.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
                // salario.fecha_inicio.toLowerCase().match(this.buscar.toLowerCase().trim())
            
        });
    },
// paginacion
		numeroDePaginas: function () {
			return Math.ceil(this.filtrarSalario.length / this.mostrarPorPagina);
		},

		paginar: function () {
			const start = (this.paginaActual - 1) * this.mostrarPorPagina;
			const end = this.paginaActual * this.mostrarPorPagina;
			return this.filtrarSalario.slice(start, end);
		},
        // fin de paginacion

    }

});