<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white"><i class="fa fa-user"></i> Personal de trabajo</div>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-circle"></i> Agregar nuevo personal
                        </button>
                        <button type="button" class="btn btn-success mb-2" @click="pdf()" >
                            <i class="fa fa-print"></i> credencial
                        </button>
                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Unidad</th>
                                <th>Targeta</th>
                                <th>Fecha creado</th>
                                <th>Opciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(i,index) in personas" :key="index">
                                <td>{{index+1}}</td>
                                <td>{{i.nombre}}</td>
                                <td>{{i.unit.unidad}}</td>
                                <td>{{i.targeta}}</td>
                                <td>{{i.created_at|moment('DD-MM-YY')}}</td>
                                <td>
                                    <div class="btn btn-group">
                                        <button @click.prevent="modificar(i)" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                        <button @click.prevent="eliminar(i)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        <button @click.prevent="photo(i)"  class="btn btn-sm btn-primary"><i class="fa fa-image"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-plus-circle"></i> Registrar Nuevo personal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="guardar">
                                            <div class="form-group row">
                                                <label for="unit_id" class="col-sm-2 col-form-label">Unidad</label>
                                                <div class="col-sm-10">
<!--                                                    <input type="password" class="form-control" id="" placeholder="Password">-->
                                                    <select name="unit_id" id="unit_id" class="form-control" v-model="persona.unit_id" required>
                                                        <option v-for="(i,index) in units" :value="i.id" :key="index">{{i.unidad}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nombre" v-model="persona.nombre" placeholder="Nombre Completo" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tergate" class="col-sm-2 col-form-label">Targeta</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="tergate" v-model="persona.targeta" placeholder="Numero de targeta" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Crear</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="modificarLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning ">
                                        <h5 class="modal-title" id="modificarLabel"> <i class="fa fa-edit"></i> Modificar Nuevo personal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="update">
                                            <div class="form-group row">
                                                <label for="unit_id2" class="col-sm-2 col-form-label">Unidad</label>
                                                <div class="col-sm-10">
                                                    <!--                                                    <input type="password" class="form-control" id="" placeholder="Password">-->
                                                    <select name="unit_id2" id="unit_id2" class="form-control" v-model="persona.unit_id" required>
                                                        <option v-for="(i,index) in units" :value="i.id" :key="index">{{i.unidad}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nombre2" class="col-sm-2 col-form-label">Nombre</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="nombre2" v-model="persona.nombre" placeholder="Nombre Completo" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tergate2" class="col-sm-2 col-form-label">Targeta</label>
                                                <div class="col-sm-10">
                                                    <input type="number" class="form-control" id="tergate2" v-model="persona.targeta" placeholder="Numero de targeta" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-warning"> <i class="fa fa-edit"></i> Modificar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="photo" tabindex="-1" role="dialog" aria-labelledby="photoLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning ">
                                        <h5 class="modal-title" id="photoLabel"> <i class="fa fa-edit"></i> Fotofrafia personal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form @submit.prevent="updateAvatar">
                                            <div class="form-group row">
                                                <label for="nombre2" class="col-sm-2 col-form-label">Nombre</label>
                                                <div class="col-sm-10">
<!--                                                    <input type="text" class="form-control" id="nombre2" v-model="persona.nombre" placeholder="Nombre Completo" required>-->
                                                    <input type="file" name="image" @change="getImage" accept="image/*" required>
<!--                                                    <button @click="updateAvatar">Subir Imagen</button>-->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-trash"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-warning"> <i class="fa fa-edit"></i> Modificar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import jsPDF from 'jspdf'
import datatable from 'datatables.net-dt';
    export default {
        data(){
          return {
              units:[],
              persona:{},
              personas:[],
              imagen : null,
          }
        },
        mounted() {
            // console.log('Component mounted.')
            // $("#example").DataTable();
            this.misdatos();
            axios.get('/unit').then(res=>{
                this.units=res.data;
            })
        },
        methods:{
            getImage(event){
                //Asignamos la imagen a  nuestra data
                this.imagen = event.target.files[0];
            },
            updateAvatar(){
                //Creamos el formData
                var data = new  FormData();
                //Añadimos la imagen seleccionada
                data.append('avatar', this.imagen);
                data.append('id', this.persona.id);
                //Añadimos el método PUT dentro del formData
                // Como lo hacíamos desde un formulario simple _(no ajax)_
                // data.append('_method', 'PUT');
                //Enviamos la petición
                axios.post('/photo',data).then(response => {
                    $('#photo').modal('hide');
                    this.persona={};
                    this.misdatos();
                    this.$swal('Creado!!!','Correctamente','success');
                })
            },
            pdf(){
                const doc = new jsPDF();
                var img = new Image();
                img.src = 'assets/credencial.png';
                let x=5,y=5;
                let cont=0;
                let conth=0;
                this.personas.forEach(r=>{
                    if (cont==3){
                        y=y+95;
                        x=5;
                        cont=0;
                    }
                    if (conth==9){
                        y=5;
                        x=5;
                        doc.addPage();
                        conth=0;
                    }
                    doc.addImage(img, 'png', x, y, 60, 90);
                    console.log(r.foto);
                    if(r.foto!=null){
                        var img2 = new Image();
                        img2.src = r.foto;
                        doc.addImage(img2, r.foto.substr(-3), x+19, y+29, 22, 27);
                    }
                    x=x+65;
                    doc.setFont("helvetica");
                    // doc.setFontType("bold");
                    // doc.setFontType("bold");
                    doc.setFontSize(10);
                    doc.setTextColor(255,255,255);
                    // doc.text(r.nombre, x-50, y+80);
                    doc.text(r.nombre, x-35, y+76, "center");
                    doc.text(r.unit.unidad, x-35, y+81, "center");
                    // console.log(r.nombre);
                    cont++;
                    conth++;
                });
                doc.save("credenciales.pdf");
                //doc.autoPrint();
                //window.open(doc.output('datauristring',{'a4.pdf'}));
            },
            crear(){
                this.persona={};
            },
            guardar(){
                axios.post('/persona',this.persona).then(res=>{
                    // this.personas=res.data;
                    this.misdatos();
                    $('#exampleModal').modal('hide');
                    this.persona={};
                    this.$swal('Creado!!!','Correctamente','success');
                })
            },
            modificar(i){
                this.persona=i;
                $('#modificar').modal('show');
                // axios.post('/persona',this.persona).then(res=>{
                //     // this.personas=res.data;
                //     this.misdatos();
                //     $('#exampleModal').modal('hide');
                //     this.persona={};
                // })
            },
            photo(i){
                this.persona=i;
                $('#photo').modal('show');
            },
            update(){
                axios.put('/persona/'+this.persona.id,this.persona).then(res=>{
                    // this.personas=res.data;
                    this.misdatos();
                    $('#modificar').modal('hide');
                    this.persona={};
                    this.$swal('Modificado!!!','Correctamente','success');
                })
            },
            eliminar(i){
                    let id=i.id;
                    // this.personas=res.data;

                    // $('#modificar').modal('hide');
                    // this.persona={};
                    this.$swal({
                        title: "Seguro?",
                        text: "De eliminar",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Delete it!"

                    }).then((result) => { // <--
                        if (result.value) { // <-- if confirmed
                            // del('status-delete/' + id);
                            axios.delete('/persona/'+id).then(res=>{
                                // $('#modificar').modal('hide');
                                // this.persona={};
                                this.misdatos();
                                this.$swal('Eliminado!!!','Correctamente','success');
                            })
                        }
                    });
            },
            misdatos(){
                $('#example').DataTable().destroy();
                axios.get('/persona').then(res=>{
                    this.personas=res.data;
                    console.log(this.personas);
                    this.$nextTick(()=>{
                        $('#example').DataTable();
                    })
                })
            }
        }
    }
</script>
