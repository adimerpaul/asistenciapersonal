<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-danger text-white"><i class="fa fa-print"></i> Imprimir Asistencia de trabajo</div>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-circle"></i> Agregar dia de de sistencias
                        </button>
                        <form @submit.enter.prevent="buscar">
                            <div class="form-group row">
                                <label for="mes" class="col-sm-1 col-form-label">Mes</label>
                                <div class="col-sm-2">
                                    <!--                                                    <input type="password" class="form-control" id="" placeholder="Password">-->
                                    <select name="mes" id="mes" class="form-control" v-model="dato.mes" required>
                                        <option v-for="(i,index) in mes" :value="i.id" :key="index">{{i.mes}}</option>
                                    </select>
                                </div>
                                <label for="unidad" class="col-sm-1 col-form-label">Unidad</label>
                                <div class="col-sm-2">
                                    <select name="unit_id" id="unidad" class="form-control" v-model="dato.unit_id" required>
                                        <option v-for="(i,index) in units" :value="i.id" :key="index">{{i.unidad}}</option>
                                    </select>
                                </div>
                                <label for="anio" class="col-sm-1 col-form-label">Año</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="anio" v-model="dato.anio">
<!--                                    <select name="unit_id" id="unidad" class="form-control" v-model="dato.unit_id" required>-->
<!--                                        <option v-for="(i,index) in units" :value="i.id" :key="index">{{i.unidad}}</option>-->
<!--                                    </select>-->
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-primary" ><i class="fa fa-cog"></i> </button>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger"> <i class="fa fa-print"></i> </button>
                                </div>
                            </div>
                        </form>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import datatable from 'datatables.net-dt';
import moment from 'moment';
    export default {
        data(){
          return {
              units:[],
              dato:{},
              personas:[],
              persona:{},
              mes:[
                  {id:1,mes:'Enero'},
                  {id:2,mes:'Febrero'},
                  {id:3,mes:'Marzo'},
                  {id:4,mes:'Abril'},
                  {id:5,mes:'Mayo'},
                  {id:6,mes:'Junio'},
                  {id:7,mes:'Julio'},
                  {id:8,mes:'Agosto'},
                  {id:9,mes:'Septiembre'},
                  {id:10,mes:'Octubre'},
                  {id:11,mes:'Noviembre'},
                  {id:12,mes:'Diciembre'},
              ],
          }
        },
        mounted() {


            // console.log(moment().format('MM'));
            this.dato.mes=parseInt(moment().format('MM'));
            this.dato.anio=parseInt(moment().format('YYYY'));
            // $("#example").DataTable();
            // this.misdatos();
            axios.get('/unit').then(res=>{
                this.units=res.data;
            })
        },
        methods:{
            crear(){
                this.persona={};
            },
            buscar(){
                // this.persona={};
                axios.post('/buscar',this.dato).then(res=>{
                    console.log(res.data)
                });

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
                    this.$nextTick(()=>{
                        $('#example').DataTable();
                    })
                })
            }
        }
    }
</script>
