var ruta = document.querySelector("[name=route]").value;

var apiUsuarios = ruta + '/api/apiUsuarios';


new Vue({
    //se define el codigo para ubicar la el token de las vistas
    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el: "#usuarios_api",
    data: {
        prueba: 'hola mundo',

        usuarios: [],
        name: '',
        username: '',
        email: '',
        password: '',
        banderaModal: true,
        id: '',
        buscar: '',
        status: '1',

        // variables de paginacion
        paginaActual: 1,
        mostrarPorPagina: 6,
        // fin variables de paginacion


    },
    
    created: function () {
        this.usuario_index();
        
    },

    methods: {
        usuario_index() {
            this.$http.get(apiUsuarios).then(function (json) {
                this.usuarios = json.data;
                
            }).catch(function (json) {
                console.log(json);
            })
        },

        ActivarModal() {
            this.banderaModal = true;
            this.name = '';
            this.username = '';
            this.email = '';
            this.password = '';
            this.status = '1';

            $('#ModalUsuario').modal('show');
        },

        usuario_store() {

            let usuarioNuevo = {
            
                name: this.name,
                username: this.username,
                email: this.email,
                password: this.password,
                status: this.status,
            };
            if (
                !usuarioNuevo.name ||
                !usuarioNuevo.username ||
                !usuarioNuevo.email ||
                !usuarioNuevo.password) {
                swal("Por favor", "Rellene todos los campos del formulario", "warning");
                return
            };
            if (!usuarioNuevo.email.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) {
                swal("Por favor", "Ingrese un correo electrónico válido", "warning");
            return;
            }

            this.$http.post(apiUsuarios, usuarioNuevo).then(function (json) {
                this.usuario_index();
                $('#ModalUsuario').modal('hide');
            
                this.name = '';
                this.username = '';
                this.email = '';
                this.password = '';
                this.status = '1';
            }).catch(function (json) {
                swal("El correo ya se encuentra dentro de la base de datos", "Intente con otro.", "error");
            });
           
        },
        usuario_delete(id) {
            swal({
                title: "Esta seguro?",
                text: "Se eliminará el usuario",
                icon: "warning",
                buttons: ["Cancelar", "aceptar"],
                
            })
                .then((confir) => {
                    if (confir) {
                        this.$http.delete(apiUsuarios + '/' + id).then(function (json) {
                            this.usuario_index();
                        });
                        swal("Perfecto! el usuario se a eliminado!", {
                            icon: "success",
                        });
                    } else {
                    
                    }
                });
            ///mensaje de confirmacion
            
            // console.log(id);
        },

        usuario_edit(id) {
            this.banderaModal = false;
            this.id = id;

            this.$http.get(apiUsuarios + '/' + id).then(function (json) {
                this.name = json.data.name;
                this.username = json.data.username;
                this.email = json.data.email;
                this.password = '';
            });
            
            // Borrar el valor actual del campo de contraseña en el formulario
    
            //console.log(id);
            $('#ModalUsuario').modal('show');
        },

        usuario_update() {
            let UsuarioActualizar = {
                
                name: this.name,
                username: this.username,
                email: this.email,
                password: this.password,
                status: this.status,
    
            };
            if (
                !UsuarioActualizar.name ||
                !UsuarioActualizar.username ||
                !UsuarioActualizar.email) {
                swal("Por favor", "Rellene todos los campos del formulario", "warning");
                return
            };
            this.$http.patch(apiUsuarios + '/' + this.id, UsuarioActualizar)
                .then((json) => {
                    this.usuario_index();
                
                })
                
                .catch((error) => {
                    console.log(error);
                });
            $('#ModalUsuario').modal('hide');
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

    computed: {

    //metodo para buscar mascotas
    filtrarUsuario: function () {
        //retorno el array de puestos con un filtro (puestos), la cual sera aquel valor que se retornara
        //para definirle que el puesto me buscar el nombre, y luego me lo explotara a admitir palabras masyusculas, minisculas.
        //luego procede con el match a vereficar si conicide con lo que el usuario esta escribiendo-
        //el trim es para hacer una disminucion de espacios, para evitar que no encuentre valores con espacios.
        return this.usuarios.filter((usuario) => {
            return usuario.name.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
                usuario.username.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
                usuario.email.toLowerCase().match(this.buscar.toLowerCase().trim())
            
            
        });
    },
    // paginacion
    numeroDePaginas: function () {
        return Math.ceil(this.filtrarUsuario.length / this.mostrarPorPagina);
    },

    paginar: function () {
        const start = (this.paginaActual - 1) * this.mostrarPorPagina;
        const end = this.paginaActual * this.mostrarPorPagina;
        return this.filtrarUsuario.slice(start, end);
    },
    // fin de paginacion

}
    
});